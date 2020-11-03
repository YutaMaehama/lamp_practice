<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_user_history($db, $user_id = NULL){
    if($user_id === NULL) {
      $where = '';
    } else {
      $where = 'WHERE orders.user_id = ?';
    }
    $sql = "
      SELECT 
        orders.order_id,
        orders.order_date,
        sum(purchase_items.purchase_price *  purchase_items.amount) AS total
      FROM
        orders
      JOIN
        purchase_items
      ON
        orders.order_id = purchase_items.order_id
      {$where}
      GROUP BY
        orders.order_id
      ORDER BY
        orders.order_id DESC
    ";
    if($user_id === NULL) {
      return fetch_all_query($db, $sql);   
    } else {
      return fetch_all_query($db, $sql, array($user_id));
    }
  }