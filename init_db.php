<?php

function random_color() {
  return substr(md5(rand()), 0, 6);
}

$db_user = 'root';

// Get current canvas
$pdo = new PDO('mysql:host=localhost;dbname=place', $db_user, "mysql");

// Corresponds to length of one side of canvas
$canvas_size = 100;

$pixel_insert_stmt = $pdo->prepare("INSERT INTO `pixels_new` (`id`, `x`, `y`, `color`) VALUES (:id, :x_val, :y_val, :color)");

$count = 0;
for($i = 0; $i < $canvas_size; $i++)
{
  for($j = 0; $j < $canvas_size; $j++)
  {
    $color = random_color();
    $result = $pixel_insert_stmt->execute(array('id'=>$count, 'x_val'=>$i, 'y_val'=>$j, 'color'=>$color));
    if(!$result){
      error_log(print_r($pixel_insert_stmt->errorInfo()));
      echo "<h1>ERROR OCCURED</h1>";
    }
    $count++;
  }
}
?>
