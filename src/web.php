<?php

// 가능하면 URL 정도는 다 외워서 치는 걸 목표로 !
use App\Router;

// B과제에서 만들었던 페이지를 우선적으로 만들어야 함.

Router::get("/", "ViewController@index");

// A과제
Router::get("/overview", "ViewController@overview");
Router::get("/roadmap", "ViewController@roadmap");

// 회원관리
Router::get("/join", "ViewController@join", "guest");
Router::get("/login", "ViewController@login", "guest");

Router::post("/join", "ActionController@join", "guest");
Router::post("/login", "ActionController@login", "guest");
Router::post("/logout", "ActionController@logout", "user");

Router::get("/api/users/{user_email}", "AjaxController@getUser") ;

// 온라인 스토어
Router::get('"/store", "ViewController@store');

// 출품하기
Router::get("/entry", "ViewController@entry");


// // 관리자 접근일 경우 
// Router::get("/", "ViewController@index", "admin");

Router::start();