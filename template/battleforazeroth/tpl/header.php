<?php
/**
 * Created by Amin.MasterkinG
 * Website : MasterkinG32.CoM
 * Email : lichwow_masterking@yahoo.com
 * Date: 11/26/2018 - 8:36 PM
 */

$zone_names = [
    0 =>"미정",
1 =>"던 모로", 3 =>"황야의 땅", 4 =>"저주받은 땅", 8 =>"슬픔의 늪", 10 =>"그늘숲",
    11 =>"저습지", 12 =>"엘윈 숲", 14 =>"듀로타", 15 =>"먼지진흙 습지대", 16 =>"아즈샤라",
    17 =>"불모의 땅", 25 =>"검은바위 산", 28 =>"서부 역병지대", 33 =>"가시덤불 골짜기", 36 =>"알터랙 산맥",
    38 =>"모단 호수", 40 =>"서부 몰락지대", 41 =>"죽음의 고개", 44 =>"붉은마루 산맥", 45 =>"아라시 고원",
    46 =>"불타는 평원", 47 =>"동부 내륙지", 51 =>"이글거리는 협곡", 65 =>"용의 안식처", 66 =>"줄드락",
    67 =>"폭풍우 봉우리", 85 =>"티리스팔 숲", 130 =>"은빛소나무 숲", 139 =>"동부 역병지대", 141 =>"텔드랏실",
    148 =>"어둠의 해안", 206 =>"우트가드 성채", 207 =>"대해", 209 =>"그림자송곳니 성채", 210 =>"얼음왕관",
    215 =>"멀고어", 267 =>"힐스브래드 구릉지", 331 =>"잿빛 골짜기", 357 =>"페랄라스", 361 =>"악령의 숲",
    394 =>"회색 구릉지", 400 =>"버섯구름 봉우리", 405 =>"잊혀진 땅", 406 =>"돌발톱 산맥", 440 =>"타나리스",
    457 =>"장막의 바다", 490 =>"운고로 분화구", 491 =>"가시덩굴 우리", 493 =>"달의 숲", 495 =>"울부짖는 협만",
    618 =>"여명의 설원", 717 =>"스톰윈드 지하감옥", 718 =>"통곡의 동굴", 719 =>"검은심연의 나락", 721 =>"놈리건",
    722 =>"가시덩굴 구릉", 796 =>"붉은십자군 수도원", 1176 =>"줄파락", 1196 =>"우트가드 첨탑", 1337 =>"울다만",
    1377 =>"실리더스", 1397 =>"에메랄드 숲", 1417 =>"가라앉은 사원", 1477 =>"아탈학카르 신전", 1497 =>"언더시티",
    1519 =>"스톰윈드", 1537 =>"아이언포지", 1581 =>"죽음의 폐광", 1583 =>"검은바위 첨탑", 1584 =>"검은바위 나락",
    1637 =>"오그리마", 1638 =>"썬더 블러프", 1657 =>"다르나서스", 1941 =>"시간의 동굴", 1977 =>"줄구룹",
    2017 =>"스트라솔름", 2057 =>"스칼로맨스", 2100 =>"마라우돈", 2159 =>"오닉시아의 둥지", 2257 =>"깊은굴 지하철",
    2366 =>"검은늪", 2367 =>"옛 힐스브래드 구릉지", 2437 =>"성난불길 협곡", 2557 =>"혈투의 전장", 2597 =>"알터랙 계곡",
    2677 =>"검은날개 둥지", 2717 =>"화산 심장부", 2817 =>"수정노래 숲", 3277 =>"전쟁노래 협곡", 3358 =>"아라시 분지",
    3428 =>"안퀴라즈", 3429 =>"안퀴라즈 폐허", 3430 =>"영원노래 숲", 3433 =>"유령의 땅", 3455 =>"북해",
    3456 =>"낙스라마스", 3457 =>"카라잔", 3477 =>"아졸네룹", 3483 =>"지옥불 반도", 3487 =>"실버문",
    3518 =>"나그란드", 3519 =>"테로카르 숲", 3520 =>"어둠달 골짜기", 3521 =>"장가르 습지대", 3522 =>"칼날 산맥",
    3523 =>"황천의 폭풍", 3524 =>"하늘안개 섬", 3525 =>"핏빛안개 섬", 3535 =>"지옥불 성채", 3537 =>"북풍의 땅",
    3540 =>"뒤틀린 황천", 3557 =>"엑소다르", 3562 =>"지옥불 성루", 3605 =>"과거의 하이잘", 3606 =>"하이잘 정상",
    3607 =>"불뱀 제단", 3698 =>"나그란드 투기장", 3702 =>"칼날 산맥 투기장", 3703 =>"샤트라스", 3711 =>"숄라자르 분지",
    3713 =>"피의 용광로", 3714 =>"으스러진 손의 전당", 3715 =>"증기 저장고", 3716 =>"지하수렁", 3717 =>"강제 노역소",
    3789 =>"어둠의 미궁", 3790 =>"아키나이 납골당", 3791 =>"세데크 전당", 3792 =>"마나 무덤", 3805 =>"줄아만",
    3817 =>"Test Dungeon", 3820 =>"폭풍의 눈", 3836 =>"마그테리돈의 둥지", 3845 =>"폭풍우 요새", 3847 =>"신록의 정원",
    3848 =>"알카트라즈", 3849 =>"메카나르", 3917 =>"아킨둔", 3923 =>"그룰의 둥지", 3948 =>"시험용", 3959 =>"검은 사원",
    3968 =>"로데론의 폐허", 3979 =>"얼어붙은 바다", 4019 =>"진화의 대지", 4075 =>"태양샘 고원", 4076 =>"Reuse Me 7",
    4080 =>"쿠엘다나스 섬", 4100 =>"옛 스트라솔름", 4131 =>"마법학자의 정원", 4196 =>"드락타론 성채", 4197 =>"겨울손아귀 호수",
    4201 =>"볼드랏실의 눈물", 4228 =>"마력의 눈", 4258 =>"북해", 4264 =>"돌의 전당", 4265 =>"마력의 탑",
    4272 =>"번개의 전당", 4273 =>"울두아르", 4277 =>"아졸네룹", 4298 =>"동부 역병지대: 붉은십자군 초소", 4378 =>"달라란 투기장",
    4384 =>"고대의 해안", 4395 =>"달라란", 4406 =>"용맹의 투기장", 4415 =>"보랏빛 요새", 4416 =>"군드락",
    4493 =>"흑요석 성소", 4494 =>"안카헤트: 고대 왕국", 4500 =>"영원의 눈", 4602 =>"내부 강제", 4603 =>"아카본 석실",
    4630 =>"북해", 4710 =>"정복의 섬", 4722 =>"십자군의 시험장", 4723 =>"용사의 시험장", 4742 =>"흐로스가르 상륙지",
    4763 =>"수송: 얼라이언스 비행포격선", 4764 =>"수송: 호드 비행포격선", 4809 =>"영혼의 제련소", 4812 =>"얼음왕관 성채",
    4813 =>"사론의 구덩이", 4820 =>"투영의 전당", 4832 =>"수송: 얼라이언스 비행포격선", 4833 =>"수송: 호드 비행포격선",
    4893 =>"서리 여왕의 둥지", 4894 =>"공포와 재미가 넘치는 퓨트리사이드의 연금술 실험실", 4895 =>"진홍빛 전당", 4896 =>"얼어붙은 왕좌",
    4897 =>"피의 성소", 4987 =>"루비 성소", 14284 =>"북풍의 땅", 14285 =>"얼음왕관", 14286 =>"숄라자르 분지",
    14287 =>"용의 안식처", 14288 =>"격전의 겨울손아귀"
];

