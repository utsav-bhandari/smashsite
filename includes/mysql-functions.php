<?php

function print_table($table, $alignment_array) 
{
    if (sizeof(reset($table)) != sizeof($alignment_array)) {
        print("Invalid params: table needs to have the same number of columns as the second array.\n");
        exit("</body>\n</html>\n"); 
    }

    $column_headers = array_keys(reset($table));

    print("<table>\n");
    print("<tr>\n");
    foreach ($column_headers as $header) {
        print("<td class=\"header\">$header</td>\n");    
    }
    print("</tr>\n");

    foreach ($table as $row) {
        print("<tr>\n");
    
        $idx = 0;
        foreach ($row as $key => $value) {

            if ($alignment_array[$idx] == 'l') {
                print("<td>$value</td>\n");
            } elseif ($alignment_array[$idx] == 'r') {
                print("<td class=\"right\">$value</td>\n");
            } elseif ($alignment_array[$idx] == 'c') {
                print("<td class=\"cen\">$value</td>\n");
            }

            $idx++;
        }
    
        print("</tr>\n");
    }
    print("</table>\n");
}