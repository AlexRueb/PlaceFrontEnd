<?php
//include_once("config.php");
$db_user = 'root';

// Get current canvas
global $pdo;
$pdo = new PDO('mysql:host=localhost;dbname=place', $db_user, "mysql");

return array(
  'db_user' => 'dtice',
  'db_pass' => 'password',

  // Represents 10x10 canvas size
  'canvas_size' => '10'
)

 ?>
