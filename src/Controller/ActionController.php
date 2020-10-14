<?php
namespace Controller;

use App\DB;

class ActionController {
    // 회원 관리

    function join() {
        checkEmpty();
        extract($_POST);

        $file = $_FILES['image']; //html 에서 image라는 name을 가지고 있어야 한다.
        $filename = time() . extname($file['name']); // 빠르게 파일명을 중복되지 않게 만듦
        move_uploaded_file($file['tmp_name'], UPLOAD ."/$filename");

        DB::query("INSERT INTO users(user_email, user_name, password, image, type)
                                                    VALUES (?, ?, ?, ?, ?)",
                                                    [$user_email, $user_name, $password, $filename, $type]);
        go("/", "회원가입 되었습니다.");
    }
}