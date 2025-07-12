<?php
// application/loader.php를 포함하여 필요한 함수와 변수를 초기화합니다.
// 이 파일은 모달 콘텐츠를 제공하므로, 전체 페이지 헤더/푸터는 포함하지 않습니다.
require_once 'application/loader.php';

// 서버 정보 (예시: 실제로는 DB나 설정 파일에서 가져올 수 있음)
$server_features = [
    'xp_rate' => 'x5',
    'drop_rate' => 'x3',
    'custom_content' => [
        '새로운 던전: 그림자 미궁',
        '커스텀 아이템: 전설의 검',
        'PvP 아레나 시즌 1',
    ],
    'events' => [
        '매주 주말 경험치 부스트 이벤트',
        '월간 보스 레이드 챌린지',
    ],
];

$server_rules = [
    '욕설 및 비방 금지',
    '버그 악용 금지',
    '계정 공유 금지',
    '타인 비방 및 괴롭힘 금지',
    '운영진 사칭 금지',
];

$contact_info = [
    'email' => 'support@yourserver.com',
    'discord_link' => 'https://discord.gg/yourserver', // 실제 디스코드 링크로 변경하세요
    'forum_link' => 'https://forum.yourserver.com', // 실제 포럼 링크로 변경하세요 (선택 사항)
];

// $antiXss 변수가 loader.php에서 전역으로 선언되었으므로, 여기서는 global 선언이 필요 없습니다.
// 만약 get_template_image_url 함수가 $antiXss를 사용한다면, 해당 함수 내에서 global 선언이 필요할 수 있습니다.
?>

<div class="container-fluid" style="padding: 0;">
    <h1 class="text-center my-4" style="color: #FFD700;">서버 정보</h1>

    <!-- 서버 특징 섹션 -->
    <div class="card mb-4" style="background-color: rgba(0, 0, 0, 0.7); border: none;">
        <div class="card-header" style="background-color: rgba(23, 162, 184, 0.85); color: white; font-weight: bold;">
            서버 특징
        </div>
        <div class="card-body" style="color: white;">
            <p><strong>경험치 배율:</strong> <?php echo $server_features['xp_rate']; ?></p>
            <p><strong>아이템 드랍 배율:</strong> <?php echo $server_features['drop_rate']; ?></p>
            <h5>커스텀 콘텐츠:</h5>
            <ul class="list-group list-group-flush" style="background-color: transparent;">
                <?php foreach ($server_features['custom_content'] as $content) { ?>
                    <li class="list-group-item" style="background-color: transparent; color: white; border-color: rgba(255, 255, 255, 0.1);">
                        <?php echo $content; ?>
                    </li>
                <?php } ?>
            </ul>
            <h5 class="mt-3">특별 이벤트:</h5>
            <ul class="list-group list-group-flush" style="background-color: transparent;">
                <?php foreach ($server_features['events'] as $event) { ?>
                    <li class="list-group-item" style="background-color: transparent; color: white; border-color: rgba(255, 255, 255, 0.1);">
                        <?php echo $event; ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <!-- 서버 규칙 섹션 -->
    <div class="card mb-4" style="background-color: rgba(0, 0, 0, 0.7); border: none;">
        <div class="card-header" style="background-color: rgba(23, 162, 184, 0.85); color: white; font-weight: bold;">
            서버 규칙
        </div>
        <div class="card-body" style="color: white;">
            <ul class="list-group list-group-flush" style="background-color: transparent;">
                <?php foreach ($server_rules as $rule) { ?>
                    <li class="list-group-item" style="background-color: transparent; color: white; border-color: rgba(255, 255, 255, 0.1);">
                        <?php echo $rule; ?>
                    </li>
                <?php } ?>
            </ul>
            <p class="mt-3">모든 플레이어는 원활한 게임 환경을 위해 위 규칙을 준수해야 합니다.</p>
        </div>
    </div>

    <!-- 연락처/지원 섹션 -->
    <div class="card mb-4" style="background-color: rgba(0, 0, 0, 0.7); border: none;">
        <div class="card-header" style="background-color: rgba(23, 162, 184, 0.85); color: white; font-weight: bold;">
            연락처 및 지원
        </div>
        <div class="card-body" style="color: white;">
            <p><strong>이메일:</strong> <a href="mailto:<?php echo $contact_info['email']; ?>" style="color: #FFD700;"><?php echo $contact_info['email']; ?></a></p>
            <p><strong>디스코드:</strong> <a href="<?php echo $contact_info['discord_link']; ?>" target="_blank" style="color: #FFD700;">저희 디스코드 채널에 참여하세요!</a></p>
            <?php if (!empty($contact_info['forum_link'])) { ?>
                <p><strong>포럼:</strong> <a href="<?php echo $contact_info['forum_link']; ?>" target="_blank" style="color: #FFD700;">공식 포럼 방문하기</a></p>
            <?php } ?>
            <p class="mt-3">문의 사항이나 도움이 필요하시면 언제든지 연락 주세요.</p>
        </div>
    </div>

    <!-- 스크린샷/영상 갤러리 섹션 -->
    <div class="card mb-4" style="background-color: rgba(0, 0, 0, 0.7); border: none;">
        <div class="card-header" style="background-color: rgba(23, 162, 184, 0.85); color: white; font-weight: bold;">
            갤러리
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <img src="<?php echo get_template_image_url('img/01.jpg'); ?>" class="img-fluid rounded" alt="서버 스크린샷 1">
                </div>
                <div class="col-md-4 mb-3">
                    <img src="<?php echo get_template_image_url('img/02.jpg'); ?>" class="img-fluid rounded" alt="서버 스크린샷 2">
                </div>
                <div class="col-md-4 mb-3">
                    <img src="<?php echo get_template_image_url('img/03.jpg'); ?>" class="img-fluid rounded" alt="서버 스크린샷 3">
                </div>
                <!-- 필요에 따라 더 많은 이미지 추가 -->
            </div>
        </div>
    </div>

</div>