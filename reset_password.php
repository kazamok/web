<?php
/**
 * Password Reset Page
 * @author Amin Mahmoudi (MasterkinG)
 * @copyright    Copyright (c) 2019 - 2024, MasterkinG32. (https://masterkinG32.com)
 * @link    https://masterkinG32.com
 **/

require_once './application/loader.php';

$token = isset($_GET['token']) ? $_GET['token'] : '';
$valid_token = false;
$user_email = '';

if (!empty($token)) {
    // Check token in database
    $query = "SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW() AND used = FALSE";
    $reset_request = database::query($query, [$token])->fetch(PDO::FETCH_ASSOC);

    if ($reset_request) {
        $valid_token = true;
        $user_email = $reset_request['email'];
    } else {
        error_msg(lang('account_is_not_valid')); // Generic message for invalid/expired token
    }
} else {
    error_msg(lang('account_is_not_valid')); // No token provided
}

if (isset($_POST['submit']) && $_POST['submit'] == 'reset_password' && $valid_token) {
    $new_password = $_POST['password'];
    $retype_password = $_POST['repassword'];

    if (empty($new_password) || empty($retype_password)) {
        error_msg(lang('passwords_not_equal')); // Reusing this message for empty fields
    } elseif ($new_password !== $retype_password) {
        error_msg(lang('passwords_not_equal'));
    } elseif (strlen($new_password) < 6) { // Example: minimum password length
        error_msg(lang('passwords_length'));
    } else {
        // Update user's password
        $user_obj = new user();
        if ($user_obj->change_password_by_email($user_email, $new_password)) {
            // Mark token as used
            $query = "UPDATE password_resets SET used = TRUE WHERE token = ?";
            database::query($query, [$token]);
            success_msg(lang('password_changed'));
            // Optionally redirect to login page
            // header('Location: index.php');
            // exit();
        } else {
            error_msg(lang('error_try_again'));
        }
    }
}

// Include header
require_once base_path . 'template/' . get_config('template') . '/tpl/header.php';
?>

<div class="container" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4><?php elang('change_password'); ?></h4>
                </div>
                <div class="card-body">
                    <?php error_msg(); success_msg(); ?>
                    <?php if ($valid_token) { ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="password"><?php elang('new_password'); ?></label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="repassword"><?php elang('retype_new_password'); ?></label>
                                <input type="password" class="form-control" id="repassword" name="repassword" required>
                            </div>
                            <button type="submit" name="submit" value="reset_password" class="site-btn btn-block mt-3"><?php elang('change_password'); ?></button>
                        </form>
                    <?php } else {
                        // Display error message if token is invalid or not provided
                        echo '<p class="text-center">' . lang('account_is_not_valid') . '</p>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
require_once base_path . 'template/' . get_config('template') . '/tpl/footer.php';
?>