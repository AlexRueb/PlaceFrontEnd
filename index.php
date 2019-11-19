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
      <header>
        <ul>
            <span style="margin-right: 1em;">The Place&nbsp;&nbsp;//</span>
            <li><a href = "aboutus.html">About Us</a></li>
            <li><a href = "history.html">History</a></li>
        </ul>
      </header>
      <div id="container">
          <nav>
            <label>Pick your color!</label><br>
            <input id="colorChoice" type="color" value="#000000" />
            <p>Instructions:</p>
            <ol>
                <li>Click the color box</li>
                <li>Pick your desired color</li>
                <li>Click any pixel in the grid to instantly change it to your color!</li>
            </ol>
          </nav>

          <main>
              <div class="pixelCanvasContainer">
                <div class="pixelCanvas">
                <?php
                  $rendered_canvas = "";
                  foreach($canvas as $pixel){
                    $rendered_canvas .= "<div class='pixel' x='" . $pixel['x'] . "' y='" . $pixel['y'] . "' color='" . $pixel['color'] . "' style='background-color: ".$pixel['color']."'></div>";
                  }
                  echo $rendered_canvas;
                ?>
                </div>
              </div>
          </main>
        </div>
  </body>
</html>
<?php
?>
