<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_user_details($db, $order_id){
    $sql = "
      SELECT 
        purchase_name,
        purchase_price,
        amount,
        purchase_price * amount AS total
      FROM
        purchase_items
      WHERE
        order_id = ?
    ";
    return fetch_all_query($db, $sql, array($order_id));
  }

  function get_user_history_details($db, $order_id){
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
      WHERE
        orders.order_id = ?
      GROUP BY
        orders.order_id
    ";
    return fetch_all_query($db, $sql, array($order_id));
  }