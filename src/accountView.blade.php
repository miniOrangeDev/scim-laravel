<?php if (!isset($_SESSION)) session_start();?>
<?php echo View::make('mo_scim::menuView'); 
?><main class="app-content">
    <div class="app-title">
        <div>
            <h1>Account Setup</h1>
        </div>
    </div>

    <?php
    use MoScim\Helper\DB;
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-lg-10">
                        <input type="hidden" value="" id="mo_customer_registered">
                    </div>
                    <div class="col-lg-12">
                        <div id="customer">
                        <?php
                            mo_scim_show_customer_details();
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
<?php
use MoScim\Helper\DB as setupDB;

if (isset($_SESSION['show_success_msg'])) {

    echo '<script>
    var message = document.getElementById("oauth_message");
    message.classList.add("success-message");
    message.innerText = "' . DB::get_option('mo_scim_message') . '";
    </script>';
    unset($_SESSION['show_success_msg']);
    exit();
}
if (isset($_SESSION['show_error_msg'])) {
    echo '<script>
    var message = document.getElementById("oauth_message");
    message.classList.add("error-message");
    message.innerText = "' . DB::get_option('mo_scim_message') . '";
    message.overflow = "break-word";
    </script>';
    unset($_SESSION['show_error_msg']);
}
?>