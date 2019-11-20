<?php
//include_once("config.php");
$db_user = 'user58';
$db_pass = '58qktp';

// Get current canvas
global $pdo;
$pdo = new PDO('mysql:host=localhost;dbname=db58', $db_user, $db_pass);

return array(
  // Represents 10x10 canvas size
  'canvas_size' => '10'
)

 ?>
