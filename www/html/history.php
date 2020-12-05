<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'history.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

if(is_admin($user) === TRUE) {
  $historys = get_user_history($db);
} else {
  $historys = get_user_history($db, $user['user_id']);
}
include_once VIEW_PATH . 'history_view.php';