<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="playerinfo-styles.css">
<?php
    include "../includes/cleaning-functions.php";
    include "../../smashsite_queries/playerinfo_query.php";
    include "../includes/exit-nicely.php";

    // tags have special characters, cannot be cleaned
    $playertag = $_GET['playertag'];
    
    $allrows = get_player_data($playertag);

    // this check prevents malicious inputs
    if (count($allrows) == 0) {
        print("<title>N/A</title>\n");
        print("<script>\n");
        print("document.write('<a href=\"' + document.referrer + '\">Go Back</a>')\n");
        print("</script>\n");
        exit_nicely("<br>\n<br>\n<h1>Player does not exist in our database!<h1>\n");
    }
    print("<title>$playertag</title>\n");

    // print_r($allrows);
?>
</head>
<body>
    
<?php
print("<div id='playerinfo'>");
print("<h1>$playertag</h1>");

$othertags = str_replace("'", "\"", $allrows[0]['all_tags']);
print("<div class='info'>");
print("<p class='descriptor'>Other tags: </p>");
print("<p>");
foreach (json_decode($othertags) as $row) {
    print($row . " \n");
} 
print("</p>");
print("</div>");


print("<div class='info'>");
print("<p class='descriptor'>Socials: </p>");
print("<p>");
$socials = str_replace("'", "\"", $allrows[0]['social']);
foreach (json_decode($socials) as $row) {
    foreach ($row as $username) {
        print($username . " \n");
    }
} 
print("</p>");
print("</div>");


print("<div class='info'>");
$country = $allrows[0]['country'];

print("<p class='descriptor'>Country: </p>");
print("<p>");
if ($country == "NULL" || $country == "") {
    print("N/A\n");
} else {
    print("$country\n");
}
print("</p>");
print("</div>");

print("</div>");
print("<div id='game_data'>");
    print("<div id='tournaments'>");

    $player_id = $allrows[0]['player_id'];

    $tournaments = get_player_tourneys($player_id);
    foreach ($tournaments as $value) {
        print("<form action=\"tournamentinfo.php\" method = \"post\">");
        print("<input type='hidden' name='t_name' value='{$value['cleaned_name']}'>");
        print("<input type='hidden' name='key' value='{$value['key']}'>");
        print("<input type='hidden' name='p_id' value='{$player_id}']}'>");
        print("<p><input class='t_submit' type='submit' value='{$value['cleaned_name']}'></p>");
        print("</form>");
    }
    print("</div>");

    print("<div id='characters'>");
    $characterlist = json_decode(str_replace("'", "\"", $allrows[0]['characters']));
    if (count((array)$characterlist) == 0) {
        print("<p>No characters found!</p>\n");
    } else {
        foreach ((array)$characterlist as $key => $row) {
            $imagename = ucfirst(str_replace("ultimate/", "", $key)) . ".png";
            print("<div class='character_container'>");
            print("<img src=\"../smash_images/$imagename\">");
            print("<div class='counter'>");
            print("$row");
            print("</div>");
            print("</div>");
        }
    }
?>
    
</body>
</html>
