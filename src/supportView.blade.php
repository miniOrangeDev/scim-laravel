<?php use MoScim\Helper\DB;
use MoScim\Helper\CustomerDetails as CD;?>
<?php echo View::make('mo_scim::menuView'); 
?><main class="app-content">
    <div class="app-title">
        <div>
            <h1>Support/Contact Us</h1>
        </div>
    </div>

    <p id="oauth_message"></p>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" action="">
                            <p>
                                <b>Need any help? We can help you in setting up SCIM. Just send us a query and we will
                                    get back to you soon.</b>
                            </p>
                            <input type="hidden" name="option"
                                   value="mo_scim_contact_us_query_option"/>
                            <div class="form-group">
                                <label style="font-size: 1.25rem;" for="mo_scim_contact_us_email">Email: </label>
                                <input class="form-control" type="email"
                                       id="mo_scim_contact_us_email" name="mo_scim_contact_us_email" placeholder="Enter your email"
                                       required
                                       value="<?php echo CD::get_option('mo_scim_admin_email');?>">
                            </div>
                            <div class="form-group">
                            <label style="font-size: 1.25rem;" for="mo_scim_contact_us_phone">Contact number (Optional): </label>
                                <input class="form-control" type="tel"
                                       id="mo_scim_contact_us_phone"
                                       name="mo_scim_contact_us_phone"
                                       pattern="[\+]\d{11,14}|[\+]\d{1,4}[\s]\d{9,10}"
                                       placeholder="We call only if you do. 	( eg.+1 9876543210, +91 1234567890 )">
                            </div>
                            <div class="form-group">
                            <label style="font-size: 1.25rem;" for="mo_scim_contact_us_query">Enter your query: </label>
								<textarea class="form-control" id="mo_scim_contact_us_query" name="mo_scim_contact_us_query"
                                          required placeholder="Enter your query here"
                                          onkeypress="mo_scim_valid_query(this)"
                                          onkeyup="mo_scim_valid_query(this)"
                                          onblur="mo_scim_valid_query(this)"
                                          style="height: 150px;"></textarea>
                            </div>

                    </div>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit" name="submit" style="margin-left: 45%;">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    function mo_scim_valid_query(f) {
        !(/^[a-zA-Z?,.\(\)\/@ 0-9]*$/).test(f.value) ? f.value = f.value.replace(
            /[^a-zA-Z?,.\(\)\/@ 0-9]/, '') : null;
    }
</script>
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