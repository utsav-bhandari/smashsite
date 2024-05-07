<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find your tag</title>
</head>
<body>
    
<?php
    include "../../smashsite_queries/playerinfo_query.php";
    include "../includes/mysql-functions.php";
    include "../includes/exit-nicely.php";

    $tag = $_GET['playertag'];
    $allrows = get_more_player_data_tag($tag);
    
    if (count($allrows) == 1) {
        header('Location: playerinfo.php?player_id=' . $allrows[0]['player_id']);
        exit_nicely("");
    } elseif (count($allrows) == 0) {
        exit_nicely("<h1>No such tag exists within the official database!<h1>\n");
    }
    
    print("<h1>Multiple tags exist with the same name. Here are all of them:</h1>\n");
    
    print("<table>\n");
    print("<tr>\n");
    foreach (reset($allrows) as $key => $value) {
        if ($key == "player_id") {
            continue;
        }
        print("<th>\n");
        print($key. "\n");
        print("</th>\n");
    }
    print("</tr>\n");

    foreach ($allrows as $row) {

        print("<tr>\n");

        print("<td>\n");
        print("<a href=\"playerinfo.php?player_id={$row['player_id']}\" target=\"_blank\">{$row['tag']}</a>\n");
        print("</td>\n");

        $parsed_data = json_decode(str_replace("'", "\"", $row['all_tags']), true);
        
        print("<td>\n");
        for ($i=0; $i < sizeof($parsed_data) - 1; $i++) { 
            if ($i > 2) {
                break;
            }
            print($parsed_data[$i] . " \n");
        } 
        print("</td>\n"); 

        $parsed_data2 = json_decode(str_replace("'", "\"",$row['prefixes']), true);

        print("<td>\n");
        for ($i=0; $i < sizeof($parsed_data2) - 1; $i++) { 
            if ($i > 2) {
                break;
            }
            print($parsed_data2[$i] . " \n");
        } 
        print("</td>\n"); 

        $parsed_data3 = json_decode(str_replace("'", "\"", $row['social']), true);

        print("<td>\n");
        for ($i=0; $i < sizeof($parsed_data3['twitter']); $i++) { 
            print($parsed_data3['twitter'][$i] . "\n");
        }
        print("</td>\n"); 

        print("<td>\n");
        print("{$row['country']}\n");
        print("</td>\n");

        $parsed_data5 = json_decode(str_replace("'", "\"", $row['characters']), true);
        print("<td>\n");
        if ($parsed_data5 != "") {
            arsort($parsed_data5);
            print(ucfirst(str_replace("ultimate/", "", array_key_first($parsed_data5))) . ": " . reset($parsed_data5) . "\n");
        }
        print("</td>\n");


        print("</tr>\n");
    }
    print("</table>\n");
    // print($allrows['all_tag']);
    // print_r($sub_table);

    //print_table($sub_table, ['l', 'l', 'l', 'l', 'l', 'l']);
?>


</body>
</html>