<?php
/**
 * @author Amin Mahmoudi (MasterkinG)
 * @copyright    Copyright (c) 2019 - 2024, MasterkinG32 (https://masterking32.com)
 * @link    https://masterkinG32.com
 **/
?>
<footer class="footer-section">
    <div class="container">
        <p class="copyright">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
    </div>
</footer>

<!--====== Javascripts & Jquery ======-->
<script src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/js/magnific-popup.min.js"></script>
<script src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/js/owl.carousel.min.js"></script>
<script src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/js/circle-progress.min.js"></script>
<script src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/js/main.js?v=<?php echo time(); ?>"></script>
<script src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/js/audio-player-injector.js"></script>
<!-- Change Password Modal -->
<div class="modal" id="changepassword-modal" style="pointer-events: auto; z-index: 99999;">
    <div class="modal-dialog" style="max-width: 400px; margin: 120px auto;">
        <div class="modal-content" style="max-height: 80vh; overflow-y: auto; background-color: rgba(50, 50, 70, 0.98); color: #F5E6AB;">
            <div class="modal-header">
                <h4 class="modal-title"><?php elang('change_password'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-class">
                    <div style="padding: 5px;">
                        <?php if (get_config('battlenet_support')) { ?>
                            <div class="input-group" style="margin-bottom: 5px;">
                            <input type="email" placeholder="<?php elang('email'); ?>" name="email" value="<?php echo $antiXss->xss_clean($_SESSION['email']); ?>" readonly>
                        </div>
                        <?php } else { ?>
                            <div class="input-group" style="margin-bottom: 5px;">
                            <input type="text" placeholder="<?php elang('username'); ?>" name="username" value="<?php echo isset($_SESSION['username']) ? $antiXss->xss_clean($_SESSION['username']) : ''; ?>" readonly>
                        </div>
                        <?php } ?>
                        <div class="input-group" style="margin-bottom: 5px;">
                            <input type="password" placeholder="<?php elang('old_password'); ?>" name="old_password">
                        </div>
                        <div class="input-group" style="margin-bottom: 5px;">
                            <input type="password" placeholder="<?php elang('new_password'); ?>" name="password">
                        </div>
                        <div class="input-group" style="margin-bottom: 5px;">
                            <input type="password" placeholder="<?php elang('retype_new_password'); ?>" name="repassword">
                        </div>
                        <?php echo GetCaptchaHTML(false); ?>
                        <input name="submit" type="hidden" value="changepass">
                        <div class="text-center" style="margin-top: 5px;">
                            <input type="submit" class="site-btn" value="<?php elang('change_password'); ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Forgot Password Modal -->
<div class="modal" id="forgotpassword-modal" style="pointer-events: auto; z-index: 99999;">
    <div class="modal-dialog" style="max-width: 400px; margin: 120px auto;">
        <div class="modal-content" style="background-color: rgba(50, 50, 70, 0.98); color: #F5E6AB;">
            <div class="modal-header">
                <h4 class="modal-title"><?php elang('restore_password'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php error_msg(); success_msg(); ?>
                <form action="" method="post" class="form-class" id="forgot-password-form">
                    <div style="padding: 10px;">
                        <div class="input-group">
                            <input type="text" placeholder="아이디" name="username" class="form-control" required>
                        </div>
                        <input name="submit" type="hidden" value="forgot_password_security_question">
                        <div class="text-center" style="margin-top: 10px;">
                            <button type="submit" class="site-btn" style="width: 100%;">비밀번호 복구</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Set Security Questions Modal -->
<div class="modal" id="setsecurityquestions-modal" style="pointer-events: auto; z-index: 99999;">
    <div class="modal-dialog" style="max-width: 400px; margin: 120px auto;">
        <div class="modal-content" style="background-color: rgba(50, 50, 70, 0.98); color: #F5E6AB;">
            <div class="modal-header">
                <h4 class="modal-title">보안 질문 설정</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php error_msg(); success_msg(); ?>
                <form action="" method="post" class="form-class">
                    <div style="padding: 10px;">
                        <div class="form-group">
                            <label for="security_question">보안 질문 선택:</label>
                            <select class="form-control" id="security_question" name="security_question_id" required>
                                <?php
                                $security_questions = get_security_questions_list();
                                foreach ($security_questions as $id => $question) {
                                    echo '<option value="' . $id . '">' . $question . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="set_security_answer">답변:</label>
                            <input type="text" class="form-control" id="set_security_answer" name="security_answer" required>
                        </div>
                        <input name="submit" type="hidden" value="set_security_question">
                        <div class="text-center" style="margin-top: 10px;">
                            <button type="submit" class="site-btn" style="width: 100%;">저장</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Security Question Challenge Modal -->
<div class="modal" id="securityquestion-challenge-modal" style="pointer-events: auto; z-index: 99999;">
    <div class="modal-dialog" style="max-width: 400px; margin: 120px auto;">
        <div class="modal-content" style="background-color: rgba(50, 50, 70, 0.98); color: #F5E6AB;">
            <div class="modal-header">
                <h4 class="modal-title">보안 질문 확인</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php error_msg(); success_msg(); ?>
                <form action="index.php" method="post" class="form-class" id="security-question-challenge-form">
                    <div style="padding: 10px;">
                        <div class="form-group">
                            <label for="challenge_security_answer" id="challenge_question_label">질문 로딩 중...</label>
                            <input type="hidden" name="user_id" id="challenge_user_id">
                            <input type="hidden" name="security_question_id" id="challenge_question_id">
                            <input type="text" class="form-control" id="challenge_security_answer" name="security_answer" required>
                        </div>
                        <input name="submit" type="hidden" value="verify_security_answer_modal">
                        <div class="text-center" style="margin-top: 10px;">
                            <button type="submit" class="site-btn" style="width: 100%;">답변 확인</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Password Reset Modal (reusing changepassword-modal structure) -->
<div class="modal" id="password-reset-modal" style="pointer-events: auto; z-index: 99999;">
    <div class="modal-dialog" style="max-width: 400px; margin: 120px auto;">
        <div class="modal-content" style="background-color: rgba(50, 50, 70, 0.98); color: #F5E6AB;">            <div class="modal-header">
                <h4 class="modal-title">새 비밀번호 설정</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php error_msg(); success_msg(); ?>
                <form action="" method="post" class="form-class" id="password-reset-form">
                    <div style="padding: 10px;">
                        <div class="form-group">
                            <label for="new_password">새 비밀번호:</label>
                            <input type="password" class="form-control" id="new_password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="retype_new_password">새 비밀번호 확인:</label>
                            <input type="password" class="form-control" id="retype_new_password" name="repassword" required>
                        </div>
                        <input name="submit" type="hidden" value="reset_password_modal">
                        <div class="text-center" style="margin-top: 10px;">
                            <button type="submit" class="site-btn" style="width: 100%;">비밀번호 변경</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        <!-- Enter 키 제출 기능 추가 -->
<script>
    function submitForgotPasswordForm() {
        const username = document.querySelector('#forgotpassword-modal input[name="username"]').value;
        fetch('index.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `submit=forgot_password_security_question&username=${encodeURIComponent(username)}`
        })
        .then(response => response.json())
        .then(data => {
            console.log('Received data for forgot password:', data); // Debug log
            if (data.status === 'success') {
                $('#forgotpassword-modal').modal('hide');
                if (data.user_id && data.security_question) {
                    document.getElementById('challenge_user_id').value = data.user_id;
                    document.getElementById('challenge_question_id').value = data.security_question_id;
                    const questionLabel = document.getElementById('challenge_question_label');
                    if (questionLabel) {
                        questionLabel.innerText = data.security_question;
                        console.log('Question label updated to:', data.security_question); // Debug log
                    } else {
                        console.error('Element with ID challenge_question_label not found.'); // Debug log
                    }
                    $('#securityquestion-challenge-modal').modal('show');
                }
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error in submitForgotPasswordForm:', error); // Debug log
            alert('요청 처리 중 오류가 발생했습니다.');
        });
    }

    function submitSecurityQuestionChallengeForm() {
        const userId = document.getElementById('challenge_user_id').value;
        const questionId = document.getElementById('challenge_question_id').value;
        const answer = document.getElementById('challenge_security_answer').value;

        const requestBody = `submit=verify_security_answer_modal&user_id=${encodeURIComponent(userId)}&security_question_id=${encodeURIComponent(questionId)}&security_answer=${encodeURIComponent(answer)}`;
        console.log('Sending security answer request:', requestBody); // Debug log

        fetch('index.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: requestBody
        })
        .then(response => {
            console.log('Raw response for security answer:', response); // Debug log
            return response.json();
        })
        .then(data => {
            console.log('Received security answer response:', data); // Debug log
            if (data.status === 'success') {
                alert(data.message); // Re-added alert for success
                $('#securityquestion-challenge-modal').modal('hide');
                setTimeout(() => {
                    $('#password-reset-modal').modal('show');
                }, 300); // Add a small delay
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error in submitSecurityQuestionChallengeForm:', error, JSON.stringify(error)); // Debug log
            alert('요청 처리 중 오류가 발생했습니다.');
        });
    }

    function submitPasswordResetForm() {
        const newPassword = document.getElementById('new_password').value;
        const retypeNewPassword = document.getElementById('retype_new_password').value;

        if (newPassword !== retypeNewPassword) {
            alert('새 비밀번호와 비밀번호 확인이 일치하지 않습니다.');
            return;
        }

        fetch('index.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `submit=reset_password_modal&password=${encodeURIComponent(newPassword)}&repassword=${encodeURIComponent(retypeNewPassword)}`
        })
        .then(response => response.json())
        .then(data => {
            console.log('Received password reset response:', data); // Debug log
            if (data.status === 'success') {
                alert(data.message); // Re-added alert for success
                $('#password-reset-modal').modal('hide');
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error in submitPasswordResetForm:', error); // Debug log
            alert('요청 처리 중 오류가 발생했습니다.');
        });
    }

document.addEventListener('DOMContentLoaded', function() {
    // Helper function to add the keyup event listener
    function setupEnterKeyListener(modalId, inputSelector, action) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        const inputs = modal.querySelectorAll(inputSelector);

        if (inputs.length > 0) {
            inputs.forEach(input => {
                input.addEventListener('keyup', function(event) {
                    if (event.key === 'Enter' || event.keyCode === 13) {
                        event.preventDefault();
                        if (typeof action === 'function') {
                            action();
                        } else if (typeof action === 'string') {
                            const button = modal.querySelector(action);
                            if (button) {
                                button.click();
                            }
                        }
                    }
                });
            });
        }
    }

    // 1. 비밀번호 복구 (Forgot Password)
    setupEnterKeyListener('forgotpassword-modal', 'input[name="username"]', submitForgotPasswordForm);

    // 2. 보안 질문 확인 (Security Question Challenge)
    setupEnterKeyListener('securityquestion-challenge-modal', 'input#challenge_security_answer', submitSecurityQuestionChallengeForm);

    // 3. 새 비밀번호 설정 (Password Reset)
    setupEnterKeyListener('password-reset-modal', 'input[type="password"]', submitPasswordResetForm);

    // 비밀번호 복구 폼 제출 이벤트 처리
    const forgotPasswordForm = document.getElementById('forgot-password-form');
    if (forgotPasswordForm) {
        forgotPasswordForm.addEventListener('submit', function(event) {
            event.preventDefault(); // 기본 폼 제출 방지
            submitForgotPasswordForm();
        });
    }

    // 보안 질문 확인 폼 제출 이벤트 처리
    const securityQuestionChallengeForm = document.getElementById('security-question-challenge-form');
    if (securityQuestionChallengeForm) {
        securityQuestionChallengeForm.addEventListener('submit', function(event) {
            event.preventDefault(); // 기본 폼 제출 방지
            submitSecurityQuestionChallengeForm();
        });
    }

    // 새 비밀번호 설정 폼 제출 이벤트 처리
    const passwordResetForm = document.getElementById('password-reset-form');
    if (passwordResetForm) {
        passwordResetForm.addEventListener('submit', function(event) {
            event.preventDefault(); // 기본 폼 제출 방지
            submitPasswordResetForm();
        });
    }
});
</script>
</body>
</html>