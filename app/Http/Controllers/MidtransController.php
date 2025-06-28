<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Pendaftar;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;


class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function pay(Request $request, Lowongan $lowongan)
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())
            ->where('lowongan_id', $lowongan->id)
            ->firstOrFail();

        $baseOrderId = $pendaftar->kode_pendaftaran;

        $payload = [
            'transaction_details' => [
                'order_id' => $baseOrderId,
                'gross_amount' => $lowongan->pembayaran,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        try {
            // Coba generate token dengan order_id asli dulu
            $snapToken = Snap::getSnapToken($payload);
        } catch (\Exception $e) {
            // Kalau gagal (karena order_id bentrok, dsb), buat order_id unik
            Log::warning("Gagal pakai order_id asli: {$e->getMessage()}");

            $uniqueOrderId = $baseOrderId . '-' . now()->timestamp;
            $payload['transaction_details']['order_id'] = $uniqueOrderId;

            $snapToken = Snap::getSnapToken($payload);
        }

        return view('dashboard.lowongan-tersedia.snap', [
            'snapToken' => $snapToken,
            'users' => auth()->user(),
        ]);
    }



    public function callback(Request $request)
    {
        Log::info('Midtrans Callback:', $request->all());

        $serverKey = config('midtrans.server_key');
        $signatureCheck = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($signatureCheck !== $request->signature_key) {
            Log::error("Signature tidak valid. Diterima: {$request->signature_key}, Dihitung: {$signatureCheck}");
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        if (in_array($request->transaction_status, ['settlement', 'capture'])) {
            $updated = Pendaftar::where('kode_pendaftaran', $request->order_id)
                ->update(['status_pembayaran' => 'lunas']);

            if ($updated) {
                Log::info("Status pembayaran berhasil diperbarui ke 'lunas' untuk order_id: {$request->order_id}");
            } else {
                Log::warning("Tidak ditemukan pendaftar dengan kode_pendaftaran: {$request->order_id}");
            }
        } else {
            Log::info("Transaksi tidak sukses. Status saat ini: {$request->transaction_status}");
        }

        return response()->json(['message' => 'Callback diproses']);
    }

    public function manualUpdate(Request $request)
    {
        $request->validate([
            'order_id' => 'required'
        ]);

        $pendaftar = Pendaftar::where('kode_pendaftaran', $request->order_id)->first();

        if ($pendaftar) {
            $pendaftar->status_pembayaran = 'lunas';
            $pendaftar->save();

            Log::info("Status pembayaran diperbarui manual untuk order_id: {$request->order_id}");

            return response()->json(['message' => 'Status pembayaran diperbarui']);
        }

        Log::warning("Gagal memperbarui status. Pendaftar tidak ditemukan untuk order_id: {$request->order_id}");

        return response()->json(['message' => 'Pendaftar tidak ditemukan'], 404);
    }
}
