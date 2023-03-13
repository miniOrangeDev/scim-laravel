<?php

namespace MoScim;

use MoScim\Classes\Actions\SendAuthnRequest;
use MoScim\Helper\Utilities;

final class Login
{

    public function __construct()
    {
        try {
            SendAuthnRequest::execute();
        } catch (\Exception $e) {
            Utilities::showErrorMessage($e->getMessage());
        }
    }
}

new Login();