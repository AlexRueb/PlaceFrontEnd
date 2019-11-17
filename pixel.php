<?php
include_once("config.php");

if($_GET['a'] == 'update_pixel'){
  $color = $_POST['color'];
  $id = $_POST['id'];

  $pixel_update_stmt = $pdo->prepare("UPDATE `pixels` SET `color`=:color WHERE id=:id");
  $result = $pixel_update_stmt->execute(array('color'=>$color, 'id'=>$id));
  echo json_encode($result);
}
elseif($_GET['a'] == 'get_canvas'){
  $canvas_get_stmt = $pdo->prepare("SELECT * FROM `pixels`");
  $result = $canvas_get_stmt->execute();
  $canvas = $canvas_get_stmt->fetchAll(PDO::FETCH_ASSOC);
  if(!$result){
    error_log(print_r($canvas_get_stmt->errorInfo()));
    echo json_encode(array('error'=>1, 'msg'=>'DB Error'));
  } else {
    echo json_encode(array('error'=>0, 'canvas'=>$canvas));
  }
}
?>
