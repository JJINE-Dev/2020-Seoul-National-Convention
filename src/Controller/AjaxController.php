<?php
namespace Controller;

use App\DB;

class AjaxController {
    function getUseR($user_email) {
        json_response(DB::who($user_email));
    }
}