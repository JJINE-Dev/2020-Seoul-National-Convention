<?php
/* 
    헬퍼에서 모든 변수를 다 생각하고 미리 함수를 만들어야 한다.
    이미지 업로드 대비해서 함수를 만들어야한다. 이미지에 대한 함수라든지, 확장자가 필요할테고 

*/ 

// 사이트 내에 유저 테이블이 변경될 수 있는 경우 
function user() {
    if(isset($_SESSION['user'])) {
        $user = DB::find("users", $_SESSION['user']->id);
        // DB에 정보가 없으면 로그아웃
        if(!$user) {
            go("/logout", "회원 정보를 찾을 수 없어 로그아웃이 되었습니다.");
        } else {
            // 있으면 세션 업데이트
            $_SESSION['user'] = $user;
            return $_SESSION['user'];
        } 
    } else return false;
}

/**
 * 변경이 없다면 이렇게 써
 * function user() {
 *      return isset($_SESSION['user]) ? $_SESSION['user] : false;
 * }
 */

 function company() {
     return user() && user()->type == 'company';
 }

 function admin() {
    return user() && user()->type == 'admin';
}

/**
 * 여기서 실수하기 쉬운 거
 * alert 다음에 location이 와야함.
 * 이동한 다음 alert가 떠버리면
 * 유저가 확인을 누르기 전에 이동해버림.
 */

function go($url, $message) {
    echo "<script>";
    echo "alert('$message');";
    echo "location.href='$url';";
    echo "</script>";
    exit; // 꼭 붙이기
}

function back($message) {
    echo "<script>";
    echo "alert('$message');";
    echo "history.back();";
    echo "</script>";
    exit; // 꼭 붙이기
}

function view($viewName, $data = []) {  
    extract($data);

    require VIEW . "/header.php";
    require VIEW . "/$viewName.php";
    require VIEW . "/footer.php";
    exit; // 이건 굳이 안해도 된다.
}

function checkEmpty() {
    foreach($_POST as $input) {
        if(!is_array($input) && trim($input) == "") 
            back("모든 정보를 입력해 주세요!");
    }
}

// strrpos :: 뒤에서부터 특정 문자열 검사하기
function extname($filename) { // 확장자를 가져올 수 있음. 
    return strtolower(substr($filename, strrpos($filename, ".")));
    //대문자 소문자 터지지않게 strtolower() 메소드 사용
}

// 이미지 검사 메소드 
function isImage($filename) {
    // .jpg > 0 : false 
    return array_search(extname($filename), [".jpg", ".png", ".gif"]) >= 0;
}

// encoding 
function enc($output) {
    //new line to <br>
    return nl2br(str_replace(" ", "&nbsp;", htmlentities($output)));
}

function json_response($data) {
    echo json_encode($data, JSON_UNESCAPED_UNICODE); // 한글을 지원하기 위해서 이거 안쓰면은 반환 타입에 따라 다르며 한글이 깨질 수 있음 
}

