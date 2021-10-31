<?php

namespace app;

require_once('Model.php');

/**
 * Class  Conctroller
 */

class Controller
{

  public $table = [];

  public $user = [];

  public function __construct()
  {
    $this->action();
  }

  protected function action()
  {
    $table_model = new Model();
    $this->table = $table_model->selectItems('users');

   
    if (isset($_POST['action'])) {
      switch ($_POST['action']) {

        case 'add':
          $this->add();
        break;

        case 'delete':
          $this->delete();
        break;

        case 'up':
          $this->up_down('up');
        break;

        case 'down':
          $this->up_down('down');
        break;
      }
    }

    if (isset($_GET['action']) == 'edit' && basename($_SERVER['PHP_SELF']) == 'edit.php') {

      $getUser_model = new Model();

      $this->user = $getUser_model->selectItem('users',$_GET['id'])[0];

      if (isset($_POST['action'])) {

        switch ($_POST['action']) {

          case 'edit':
            $this->edit($this->user);
          break;

          case 'update_img':
            $this->update_img($this->user);
          break;

        } 
      }

    }
    
  }

  protected function update_img($user)
  {
    $updateImg = new Model();

    $img_link = 'data/' . $user['img'];

    if (file_exists($img_link)) {
      unlink($img_link);
    }
    
    $name = $this->pushImg($user['id']);

    $updateImg->updateItem('users', $user['id'], 'img', $name);

    $url = 'edit.php?action=edit&id=' . $user['id'];
    header("Location: $url");
  }

  protected function edit($user)
  {
    $data = $this->getPostValues();
    
    if ($user['name'] != $data['name']) {

      $updateName = new Model();
      $updateName->updateItem('users', $user['id'], 'name', $data['name']);

      header("Location: edit.php");
  
    }

    if ($user['lastName'] != $data['lastName']) {

      $updatelastName = new Model();
      $updatelastName->updateItem('users', $user['id'], 'lastName', $data['lastName']);

    }

    if ($user['phone'] != $data['phone']) {

      $updatelastName = new Model();
      $updatelastName->updateItem('users', $user['id'], 'phone', $data['phone']);

    }

    if ($user['age'] != $data['age']) {

      $updatelastName = new Model();
      $updatelastName->updateItem('users', $user['id'], 'age', $data['age']);

    }

    header("Location: index.php");

  }

  protected function up_down($do)
  {
    $up_model = new Model();
    $data = $this->getPostValues(); 
    $up_model->up_down('users',$data['id'], $data['order'], $do);
    header("Location: index.php");
  }


  private function pushImg($id) {
    
    $uploads_dir = "data";

    $tmp_name = $_FILES['file']["tmp_name"];
    
    $ext = pathinfo($_FILES['file']["name"], PATHINFO_EXTENSION);

    $name = $id . "." .$ext;

    $img_model = new Model();

    move_uploaded_file($tmp_name, "$uploads_dir/"."$name"); 

    return $name; 
    
  }

  protected function add()
  {
    $user_model = new Model();
    $data = $this->getPostValues();

    $lastId = new Model();
    $id = $lastId->getMaxId('users')+1;

    $name = $this->pushImg($id);

    $data['img'] = $name;

    $user_model->addUser('users', $data);
    
    header("Location: index.php");

  }

  protected function delete()
  {
    $delete_model = new Model();
    $data = $this->getPostValues(); 

    $img_link = 'data/' . $data['img'];

    if (file_exists($img_link)) {
      unlink($img_link);
    }

    unset($data['img']);

    $delete_model->deleteItem('users',$data['id']);

    header("Location: index.php");
  }

  protected function getPostValues()
  {
      
    $data = [];
    
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST'){
      
      foreach ($_POST as $key=>$value) {
        
        $filter = strip_tags($value);
          
        $data[$key] = $filter;
              
      }
      
      if(isset($data['action'])){
        unset($data['action']);
      }
      
      return $data;
      
    }else{
      return false;
    }
  }

}

