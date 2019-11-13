<?php
//include_once("config.php");
$db_user = 'root';

// Get current canvas
$pdo = new PDO('mysql:host=localhost;dbname=place', $db_user, "mysql");
$canvas_select_stmt = $pdo->prepare("SELECT * FROM `pixels`");
$result = $canvas_select_stmt->execute();

// Can probably change to PDO::FETCH_COLUMN or something
$raw_canvas = $canvas_select_stmt->fetchAll(PDO::FETCH_ASSOC);
// $pdo->prepare("SELECT * FROM `pixels` WHERE `current`=1 ")

$canvas = array(array());

// Since pixels will be in 1D array, we need to convert to x,y
foreach($raw_canvas as $pixel)
{
  $canvas[$pixel['y']][$pixel['x']] = $pixel['color'];
}


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
            <div id="info"></div>
            <div class="pixelCanvas">
            <!-- TODO: Create a FlexBox that wraps after every x pixels -->
            <?php
              foreach($canvas as $pixel){ ?>
                <!-- Not sure if attributes are the best way to set x and y -->
                <div class="pixel" x="<?=$pixel['x'];?>" y="<?=$pixel['y'];?>" style="background-color: <?=$pixel['color'];?>"></div>
              <?php }
            ?>
            </div>
        </main>

        <aside>Pick your color!
            <input id="colorChoice" type="color" value="#000000" />
            <input type="submit" />
            <p>Instructions:</p>
            <ol>
                <li>Click the color box</li>
                <li>Pick your desired color</li>
                <li>Click submit</li>
                <li>Click any pixel in the grid to instantly change it to your color!</li>
            </ol>
        </aside>
    </div>
        <footer>Footer</footer>

</body>
</html>
<?php
?>
