<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'details.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$historys = get_user_history_details($db, $_POST['order_id']);

$details = get_user_details($db, $_POST['order_id']);

include_once VIEW_PATH . 'details_view.php';