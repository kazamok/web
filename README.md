# 🌍 TrinityCore/AzerothCore/AshamaneCore/CMangos를 위한 간단한 웹 등록 페이지

이 프로젝트는 주요 게임 서버 코어와 호환되는 다목적 웹사이트를 쉽게 구축할 수 있도록 설계된 PHP 기반의 웹 등록 페이지입니다.

**지원하는 코어:**

*   [AzerothCore](http://azerothcore.org)
*   [TrinityCore](http://TrinityCore.org)
*   [AshamaneCore](https://github.com/AshamaneProject/AshamaneCore/)
*   [CMangos](https://github.com/cmangos/)

### ⭐ 프로젝트가 마음에 드셨다면 별을 눌러주세요! ⭐

<a href="https://github.com/masterking32/WoWSimpleRegistration">
   <img title="Star on GitHub" src="https://img.shields.io/github/stars/masterking32/WoWSimpleRegistration.svg?style=social&label=Star">
</a>
<a href="https://github.com/masterking32/WoWSimpleRegistration/fork">
   <img title="Fork on GitHub" src="https://img.shields.io/github/forks/masterking32/WoWSimpleRegistration.svg?style=social&label=Fork">
</a>

## ✅ 주요 기능

이 웹사이트는 게임 서버 사용자를 위한 포괄적인 기능을 제공하며, 사용자 친화적인 인터페이스와 동적인 콘텐츠를 특징으로 합니다.

1.  **사용자 등록 및 인증**:
    *   간편한 계정 생성 및 로그인 기능.
    *   비밀번호 변경 및 복구 기능.
    *   2단계 인증(2FA) 지원으로 보안 강화.
    *   HCaptcha/Recaptcha v2 또는 이미지 캡차를 통한 봇 방지.

2.  **서버 정보 및 통계**:
    *   **온라인 플레이어 상태**: 서버에 접속 중인 플레이어 수 및 상세 목록(이름, 종족, 직업, 레벨, 길드, 지역) 실시간 표시.
    *   **리더보드**: 플레이 시간, 킬러, 명예 점수, 아레나 점수, 아레나 팀 등 다양한 카테고리별 상위 플레이어 순위 제공.

3.  **사용자 경험 (UX) 및 인터페이스 (UI)**:
    *   **스플래시 화면**: "서버에 오신걸 환영합니다." 메시지와 "입장하기" 버튼을 통해 몰입감 있는 시작 경험 제공.
    *   **배경 음악**: 웹사이트 탐색 중 배경 음악 재생 기능 및 볼륨 조절, 음소거/음소거 해제, 현재 재생 트랙 제목 표시 기능.
    *   **프리로더**: 페이지 로딩 중 시각적인 로딩 애니메이션 제공.
    *   **히어로 섹션**: 배경 이미지 슬라이더를 포함한 메인 비주얼 영역.
    *   **모달 창**: 로그인, 등록, 비밀번호 복구, 언어 선택 등 다양한 기능에 대한 깔끔한 모달 인터페이스.
    *   **다국어 지원**: 한국어를 포함한 다양한 언어 지원.

4.  **기타 기능**:
    *   **연결 가이드**: 새로운 플레이어를 위한 서버 접속 방법 안내.
    *   **문의 양식**: 사용자 문의 및 지원을 위한 연락처 페이지.
    *   **투표 시스템**: 커뮤니티 참여를 위한 투표 기능.

## 🛠️ 기술 스택

*   **백엔드**: PHP (버전 8.0 이상 권장)
*   **프론트엔드**: HTML5, CSS3, JavaScript
*   **CSS 프레임워크**: Bootstrap
*   **JavaScript 라이브러리**: jQuery, Magnific Popup, Owl Carousel, Circle Progress 등
*   **데이터베이스**: MySQL (게임 서버 코어에 따라 다름)

## 📂 파일 구조

프로젝트의 주요 디렉토리 및 파일은 다음과 같습니다.

*   **`index.php`**: 웹사이트의 진입점 파일. PHP 버전 확인 및 핵심 로직 로드.
*   **`application/`**: 애플리케이션의 핵심 로직을 포함합니다.
    *   `config/`: 웹사이트의 전반적인 설정 파일 (`config.php`).
    *   `include/`: 핵심 함수 및 클래스 파일.
    *   `language/`: 다국어 지원을 위한 언어 파일.
    *   `vendor/`: Composer를 통해 설치된 외부 라이브러리.
*   **`template/`**: 웹사이트의 테마 파일들을 포함합니다.
    *   `battleforazeroth/`: 현재 사용 중인 'Battle for Azeroth' 테마의 파일들.
        *   `audio/`: 배경 음악 파일.
        *   `css/`: 테마별 스타일시트.
        *   `img/`: 테마별 이미지 파일.
        *   `js/`: 테마별 JavaScript 파일.
        *   `tpl/`: 테마의 주요 템플릿 파일 (`main.php`, `header.php`, `footer.php` 등).
*   **`screenshots/`**: 프로젝트의 다양한 테마 스크린샷.

## 🖱️ 필수 요구 사항

PHP 버전 8.0 이상이 설치되어 있어야 하며, 다음 PHP 확장 기능이 활성화되어야 합니다:

*   [GMP Extension](https://www.php.net/manual/en/book.gmp.php)
*   [GD Extension](https://www.php.net/manual/en/book.image.php)
*   [ZIP Extension](https://www.php.net/manual/en/book.zip.php)
*   [Soap Extension](https://www.php.net/manual/en/book.soap.php)
*   [Mbstring Extension](https://www.php.net/manual/en/book.mbstring.php)
*   [PDO Extension](https://www.php.net/manual/en/book.pdo.php)
*   [PDO-MySQL Extension](https://www.php.net/manual/en/ref.pdo-mysql.php)

## ⚙️ 설치 가이드 (최신 버전 - PHP 8)

1.  서버에 위에서 언급된 필수 요구 사항을 충족시키세요.

2.  프로젝트 파일을 다운로드하거나 Git을 사용하여 클론하세요:

    ```bash
    git clone https://github.com/masterking32/WoWSimpleRegistration
    ```

3.  [Composer](https://getcomposer.org/download/)를 설치하세요.

4.  프로젝트 디렉토리로 이동한 다음, `application/` 디렉토리로 이동하세요.

5.  다음 명령어를 실행하여 필요한 의존성을 설치하세요:

    ```bash
    composer install
    ```

6.  `application/config/` 디렉토리로 이동하여 `config.php.sample` 파일을 `config.php`로 이름을 변경하세요.

7.  새로 이름 변경된 `config.php` 파일을 편집하여 서버 세부 정보를 입력하세요. "Image Captcha" 기능을 사용하는 경우, PHP의 GD2 모듈이 활성화되어 있어야 합니다.

8.  설정이 완료되면 등록 페이지가 작동할 것입니다.

## 🔧 PHP 7 버전 다운로드

PHP 7 지원이 필요한 경우, [PHP 7과 호환되는 마지막 커밋](https://github.com/masterking32/WoWSimpleRegistration/tree/32a1e7e6bc31f2ed6ed1d83f64d1ae62aeab9d32)을 사용하세요. 특정 커밋에서 저장소를 클론하려면 다음 단계를 따르세요:

```sh
git clone https://github.com/masterking32/WoWSimpleRegistration
cd WoWSimpleRegistration
git checkout 32a1e7e6bc31f2ed6ed1d83f64d1ae62aeab9d32
```

# 🪛 디버깅

빈 페이지가 나타나는 것은 흔한 문제이며, 일반적으로 진단이 필요한 숨겨진 오류를 나타냅니다. 문제 해결을 용이하게 하려면 구성 파일에서 `debug_mode`를 활성화하세요.

디버그 모드를 활성화하는 방법:

*   `config.php` 파일을 엽니다.
*   `$config['debug_mode']` 매개변수를 찾습니다.
*   디버그 모드를 활성화하려면 `true`로 설정합니다.

⚠️ **중요: 문제를 해결한 후에는 디버그 모드를 비활성화하는 것을 잊지 마세요.** 웹사이트를 프로덕션 환경에 배포하거나 라이브하기 전에 디버그 모드를 `false`로 설정해야 합니다. 이는 보안 및 성능이 저하되지 않도록 하는 데 도움이 됩니다.

## 🖼️ 스크린샷

### Battle for Azeroth 템플릿

![Battle for Azeroth Template Screenshot](https://raw.githubusercontent.com/masterking32/WoWSimpleRegistration/master/screenshots/b1.jpg)

더 많은 시각 자료를 찾으시나요? [여기에서 추가 스크린샷을 찾아보세요.](https://github.com/masterking32/WoWSimpleRegistration/tree/master/screenshots)

## ⬇️ 기여자

### 🧑‍💻 프로그래밍

*   **리드 개발자**: [Amin.MasterkinG](https://masterking32.com)

### 🫂 번역

*   **영어/페르시아어**: [Amin.MasterkinG](https://github.com/masterking32)
*   **이탈리아어**: [Helias](https://github.com/helias)
*   **중국어 간체/번체**: [Coolzoom](https://github.com/coolzoom), [oiuv](https://github.com/oiuv)
*   **스웨덴어**: [Kitzunu](https://github.com/Kitzunu)
*   **프랑스어**: [Kalorte](https://github.com/Kalorte)
*   **독일어**: [DuelistRag3](https://github.com/DuelistRag3)
*   **스페인어**: [xjose93](https://github.com/xjose93)
*   **한국어**: [KOREAFTP](https://github.com/KOREAFTP)
*   **러시아어**: [Haeniken](https://github.com/Haeniken)
*   **포르투갈어**: [xnexuiz](https://github.com/xnexuiz)

이 프로젝트에 귀중한 지원과 기여를 해주신 모든 분들께 진심으로 감사드립니다.