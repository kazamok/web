/*

Style: by Roxtedy
Creator: by Roxtedy
2018 © Copyright Roxtedy

Fortnite Somehow Beats Red Dead Redemption 2 For Game of the Year LOoL
*/


'use strict';

/*------------------
	Navigation
--------------------*/
function responsive() {
	// Responsive 
	$('.responsive').on('click', function(event) {
		$('.menu-list').slideToggle(400);
		event.preventDefault();
	});
}



/*------------------
	Hero Section
--------------------*/
function heroSection() {
	//Slide item bg image.
	$('.hero-item').each(function() {
		var image = $(this).data('bg');
		$(this).css({
			'background-image'  : 'url(' + image + ')',
			'background-size'   : 'cover',
			'background-repeat' : 'no-repeat',
			'background-position': 'center bottom'
		});
	});

	// Init the carousel
	$('#hero-slider').owlCarousel({
		loop: true,
		nav: true,
		items: 1,
		autoHeight:true,
		animateOut: 'fadeOut',
		animateIn: 'fadeIn',
		navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		onInitialized: function() { 
            progressBar();
            // Ensure page-content-wrapper is visible after hero images are set
            // $('#page-content-wrapper').show(); // 이 줄을 제거합니다.
        },
		onTranslated: moved,
		onDrag: pauseOnDragging
	});

	var time = 7;
	var $progressBar,
		$bar, 
		$elem, 
		isPause, 
		tick,
		percentTime;

	// Init progressBar where elem is $("#owl-demo")
	function progressBar(){    
		// build progress bar elements
		buildProgressBar();

		// start counting
		start();
	}

	// create div#progressBar and div#bar then prepend to $("#owl-demo")
	function buildProgressBar(){
		$progressBar = $("<div>",{
			id:"progressBar"
		});
		$bar = $("<div>",{
			id:"bar"
		});
		$progressBar.append($bar).prependTo($("#hero-slider"));
	}

	function start() {
		// reset timer
		percentTime = 0;
		isPause = false;
		// run interval every 0.01 second
		tick = setInterval(interval, 10);
	};

	function interval() {
		if(isPause === false){
			percentTime += 1 / time;

			$bar.css({
				width: percentTime+"%"
			});

			// if percentTime is equal or greater than 100
			if(percentTime >= 100){
				// slide to next item 
				$("#hero-slider").trigger("next.owl.carousel");
				percentTime = 0; // give the carousel at least the animation time ;)
			}
		}
	}

	// pause while dragging 
	function pauseOnDragging(){
		isPause = true;
	}

	// moved callback
	function moved(){
		// clear interval
		clearTimeout(tick);
		// start again
		start();
	}

}

	



/*------------------
	Video Popup
--------------------*/
function videoPopup() {
	$('.video-popup').magnificPopup({
		type: 'iframe',
		autoplay : true
	});
}



/*------------------
	Testimonial
--------------------*/
function testimonial() {
	// testimonial Carousel 
	$('#testimonial-slide').owlCarousel({
		loop:true,
		autoplay:true,
		margin:30,
		nav:false,
		dots: true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:2
			},
			800:{
				items:2
			},
			1000:{
				items:2
			}
		}
	});
}



/*------------------
	Progress bar
--------------------*/
function progressbar() {

	$('.progress-bar-style').each(function() {
		var progress = $(this).data("progress");
		var prog_width = progress + '%';
		if (progress <= 100) {
			$(this).append('<div class="bar-inner" style="width:' + prog_width + '"><span>' + prog_width + '</span></div>');
		}
		else {
			$(this).append('<div class="bar-inner" style="width:100%"><span>' + prog_width + '</span></div>');
		}
	});
}



/*------------------
	Accordions
--------------------*/
function accordions() {
	$('.panel').on('click', function (e) {
		$('.panel').removeClass('active');
		var $this = $(this);
		if (!$this.hasClass('active')) {
			$this.addClass('active');
		}
		e.preventDefault();
	});
}



/*------------------
	Progress Circle
--------------------*/
function progressCircle() {
	//Set progress circle 1
	$("#progress1").circleProgress({
		value: 0.75,
		size: 175,
		thickness: 5,
		fill: "#2be6ab",
		emptyFill: "rgba(0, 0, 0, 0)"
	});
	//Set progress circle 2
	$("#progress2").circleProgress({
		value: 0.83,
		size: 175,
		thickness: 5,
		fill: "#2be6ab",
		emptyFill: "rgba(0, 0, 0, 0)"
	});
	//Set progress circle 3
	$("#progress3").circleProgress({
		value: 0.25,
		size: 175,
		thickness: 5,
		fill: "#2be6ab",
		emptyFill: "rgba(0, 0, 0, 0)"
	});
	//Set progress circle 4
	$("#progress4").circleProgress({
		value: 0.95,
		size: 175,
		thickness: 5,
		fill: "#2be6ab",
		emptyFill: "rgba(0, 0, 0, 0)"
	});

}

