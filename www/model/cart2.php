<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function purchase_carts($db, $carts){
  if(validate_cart_purchase($carts) === false){
    return false;
  }
  $db->beginTransaciton();
  foreach($carts as $cart){
    if(update_item_stock(
        $db, 
        $cart['item_id'], 
        $cart['stock'] - $cart['amount']
      ) === false){
      set_error($cart['name'] . 'の購入に失敗しました。');
    }
  }

  insert_orders($db, $user_id);
  $order_id = $db->lastInsertId();

  foreach($carts as $cart) {
    insert_purchase_items($db, $order_id, $cart['name'], $cart['price'], $cart['amount']);
  }
  delete_user_carts($db, $carts[0]['user_id']);
  if(isset($_SESSION['__errors']) === TRUE ){
      $db->rollback();
  } else {
      $db->commit();
  }
}

function delete_user_carts($db, $user_id){
  $sql = "
    DELETE FROM
      carts
    WHERE
      user_id = ?
  ";

  execute_query($db, $sql, array($user_id));
}

function insert_orders($db, $user_id){
    $sql = "
    INSERT INTO
      orders(
        user_id
      )
    VALUES(?);
  ";

  return execute_query($db, $sql, array($user_id));
}  


function insert_purchase_items($db, $order_id, $purchase_name, $purchase_price, $amount){
    $sql = "
    INSERT INTO
      purchase_items(
        order_id,
        purchase_name,
        purchase_price,
        amount
      )
    VALUES(?, ?, ?, ?);
  ";

  return execute_query($db, $sql, array($order_id, $purchase_name, $purchase_price, $amount));
} 



