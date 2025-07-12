<?php
header('Content-Type: text/plain; charset=utf-8');

// --- 설정 ---
// 오디오 파일이 있는 폴더의 상대 경로
$audioFolderPath = 'template/battleforazeroth/audio';

// 생성될 playlist.json 파일의 상대 경로
$playlistJsonPath = 'application/config/playlist.json';
// ---

$audioDir = __DIR__ . '/' . $audioFolderPath;
$outputFile = __DIR__ . '/' . $playlistJsonPath;

if (!is_dir($audioDir)) {
    die("오류: 오디오 폴더를 찾을 수 없습니다. 경로를 확인하세요: " . $audioDir);
}

$playlist = [];
$files = scandir($audioDir);

if ($files === false) {
    die("오류: 오디오 폴더를 읽을 수 없습니다.");
}

foreach ($files as $file) {
    // .mp3 확장자를 가진 파일만 대상으로 함
    if (pathinfo($file, PATHINFO_EXTENSION) === 'mp3') {
        // 파일명에서 확장자를 제거하여 제목으로 사용
        $title = pathinfo($file, PATHINFO_FILENAME);

        // 보기 좋게 공백 처리 (예: "01. Lion's Pride" -> "Lion's Pride")
        $title = preg_replace('/^\d+\s*\.?\s*/', '', $title);
        $title = str_replace('_', ' ', $title); // 밑줄을 공백으로 변경

        $playlist[] = [
            'title' => trim($title),
            'src' => $audioFolderPath . '/' . $file
        ];
    }
}

// JSON 형식으로 변환 (읽기 좋게 포맷팅)
$json_data = json_encode($playlist, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

if ($json_data === false) {
    die("오류: JSON 데이터를 생성하지 못했습니다. 오류: " . json_last_error_msg());
}

// 파일에 저장
$result = file_put_contents($outputFile, $json_data);

if ($result === false) {
    die("오류: playlist.json 파일을 저장하지 못했습니다. 폴더 권한을 확인하세요: " . $outputFile);
} else {
    echo "성공! \n";
    echo count($playlist) . "개의 노래를 찾아서 playlist.json 파일을 업데이트했습니다.\n";
    echo "생성된 파일 경로: " . $outputFile . "\n\n";
    echo "이제 웹사이트를 새로고침하여 변경사항을 확인하세요.";
}
?>