function loadHeroImages(callback) {
    const heroImages = [];
    $('#hero-slider .hero-item').each(function() {
        const imageUrl = $(this).data('bg');
        if (imageUrl) {
            heroImages.push(imageUrl);
        }
    });

    if (heroImages.length === 0) {
        callback(); // No images to load, proceed
        return;
    }

    let loadedCount = 0;
    heroImages.forEach(function(url) {
        const img = new Image();
        img.onload = function() {
            loadedCount++;
            if (loadedCount === heroImages.length) {
                callback(); // All images loaded
            }
        };
        img.onerror = function() {
            console.error('Failed to load hero image:', url);
            loadedCount++; // Still count as loaded to avoid infinite wait
            if (loadedCount === heroImages.length) {
                callback();
            }
        };
        img.src = url;
    });
}

(function($) {
    console.log('main.js script started.'); // New log at the very beginning
    // Call all functions
    responsive();
    heroSection();
    testimonial();
    progressbar();
    videoPopup();
    accordions();
    progressCircle();


                        $('#splash-screen').on('click', function() {
        $.ajax({
            url: 'set_splash_session.php',
            success: function() {
                $('#splash-screen').fadeOut('slow', function() {
                    $(this).remove();
                    $('#main-content').show(); // Show main-content immediately

                    // Now show the preloader on top
                    $('#preloder').show();
                    $('.loader').show(); // Ensure the loader content is visible

                    let imagesLoaded = false;
                    let minTimeElapsed = false;

                    function proceedToHidePreloader() {
                        if (imagesLoaded && minTimeElapsed) {
                            $('#preloder').fadeOut('slow', function() {
                                // Now that preloader is gone, show hero images
                                $('#page-content-wrapper').show(); // Show hero images AFTER they are loaded

                                setTimeout(function() {
                                    $('#overlay-content').fadeIn('slow').css('pointer-events', 'auto');
                                    $('.media-section').fadeIn('slow');
                                    $('#music-controls').fadeIn('slow');
                                    $('#play-pause-icon').trigger('click');
                                }, 500);
                            });
                        }
                    }

                    // Load hero images
                    loadHeroImages(function() {
                        imagesLoaded = true;
                        proceedToHidePreloader();
                    });

                    // Set minimum preloader display time
                    setTimeout(function() {
                        minTimeElapsed = true;
                        proceedToHidePreloader();
                    }, 1200); // Minimum preloader duration
                });
            }
        });
    });

    // Login form validation for username field
    var $usernameInput = $('input[name="username"]');
    var $loginButton = $('button[type="submit"].site-btn'); // More specific selector for login button

    // Initially disable the login button
    $loginButton.prop('disabled', true);

    // Function to check username input and toggle button state
    function checkUsernameInput() {
        if ($usernameInput.val().trim() === '') {
            $loginButton.prop('disabled', true);
        } else {
            $loginButton.prop('disabled', false);
        }
    }

    // Attach event listener to username input
    $usernameInput.on('input', checkUsernameInput);

    // Also call on document ready in case there's pre-filled content
    checkUsernameInput();

    // Registration form validation
    var $registrationForm = $('form#con_form');
    var $registrationButton = $registrationForm.find('input[type="submit"].site-btn');

    // Get all required input fields for registration
    var $requiredRegistrationInputs = $registrationForm.find('input[name="email"], input[name="username"], input[name="password"], input[name="repassword"], input[name="captcha"]');

    // Function to check all registration inputs and toggle button state
    function checkRegistrationInputs() {
        var allFilled = true;
        $requiredRegistrationInputs.each(function() {
            if ($(this).val().trim() === '') {
                allFilled = false;
                return false; // Break out of each loop
            }
            // Special handling for reCAPTCHA/hCaptcha if applicable
            // If captcha_type is 1 or 2, the 'captcha' input might not be directly typed into.
            // In such cases, you might need to check for the presence of 'g-recaptcha-response' or 'h-captcha-response'
            // or rely on their callbacks to enable the button.
            // For now, assuming captcha_type == 0 (image captcha) where 'captcha' input is directly filled.
        });

        if (allFilled) {
            $registrationButton.prop('disabled', false);
        } else {
            $registrationButton.prop('disabled', true);
        }
    }

    // Initially disable the registration button
    checkRegistrationInputs();

    // Attach event listener to all required registration inputs
    $requiredRegistrationInputs.on('input', checkRegistrationInputs);

    

    

    



})(jQuery); // Closing the IIFE here

    // Check if splash screen is already hidden on page load (e.g., after refresh or direct access)
    const splashScreen = document.getElementById('splash-screen');
    if (splashScreen && isSplashShown) { // Use isSplashShown variable
        // Show main content immediately
        $('#main-content').show();
        $('#page-content-wrapper').show(); // Ensure hero images are visible

        // Show preloader immediately to cover the screen
        $('#preloder').show();
        $('.loader').show(); // Ensure the loader content is visible

        // After preloader duration, fade it out
        setTimeout(function() {
            $('#preloder').fadeOut('slow', function() {
                // Once preloader is gone, fade in overlay-content and media-section
                setTimeout(function() {
                    $('#overlay-content').fadeIn('slow').css('pointer-events', 'auto');
                    $('.media-section').fadeIn('slow');
                    $('#music-controls').fadeIn('slow');
                }, 500); // Same delay as in the splash screen logic
            });
        }, 1200); // Same preloader duration as initial visit
    } else if (splashScreen) { // If splash screen is present and not yet shown
        // Original splash screen click logic
        $('#splash-screen').on('click', function() {
            $.ajax({
                url: 'set_splash_session.php',
                success: function() {
                    $('#splash-screen').fadeOut('slow', function() {
                        $(this).remove();
                        $('#main-content').show(); // Show main-content immediately

                        // Now show the preloader on top
                        $('#preloder').show();
                        $('.loader').show(); // Ensure the loader content is visible

                        let imagesLoaded = false;
                        let minTimeElapsed = false;

                        function proceedToHidePreloader() {
                            if (imagesLoaded && minTimeElapsed) {
                                $('#preloder').fadeOut('slow', function() {
                                    // Now that preloader is gone, show hero images
                                    // $('#page-content-wrapper').show(); // REMOVED FROM HERE

                                    setTimeout(function() {
                                        $('#overlay-content').fadeIn('slow').css('pointer-events', 'auto');
                                        $('.media-section').fadeIn('slow');
                                        $('#music-controls').fadeIn('slow');
                                        $('#play-pause-icon').trigger('click');
                                    }, 500);
                                });
                            }
                        }

                        // Load hero images
                        loadHeroImages(function() {
                            imagesLoaded = true;
                            $('#page-content-wrapper').show(); // ADDED HERE (after images are loaded)
                            proceedToHidePreloader();
                        });

                        // Set minimum preloader display time
                        setTimeout(function() {
                            minTimeElapsed = true;
                            proceedToHidePreloader();
                        }, 1200); // Minimum preloader duration
                    });
                }
            });
        });
    }

