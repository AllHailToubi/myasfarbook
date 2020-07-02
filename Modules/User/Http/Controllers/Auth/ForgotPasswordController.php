<?php

namespace Modules\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends \App\Http\Controllers\Auth\ForgotPasswordController
{
    public function showLinkRequestForm()
    {
        return view('user::auth.passwords.email');
    }
}
