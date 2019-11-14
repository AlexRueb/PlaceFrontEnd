<?php

function random_color() {
  return substr(md5(rand()), 0, 6);
}

$db_user = 'root';

// Get current canvas
$pdo = new PDO('mysql:host=localhost;dbname=place', $db_user, "mysql");

$canvas_size = 10000;

$pixel_insert_stmt = $pdo->prepare("INSERT INTO `pixels` (`color`) VALUES (:color)");

for($i = 0; $i < $canvas_size; $i++)
{
  $color = random_color();
  $result = $pixel_insert_stmt->execute(array('color'=>$color));
  if(!$result){
    error_log(print_r($pixel_insert_stmt->errorInfo()));
    echo "<h1>ERROR OCCURED</h1>";
  }
}
?>
