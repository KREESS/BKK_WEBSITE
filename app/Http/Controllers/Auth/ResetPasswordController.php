<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use App\Models\User; // pastikan ini sesuai model kamu


class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Setelah reset password, redirect ke login tanpa auto login.
     */
    protected function redirectTo()
    {
        return '/login';
    }

    /**
     * Override untuk mencegah auto-login setelah reset password.
     */
    protected function resetPassword($user, $password)
    {
        /** @var User $user */
        $user->password = bcrypt($password);
        $user->setRememberToken(Str::random(60)); // error Intelephense akan hilang
        $user->save();
    }
}
