<?php

function random_color() {
  return substr(md5(rand()), 0, 6);
}

set_time_limit(120);

$db_user = 'root';

// Get current canvas
$pdo = new PDO('mysql:host=localhost;dbname=place', $db_user, "mysql");

// Corresponds to length of one side of canvas
$canvas_size = 100;

$pixel_insert_stmt = $pdo->prepare("INSERT INTO `pixels` (`x`, `y`, `color`, `last_update`) VALUES (:x_val, :y_val, :color, :last_update)");

try {
  $pdo->beginTransaction();
  for($i = 0; $i < $canvas_size; $i++)
  {
    for($j = 0; $j < $canvas_size; $j++)
    {
      $color = random_color();
      $result = $pixel_insert_stmt->execute(array('x_val'=>$i, 'y_val'=>$j, 'color'=>$color, 'last_update'=>time()));
      if(!$result){
        error_log(print_r($pixel_insert_stmt->errorInfo()));
        echo "<h1>ERROR OCCURED</h1>";
      }
    }
  }
  $pdo->commit();
} catch(Exception $e){
  $pdo->rollback();
  throw $e;
}


?>
