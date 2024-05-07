<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="characterinfo-styles.css">
    <link rel="stylesheet" href="playerinfo-styles.css">
    <link rel="stylesheet" href="filterpage.css">
    <title>
    <?php
    include "../includes/cleaning-functions.php";
    include "../../smashsite_queries/characterinfo_query.php";
    include "../includes/exit-nicely.php";

    $character = $_GET['character'];
    $character_name = $_GET['character'];
      print(ucfirst($character));
    ?>
    </title>
</head>
<body>
    <div id='playerinfo' style='margin: 2px; margin-bottom: 2.5em;'>
    <h1 style='font-size: 2em;'>Top ten players who have played <?php print(ucfirst($character_name)); ?> the most.</h1>
    </div>

    <?php
    $char = get_characters($character);
    print("<table class='filter_table' style='width: 30%;'>");
    foreach ($char as $data) {
      print("<tr onclick=\"window.location='playerinfo.php?player_id={$data['player_id']}'\">");
      print("<td>");
      print("<u>" . $data['tag'] . "</u>");
      print("</td>");
      print("<td>");
      print($data['the_count']);
      print("</td>");
      print("</tr>");
    /*  print("<form action=\"playerinfo.php\" method = \"get\">");
      print("<input type='hidden' name='player_id' value=\"{$data['player_id']}\">");
      print("<input style='margin: 3px;' class='t_submit' type='submit' value=\"");
      print($data['tag']);
      print(" ");
      print($data['the_count']);
      print("\">");
      print("</form>");*/
    }
    print("</table>");
    ?>
</body>
</html>
