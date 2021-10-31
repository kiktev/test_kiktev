<?php

namespace app;

use PDO;

require_once('config.php');

/**
 * Class Model
 */

class Model
{

  public function varDump($data) {
    var_dump($data);
  }

  public function getConnection()
  {

    $pdo = new PDO('mysql:host='.MYSQL_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USERNAME, DB_PASSWORD);

    return $pdo;

  }

  public function query($sql, $params = [])
  {

    $pdo = $this->getConnection();

    $stmt = $pdo->prepare($sql);
  
    $result = $stmt->execute($params);

    if ($result !== false) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }else{
      return false;
    }

  }

  public function querys($array)
  {

    foreach ($array as $key=>$val) {
      $this->query($array[$key]['sql'],$array[$key]['params']);
    }

    return true;

  }

  public function selectItems($table){

    $params = [];

    $sql = "SELECT * FROM $table ORDER BY order_num";

    return $this->query($sql,$params);
     
  }

  public function selectItem($table, $id){

    $params = array($id);

    $sql = "SELECT * FROM $table WHERE id = ?";

    return $this->query($sql,$params);
     
  }

  public function updateItem($table, $id, $field, $item) {

    $params = [];
    
    $params[':id'] = $id;
    $params[':item'] = $item;

    $sql = "UPDATE $table SET `$field` = :item WHERE id = :id;";
    
    return $this->query($sql,$params);

  }

  public function up_down($table, $id, $order_num, $do){

    $array = [];

    if ($do == 'up') {
      $get = $this->query("SELECT id, order_num FROM $table WHERE order_num < $order_num ORDER BY order_num DESC", array());
    }

    if($do == 'down') {
      $get = $this->query("SELECT id, order_num FROM $table WHERE order_num > $order_num ORDER BY order_num ASC", array());
    }

    if($get != false) {
      $get = $get[0];
    }else{
      return false;
    }
    
    $get_order = $get['order_num'];
    $get_id = $get['id'];
    
    $first_sql = "UPDATE $table SET `order_num` = $get_order WHERE id = $id;";

    $second_sql = "UPDATE $table SET `order_num` = $order_num WHERE id = $get_id;";

    $array[] = array('sql' => $first_sql, 'params' => array()); 

    $array[] = array('sql' => $second_sql, 'params' => array()); 

    $this->querys($array);
  }

  public function addUser($table, $data)
  {
  
    $params = [];
    
    foreach($data as $key => $val){
      $params[":$key"] = $val;
    }

    $params[":order_num"] = $this->getMaxOrder('users') + 1;
    
    $sql = "INSERT INTO `$table` (name, lastName, phone, age, order_num, img) VALUES (:name, :lastName, :phone, :age, :order_num, :img);";

    $this->query($sql,$params);

  }

  public function getMaxId($table)
  {
    $sql = "SELECT MAX(id) FROM $table";

    $result = $this->query($sql);

    if (isset($result)) {
      return $result[0]["MAX(id)"];
    }else{
      return false;
    }  
  }

  public function getMaxOrder($table)
  {

    $sql = "SELECT MAX(order_num) FROM $table";

    $result = $this->query($sql);

    if (isset($result)) {
      return $result[0]["MAX(order_num)"];
    }else{
      return false;
    }  

  }

  public function deleteItem($table, $id)
  {
      $sql = "DELETE FROM `$table` WHERE id = ?";
      $params = array($id);
      
      return $this->query($sql,$params);
  }

}
