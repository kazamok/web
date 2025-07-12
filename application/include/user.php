<?php
/**
 * @author Amin Mahmoudi (MasterkinG)
 * @copyright    Copyright (c) 2019 - 2024, MasterkinG32. (https://masterking32.com)
 * @link    https://masterking32.com
 **/

use Gregwar\Captcha\CaptchaBuilder;

class user
{
    public static $captcha;

    public static function initCaptcha() {
        global $config;
        if (empty($config['captcha_type'])) {
            if (!isset(self::$captcha)) {
                self::$captcha = new CaptchaBuilder;
                self::$captcha->build();
                $_SESSION['captcha'] = self::$captcha->getPhrase();
            }
        }
    }

    public static function post_handler()
    {
        error_log("post_handler entered. Request method: " . $_SERVER['REQUEST_METHOD'] . ", POST data: " . print_r($_POST, true)); // New log
        global $error_error, $success_msg;
        $error_error = "";
        $success_msg = "";
        // if (!empty($_GET['restore']) && !empty($_GET['key'])) { // Commented out for debugging
        //     self::restorepassword_setnewpw($_GET['restore'], $_GET['key']); // Commented out for debugging
        // } // Commented out for debugging

        if (!empty($_GET['enabletfa']) && !empty($_GET['account'])) {
            self::account_set_2fa($_GET['enabletfa'], $_GET['account']);
        }

        if (!empty($_POST['langchangever'])) {
            self::lang_cookie_changer($_POST['langchange']);
        }

        if (!empty($_POST['submit']) || !empty($_POST['action_type'])) {
            self::tfa_enable();
            if (get_config('battlenet_support')) {
                self::bnet_register();
                self::bnet_changepass();
            } else {
                self::normal_register();
                self::normal_changepass();
            }
            self::restorepassword();
            // Handle setting security question
            if (!empty($_POST['submit']) && $_POST['submit'] == 'set_security_question') {
                if (isset($_SESSION['id']) && !empty($_POST['security_question_id']) && !empty($_POST['security_answer'])) {
                    if (self::set_security_question($_SESSION['id'], $_POST['security_question_id'], $_POST['security_answer'])) {
                        success_msg("보안 질문이 성공적으로 설정되었습니다.");
                    } else {
                        error_msg("보안 질문 설정 중 오류가 발생했습니다.");
                    }
                } else {
                    error_msg("보안 질문 및 답변을 모두 입력해주세요.");
                }
            }
            // Handle forgot password via security question (AJAX)
            elseif (!empty($_POST['submit']) && $_POST['submit'] == 'forgot_password_security_question') {
                error_log("forgot_password_security_question handler entered.");
                header('Content-Type: application/json'); // Set header for JSON response
                if (!empty($_POST['username'])) {
                    $username = strtoupper($_POST['username']);
                    error_log("Username received: " . $username);
                    $user_data = self::get_user_by_username($username);
                    error_log("User data from get_user_by_username: " . print_r($user_data, true));
                    if ($user_data) {
                        $user_security_data = self::get_user_security_question($user_data['id']);
                        error_log("User security data from get_user_security_question: " . print_r($user_security_data, true));
                        if ($user_security_data && !empty($user_security_data['security_question_id'])) {
                            $_SESSION['temp_recovery_user_id'] = $user_data['id']; // Store user ID in session
                            $security_questions_list = get_security_questions_list();
                            $question_text = isset($security_questions_list[$user_security_data['security_question_id']]) ? $security_questions_list[$user_security_data['security_question_id']] : '알 수 없는 질문';
                            error_log("Question text: " . $question_text);
                            echo json_encode([
                                'status' => 'success',
                                'user_id' => $user_data['id'],
                                'security_question_id' => $user_security_data['security_question_id'],
                                'security_question' => $question_text
                            ]);
                        } else {
                            error_log("No security question set for user or security_question_id is empty.");
                            echo json_encode(['status' => 'error', 'message' => '이 계정에는 보안 질문이 설정되어 있지 않습니다.']);
                        }
                    } else {
                        error_log("User not found for username: " . $username);
                        echo json_encode(['status' => 'error', 'message' => '사용자 이름을 찾을 수 없습니다.']);
                    }
                } else {
                    error_log("Username is empty.");
                    echo json_encode(['status' => 'error', 'message' => '사용자 이름을 입력해주세요.']);
                }
                exit(); // Terminate script after sending JSON response
            }
            // Handle verify security answer from modal (AJAX)
            elseif (!empty($_POST['submit']) && $_POST['submit'] == 'verify_security_answer_modal') {
                error_log("verify_security_answer_modal handler entered.");
                header('Content-Type: application/json');
                $user_id = isset($_SESSION['temp_recovery_user_id']) ? $_SESSION['temp_recovery_user_id'] : null;
                $submitted_answer = $_POST['security_answer'];

                error_log("User ID: " . ($user_id ? $user_id : "NULL"));
                error_log("Submitted Answer: " . $submitted_answer);

                if ($user_id && self::verify_security_answer($user_id, $submitted_answer)) {
                    error_log("Security answer verification SUCCESS.");
                    echo json_encode(['status' => 'success', 'message' => '보안 질문 답변이 확인되었습니다.']);
                } else {
                    error_log("Security answer verification FAILED.");
                    echo json_encode(['status' => 'error', 'message' => '보안 질문 답변이 올바르지 않습니다.']);
                }
                exit();
            }
            // Handle password reset from modal (AJAX)
            elseif (!empty($_POST['submit']) && $_POST['submit'] == 'reset_password_modal') {
                header('Content-Type: application/json');
                $user_id = isset($_SESSION['temp_recovery_user_id']) ? $_SESSION['temp_recovery_user_id'] : null;
                $new_password = $_POST['password'];
                $retype_password = $_POST['repassword'];

                if (!$user_id) {
                    echo json_encode(['status' => 'error', 'message' => '잘못된 접근입니다. 비밀번호 복구 절차를 다시 시작해주세요.']);
                    exit();
                }

                if (empty($new_password) || empty($retype_password)) {
                    echo json_encode(['status' => 'error', 'message' => lang('passwords_not_equal')]);
                } elseif ($new_password !== $retype_password) {
                    echo json_encode(['status' => 'error', 'message' => lang('passwords_not_equal')]);
                } elseif (strlen($new_password) < 6) {
                    echo json_encode(['status' => 'error', 'message' => lang('passwords_length')]);
                } else {
                    $user_obj = new user();
                    $user_info = user::get_user_by_id($user_id);
                    if ($user_info && $user_obj->change_password_by_email($user_info['email'], $new_password)) {
                        // Clear session variables after successful reset
                        unset($_SESSION['temp_recovery_user_id']);
                        echo json_encode(['status' => 'success', 'message' => lang('password_changed')]);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => lang('error_try_again')]);
                    }
                }
                exit();
            }
            self::handle_forgot_password_request(); // Call the original method for email-based recovery (if still needed)
            if (!empty($_POST['submit']) && $_POST['submit'] == 'login') {
                self::login();
            } elseif (!empty($_POST['action_type']) && $_POST['action_type'] == 'logout') { // Handle logout
                error_log("Logout initiated. Session ID before: " . session_id());
                error_log("Session data before unset: " . print_r($_SESSION, true));

                $splash_shown = isset($_SESSION['splash_shown']) ? $_SESSION['splash_shown'] : false; // Save splash_shown state
                session_unset(); // Unset all session variables
                error_log("Session data after unset: " . print_r($_SESSION, true));

                session_destroy(); // Destroy the session
                error_log("Session data after destroy (should be empty): " . print_r($_SESSION, true)); // Note: $_SESSION might still show data right after destroy, but it's marked for deletion

                session_start(); // Start a new session
                error_log("Session ID after new session_start: " . session_id());
                error_log("Session data after new session_start (should be empty except for splash_shown): " . print_r($_SESSION, true));

                $_SESSION['splash_shown'] = $splash_shown; // Restore splash_shown state
                error_log("Session data after restoring splash_shown: " . print_r($_SESSION, true));

                header("Location: " . get_config("baseurl")); // Redirect to home page after logout
                exit();
            }

        } else {

        }
    }

    public static function login()
    {
        global $antiXss;

        if (empty($_POST['username']) || empty($_POST['password'])) {
            error_msg(lang('fill_all_fields'));
            return false;
        }

        $username = strtoupper($_POST['username']);
        $password = $_POST['password'];

        if (get_config('battlenet_support')) {
            $userinfo = self::get_user_by_email($username);
        } else {
            $userinfo = self::get_user_by_username($username);
        }

        if (empty($userinfo)) {
            error_log("Login username not correct message called.");
            error_msg(lang('username_not_correct'));
            return false;
        }

        if (empty(get_config('srp6_support'))) {
            $hashed_pass = strtoupper(sha1(strtoupper($userinfo['username']) . ':' . $password));
            if ($userinfo['sha_pass_hash'] != $hashed_pass) {
                error_msg(lang('password_not_correct'));
                return false;
            }
        } else {
            if (get_config('battlenet_support')) {
                if (get_config('srp6_version') == 1) {
                    if (!verifySRP6BnetV1($userinfo['email'], $password, $userinfo[get_core_config("salt_field")], $userinfo[get_core_config("verifier_field")])) {
                        error_msg(lang('password_not_correct'));
                        return false;
                    }
                } elseif (get_config('srp6_version') == 2) {
                    if (!verifySRP6BnetV2($userinfo['email'], $password, $userinfo[get_core_config("salt_field")], $userinfo[get_core_config("verifier_field")])) {
                        error_log("Login password incorrect message called.");
                        error_msg(lang('password_not_correct'));
                        return false;
                    }
                } else {
                    if (!verifySRP6($userinfo['username'], $password, $userinfo[get_core_config("salt_field")], $userinfo[get_core_config("verifier_field")])) {
                        error_log("Login password incorrect message called.");
                        error_msg(lang('password_not_correct'));
                        return false;
                    }
                }
            } else {
                if (!verifySRP6($userinfo['username'], $password, $userinfo[get_core_config("salt_field")], $userinfo[get_core_config("verifier_field")])) {
                    error_msg(lang('password_not_correct'));
                    return false;
                }
            }
        }

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $userinfo['username'];
        $_SESSION['email'] = $userinfo['email'];
        $_SESSION['id'] = $userinfo['id'];

        // Get characters and store in session
        $_SESSION['characters'] = self::get_characters_by_account_id($userinfo['id']);
        error_log("Characters in session: " . print_r($_SESSION['characters'], true));

        error_log("Login success message called.");
        success_msg(lang('logged_in_successfully'));
    }

    public static function get_characters_by_account_id($account_id)
    {
        if (empty($account_id)) {
            return false;
        }

        $all_characters = [];
        foreach (get_config('realmlists') as $realm) {
            $queryBuilder = database::$chars[$realm['realmid']]->createQueryBuilder();
            $queryBuilder->select(
                'c.name',
                'c.level',
                'c.race',
                'c.class',
                'c.gender',
                'c.zone' // Added zone
            )
            ->from('characters', 'c') // Added alias
            ->where('c.account = :account_id') // Used alias
            ->setParameter('account_id', $account_id);

            $statement = $queryBuilder->executeQuery();
            $characters = $statement->fetchAllAssociative();

            if (!empty($characters)) {
                $all_characters = array_merge($all_characters, $characters);
            }
        }
        return $all_characters;
    }

    /**
     * Language Changer
     */
    public static function lang_cookie_changer($getlang)
    {
        $supported_langs = get_config('supported_langs');
        if (!empty($supported_langs) && !empty($supported_langs[$getlang])) {
            setcookie('website_lang', $getlang); //sets the language cookie to selected language
            header("location: " . get_config("baseurl"));
            exit();
        }
    }

    /**
     * Battle.net registration
     * @return bool
     */
    public static function bnet_register()
    {
        global $antiXss;
        if ($_POST['submit'] != 'register' || empty($_POST['password']) || empty($_POST['repassword']) || empty($_POST['email'])) {
            return false;
        }

        if (!captcha_validation()) {
            return false;
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            error_msg(lang('use_valid_email'));
            return false;
        }

        if ($_POST['password'] != $_POST['repassword']) {
            error_msg(lang('passwords_not_equal'));
            return false;
        }

        if(get_config('srp6_support') && get_config('srp6_version') == 2) {
            if (!(strlen($_POST['password']) >= 4 && strlen($_POST['password']) <= 128)) {
                error_msg(lang('passwords_length'));
                return false;
            }
        }
        else {
            if (!(strlen($_POST['password']) >= 4 && strlen($_POST['password']) <= 16)) {
                error_msg(lang('passwords_length'));
                return false;
            }
        }

        if (!self::check_email_exists(strtoupper($_POST["email"]))) {
            error_msg(lang('username_or_email_exists'));
            return false;
        }

        if (empty(get_config('soap_for_register'))) {
            if (empty(get_config('srp6_support'))) {
                $bnet_hashed_pass = strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash('sha256', strtoupper(hash('sha256', strtoupper($_POST['email'])) . ':' . strtoupper($_POST['password']))))))));
                database::$auth->insert('battlenet_accounts', [
                    'email' => $antiXss->xss_clean(strtoupper($_POST['email'])),
                    'sha_pass_hash' => $antiXss->xss_clean($bnet_hashed_pass),
                ]);
                
                $bnet_account_id = database::$auth->lastInsertId();
                $username = $bnet_account_id . '#1';
                database::$auth->insert('account', [
                    'username' => $antiXss->xss_clean(strtoupper($username)),
                    'email' => $antiXss->xss_clean(strtoupper($_POST['email'])),
                    'expansion' => $antiXss->xss_clean(get_config('expansion')),
                    'battlenet_account' => $bnet_account_id,
                    'battlenet_index' => 1,
                ]);
            } else {
                if(get_config('srp6_version') == 1) {
                    list($salt, $verifier) = getRegistrationDataBnetV1(strtoupper($_POST['email']), $_POST['password']);
                    database::$auth->insert('battlenet_accounts', [
                        'email' => $antiXss->xss_clean(strtoupper($_POST['email'])),
                        'srp_version' => 1,
                        get_core_config("salt_field") => $salt,
                        get_core_config("verifier_field") => $verifier,
                    ]);
                    
                    $bnet_account_id = database::$auth->lastInsertId();
                    $game_account_name = $bnet_account_id . '#1';
                    list($game_account_salt, $game_account_verifier) = getRegistrationData($game_account_name, $_POST['password']);
                    database::$auth->insert('account', [
                        'username' => $antiXss->xss_clean($game_account_name),
                        get_core_config("salt_field") => $game_account_salt,
                        get_core_config("verifier_field") => $game_account_verifier,
                        'email' => $antiXss->xss_clean(strtoupper($_POST['email'])),
                        'expansion' => $antiXss->xss_clean(get_config('expansion')),
                        'battlenet_account' => $bnet_account_id,
                        'battlenet_index' => 1,
                    ]);
                }
                
                if(get_config('srp6_version') == 2) {
                    list($salt, $verifier) = getRegistrationDataBnetV2(strtoupper($_POST['email']), $_POST['password']);
                    database::$auth->insert('battlenet_accounts', [
                        'email' => $antiXss->xss_clean(strtoupper($_POST['email'])),
                        'srp_version' => 2,
                        get_core_config("salt_field") => $salt,
                        get_core_config("verifier_field") => $verifier,
                    ]);
                    
                    $bnet_account_id = database::$auth->lastInsertId();
                    $game_account_name = $bnet_account_id . '#1';
                    list($game_account_salt, $game_account_verifier) = getRegistrationData($game_account_name, substr($_POST['password'], 0, 16));
                    database::$auth->insert('account', [
                        'username' => $antiXss->xss_clean($game_account_name),
                        get_core_config("salt_field") => $game_account_salt,
                        get_core_config("verifier_field") => $game_account_verifier,
                        'email' => $antiXss->xss_clean(strtoupper($_POST['email'])),
                        'expansion' => $antiXss->xss_clean(get_config('expansion')),
                        'battlenet_account' => $bnet_account_id,
                        'battlenet_index' => 1,
                    ]);
                }
            }
            success_msg(lang('account_created'));
        }

        $command = str_replace('{USERNAME}', $antiXss->xss_clean($_POST['email']), get_config('soap_ca_command'));
        $command = str_replace('{PASSWORD}', $antiXss->xss_clean($_POST['password']), $command);
        if (RemoteCommandWithSOAP($command)) {
            success_msg(lang('account_created'));
        } else {
            error_msg(lang('error_try_again'));
        }
    }

    /**
     * Registration without battle net servers.
     * @return bool
     */
    public static function normal_register()
    {
        global $antiXss;
        if ($_POST['submit'] != 'register' || empty($_POST['password']) || empty($_POST['username']) || empty($_POST['repassword']) || empty($_POST['email'])) {
            return false;
        }

        if (!captcha_validation()) {
            return false;
        }

        if (!preg_match('/^[0-9A-Z-_]+$/', strtoupper($_POST['username']))) {
            error_msg(lang('use_valid_username'));
            return false;
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            error_msg(lang('use_valid_email'));
            return false;
        }

        if ($_POST['password'] != $_POST['repassword']) {
            error_msg(lang('passwords_not_equal'));
            return false;
        }

        if (!(strlen($_POST['password']) >= 4 && strlen($_POST['password']) <= 16)) {
            error_msg(lang('passwords_length'));
            return false;
        }

        if (!(strlen($_POST['username']) >= 2 && strlen($_POST['username']) <= 16)) {
            error_msg(lang('username_length'));
            return false;
        }

        if (!get_config('multiple_email_use') && !self::check_email_exists(strtoupper($_POST['email']))) {
            error_msg(lang('email_exists'));
            return false;
        }

        if (!self::check_username_exists(strtoupper($_POST['username']))) {
            error_msg(lang('username_exists'));
            return false;
        }

        if (empty(get_config('soap_for_register'))) {
            if (empty(get_config('srp6_support'))) {
                $hashed_pass = strtoupper(sha1(strtoupper($_POST['username'] . ':' . $_POST['password'])));
                database::$auth->insert('account', [
                    'username' => $antiXss->xss_clean(strtoupper($_POST['username'])),
                    'sha_pass_hash' => $antiXss->xss_clean($hashed_pass),
                    'email' => $antiXss->xss_clean(strtoupper($_POST['email'])),
                    //'reg_mail' => $antiXss->xss_clean(strtoupper($_POST['email'])),
                    'expansion' => $antiXss->xss_clean(get_config('expansion')),
                ]);
            } else {
                list($salt, $verifier) = getRegistrationData(strtoupper($_POST['username']), $_POST['password']);
                database::$auth->insert('account', [
                    'username' => $antiXss->xss_clean(strtoupper($_POST['username'])),
                    get_core_config("salt_field") => $salt,
                    get_core_config("verifier_field") => $verifier,
                    'email' => $antiXss->xss_clean(strtoupper($_POST['email'])),
                    'expansion' => $antiXss->xss_clean(get_config('expansion')),
                ]);
            }
            success_msg(lang('account_created'));
        } else {
            $command = str_replace('{USERNAME}', $antiXss->xss_clean(strtoupper($_POST['username'])), get_config('soap_ca_command'));
            $command = str_replace('{PASSWORD}', $antiXss->xss_clean($_POST['password']), $command);
            $command = str_replace('{EMAIL}', $antiXss->xss_clean(strtoupper($_POST['email'])), $command);
            if (RemoteCommandWithSOAP($command)) {
                if (!empty(get_config('soap_asa_command'))) {
                    $command_addon = str_replace('{USERNAME}', $antiXss->xss_clean(strtoupper($_POST['username'])), get_config('soap_asa_command'));
                    $command_addon = str_replace('{EXPANSION}', get_config('expansion'), $command_addon);
                    RemoteCommandWithSOAP($command_addon);
                }

                $queryBuilder = database::$auth->createQueryBuilder();
                $queryBuilder->update('account')
                    ->set('email', ':email')
                    ->where('username = :username')
                    ->setParameter('email', $antiXss->xss_clean(strtoupper($_POST['email'])))
                    ->setParameter('username', $antiXss->xss_clean(strtoupper($_POST['username'])));
                $queryBuilder->executeQuery();

                success_msg(lang('account_created'));
            } else {
                error_msg(lang('error_try_again'));
            }
        }
    }

    /**
     * Change password for Battle.net Cores.
     * @return bool
     */
    public static function bnet_changepass()
    {
        global $antiXss;

        if (!empty(get_config('disable_changepassword'))) {
            return false;
        }

        if ($_POST['submit'] != 'changepass' || empty($_POST['password']) || empty($_POST['old_password']) || empty($_POST['repassword']) || empty($_POST['email'])) {
            return false;
        }

        if (!captcha_validation()) {
            return false;
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            error_msg(lang('use_valid_email'));
            return false;
        }

        if ($_POST['password'] != $_POST['repassword']) {

            error_msg(lang('passwords_not_equal'));
            return false;
        }

        if(get_config('srp6_support') && get_config('srp6_version') == 2) {
            if (!(strlen($_POST['password']) >= 4 && strlen($_POST['password']) <= 128)) {
                error_msg(lang('passwords_length'));
                return false;
            }
        }
        else {
            if (!(strlen($_POST['password']) >= 4 && strlen($_POST['password']) <= 16)) {
                error_msg(lang('passwords_length'));
                return false;
            }
        }

        $userinfo = self::get_user_by_email(strtoupper($_POST['email']));
        if ((empty(get_config('srp6_support')) && empty($userinfo['username'])) || (!empty(get_config('srp6_support')) && (get_config('srp6_version') == 0) && empty($userinfo['username']))) {
            error_msg(lang('email_not_correct'));
            return false;
        }

        $bnetAccountInfo = self::get_bnetaccount_by_email(strtoupper($_POST['email']));
        if (empty($bnetAccountInfo['email']) && !empty(get_config('srp6_support')) && (get_config('srp6_version') > 0)) {
            error_msg(lang('email_not_correct'));
            return false;
        }

        if (empty(get_config('srp6_support'))) {
            $Old_hashed_pass = strtoupper(sha1(strtoupper($userinfo['username'] . ':' . $_POST['old_password'])));
            $hashed_pass = strtoupper(sha1(strtoupper($userinfo['username'] . ':' . $_POST['password'])));

            if (strtoupper($userinfo['sha_pass_hash']) != $Old_hashed_pass) {
                error_msg(lang('old_password_not_valid'));
                return false;
            }

            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->update('account')
                ->set('sha_pass_hash', ':sha_pass_hash')
                ->set('sessionkey', '')
                ->set('v', '')
                ->set('s', '')
                ->where('id = :id')
                ->setParameter('sha_pass_hash', $antiXss->xss_clean($hashed_pass))
                ->setParameter('id', $userinfo['id']);
            $queryBuilder->executeQuery();

            $bnet_hashed_pass = strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash('sha256', strtoupper(hash('sha256', strtoupper($userinfo['email'])) . ':' . strtoupper($_POST['password']))))))));

            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->update('battlenet_accounts')
                ->set('sha_pass_hash', ':sha_pass_hash')
                ->set('sessionkey', '')
                ->set('v', '')
                ->set('s', '')
                ->where('id = :id')
                ->setParameter('sha_pass_hash', $antiXss->xss_clean($bnet_hashed_pass))
                ->setParameter('id', $userinfo['battlenet_account']);
            $queryBuilder->executeQuery();
        } else {
            if (get_config('srp6_version') == 0) {
                if (!verifySRP6($userinfo['username'], $_POST['old_password'], $userinfo[get_core_config("salt_field")], $userinfo[get_core_config("verifier_field")])) {
                error_msg(lang('old_password_not_valid'));
                return false;
                }
                
                list($salt, $verifier) = getRegistrationData(strtoupper($userinfo['username']), $_POST['password']);
                
                $queryBuilder = database::$auth->createQueryBuilder();
                $queryBuilder->update('account')
                    ->set(get_core_config("salt_field"), ':salt')
                    ->set(get_core_config("verifier_field"), ':verifier')
                    ->where('id = :id')
                    ->setParameter('salt', $salt)
                    ->setParameter('verifier', $verifier)
                    ->setParameter('id', $userinfo['id']);
                $queryBuilder->executeQuery();
            }
            if (get_config('srp6_version') == 1) {
                if (!verifySRP6BnetV1($bnetAccountInfo['email'], $_POST['old_password'], $bnetAccountInfo[get_core_config("salt_field")], $bnetAccountInfo[get_core_config("verifier_field")])) {
                    error_msg(lang('old_password_not_valid'));
                    return false;
                }

                $game_account_name = $bnetAccountInfo['id'] . '#1';
                list($salt, $verifier) = getRegistrationData($game_account_name, substr($_POST['password'], 0, 16));
                
                $queryBuilder = database::$auth->createQueryBuilder();
                $queryBuilder->update('account')
                    ->set(get_core_config("salt_field"), ':salt')
                    ->set(get_core_config("verifier_field"), ':verifier')
                    ->where('email = :email')
                    ->setParameter('salt', $salt)
                    ->setParameter('verifier', $verifier)
                    ->setParameter('email', $bnetAccountInfo['email']);
                $queryBuilder->executeQuery();
                
                list($salt, $verifier) = getRegistrationDataBnetV1($bnetAccountInfo['email'], $_POST['password']);
                
                $queryBuilder = database::$auth->createQueryBuilder();
                $queryBuilder->update('battlenet_accounts')
                    ->set('srp_version', 1)
                    ->set(get_core_config("salt_field"), ':salt')
                    ->set(get_core_config("verifier_field"), ':verifier')
                    ->where('id = :id')
                    ->setParameter('salt', $salt)
                    ->setParameter('verifier', $verifier)
                    ->setParameter('id', $bnetAccountInfo['id']);
                $queryBuilder->executeQuery();
            }
            if (get_config('srp6_version') == 2) {
                if (!verifySRP6BnetV2($bnetAccountInfo['email'], $_POST['old_password'], $bnetAccountInfo[get_core_config("salt_field")], $bnetAccountInfo[get_core_config("verifier_field")])) {
                    error_msg($bnetAccountInfo[get_core_config("salt_field")]);
                    return false;
                }
                
                $game_account_name = $bnetAccountInfo['id'] . '#1';
                list($salt, $verifier) = getRegistrationData($game_account_name, substr($_POST['password'], 0, 16));
                
                $queryBuilder = database::$auth->createQueryBuilder();
                $queryBuilder->update('account')
                    ->set(get_core_config("salt_field"), ':salt')
                    ->set(get_core_config("verifier_field"), ':verifier')
                    ->where('email = :email')
                    ->setParameter('salt', $salt)
                    ->setParameter('verifier', $verifier)
                    ->setParameter('email', $bnetAccountInfo['email']);
                $queryBuilder->executeQuery();
                
                list($salt, $verifier) = getRegistrationDataBnetV2($bnetAccountInfo['email'], $_POST['password']);
                
                $queryBuilder = database::$auth->createQueryBuilder();
                $queryBuilder->update('battlenet_accounts')
                    ->set('srp_version', 2)
                    ->set(get_core_config("salt_field"), ':salt')
                    ->set(get_core_config("verifier_field"), ':verifier')
                    ->where('id = :id')
                    ->setParameter('salt', $salt)
                    ->setParameter('verifier', $verifier)
                    ->setParameter('id', $bnetAccountInfo['id']);
                $queryBuilder->executeQuery();
            }
        }

        success_msg(lang('password_changed'));
        return true;
    }

    /**
     * Change password for normal servers.
     * @return bool
     */
    public static function normal_changepass()
    {
        global $antiXss;

        if (!empty(get_config('disable_changepassword'))) {
            return false;
        }

        if ($_POST['submit'] != 'changepass' || empty($_POST['password']) || empty($_POST['old_password']) || empty($_POST['repassword']) || empty($_POST['username'])) {
            return false;
        }

        if (!captcha_validation()) {
            return false;
        }

        if ($_POST['password'] != $_POST['repassword']) {
            error_msg(lang('passwords_not_equal'));
            return false;
        }

        if (!(strlen($_POST['password']) >= 4 && strlen($_POST['password']) <= 16)) {
            error_msg(lang('passwords_length'));
            return false;
        }

        $userinfo = self::get_user_by_username(strtoupper($_POST['username']));
        if (empty($userinfo['username'])) {
            error_msg(lang('username_not_correct'));
            return false;
        }

        if (empty(get_config('srp6_support'))) {
            $Old_hashed_pass = strtoupper(sha1(strtoupper($userinfo['username'] . ':' . $_POST['old_password'])));
            $hashed_pass = strtoupper(sha1(strtoupper($userinfo['username'] . ':' . $_POST['password'])));
            if (strtoupper($userinfo['sha_pass_hash']) != $Old_hashed_pass) {
                error_msg(lang('old_password_not_valid'));
                return false;
            }

            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->update('account')
                ->set('sha_pass_hash', ':sha_pass_hash')
                ->set('sessionkey', '')
                ->set('v', '')
                ->set('s', '')
                ->where('id = :id')
                ->setParameter('sha_pass_hash', $antiXss->xss_clean($hashed_pass))
                ->setParameter('id', $userinfo['id']);
            $queryBuilder->executeQuery();
        } else {
            if (!verifySRP6($userinfo['username'], $_POST['old_password'], $userinfo[get_core_config("salt_field")], $userinfo[get_core_config("verifier_field")])) {
                error_msg(lang('old_password_not_valid'));
                return false;
            }

            list($salt, $verifier) = getRegistrationData(strtoupper($userinfo['username']), $_POST['password']);

            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->update('account')
                ->set(get_core_config("salt_field"), ':salt')
                ->set(get_core_config("verifier_field"), ':verifier')
                ->where('id = :id')
                ->setParameter('salt', $salt)
                ->setParameter('verifier', $verifier)
                ->setParameter('id', $userinfo['id']);
            $queryBuilder->executeQuery();
        }

        success_msg(lang('password_changed'));
        return true;
    }

    /**
     * Change password for normal servers.
     * @return bool
     */
    public static function handle_forgot_password_request()
    {
        if (isset($_POST['submit']) && $_POST['submit'] == 'forgot_password') {
            $email = $_POST['email'];

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                error_msg(lang('use_valid_email'));
            } else {
                $user_data = null;
                if (get_config('battlenet_support')) {
                    $user_data = self::get_bnetaccount_by_email($email);
                } else {
                    $user_data = self::get_user_by_email($email);
                }

                if (!$user_data) {
                    error_msg(lang('email_not_correct')); // Generic message to avoid user enumeration
                } else {
                    // Generate a unique token
                    $token = bin2hex(random_bytes(32)); // 64 characters long

                    // Set token expiration (e.g., 1 hour from now)
                    $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

                    // Store token in password_resets table
                    $query = "INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)";
                    database::query($query, [$email, $token, $expires_at]);

                    // Construct reset link
                    $reset_link = get_config('baseurl') . '/reset_password.php?token=' . $token;

                    // Send email
                    $subject = "Password Reset Request";
                    $message = "Hello,\n\nYou have requested a password reset for your account. Please click the following link to reset your password:\n\n" . $reset_link . "\n\nThis link will expire in 1 hour.\n\nIf you did not request a password reset, please ignore this email.\n\n" . get_config('page_title');

                    if (send_phpmailer($email, $subject, $message)) {
                        success_msg(lang('check_your_email'));
                    } else {
                        error_msg(lang('error_try_again'));
                    }
                }
            }
            return true; // Indicate that this handler processed the request
        }
        return false; // Indicate that this handler did not process the request
    }

    public static function restorepassword()
    {
        global $antiXss;
        if ($_POST['submit'] != 'restorepassword') {
            return false;
        }

        if (get_config('battlenet_support') && empty($_POST['email'])) {
            return false;
        } elseif (!get_config('battlenet_support') && empty($_POST['username'])) {
            return false;
        }

        if (!captcha_validation()) {
            return false;
        }

        if (get_config('battlenet_support')) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                error_msg(lang('use_valid_email'));
                return false;
            }

            $userinfo = self::get_user_by_email(strtoupper($_POST['email']));
            if (empty($userinfo['email'])) {
                error_msg(lang('email_not_correct'));
                return false;
            }

            $field_acc = $userinfo['email'];
        } else {
            if (!preg_match('/^[0-9A-Z-_]+$/', strtoupper($_POST['username']))) {
                error_msg(lang('use_valid_username'));
                return false;
            }

            $userinfo = self::get_user_by_username(strtoupper($_POST['username']));
            if (empty($userinfo['email'])) {
                error_msg(lang('username_not_correct'));
                return false;
            }

            $field_acc = $userinfo['username'];
        }

        if (!isset($userinfo['restore_key'])) {
            self::add_password_key_to_acctbl();
        }

        $restore_key = strtolower(md5(time() . mt_rand(1000, 9999)) . mt_rand(10000, 99999));

        $queryBuilder = database::$auth->createQueryBuilder();
        $queryBuilder->update('account')
            ->set('restore_key', ':restore_key')
            ->where('id = :id')
            ->setParameter('restore_key', $antiXss->xss_clean($restore_key))
            ->setParameter('id', $userinfo['id']);
        $queryBuilder->executeQuery();

        $restorepass_URL = get_config('baseurl') . '/index.php?restore=' . strtolower($field_acc) . '&key=' . $restore_key;
        $message = "For restore you game account open <a href='$restorepass_URL' target='_blank'>this link</a>: <BR>$restorepass_URL";
        send_phpmailer(strtolower($userinfo['email']), lang('restore_account_password'), $message);
        success_msg(lang('check_your_email'));
        return true;
    }

    public static function restorepassword_setnewpw($user_data, $restore_key)
    {
        global $antiXss;
        if (empty($user_data) || empty($restore_key)) {
            return false;
        }

        if ($restore_key == 1 || strlen($restore_key) < 30) {
            return false;
        }

        if (get_config('battlenet_support')) {
            if (!filter_var($user_data, FILTER_VALIDATE_EMAIL)) {
                return false;
            }

            $userinfo = self::get_user_by_email(strtoupper($user_data));
        } else {
            if (!preg_match('/^[0-9A-Z-_]+$/', strtoupper($user_data))) {
                error_msg(lang('use_valid_username'));
                return false;
            }

            $userinfo = self::get_user_by_username(strtoupper($user_data));
        }

        if (empty($userinfo['email'])) {
            return false;
        }

        if ($userinfo['restore_key'] != $restore_key) {
            return false;
        }

        $new_password = generateRandomString(12);

        if (get_config('battlenet_support')) {
            $message = 'Your new account information : <br>Email: ' . strtolower($userinfo['email']) . '<br>Password: ' . $new_password;
            if (empty(get_config('srp6_support'))) {
                $hashed_pass = strtoupper(sha1(strtoupper($userinfo['username'] . ':' . $new_password)));

                $queryBuilder = database::$auth->createQueryBuilder();
                $queryBuilder->update('account')
                    ->set('sha_pass_hash', ':sha_pass_hash')
                    ->set('sessionkey', '')
                    ->set('v', '')
                    ->set('s', '')
                    ->set('restore_key', '1')
                    ->where('id = :id')
                    ->setParameter('sha_pass_hash', $antiXss->xss_clean($hashed_pass))
                    ->setParameter('id', $userinfo['id']);
                $queryBuilder->executeQuery();
            } else {
                list($salt, $verifier) = getRegistrationData(strtoupper($userinfo['username']), $new_password);

                $queryBuilder = database::$auth->createQueryBuilder();
                $queryBuilder->update('account')
                    ->set(get_core_config("salt_field"), ':salt')
                    ->set(get_core_config("verifier_field"), ':verifier')
                    ->set('restore_key', '1')
                    ->where('id = :id')
                    ->setParameter('salt', $salt)
                    ->setParameter('verifier', $verifier)
                    ->setParameter('id', $userinfo['id']);
                $queryBuilder->executeQuery();
            }

            $bnet_hashed_pass = strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash('sha256', strtoupper(hash('sha256', strtoupper($userinfo['email'])) . ':' . strtoupper($new_password))))))));

            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->update('battlenet_accounts')
                ->set('sha_pass_hash', ':sha_pass_hash')
                ->where('id = :id')
                ->setParameter('sha_pass_hash', $antiXss->xss_clean($bnet_hashed_pass))
                ->setParameter('id', $userinfo['battlenet_account']);
            $queryBuilder->executeQuery();
        } else {
            $message = 'Your new account information : <br>Username: ' . strtolower($userinfo['username']) . '<br>Password: ' . $new_password;
            if (empty(get_config('soap_for_register'))) {
                if (empty(get_config('srp6_support'))) {
                    $hashed_pass = strtoupper(sha1(strtoupper($userinfo['username'] . ':' . $new_password)));

                    $queryBuilder = database::$auth->createQueryBuilder();
                    $queryBuilder->update('account')
                        ->set('sha_pass_hash', ':sha_pass_hash')
                        ->set('sessionkey', '')
                        ->set('v', '')
                        ->set('s', '')
                        ->set('restore_key', '1')
                        ->where('id = :id')
                        ->setParameter('sha_pass_hash', $antiXss->xss_clean($hashed_pass))
                        ->setParameter('id', $userinfo['id']);
                    $queryBuilder->executeQuery();
                } else {
                    list($salt, $verifier) = getRegistrationData(strtoupper($userinfo['username']), $new_password);

                    $queryBuilder = database::$auth->createQueryBuilder();
                    $queryBuilder->update('account')
                        ->set(get_core_config("salt_field"), ':salt')
                        ->set(get_core_config("verifier_field"), ':verifier')
                        ->set('restore_key', '1')
                        ->where('id = :id')
                        ->setParameter('salt', $salt)
                        ->setParameter('verifier', $verifier)
                        ->setParameter('id', $userinfo['id']);
                    $queryBuilder->executeQuery();
                }
            } else {
                $command = str_replace('{USERNAME}', $antiXss->xss_clean(strtoupper($userinfo['username'])), get_config('soap_cp_command'));
                $command = str_replace('{PASSWORD}', $antiXss->xss_clean($new_password), $command);
                if (RemoteCommandWithSOAP($command)) {
                    success_msg(lang('password_changed'));

                    $queryBuilder = database::$auth->createQueryBuilder();
                    $queryBuilder->update('account')
                        ->set('restore_key', '1')
                        ->where('id = :id')
                        ->setParameter('id', $userinfo['id']);
                    $queryBuilder->executeQuery();
                } else {
                    error_msg(lang('error_try_again'));
                    return false;
                }
            }
        }

        send_phpmailer(strtolower($userinfo['email']), 'New Account Password', $message);
        success_msg(lang('check_your_email'));
        return false;
    }

    public static function change_password_by_email($email, $new_password)
    {
        global $antiXss; // Assuming antiXss is available globally or passed

        $userinfo = null;
        if (get_config('battlenet_support')) {
            $userinfo = self::get_bnetaccount_by_email(strtoupper($email)); // Get bnet account info
        } else {
            $userinfo = self::get_user_by_email(strtoupper($email)); // Get normal account info
        }

        if (!$userinfo) {
            return false; // User not found
        }

        if (empty(get_config('srp6_support'))) {
            // Non-SRP6 password hashing
            $hashed_pass = strtoupper(sha1(strtoupper($userinfo['username']) . ':' . $new_password)); // Assuming username is available for non-bnet
            
            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->update('account')
                ->set('sha_pass_hash', ':sha_pass_hash')
                ->set('sessionkey', '')
                ->set('v', '')
                ->set('s', '')
                ->where('id = :id')
                ->setParameter('sha_pass_hash', $antiXss->xss_clean($hashed_pass))
                ->setParameter('id', $userinfo['id']);
            $queryBuilder->executeQuery();

            if (get_config('battlenet_support')) {
                $bnet_hashed_pass = strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash('sha256', strtoupper(hash('sha256', strtoupper($userinfo['email'])) . ':' . strtoupper($new_password))))))));
                $queryBuilder = database::$auth->createQueryBuilder();
                $queryBuilder->update('battlenet_accounts')
                    ->set('sha_pass_hash', ':sha_pass_hash')
                    ->set('sessionkey', '')
                    ->set('v', '')
                    ->set('s', '')
                    ->where('id = :id')
                    ->setParameter('sha_pass_hash', $antiXss->xss_clean($bnet_hashed_pass))
                    ->setParameter('id', $userinfo['id']); // Assuming bnet_account_id is in userinfo['id'] for bnet accounts
                $queryBuilder->executeQuery();
            }

        } else {
            // SRP6 password hashing
            if (get_config('battlenet_support')) {
                if (get_config('srp6_version') == 1) {
                    list($salt, $verifier) = getRegistrationDataBnetV1(strtoupper($userinfo['email']), $new_password);
                    $queryBuilder = database::$auth->createQueryBuilder();
                    $queryBuilder->update('battlenet_accounts')
                        ->set('srp_version', 1)
                        ->set(get_core_config("salt_field"), ':salt')
                        ->set(get_core_config("verifier_field"), ':verifier')
                        ->where('id = :id')
                        ->setParameter('salt', $salt)
                        ->setParameter('verifier', $verifier)
                        ->setParameter('id', $userinfo['id']);
                    $queryBuilder->executeQuery();
                } elseif (get_config('srp6_version') == 2) {
                    list($salt, $verifier) = getRegistrationDataBnetV2(strtoupper($userinfo['email']), $new_password);
                    $queryBuilder = database::$auth->createQueryBuilder();
                    $queryBuilder->update('battlenet_accounts')
                        ->set('srp_version', 2)
                        ->set(get_core_config("salt_field"), ':salt')
                        ->set(get_core_config("verifier_field"), ':verifier')
                        ->where('id = :id')
                        ->setParameter('salt', $salt)
                        ->setParameter('verifier', $verifier)
                        ->setParameter('id', $userinfo['id']);
                    $queryBuilder->executeQuery();
                }
                // Also update the game account password if it's a bnet account
                $game_account_name = $userinfo['id'] . '#1'; // Assuming game account name is bnet_account_id#1
                list($game_account_salt, $game_account_verifier) = getRegistrationData($game_account_name, substr($new_password, 0, 16)); // Max 16 chars for game account
                $queryBuilder = database::$auth->createQueryBuilder();
                $queryBuilder->update('account')
                    ->set(get_core_config("salt_field"), ':salt')
                    ->set(get_core_config("verifier_field"), ':verifier')
                    ->where('battlenet_account = :battlenet_account_id')
                    ->setParameter('salt', $game_account_salt)
                    ->setParameter('verifier', $game_account_verifier)
                    ->setParameter('battlenet_account_id', $userinfo['id']);
                $queryBuilder->executeQuery();

            } else {
                // Normal SRP6 password update
                list($salt, $verifier) = getRegistrationData(strtoupper($userinfo['username']), $new_password);
                $queryBuilder = database::$auth->createQueryBuilder();
                $queryBuilder->update('account')
                    ->set(get_core_config("salt_field"), ':salt')
                    ->set(get_core_config("verifier_field"), ':verifier')
                    ->where('id = :id')
                    ->setParameter('salt', $salt)
                    ->setParameter('verifier', $verifier)
                    ->setParameter('id', $userinfo['id']);
                $queryBuilder->executeQuery();
            }
        }
        return true;
    }

    public static function check_email_exists($email)
    {
        if (!empty($email)) {
            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->select('id')
                ->from('account')
                ->where('email = :email')
                ->setParameter('email', strtoupper($email));

            $statement = $queryBuilder->executeQuery();
            $datas = $statement->fetchAllAssociative();

            if (empty($datas[0])) {
                return true;
            }
        }
        return false;
    }

    public static function get_user_by_email($email)
    {
        if (!empty($email)) {
            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->select('*')
                ->from('account')
                ->where('email = :email')
                ->setParameter('email', strtoupper($email));

            $statement = $queryBuilder->executeQuery();
            $datas = $statement->fetchAllAssociative();

            if (!empty($datas[0]['username'])) {
                return $datas[0];
            }
        }
        return false;
    }

    public static function get_bnetaccount_by_email($email)
    {
        if (!empty($email)) {
            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->select('*')
                ->from('battlenet_accounts')
                ->where('email = :email')
                ->setParameter('email', strtoupper($email));

            $statement = $queryBuilder->executeQuery();
            $datas = $statement->fetchAllAssociative();

            if (!empty($datas[0]['email'])) {
                return $datas[0];
            }
        }
        return false;
    }

    public static function get_user_by_username($username)
    {
        if (!empty($username)) {
            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->select('*')
                ->from('account')
                ->where('username = :username')
                ->setParameter('username', strtoupper($username));

            $statement = $queryBuilder->executeQuery();
            $datas = $statement->fetchAllAssociative();
            if (!empty($datas[0]['username'])) {
                return $datas[0];
            }
        }
        return false;
    }

    /**
     * Get user information by user ID.
     * @param int $user_id The ID of the user.
     * @return array|false An associative array with user data on success, false if not found.
     */
    public static function get_user_by_id($user_id)
    {
        if (empty($user_id)) {
            return false;
        }

        try {
            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->select('*')
                ->from('account')
                ->where('id = :id')
                ->setParameter('id', $user_id);
            $statement = $queryBuilder->executeQuery();
            $data = $statement->fetchAssociative();
            return $data ?: false;
        } catch (Exception $e) {
            error_log("Error getting user by ID: " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param $username
     * @return bool
     */
    public static function check_username_exists($username)
    {
        if (!empty($username)) {
            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->select('id')
                ->from('account')
                ->where('username = :username')
                ->setParameter('username', strtoupper($username));

            $statement = $queryBuilder->executeQuery();
            $datas = $statement->fetchAllAssociative();

            if (empty($datas[0])) {
                return true;
            }
        }
        return false;
    }

    public static function get_online_players($realmID)
    {
        $queryBuilder = database::$chars[$realmID]->createQueryBuilder();
        $queryBuilder->select(
                'c.name',
                'c.race',
                'c.class',
                'c.gender',
                'c.level',
                'c.zone',
                'g.name AS guildname'
            )
            ->from('characters', 'c')
            ->leftJoin('c', 'guild_member', 'gm', 'c.guid = gm.guid')
            ->leftJoin('gm', 'guild', 'g', 'gm.guildid = g.guildid')
            ->where('c.online = :online')
            
            ->setMaxResults(49)
            ->setParameter('online', 1);

        $statement = $queryBuilder->executeQuery();
        $datas = $statement->fetchAllAssociative();

        if (!empty($datas[0]['name'])) {
            return $datas;
        }
        return false;
    }

    public static function get_online_players_count($realmID)
    {
        $queryBuilder = database::$chars[$realmID]->createQueryBuilder();
        $queryBuilder->select('COUNT(*)')
            ->from('characters')
            ->where('online = :online')
            ->setParameter('online', 1);
        $statement = $queryBuilder->executeQuery();
        $datas = $statement->fetchOne();
        if (!empty($datas)) {
            return $datas;
        }
        return 0;
    }

    public static function add_password_key_to_acctbl()
    {
        database::$auth->executeQuery("ALTER TABLE `account` ADD COLUMN `restore_key` varchar(255) NULL DEFAULT '1';");
        return true;
    }

    /**
     * Enable 2fa
     * @return bool
     */
    public static function tfa_enable()
    {
        global $antiXss;

        if (empty(get_config('2fa_support'))) {
            return false;
        }

        if (empty($_POST['submit']) || $_POST['submit'] != 'etfa' || empty($_POST['email']) || (empty(get_config('battlenet_support')) && empty($_POST['username']))) {
            return false;
        }

        if (!captcha_validation()) {
            return false;
        }

        $userinfo = self::get_user_by_email(strtoupper($_POST['email']));
        if (empty($userinfo['id'])) {
            error_msg(lang('account_is_not_valid'));
            return false;
        }

        if (empty(get_config('battlenet_support')) && strtolower($userinfo['username']) != strtolower($_POST['username'])) {
            error_msg(lang('account_is_not_valid'));
            return false;
        }

        $verify_key = md5(strtolower($userinfo['email']) . "_" . time() . rand(1, 999999));

        if (!isset($userinfo['restore_key'])) {
            self::add_password_key_to_acctbl();
        }

        $queryBuilder = database::$auth->createQueryBuilder();
        $queryBuilder->update('account')
            ->set('restore_key', ':restore_key')
            ->where('id = :id')
            ->setParameter('restore_key', $antiXss->xss_clean($verify_key))
            ->setParameter('id', $userinfo['id']);
        $queryBuilder->executeQuery();

        $account = $userinfo['email'];
        if (empty(get_config('battlenet_support'))) {
            $account = $userinfo['username'];
        }

        $restorepass_URL = get_config('baseurl') . '/index.php?enabletfa=' . strtolower($verify_key) . '&account=' . strtolower($account);
        $message = "Hey, to enable Two-Factor Authentication (2FA), Please open  <a href='$restorepass_URL' target='_blank'>this link</a>: <BR>$restorepass_URL";
        send_phpmailer(strtolower($userinfo['email']), 'Enable Account 2FA', $message);
        success_msg(lang('check_your_email'));
        return true;
    }

    public static function account_set_2fa($verify_key, $account)
    {
        global $antiXss;

        if (empty(get_config('2fa_support'))) {
            return false;
        }

        if (empty($verify_key) || empty($account)) {
            return false;
        }

        if ($verify_key == 1 || strlen($verify_key) < 30) {
            return false;
        }

        $acc_name = "";
        if (get_config('battlenet_support')) {
            if (!filter_var($account, FILTER_VALIDATE_EMAIL)) {
                return false;
            }

            $userinfo = self::get_user_by_email(strtoupper($account));
            $acc_name = $userinfo['email'];
        } else {
            if (!preg_match('/^[0-9A-Z-_]+$/', strtoupper($account))) {
                return false;
            }

            $userinfo = self::get_user_by_username(strtoupper($account));
            $acc_name = $userinfo['username'];
        }

        if (empty($userinfo['email'])) {
            return false;
        }

        if ($userinfo['restore_key'] != $verify_key) {
            return false;
        }

        $ga = new PHPGangsta_GoogleAuthenticator();
        $tfa_key = $ga->createSecret();

        $queryBuilder = database::$auth->createQueryBuilder();
        $queryBuilder->update('account')
            ->set('restore_key', '1')
            ->where('id = :id')
            ->setParameter('id', $userinfo['id']);
        $queryBuilder->executeQuery();

        $command = str_replace('{USERNAME}', $antiXss->xss_clean(strtoupper($userinfo['username'])), get_config('soap_2d_command'));
        RemoteCommandWithSOAP($command);
        $command = str_replace('{USERNAME}', $antiXss->xss_clean(strtoupper($userinfo['username'])), get_config('soap_2e_command'));
        $command = str_replace('{SECRET}', $tfa_key, $command);
        RemoteCommandWithSOAP($command);

        $acc_name = str_replace('-', '', $acc_name);
        $acc_name = str_replace('.', '', $acc_name);
        $acc_name = str_replace('_', '', $acc_name);
        $acc_name = str_replace('@', '', $acc_name);

        $message = 'Two-Factor Authentication (2FA) enabled on your account.<br>Please scan the barcode with Google Authenticator.<BR>';
        $message .= '<img src="' . $ga->getQRCodeGoogleUrl($acc_name, $tfa_key) . '"><BR>';
        $message .= 'or you can add this code to Google Authenticator: <B>' . $tfa_key . '</B>.<BR>';

        send_phpmailer(strtolower($userinfo['email']), 'Account 2FA enabled', $message);
        success_msg(lang('check_your_email'));
    }

    /**
     * Set a security question and hash its answer for a user.
     * Assumes 'account' table has 'security_question_id' (INT) and 'security_answer_hash' (VARCHAR) columns.
     * @param int $user_id The ID of the user.
     * @param int $question_id The ID of the chosen security question.
     * @param string $answer The plain-text answer to the security question.
     * @return bool True on success, false on failure.
     */
    public static function set_security_question($user_id, $question_id, $answer)
    {
        global $antiXss;
        if (empty($user_id) || empty($question_id) || empty($answer)) {
            return false;
        }

        // Hash the answer before storing
        $hashed_answer = password_hash($answer, PASSWORD_DEFAULT);

        try {
            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->update('account')
                ->set('security_question_id', ':question_id')
                ->set('security_answer_hash', ':answer_hash')
                ->where('id = :user_id')
                ->setParameter('question_id', $question_id)
                ->setParameter('answer_hash', $antiXss->xss_clean($hashed_answer))
                ->setParameter('user_id', $user_id);
            $queryBuilder->executeQuery();
            return true;
        } catch (Exception $e) {
            error_log("Error setting security question: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get a user's set security question ID and hashed answer.
     * @param int $user_id The ID of the user.
     * @return array|false An associative array with 'security_question_id' and 'security_answer_hash' on success, false if not found.
     */
    public static function get_user_security_question($user_id)
    {
        if (empty($user_id)) {
            return false;
        }

        try {
            $queryBuilder = database::$auth->createQueryBuilder();
            $queryBuilder->select('security_question_id', 'security_answer_hash')
                ->from('account')
                ->where('id = :user_id')
                ->setParameter('user_id', $user_id);
            $statement = $queryBuilder->executeQuery();
            $data = $statement->fetchAssociative();
            return $data ?: false;
        } catch (Exception $e) {
            error_log("Error getting user security question: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Verify a submitted answer against the stored hashed security answer.
     * @param int $user_id The ID of the user.
     * @param string $submitted_answer The plain-text answer submitted by the user.
     * @return bool True if the answer is correct, false otherwise.
     */
    public static function verify_security_answer($user_id, $submitted_answer)
    {
        if (empty($user_id) || empty($submitted_answer)) {
            return false;
        }

        $user_security_data = self::get_user_security_question($user_id);

        if (!$user_security_data || empty($user_security_data['security_answer_hash'])) {
            return false; // No security question set or hash found
        }

        // Verify the submitted answer against the stored hash
        return password_verify($submitted_answer, $user_security_data['security_answer_hash']);
    }
}
