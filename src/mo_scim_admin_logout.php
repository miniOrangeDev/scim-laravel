<?php
if (!isset($_SESSION)) {
    session_start();
}

unset($_SESSION['authorized']);

session_destroy();

header("Location: mo_scim_admin_login.php");
exit();
?>