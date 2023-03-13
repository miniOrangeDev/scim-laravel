<?php

namespace MoScim\Classes\Actions;

use Illuminate\Routing\Controller;

class MoScimAdminLogoutController extends Controller {
    public function launch() {
        include_once dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'mo_scim_admin_logout.php';
    }
}