$class_names = [
    1 => '전사', 2 => '성기사', 3 => '사냥꾼', 4 => '도적', 5 => '사제',
    6 => '죽음의 기사', 7 => '주술사', 8 => '마법사', 9 => '흑마법사', 11 => '드루이드'
];

$class_colors = [
    1 => '#C79C6E', // Warrior
    2 => '#F58CBA', // Paladin
    3 => '#ABD473', // Hunter
    4 => '#FFF569', // Rogue
    5 => '#FFFFFF', // Priest
    6 => '#C41F3B', // Death Knight
    7 => '#0070DE', // Shaman
    8 => '#69CCF0', // Mage
    9 => '#9482C9', // Warlock
    11 => '#FF7D0A' // Druid
];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="MasterkinG32.CoM"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="description" content="<?php global $antiXss; echo $antiXss->xss_clean(get_config("page_title")); ?>">
    <meta name="description" content="<?php global $antiXss; echo $antiXss->xss_clean(get_config("page_title")); ?>">
    <title><?php global $antiXss; echo $antiXss->xss_clean(get_config("page_title")); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo get_template_image_url('img/favicon.ico'); ?>" rel="shortcut icon"/>

    <link rel="stylesheet" href="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/css/google-fonts.css"/>
    <link rel="stylesheet" href="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/css/flaticon.css"/>
    <link rel="stylesheet" href="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/css/magnific-popup.css"/>
    <link rel="stylesheet" href="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/css/owl.carousel.css"/>
    <link rel="stylesheet" href="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/css/bfa-style.css"/>

    <link rel="preload" href="<?php echo get_template_image_url('img/01.jpg'); ?>" as="image">
    <link rel="preload" href="<?php echo get_template_image_url('img/02.jpg'); ?>" as="image">
    <link rel="preload" href="<?php echo get_template_image_url('img/03.jpg'); ?>" as="image">
    <link rel="preload" href="<?php echo get_template_image_url('img/04.jpg'); ?>" as="image">
    <link rel="preload" href="<?php echo get_template_image_url('img/05.jpg'); ?>" as="image">

    <!--[if lt IE 9]>
    <script src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/js/html5shiv.min.js"></script>
    <script src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/js/respond.min.js"></script>
    <![endif]-->

    <?php echo getCaptchaJS(); ?>

    <?php echo(!empty(lang('custom_css')) ? '<style>' . lang('custom_css') . '</style>' : ''); ?>
    <?php echo(!empty(lang('tpl_battleforazeroth_custom_css')) ? '<style>' . lang('tpl_battleforazeroth_custom_css') . '</style>' : ''); ?>

    <style>
        /* Custom CSS for dropdown on hover (from previous steps, keep for now) */
        @media all and (min-width: 992px) {
            .navbar .nav-item .dropdown-menu { display: none; }
            .navbar .nav-item:hover .dropdown-menu { display: block; }
            .navbar .nav-item .dropdown-menu { margin-top: 0; }
        }

        /* Aggressive reset for fixed positioning issues */
        html, body {
            transform: none !important;
            perspective: none !important;
            filter: none !important;
            will-change: auto !important;
            margin: 0;
            padding: 0;
        }

        /* Ensure hero section is not pushed down */
        .hero-section {
            margin-top: 0 !important; /* Force no top margin */
        }

        /* Bookmark Menu Styles */
        #bookmark-menu {
            position: fixed;
            top: 25%; /* Move higher up */
            left: 0; /* Align to the left edge */
            transform: translateY(-50%); /* Adjust for vertical centering */
            z-index: 99999; /* Very high z-index to ensure it's on top */
            /* Removed display: flex; flex-direction: row; */
        }

        .bookmark-tab {
            background-color: #17a2b8; /* Eye-catching blue */
            width: 20px; /* Narrower width */
            height: 100px; /* Taller height */
            padding: 0;
            cursor: pointer;
            border-top-left-radius: 5px; /* Changed for symmetry */
            border-bottom-left-radius: 5px; /* Changed for symmetry */
            margin-right: -10px; /* Overlap with content slightly */
            transition: background-color 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute; /* Position absolutely within #bookmark-menu */
            left: 0; /* Changed for symmetry */
            top: 0;
        }

        .bookmark-tab:hover {
            background-color: #138496; /* Slightly darker blue on hover */
        }

        .bookmark-content {
            background-color: rgba(23, 162, 184, 0.85); /* Matching tab color with transparency */
            min-width: 200px; /* Increased width */
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); /* Re-add shadow for depth */
            padding: 0; /* Removed vertical padding */
            border-top-left-radius: 0; /* Removed round effect */
            border-bottom-left-radius: 0; /* Removed round effect */
            position: absolute; /* Position absolutely within #bookmark-menu */
            top: 0;
            left: -200px; /* Hide content initially (min-width) */
            transition: left 0.3s ease-in-out; /* Transition for left property */
        }

        #bookmark-menu:hover .bookmark-content {
            left: 20px; /* Show content on hover, positioned next to the tab */
        }

        #bookmark-menu:hover .bookmark-content {
            right: 20px; /* Show content on hover, positioned next to the tab */
        }

        .bookmark-content a {
            color: white;
            padding: 0; /* Removed padding for a 'filled' look */
            text-decoration: none;
            display: block;
            text-align: left;
            line-height: 40px; /* Adjust line height to give vertical spacing */
            padding-left: 16px; /* Add back left padding for text alignment */
        }

        .bookmark-content a:hover {
            background-color: #138496; /* Solid color for 'filled' effect */
        }
    </style>
