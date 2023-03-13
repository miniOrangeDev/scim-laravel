<?php use MoScim\Helper\DB;?>
<?php echo View::make('mo_scim::menuView'); 
?><main class="app-content">
    <div class="app-title">
        <div>
            <h1>How to Setup?</h1>
        </div>
    </div>
    <p id="oauth_message"></p>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Follow these steps to setup the plugin:</h3>
                        <h4>Step 1:</h4>
                        <ul>
                            <li>Click on 'Generate New Token' if the field is empty.</li>
                        </ul>
                        <h4>Step 2:</h4>
                        <ul>
                            <li>In the name field, select from the dropdown the SCIM attribute you want to map with name column of your user table.</li>
                        </ul>
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
    message.innerText = "' . setupDB::get_option('mo_scim_message') . '"
    </script>';
    unset($_SESSION['show_success_msg']);
    exit();
}
if (isset($_SESSION['show_error_msg'])) {
    echo '<script>
    var message = document.getElementById("oauth_message");
    message.classList.add("error-message");
    message.innerText = "' . DB::get_option('mo_scim_message') . '"
    </script>';
    unset($_SESSION['show_error_msg']);
}
?>