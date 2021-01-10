<?php
if(!isAuthUser()) {
    header("Location: " . url('auth'), true, 301);
}

printTemplateHtml('user/profile');