</head>
<body>
    <div id="bookmark-menu">
        <div class="bookmark-tab"></div>
        <div class="bookmark-content">
            <a href="#" onclick="loadAboutServerModal(); return false;">About Server</a> <!-- 서버 정보 페이지 링크 -->
            <a href="<?php echo get_config("baseurl"); ?>/how_to_play.php">How to Play</a> <!-- 게임 방법 페이지 링크 -->
            <a href="<?php echo get_config("baseurl"); ?>/download.php">Download</a> <!-- 다운로드 페이지 링크 -->
            <a href="<?php echo get_config("baseurl"); ?>/undefined4.php">미정 4</a> <!-- 미정 페이지 4 링크 -->
            <a href="<?php echo get_config("baseurl"); ?>/undefined5.php">미정 5</a> <!-- 미정 페이지 5 링크 -->
        </div>
    </div>
    <?php error_msg(); success_msg(); ?>
    <script>
        var isSplashShown = <?php echo (isset($_SESSION['splash_shown']) && $_SESSION['splash_shown'] === true) ? 'true' : 'false'; ?>;

        document.addEventListener('DOMContentLoaded', function() {
            function updateClock() {
                const liveClockElement = document.getElementById('live-clock');
                if (liveClockElement) { // 요소가 존재하는지 확인
                    const now = new Date();
                    const hours = String(now.getHours()).padStart(2, '0');
                    const minutes = String(now.getMinutes()).padStart(2, '0');
                    const seconds = String(now.getSeconds()).padStart(2, '0');
                    liveClockElement.textContent = `${hours}:${minutes}:${seconds}`;
                }
            }
            // Update the clock every every second
            setInterval(updateClock, 1000);
            // Initial call to display the clock immediately
            updateClock();

            // Function to load About Server content into modal
            window.loadAboutServerModal = function() {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '<?php echo get_config("baseurl"); ?>/about_server.php', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById('about-server-modal-body').innerHTML = xhr.responseText;
                        $('#about-server-modal').modal('show');
                    }
                };
                xhr.send();
            };
        });
    </script>
    <script>
        var isSplashShown = <?php echo (isset($_SESSION['splash_shown']) && $_SESSION['splash_shown'] === true) ? 'true' : 'false'; ?>;
    </script>
    <div id="overlay-content" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: transparent; z-index: 9998; overflow-y: auto; pointer-events: none;">
        <div class="testimonial-section">
            <div class="container">
                <div class="row">
                    <div class="<?php echo (empty($_SESSION['loggedin'])) ? 'col-md-4 col-md-offset-4' : 'col-md-12'; ?>">
                        <?php if (empty($_SESSION['loggedin'])) { ?>
                            <form action="#" method="post" class="form-class" style="margin-top: -100px; pointer-events: auto;">
                                <input type="text" placeholder="<?php echo (get_config('battlenet_support')) ? '이메일' : '아이디'; ?>" name="username" class="form-control" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0; border-top-left-radius: 0; border-top-right-radius: 0; margin-bottom: 0;">
                                <input type="password" placeholder="비밀번호" name="password" class="form-control" style="border-top-left-radius: 0; border-top-right-radius: 0;">
                                <input name="submit" type="hidden" value="login">
                                <div class="text-center">
                                    <button type="submit" class="site-btn" style="width: 100%; margin-bottom: 15px; margin-top: 10px;">로그인</button>
                                </div>
                                <div class="text-center" style="pointer-events: auto; margin-top: 10px;">
                                     <a href="#" data-toggle="modal" data-target="#register-modal" style="color: #efad0c; text-decoration: none;">회원가입</a>
                                </div>
                            </form>
                            <div class="text-center" style="pointer-events: auto;">
                                <a href="#" data-toggle="modal" data-target="#forgotpassword-modal" style="color: #ccc; text-decoration: none;">비밀번호가 기억나지 않으세요! <span style="color: #69CCF0;">비밀번호 복구</span></a>
                            </div>
                        <?php } else { ?>
                            <div class="user-info" style="margin-top: 50px; color: #F5E6AB; text-align: center; pointer-events: auto;">
                                <h3 style="margin-bottom: 20px;">환영합니다, <?php echo $antiXss->xss_clean($_SESSION['username']); ?>!</h3>
                                <?php if (!empty($_SESSION['characters'])) { ?>
                                    
                                    <?php
                                    $zone_names = [
                                        1 =>"던 모로", 3 =>"황야의 땅", 4 =>"저주받은 땅", 8 =>"슬픔의 늪", 10 =>"그늘숲",
                                        11 =>"저습지", 12 =>"엘윈 숲", 14 =>"듀로타", 15 =>"먼지진흙 습지대", 16 =>"아즈샤라",
                                        17 =>"불모의 땅", 25 =>"검은바위 산", 28 =>"서부 역병지대", 33 =>"가시덤불 골짜기", 36 =>"알터랙 산맥",
                                        38 =>"모단 호수", 40 =>"서부 몰락지대", 41 =>"죽음의 고개", 44 =>"붉은마루 산맥", 45 =>"아라시 고원",
                                        46 =>"불타는 평원", 47 =>"동부 내륙지", 51 =>"이글거리는 협곡", 65 =>"용의 안식처", 66 =>"줄드락",
                                        67 =>"폭풍우 봉우리", 85 =>"티리스팔 숲", 130 =>"은빛소나무 숲", 139 =>"동부 역병지대", 141 =>"텔드랏실",
                                        148 =>"어둠의 해안", 206 =>"우트가드 성채", 207 =>"대해", 209 =>"그림자송곳니 성채", 210 =>"얼음왕관",
                                        215 =>"멀고어", 267 =>"힐스브래드 구릉지", 331 =>"잿빛 골짜기", 357 =>"페랄라스", 361 =>"악령의 숲",
                                        394 =>"회색 구릉지", 400 =>"버섯구름 봉우리", 405 =>"잊혀진 땅", 406 =>"돌발톱 산맥", 440 =>"타나리스",
                                        457 =>"장막의 바다", 490 =>"운고로 분화구", 491 =>"가시덩굴 우리", 493 =>"달의 숲", 495 =>"울부짖는 협만",
                                        618 =>"여명의 설원", 717 =>"스톰윈드 지하감옥", 718 =>"통곡의 동굴", 719 =>"검은심연의 나락", 721 =>"놈리건",
                                        722 =>"가시덩굴 구릉", 796 =>"붉은십자군 수도원", 1176 =>"줄파락", 1196 =>"우트가드 첨탑", 1337 =>"울다만",
                                        1377 =>"실리더스", 1397 =>"에메랄드 숲", 1417 =>"가라앉은 사원", 1477 =>"아탈학카르 신전", 1497 =>"언더시티",
                                        1519 =>"스톰윈드", 1537 =>"아이언포지", 1581 =>"죽음의 폐광", 1583 =>"검은바위 첨탑", 1584 =>"검은바위 나락",
                                        1637 =>"오그리마", 1638 =>"썬더 블러프", 1657 =>"다르나서스", 1941 =>"시간의 동굴", 1977 =>"줄구룹",
                                        2017 =>"스트라솔름", 2057 =>"스칼로맨스", 2100 =>"마라우돈", 2159 =>"오닉시아의 둥지", 2257 =>"깊은굴 지하철",
                                        2366 =>"검은늪", 2367 =>"옛 힐스브래드 구릉지", 2437 =>"성난불길 협곡", 2557 =>"혈투의 전장", 2597 =>"알터랙 계곡",
                                        2677 =>"검은날개 둥지", 2717 =>"화산 심장부", 2817 =>"수정노래 숲", 3277 =>"전쟁노래 협곡", 3358 =>"아라시 분지",
                                        3428 =>"안퀴라즈", 3429 =>"안퀴라즈 폐허", 3430 =>"영원노래 숲", 3433 =>"유령의 땅", 3455 =>"북해",
                                        3456 =>"낙스라마스", 3457 =>"카라잔", 3477 =>"아졸네룹", 3483 =>"지옥불 반도", 3487 =>"실버문",
                                        3518 =>"나그란드", 3519 =>"테로카르 숲", 3520 =>"어둠달 골짜기", 3521 =>"장가르 습지대", 3522 =>"칼날 산맥",
                                        3523 =>"황천의 폭풍", 3524 =>"하늘안개 섬", 3525 =>"핏빛안개 섬", 3535 =>"지옥불 성채", 3537 =>"북풍의 땅",
                                        3540 =>"뒤틀린 황천", 3557 =>"엑소다르", 3562 =>"지옥불 성루", 3605 =>"과거의 하이잘", 3606 =>"하이잘 정상",
                                        3607 =>"불뱀 제단", 3698 =>"나그란드 투기장", 3702 =>"칼날 산맥 투기장", 3703 =>"샤트라스", 3711 =>"숄라자르 분지",
                                        3713 =>"피의 용광로", 3714 =>"으스러진 손의 전당", 3715 =>"증기 저장고", 3716 =>"지하수렁", 3717 =>"강제 노역소",
                                        3789 =>"어둠의 미궁", 3790 =>"아키나이 납골당", 3791 =>"세데크 전당", 3792 =>"마나 무덤", 3805 =>"줄아만",
                                        3817 =>"Test Dungeon", 3820 =>"폭풍의 눈", 3836 =>"마그테리돈의 둥지", 3845 =>"폭풍우 요새", 3847 =>"신록의 정원",
                                        3848 =>"알카트라즈", 3849 =>"메카나르", 3917 =>"아킨둔", 3923 =>"그룰의 둥지", 3948 =>"시험용", 3959 =>"검은 사원",
                                        3968 =>"로데론의 폐허", 3979 =>"얼어붙은 바다", 4019 =>"진화의 대지", 4075 =>"태양샘 고원", 4076 =>"Reuse Me 7",
                                        4080 =>"쿠엘다나스 섬", 4100 =>"옛 스트라솔름", 4131 =>"마법학자의 정원", 4196 =>"드락타론 성채", 4197 =>"겨울손아귀 호수",
                                        4201 =>"볼드랏실의 눈물", 4228 =>"마력의 눈", 4258 =>"북해", 4264 =>"돌의 전당", 4265 =>"마력의 탑",
                                        4272 =>"번개의 전당", 4273 =>"울두아르", 4277 =>"아졸네룹", 4298 =>"동부 역병지대: 붉은십자군 초소", 4378 =>"달라란 투기장",
                                        4384 =>"고대의 해안", 4395 =>"달라란", 4406 =>"용맹의 투기장", 4415 =>"보랏빛 요새", 4416 =>"군드락",
                                        4493 =>"흑요석 성소", 4494 =>"안카헤트: 고대 왕국", 4500 =>"영원의 눈", 4602 =>"내부 강제", 4603 =>"아카본 석실",
                                        4630 =>"북해", 4710 =>"정복의 섬", 4722 =>"십자군의 시험장", 4723 =>"용사의 시험장", 4742 =>"흐로스가르 상륙지",
                                        4763 =>"수송: 얼라이언스 비행포격선", 4764 =>"수송: 호드 비행포격선", 4809 =>"영혼의 제련소", 4812 =>"얼음왕관 성채",
                                        4813 =>"사론의 구덩이", 4820 =>"투영의 전당", 4832 =>"수송: 얼라이언스 비행포격선", 4833 =>"수송: 호드 비행포격선",
                                        4893 =>"서리 여왕의 둥지", 4894 =>"공포와 재미가 넘치는 퓨트리사이드의 연금술 실험실", 4895 =>"진홍빛 전당", 4896 =>"얼어붙은 왕좌",
                                        4897 =>"피의 성소", 4987 =>"루비 성소", 14284 =>"북풍의 땅", 14285 =>"얼음왕관", 14286 =>"숄라자르 분지",
                                        14287 =>"용의 안식처", 14288 =>"격전의 겨울손아귀"
                                    ];
                                    ?>
                                    <?php
                                    $class_names = [
                                        1 => '전사', 2 => '성기사', 3 => '사냥꾼', 4 => '도적', 5 => '사제',
                                        6 => '죽음의 기사', 7 => '주술사', 8 => '마법사', 9 => '흑마법사', 11 => '드루이드'
                                    ];
                                    ?>
                                    <?php
                                    $class_names = [
                                        1 => '전사', 2 => '성기사', 3 => '사냥꾼', 4 => '도적', 5 => '사제',
                                        6 => '죽음의 기사', 7 => '주술사', 8 => '마법사', 9 => '흑마법사', 11 => '드루이드'
                                    ];
                                    ?>
                                    <ul style="list-style: none; padding: 0; display: flex; flex-wrap: wrap; justify-content: center;">
                                        <?php foreach ($_SESSION['characters'] as $char) { ?>
                                            <li style="flex: 0 0 19.5%; margin-bottom: 5px; border: 1px solid #C0C0C0; padding: 5px; border-radius: 5px; box-sizing: border-box; color: #D5D5D5; margin-right: 0.5%; background-color: rgba(192, 192, 192, 0.1);">
                                                <a href="" style="display: flex; align-items: flex-start; text-decoration: none; color: inherit;">
                                                    <div style="flex-shrink: 0;">
                                                        <img src="<?php echo get_config('baseurl') . '/template/' . get_config('template') . '/images/big_race/' . $antiXss->xss_clean($char['race']) . '-' . $antiXss->xss_clean($char['gender']) . '.gif'; ?>" alt="Race" style="max-width: 55px; height: auto;">
                                                    </div>
                                                    <?php $char_class_color = isset($class_colors[$char['class']]) ? $class_colors[$char['class']] : '#FFD700'; ?>
                                                    <div style="flex-grow: 1; padding-left: 5px; text-align: left; color: <?php echo $char_class_color; ?>; font-size: 1em;">
                                                        <div style="font-weight: bold; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-shadow: 1px 1px 1px #000;">Lv<?php echo $antiXss->xss_clean($char['level']); ?> <?php echo isset($class_names[$char['class']]) ? $class_names[$char['class']] : '알 수 없음'; ?></div>
                                                        <div style="font-weight: bold; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 0.9em; text-shadow: 1px 1px 1px #000;"><?php echo $antiXss->xss_clean($char['name']); ?></div>
                                                        <?php if (!empty($char['zone'])) { ?>
                                                            <?php
                                                                $raw_zone_id = (int)$char['zone'];
                                                                $zone_name = isset($zone_names[$raw_zone_id]) ? $zone_names[$raw_zone_id] : $raw_zone_id;
                                                            ?>
                                                            <div style="font-weight: bold; font-size: 0.8em; color: #bbb; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-shadow: 1px 1px 1px #000;"><?php echo $antiXss->xss_clean($zone_name); ?></div>
                                                        <?php } ?>
                                                    </div>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } else { ?>
                                    <p>캐릭터가 없습니다.</p>
                                <?php } ?>
                                <div style="max-width: 300px; margin: 20px auto 0;">
                                    <form id="logout-form" action="<?php echo get_config("baseurl"); ?>/index.php" method="post" style="display: none;">
                                        <input name="action_type" type="hidden" value="logout">
                                    </form>
                                    <button type="button" class="site-btn" style="width: 100%; margin-bottom: 10px; pointer-events: auto; position: relative;" onclick="console.log('Logout button clicked!'); document.getElementById('logout-form').submit();">로그아웃</button>
                                    <div style="pointer-events: auto;">
                                        <button type="button" class="site-btn" style="width: 100%; margin-bottom: 10px;" data-toggle="modal" data-target="#changepassword-modal">비밀번호 변경</button>
                                        <button type="button" class="site-btn" style="width: 100%; margin-bottom: 10px;" data-toggle="modal" data-target="#setsecurityquestions-modal">보안 질문 설정</button>
                                        <?php if (get_config('2fa_support')) { ?>
                                            <button type="button" class="site-btn" style="width: 100%;" data-toggle="modal" data-target="#e2fa-modal">2단계 인증</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Server Modal -->
        <div class="modal" id="about-server-modal" style="pointer-events: auto;">
            <div class="modal-dialog modal-lg" style="max-width: 900px; margin: 50px auto;">
                <div class="modal-content" style="background-color: rgba(50, 50, 70, 0.98); color: #F5E6AB;">
                    <div class="modal-header">
                        <h4 class="modal-title">서버 정보</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="about-server-modal-body">
                        <!-- about_server.php 내용이 여기에 로드됩니다 -->
                        로딩 중...
                    </div>
                </div>
            </div>
        </div>

        <!-- Register Modal -->
        <div class="modal" id="register-modal" style="pointer-events: auto;">
            <div class="modal-dialog" style="max-width: 400px; margin: 120px auto;">
                <div class="modal-content" style="background-color: rgba(50, 50, 70, 0.98); color: #F5E6AB;">
                    <div class="modal-header">
                        <h4 class="modal-title"><?php elang('create_account');?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php global $antiXss; echo $antiXss->xss_clean(get_config("baseurl")); ?>/index.php#register" method="post" class="form-class" id="con_form">
                            <div style="padding: 10px;">
                                <div class="input-group">
                                    <input type="email" placeholder="<?php elang('email'); ?>" name="email">
                                </div>
                                <?php if (!get_config('battlenet_support')) { ?>
                                    <div class="input-group">
                                        <input type="text" placeholder="<?php elang('username'); ?>" name="username">
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <input type="password" placeholder="<?php elang('password'); ?>" name="password">
                                </div>
                                <input type="password" placeholder="<?php elang('retype_password'); ?>" name="repassword">
                                <?php echo GetCaptchaHTML(false); ?>
                                <input name="submit" type="hidden" value="register">
                                <div class="text-center" style="margin-top: 10px;">
                                    <input type="submit" class="site-btn" value="<?php elang('register'); ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php if (false) { ?>
        <div class="promotion-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2><?php elang('server_status'); ?></h2>

                        <?php if (!get_config('disable_top_players')) : 
                            $i = 1;
                            foreach (get_config('realmlists') as $onerealm_key => $onerealm) : 
                        ?>
                                <h6 style='color: #005cbf;font-weight: bold;'><?php echo $antiXss->xss_clean($onerealm['realmname']); ?></h6><hr>
                                
                                <!-- Play Time Button & Modal -->
                                <?php $data2show = status::get_top_playtime($onerealm['realmid']); ?>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-aos="fade-up" data-aos-delay="100" data-target="#modal-id<?php echo $i; ?>"><?php echo lang('play_time'); ?></button>
                                <div class="modal" id="modal-id<?php echo $i; ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo lang('top_players') . ' - ' . lang('play_time'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <?php if (!is_array($data2show)) : ?>
                                                    <span style='color: #0d99e5;'><?php echo lang('online_players_msg2'); ?></span>
                                                <?php else : ?>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><?php echo lang('rank'); ?></th>
                                                                <th scope="col"><?php echo lang('name'); ?></th>
                                                                <th scope="col"><?php echo lang('race'); ?></th>
                                                                <th scope="col"><?php echo lang('class'); ?></th>
                                                                <th scope="col"><?php echo lang('level'); ?></th>
                                                                <th scope="col"><?php echo lang('play_time'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $m = 1;
                                                            foreach ($data2show as $one_char) : 
                                                                if (empty($one_char['name'])) continue;
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $m++; ?></td>
                                                                    <th scope="row"><?php global $antiXss; echo $antiXss->xss_clean($one_char['name']); ?></th>
                                                                    <td><img src="<?php global $antiXss; echo get_config('baseurl') . '/template/' . $antiXss->xss_clean(get_config('template')) . '/images/race/' . $antiXss->xss_clean($one_char['race']) . '-' . $antiXss->xss_clean($one_char['gender']) . '.gif'; ?>"></td>
                                                                    <td><img src="<?php global $antiXss; echo get_config('baseurl') . '/template/' . $antiXss->xss_clean(get_config('template')) . '/images/class/' . $antiXss->xss_clean($one_char['class']) . '.gif'; ?>"></td>
                                                                    <td><?php global $antiXss; echo $antiXss->xss_clean($one_char['level']); ?></td>
                                                                    <td><?php global $antiXss; echo $antiXss->xss_clean(get_human_time_from_sec($one_char['totaltime'])); ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                <?php endif; ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>

                                <!-- Killers Button & Modal -->
                                <?php $data2show = status::get_top_killers($onerealm['realmid']); ?>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-aos="fade-up" data-aos-delay="100" data-target="#modal-id<?php echo $i; ?>"><?php echo lang('killers'); ?></button>
                                <div class="modal" id="modal-id<?php echo $i; ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo lang('top_players') . ' - ' . lang('killers'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <?php if (!is_array($data2show)) : ?>
                                                    <span style='color: #0d99e5;'><?php echo lang('online_players_msg2'); ?></span>
                                                <?php else : ?>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><?php echo lang('rank'); ?></th>
                                                                <th scope="col"><?php echo lang('name'); ?></th>
                                                                <th scope="col"><?php echo lang('race'); ?></th>
                                                                <th scope="col"><?php echo lang('class'); ?></th>
                                                                <th scope="col"><?php echo lang('level'); ?></th>
                                                                <th scope="col"><?php echo lang('kills'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $m = 1;
                                                            foreach ($data2show as $one_char) : 
                                                                if (empty($one_char['name'])) continue;
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $m++; ?></td>
                                                                    <th scope="row"><?php global $antiXss; echo $antiXss->xss_clean($one_char['name']); ?></th>
                                                                    <td><img src="<?php global $antiXss; echo get_config('baseurl') . '/template/' . $antiXss->xss_clean(get_config('template')) . '/images/race/' . $antiXss->xss_clean($one_char['race']) . '-' . $antiXss->xss_clean($one_char['gender']) . '.gif'; ?>"></td>
                                                                    <td><img src="<?php global $antiXss; echo get_config('baseurl') . '/template/' . $antiXss->xss_clean(get_config('template')) . '/images/class/' . $antiXss->xss_clean($one_char['class']) . '.gif'; ?>"></td>
                                                                    <td><?php global $antiXss; echo $antiXss->xss_clean($one_char['level']); ?></td>
                                                                    <td><?php global $antiXss; echo $antiXss->xss_clean($one_char['totalKills']); ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                <?php endif; ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('close'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>

                                <!-- Honor Points Button & Modal -->
                                <?php $data2show = status::get_top_honorpoints($onerealm['realmid']); ?>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-aos="fade-up" data-aos-delay="100" data-target="#modal-id<?php echo $i; ?>"><?php echo lang('honor_points'); ?></button>
                                <div class="modal" id="modal-id<?php echo $i; ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo lang('top_players') . ' - ' . lang('honor_points'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <?php if (!is_array($data2show)) : ?>
                                                    <span style='color: #0d99e5;'><?php echo lang('online_players_msg2'); ?></span>
                                                <?php else : ?>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><?php echo lang('rank'); ?></th>
                                                                <th scope="col"><?php echo lang('name'); ?></th>
                                                                <th scope="col"><?php echo lang('race'); ?></th>
                                                                <th scope="col"><?php echo lang('class'); ?></th>
                                                                <th scope="col"><?php echo lang('level'); ?></th>
                                                                <?php if (get_config('expansion') >= 6) : ?>
                                                                    <th scope="col"><?php echo lang('honor_level'); ?></th>
                                                                <?php endif; ?>
                                                                <th scope="col"><?php echo lang('honor_points'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $m = 1;
                                                            foreach ($data2show as $one_char) : 
                                                                if (empty($one_char['name'])) continue;
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $m++; ?></td>
                                                                    <th scope="row"><?php global $antiXss; echo $antiXss->xss_clean($one_char['name']); ?></th>
                                                                    <td><img src="<?php global $antiXss; echo get_config('baseurl') . '/template/' . $antiXss->xss_clean(get_config('template')) . '/images/race/' . $antiXss->xss_clean($one_char['race']) . '-' . $antiXss->xss_clean($one_char['gender']) . '.gif'; ?>"></td>
                                                                    <td><img src="<?php global $antiXss; echo get_config('baseurl') . '/template/' . $antiXss->xss_clean(get_config('template')) . '/images/class/' . $antiXss->xss_clean($one_char['class']) . '.gif'; ?>"></td>
                                                                    <td><?php global $antiXss; echo $antiXss->xss_clean($one_char['level']); ?></td>
                                                                    <?php if (get_config('expansion') >= 6) : ?>
                                                                        <td><?php global $antiXss; echo $antiXss->xss_clean($one_char['honorLevel']); ?></td>
                                                                        <td><?php global $antiXss; echo $antiXss->xss_clean($one_char['honor']); ?></td>
                                                                    <?php else : ?>
                                                                        <td><?php global $antiXss; echo $antiXss->xss_clean($one_char['totalHonorPoints']); ?></td>
                                                                    <?php endif; ?>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                <?php endif; ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('close'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>

                                <!-- Arena Points Button & Modal -->
                                <?php $data2show = status::get_top_arenapoints($onerealm['realmid']); ?>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-aos="fade-up" data-aos-delay="100" data-target="#modal-id<?php echo $i; ?>"><?php echo lang('arena_points'); ?></button>
                                <div class="modal" id="modal-id<?php echo $i; ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo lang('top_players') . ' - ' . lang('arena_points'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <?php if (!is_array($data2show)) : ?>
                                                    <span style='color: #0d99e5;'><?php echo lang('online_players_msg2'); ?></span>
                                                <?php else : ?>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><?php echo lang('rank'); ?></th>
                                                                <th scope="col"><?php echo lang('name'); ?></th>
                                                                <th scope="col"><?php echo lang('race'); ?></th>
                                                                <th scope="col"><?php echo lang('class'); ?></th>
                                                                <th scope="col"><?php echo lang('level'); ?></th>
                                                                <th scope="col"><?php echo lang('arena_points'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $m = 1;
                                                            foreach ($data2show as $one_char) : 
                                                                if (empty($one_char['name'])) continue;
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $m++; ?></td>
                                                                    <th scope="row"><?php global $antiXss; echo $antiXss->xss_clean($one_char['name']); ?></th>
                                                                    <td><img src="<?php global $antiXss; echo get_config('baseurl') . '/template/' . $antiXss->xss_clean(get_config('template')) . '/images/race/' . $antiXss->xss_clean($one_char['race']) . '-' . $antiXss->xss_clean($one_char['gender']) . '.gif'; ?>"></td>
                                                                    <td><img src="<?php global $antiXss; echo get_config('baseurl') . '/template/' . $antiXss->xss_clean(get_config('template')) . '/images/class/' . $antiXss->xss_clean($one_char['class']) . '.gif'; ?>"></td>
                                                                    <td><?php global $antiXss; echo $antiXss->xss_clean($one_char['level']); ?></td>
                                                                    <td><?php global $antiXss; echo $antiXss->xss_clean($one_char['arenaPoints']); ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                <?php endif; ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('close'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>

                                <!-- Arena Teams Button & Modal -->
                                <?php $data2show = status::get_top_arenateams($onerealm['realmid']); ?>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-aos="fade-up" data-aos-delay="100" data-target="#modal-id<?php echo $i; ?>"><?php echo lang('arena_teams'); ?></button>
                                <div class="modal" id="modal-id<?php echo $i; ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo lang('top_players') . ' - ' . lang('arena_teams'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <?php if (!is_array($data2show)) : ?>
                                                    <span style='color: #0d99e5;'><?php echo lang('online_players_msg2'); ?></span>
                                                <?php else : ?>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><?php echo lang('rank'); ?></th>
                                                                <th scope="col"><?php echo lang('name'); ?></th>
                                                                <th scope="col"><?php echo lang('rating'); ?></th>
                                                                <th scope="col"><?php echo lang('captain_name'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $m = 1;
                                                            foreach ($data2show as $one_char) : 
                                                                $character_data = status::get_character_by_guid($onerealm['realmid'], $one_char['captainGuid']);
                                                                if (empty($character_data['name'])) continue;
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $m++; ?></td>
                                                                    <th scope="row"><?php global $antiXss; echo $antiXss->xss_clean($one_char['name']); ?></th>
                                                                    <td><?php global $antiXss; echo $antiXss->xss_clean($one_char['rating']); ?></td>
                                                                    <td><?php global $antiXss; echo (!empty($character_data["name"]) ? $antiXss->xss_clean($character_data['name']) : '-'); ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                <?php endif; ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('close'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                $i++;
                                echo "<hr>";
                            endforeach;
                        endif; 
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>
        <?php if (!get_config('disable_online_players')) { ?>
        <div class="media-section spad" style="margin-top: 50px; pointer-events: auto;">
            <div class="overlay"></div>
            <div class="container">
                <div class="section-title">
                    <!-- <h2><?php elang('online_players'); ?>:</h2> -->
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center" style="margin-top: -90px;">
                            <?php foreach (get_config('realmlists') as $onerealm_key => $onerealm) {
                                $online_count = user::get_online_players_count($onerealm['realmid']);
                                echo "<h2><span style='color: #9482C9;font-weight: bold;'>{$onerealm['realmname']}</span></h2>";
                                echo "<p style='font-size: 12px;'>(" . lang('online_players_msg1') . " " . $online_count . ")</p><hr>";
                                $online_chars = user::get_online_players($onerealm['realmid']);
                                
                                if (!is_array($online_chars)) {
                                    echo "<span style='color: #0d99e5;'>" . lang('online_players_msg2') . "</span>";
                                } else {
                                                                echo '<table class="table table-dark"><thead><tr><th scope="col" id="sort-name" data-sort-key="name">' . lang('name') . '</th><th scope="col">' . lang('race') . '</th> <th scope="col">' . lang('class') . '</th><th scope="col" id="sort-level" data-sort-key="level">' . lang('level') . '</th><th scope="col">' . lang('guild') . '</th><th scope="col" id="sort-zone" data-sort-key="zone">' . lang('zone') . '</th></tr></thead><tbody id="online-players-tbody">';
                                    
                                    foreach ($online_chars as $one_char) {
                                        $raw_zone_id = isset($one_char['zone']) ? $one_char['zone'] : 0; // Default to 0 if 'zone' key is missing
                                        $zone_name = isset($zone_names[$raw_zone_id]) ? $zone_names[$raw_zone_id] : $raw_zone_id;
                                        
                                        $class_color = isset($class_colors[$one_char['class']]) ? $class_colors[$one_char['class']] : '#FFD700'; // Default to gold if color not found
                                        echo '<tr style="color: ' . $class_color . ';"><th scope="row">' . $antiXss->xss_clean($one_char['name']) . '</th><td><img src="' . get_config("baseurl") . '/template/' . $antiXss->xss_clean(get_config("template")) . '/images/race/' . $antiXss->xss_clean($one_char["race"]) . '-' . $antiXss->xss_clean($one_char["gender"]) . '.gif"></td><td><img src="' . get_config("baseurl") . '/template/' . $antiXss->xss_clean(get_config("template")) . '/images/class/' . $antiXss->xss_clean($one_char["class"]) . '.gif"></td><td>' . $antiXss->xss_clean($one_char['level']) . '</td><td>' . (isset($one_char['guildname']) ? $antiXss->xss_clean($one_char['guildname']) : '-') . '</td><td>' . $antiXss->xss_clean($zone_name) . '</td></tr>';
                                    }
                                    echo '</table>';
                                }
                                echo "<hr>";
                            } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <!-- Audio Player for Background Music -->
    <audio id="background-music" preload="auto" volume="0.5">
        Your browser does not support the audio element.
    </audio>

    <!-- Music Controls (Hidden initially, shown after entering main content) -->
    <div id="music-controls" style="<?php echo (isset($_SESSION['splash_shown']) && $_SESSION['splash_shown'] === true) ? 'display: flex;' : 'display: none;'; ?> position: fixed; top: 20px; right: 20px; z-index: 9999; flex-direction: column; align-items: flex-end; pointer-events: auto;">
        <canvas id="player-visualizer" width="150" height="40" style="margin-top: 5px;"></canvas>
        <div id="volume-controls-row" style="display: flex; align-items: center; margin-bottom: 5px;">
            <i id="mute-icon" class="fa fa-volume-up" style="color: white; font-size: 20px; cursor: pointer; margin-right: 5px;"></i>
            <input type="range" id="volume-slider" min="0" max="100" value="20" style="width: 100px; vertical-align: middle;">
        </div>
        <div style="display: flex; align-items: center; margin-bottom: 5px;">
            <div id="current-track-title" style="color: white; margin-left: 10px; font-size: 14px; width: 100%; text-align: right;"></div>
            <button id="player-prev" style="background: none; border: none; color: white; font-size: 16px; cursor: pointer; margin-right: 5px;"><i class="fa fa-step-backward"></i></button>
            <i id="play-pause-icon" class="fa fa-play" style="color: white; font-size: 20px; cursor: pointer; margin-right: 5px;"></i>
            <button id="player-next" style="background: none; border: none; color: white; font-size: 16px; cursor: pointer;"><i class="fa fa-step-forward"></i></button>
        </div>
    </div>

    <!-- Splash Screen -->
    <div id="splash-screen" style="<?php echo (isset($_SESSION['splash_shown']) && $_SESSION['splash_shown'] === true) ? 'display: none;' : ''; ?>">
        <button id="enter-button" style="color: white; box-shadow: none;"><?php elang('welcome_to'); ?></button>
    </div>

    <!-- Main Content Container -->
    <div id="main-content" style="<?php echo (isset($_SESSION['splash_shown']) && $_SESSION['splash_shown'] === true) ? 'display: block;' : 'display: none;'; ?>">

        <div id="preloder">
            <div class="loader">
                <img src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/img/logo.png" alt="">
                <h2>Loading ...</h2>
            </div>
        </div>

    </div> <!-- End of #main-content -->

    <div id="page-content-wrapper" style="display: block;">
        <div class="hero-section">
            <div class="hero-content">
                <div class="hero-center">
                    
                </div>
            </div>
            <div id="hero-slider" class="owl-carousel">
            <div class="item  hero-item" data-bg="<?php echo get_template_image_url('img/01.jpg'); ?>"></div>
            <div class="item  hero-item" data-bg="<?php echo get_template_image_url('img/02.jpg'); ?>"></div>
            <div class="item  hero-item" data-bg="<?php echo get_template_image_url('img/03.jpg'); ?>"></div>
            <div class="item  hero-item" data-bg="<?php echo get_template_image_url('img/04.jpg'); ?>"></div>
            <div class="item  hero-item" data-bg="<?php echo get_template_image_url('img/05.jpg'); ?>"></div>
        </div>
        </div>
    <script src="<?php echo $antiXss->xss_clean(get_config("baseurl")); ?>/template/<?php echo $antiXss->xss_clean(get_config("template")); ?>/js/online_player_sort.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const splashScreen = document.getElementById('splash-screen');
            const mainContent = document.getElementById('main-content');
            const overlayContent = document.getElementById('overlay-content');
            const musicControls = document.getElementById('music-controls');
            const backgroundMusic = document.getElementById('background-music');

            if (splashScreen && splashScreen.style.display !== 'none') {
                splashScreen.addEventListener('click', function() {
                    // Send AJAX request to set splash_shown session
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', '<?php echo get_config("baseurl"); ?>/set_splash_session.php', true);
                    xhr.send();

                    // Hide splash screen
                    splashScreen.style.display = 'none';

                    // Show main content and other elements (controlled by main.js loader function now)
                    // if (mainContent) {
                    //     mainContent.style.display = 'block';
                    // }
                    // if (overlayContent) {
                    //     overlayContent.style.display = 'block';
                    // }
                    // if (musicControls) {
                    //     musicControls.style.display = 'flex';
                    // }

                    // Attempt to play background music
                    if (backgroundMusic && backgroundMusic.paused) {
                        backgroundMusic.play().catch(e => {
                            console.log('Autoplay prevented:', e);
                            // Optionally, show a play button if autoplay is blocked
                        });
                    }
                });
            }
        });
    </script>
</body>
</html>
</body>
</html>
*/ ?>"