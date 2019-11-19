<?php
include_once("config.php");

if($_GET['a'] == 'update_pixel'){
  $color = $_POST['color'];
  $x = $_POST['x'];
  $y = $_POST['y'];
  $last_update = $_POST['last_update'];

  $pixel_update_stmt = $pdo->prepare("UPDATE `pixels_new` SET `color`=:color, `last_update`=:last_update WHERE `x`=:x_val AND `y`=:y_val");
  $result = $pixel_update_stmt->execute(array('color'=>$color, 'x_val'=>$x, 'y_val'=>$y, 'last_update'=>$last_update));
  if(!$result)
  {
    echo json_encode(array('error'=>1, 'msg'=>print_r($pixel_update_stmt->errorInfo(), 1)));
  }
  else
  {
    echo json_encode(array('error'=>0, 'msg'=>'updated Pixel'));
  }
}
elseif($_GET['a'] == 'get_canvas'){
  // Get all pixels that have been updated since last canvas update
  $canvas_get_stmt = $pdo->prepare("SELECT * FROM `pixels_new` WHERE last_update > :last_update ORDER BY x, y");
  $result = $canvas_get_stmt->execute(array('last_update'=>$_GET['last_update']));
  $canvas = $canvas_get_stmt->fetchAll(PDO::FETCH_ASSOC);
  if(!$result){
    error_log(print_r($canvas_get_stmt->errorInfo()));
    echo json_encode(array('error'=>1, 'msg'=>'DB Error'));
  } else {
    error_log(print_r($canvas, 1));
    echo json_encode(array('error'=>0, 'canvas'=>$canvas));
  }
}
?>
