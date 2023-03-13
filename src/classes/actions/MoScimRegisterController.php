<?php

namespace MoScim\Classes\Actions;

use Illuminate\Routing\Controller;

class MoScimRegisterController extends Controller {
    public function launch() {
        include_once dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'mo_scim_register.php';
        include_once dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'jsLoader.php';
        
        return view('mo_scim::registerView');
    }
}