function submitSecurityQuestionChallengeForm() {
    console.log('submitSecurityQuestionChallengeForm called.');
    var $form = $('#securityquestion-challenge-form');

    // Manually construct data
    var formData = {
        user_id: $('#challenge_user_id').val(),
        security_question_id: $('#challenge_question_id').val(),
        security_answer: $('#challenge_security_answer').val(),
        submit: 'verify_security_answer_modal' // Explicitly set the submit value
    };

    console.log('FormData for security question challenge (manual):', formData); // New log

    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: formData, // Use manually constructed data
        dataType: 'json',
        success: function(response) {
            console.log('AJAX success response for security question challenge:', response); // New log
            if (response.status === 'success') {
                $('#securityquestion-challenge-modal').modal('hide');
                $('#password-reset-modal').modal('show');
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error for security question challenge:', xhr.responseText, status, error); // New log
            alert('An error occurred: ' + xhr.responseText);
        }
    });
}

function submitForgotPasswordForm() { // Defined globally
    console.log('submitForgotPasswordForm called.');
    var $form = $('#forgotpassword-modal form');
    var formData = $form.serialize();

    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#forgotpassword-modal').modal('hide');
                $('#challenge_user_id').val(response.user_id);
                $('#challenge_question_id').val(response.question_id);
                $('#challenge_question_label').text(response.question_text);
                console.log('Attempting to show securityquestion-challenge-modal from direct call.');
                $('#securityquestion-challenge-modal').modal('show');
                console.log('securityquestion-challenge-modal show method called from direct call.');
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('An error occurred: ' + xhr.responseText);
        }
    });
}

function submitPasswordResetForm() {
    console.log('submitPasswordResetForm called.');
    var $form = $('#password-reset-form');
    var formData = $form.serialize();
    var userId = $('#challenge_user_id').val();

    formData += '&user_id=' + userId;

    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#password-reset-modal').modal('hide');
                alert(response.message);
                window.location.reload();
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('An error occurred: ' + xhr.responseText);
        }
    });
}
