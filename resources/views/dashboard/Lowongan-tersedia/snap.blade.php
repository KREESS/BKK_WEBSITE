@extends('dashboard.layouts.main')

@section('container')
<div class="container py-5 text-center">
    <h3>🧾 Proses Pembayaran</h3>
    <p>Mohon tunggu, sedang mengarahkan ke halaman pembayaran Midtrans...</p>
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Midtrans --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
    window.onload = function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                fetch("/midtrans/manual-update", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ order_id: result.order_id })
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pembayaran Berhasil!',
                        text: 'Terima kasih, pembayaran Anda telah diterima.',
                        confirmButtonColor: '#28a745'
                    }).then(() => {
                        window.location.href = "/lamaran";
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Gagal Update Status',
                        text: 'Pembayaran berhasil, tapi status tidak terupdate.',
                        confirmButtonColor: '#ffc107'
                    });
                });
            },
            onPending: function(result) {
                Swal.fire({
                    icon: 'info',
                    title: 'Menunggu Pembayaran',
                    text: 'Silakan selesaikan pembayaran Anda.',
                    confirmButtonColor: '#ffc107'
                }).then(() => {
                    window.location.href = "/lamaran";
                });
            },
            onError: function(result) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Melakukan Pembayaran',
                    text: 'Terjadi kesalahan saat memproses pembayaran.',
                    confirmButtonColor: '#dc3545'
                }).then(() => {
                    window.location.href = "/lamaran";
                });
            }
        });
    };
</script>
@endsection
