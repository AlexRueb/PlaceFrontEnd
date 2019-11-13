<?php
//include_once("config.php");
$db_user = 'root';

// Get current canvas
$pdo = new PDO('mysql:host=localhost;dbname=place', $db_user, "mysql");
$canvas_select_stmt = $pdo->prepare("SELECT * FROM `pixels`");
$result = $canvas_select_stmt->execute();

// Can probably change to PDO::FETCH_COLUMN or something
$canvas = $canvas_select_stmt->fetchAll(PDO::FETCH_ASSOC);
// $pdo->prepare("SELECT * FROM `pixels` WHERE `current`=1 ")


?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
  <head>
      <meta charset="UTF-8">
      <title>Place</title>
      <link href="style.css" rel="stylesheet">
      <script src="index.js" defer></script>
  </head>

  <body>
      <header>The Place</header>
      <div id="container">
          <nav>Nav
          <ul>
              <li>About Us</li>
              <li>History</li>
          </ul>
          </nav>

          <main>
              <div class="pixelCanvasContainer">
                <div class="pixelCanvas">
                <!-- TODO: Create a FlexBox that wraps after every x pixels -->
                <?php
                  foreach($canvas as $pixel){ ?>
                    <!-- Not sure if attributes are the best way to set x and y -->
                    <div class="pixel" db_id="<?=$pixel['id'];?>" color="<?=$pixel['color'];?>" style="background-color: <?=$pixel['color'];?>"></div>
                  <?php }
                ?>
                </div>
              </div>
          </main>

          <aside>
            <label>Pick your color!</label><br>
            <input id="colorChoice" type="color" value="#000000" />
            <p>Instructions:</p>
            <ol>
                <li>Click the color box</li>
                <li>Pick your desired color</li>
                <li>Click any pixel in the grid to instantly change it to your color!</li>
            </ol>
          </aside>
        </div>
        <footer>Footer</footer>
  </body>
</html>
<?php
?>
