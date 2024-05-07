<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find your tag</title>
    <link rel="stylesheet" href="filterpage.css">
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
    print("<div id=\"noticetext\" style=\"margin: 2px; margin-bottom: 2.5em;\">");
    print("<h1 style=\"font-size: 2em;\">Multiple tags exist with the same name. Here are all of them:</h1>\n");
    print("</div>");
    
    print("<table class=\"filter_table\">\n");
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
        print("<a href=\"playerinfo.php?player_id={$row['player_id']}\" target=\"_blank\">{$row['Tag']}</a>\n");
        print("</td>\n");

        $parsed_data = json_decode($row['other tags'], true);
        
        print("<td>\n");
        $count = count($parsed_data);

        for ($i = 0; $i < $count - 1; $i++) {
            if ($i == 0) {
                print($parsed_data[$i]);
                if ($count > 2) {
                    print(", \n");
                }
            } elseif ($i == 1) {
                print($parsed_data[$i]);
                if ($count > 3) {
                    print(", \n");
                }
            } elseif ($i == 2) {
                print($parsed_data[$i]);
                if ($count > 4) {
                    print(", etc.\n");
                    break;
                }
            }
        }
        
        
        print("</td>\n"); 

        $parsed_data2 = json_decode($row['Prefixes'], true);

        print("<td>\n");
        $count = count($parsed_data2);
        for ($i = 0; $i < $count; $i++) {
            if ($i == 0) {
                print($parsed_data2[$i]);
                if ($count > 1) {
                    print( ", \n");
                }
            } elseif ($i == 1) {
                print( $parsed_data2[$i]);
                if ($count > 2) {
                    print( ", \n");
                }
            } elseif ($i == 2) {
                print( $parsed_data2[$i]);
                if ($count > 3) {
                    print( ", etc.\n");
                    break;
                }
            }
        }
        
        print("</td>\n"); 

        $parsed_data3 = json_decode(str_replace("'", "\"", $row['Social']), true);

        print("<td>\n");
        $count = count($parsed_data3['twitter']);
        for ($i=0; $i < sizeof($parsed_data3['twitter']); $i++) { 
            if ($i == 0) {
                print($parsed_data3['twitter'][$i]);
                if ($count > 1) {
                    print( ", \n");
                }
            } elseif ($i == 1) {
                print($parsed_data3['twitter'][$i]);
                if ($count > 2) {
                    print( ", \n");
                }
            } elseif ($i == 2) {
                print($parsed_data3['twitter'][$i]);
                if ($count > 3) {
                    print( ", etc.\n");
                    break;
                }
            }
        }
        print("</td>\n"); 

        print("<td>\n");
        print("{$row['Country']}\n");
        print("</td>\n");

        $parsed_data5 = json_decode(str_replace("'", "\"", $row['Most Played']), true);
        print("<td>\n");
        if ($parsed_data5 != "") {
            arsort($parsed_data5);
            print(ucfirst(str_replace("ultimate/", "", array_key_first($parsed_data5))) . ": " . reset($parsed_data5) . "\n");
        }
        print("</td>\n");


        print("</tr>\n");
    }
    print("</table>\n");
?>


</body>
</html>