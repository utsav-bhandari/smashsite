<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        exit_nicely("Player does not exist in our database!\n");
    }
    print("<title>$playertag</title>\n");

    // print_r($allrows);
?>
</head>
<body>
    
<?php
print("<h1>$playertag</h1>");

$othertags = str_replace("'", "\"", $allrows[0]['all_tags']);
print("Other tags: \n");
foreach (json_decode($othertags) as $row) {
    print($row . " \n");
} 

print("<br>\n");

print("Socials: \n");
$socials = str_replace("'", "\"", $allrows[0]['social']);
foreach (json_decode($socials) as $row) {
    foreach ($row as $username) {
        print($username . " \n");
    }
} 

print("<br>\n");

$country = $allrows[0]['country'];

if ($country == "NULL" || $country == "") {
    print("Country: N/A\n");
} else {
    print("Country: $country\n");
}


print("<br>\n");

print("Characters played:<br> \n");
$characterlist = json_decode(str_replace("'", "\"", $allrows[0]['characters']));
if (count((array)$characterlist) == 0) {
    print("<p>No characters found!</p>\n");
} else {
    foreach ((array)$characterlist as $key => $row) {
        $imagename = ucfirst(str_replace("ultimate/", "", $key)) . ".png";
        print("<img src=\"../smash_images/$imagename\">");
    }
}

print("<br>\n");

$player_id = $allrows[0]['player_id'];

$tournaments = get_player_tourneys($player_id);
foreach ($tournaments as $value) {
    print("<form action=\"tournamentinfo.php\">");
    print("<input type='hidden' name='t_name' value='{$value['cleaned_name']}'>");
    print("<input type='hidden' name='key' value='{$value['key']}'>");
    print("<input type='hidden' name='p_id' value='{$player_id}']}'>");
    print("<p><input type='submit' value='{$value['cleaned_name']}'></p>");
    print("</form>");
}

?>
    
</body>
</html>