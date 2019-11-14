<?php
include_once("config.php");
global $pdo;
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
      <script
          src="https://code.jquery.com/jquery-3.4.1.js"
          integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
          crossorigin="anonymous">
      </script>
      <script
          src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
          integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
          crossorigin="anonymous">
      </script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
