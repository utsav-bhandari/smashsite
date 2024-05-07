<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="characterinfo-styles.css">
    <link rel="stylesheet" href="playerinfo-styles.css">
    <title>
    <?php
    include "../includes/cleaning-functions.php";
    include "../../smashsite_queries/characterinfo_query.php";
    include "../includes/exit-nicely.php";

    $character = $_GET['character'];
    $character_name = $_GET['character'];
      print($character);
    ?>
    </title>
</head>
<body>
    <div id='playerinfo' style='margin: 2px; margin-bottom: 2.5em;'>
    <h1 style='font-size: 2em;'>Top ten players who have played <?php print($character_name); ?> the most.</h1>
    </div>

    <?php
    $char = get_characters($character);
    foreach ($char as $data) {
      print("<form action=\"playerinfo.php\" method = \"get\">");
      print("<input type='hidden' name='player_id' value=\"{$data['player_id']}\">");
      print("<input style='margin: 3px;' class='t_submit' type='submit' value='");
      print($data['tag']);
      print(" ");
      print($data['the_count']);
      print("'>");
      print("</form>");
    }
    ?>
</body>
</html>
