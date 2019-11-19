<?php
//include_once("config.php");
$db_user = 'root';

// Get current canvas
global $pdo;
$pdo = new PDO('mysql:host=localhost;dbname=place', $db_user, "");

return array(
  // Represents 10x10 canvas size
  'canvas_size' => '10'
)

 ?>
