<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
    include "../includes/cleaning-functions.php";
    include "../../smashsite_queries/playerinfo_query.php";
    include "../includes/exit-nicely.php";

    $playertag = $_GET['playertag'];
    
    $allrows = get_player_data($playertag);

    if (count($allrows) == 0) {
        print("<title>N/A</title>\n");
        exit_nicely("Player does not exist in our databse!\n");
    }
    print("<title>$playertag</title>\n");

    print_r($allrows);
?>
</head>
<body>
    
</body>
</html>