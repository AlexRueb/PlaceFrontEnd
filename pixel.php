<?php
include_once("config.php");

if($_GET['a'] == 'update_pixel'){
  $color = $_POST['color'];
  $id = $_POST['id'];

  $pixel_update_stmt = $pdo->prepare("UPDATE `pixels` SET `color`=:color WHERE id=:id");
  $result = $pixel_update_stmt->execute(array('color'=>$color, 'id'=>$id));
  echo json_encode($result);
}
?>
