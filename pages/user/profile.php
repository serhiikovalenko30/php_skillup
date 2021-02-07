<?php
use App\Auth;

if(!Auth::isAuth()) {
    redirect(url('auth'));
}

printTemplateHtml('user/profile');

