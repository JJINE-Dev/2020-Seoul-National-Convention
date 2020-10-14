<?php
namespace Controller;

use App\DB;

class ViewController {
    function index() {
        view("index");
    }

    // A과제
    /**
     * 메소드랑 파일명은 자신이 기억하기 쉽도록
     * 일정한 규칙을 만들어서 사용함. 
     * 
     * 민재 선배 같은 경우는 메소드랑 파일 이름 같게 함.
     */
    function overview() {
        view("overview");
    }

    function roadmap() {
        view("roadmap");
    }

    // 회원 관리
    function join() {
        view("join");
    }

    function login() {

    }
}