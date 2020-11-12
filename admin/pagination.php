<?php 

$page_title = 'View the Current Users';
include ('includes/header.php');

echo '<h1>Registered Users </h1>';

require_once('includes/db.php');

// Number of records to show per page: 
$display = 3;

//Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) {
    //if the age has alreasy been determined. 
    $pages =  $_GET['p'];
} else {
    // Need to determine. 

    //Count the number of records: 
    global $connection;
    $q = "SELECT COUNT(id) FROM users"; 
    $r= @mysqli_query ($connection, $q);
    $row = @mysqli_fetch_array ($r, MYSQLI_NUM);

    $records = $row[0];

    // Calcumate the number of  pages...
    if($records > $display) {
        //More than 1 page. 
        $pages = ceil ($records/$display);
    } else {
        $pages = 1;
    }
} // End of p IF. 

// Determine where in the database to start returning results...
if(isset($_GET['s']) && is_numeric ($_GET['s'])) {
    $start = $_GET['s']; 
} else {
    $start = 0; 
}

//Make the query: 
global $connection;
$q = "SELECT id, username, email, password, profile_pic, is_active, role FROM users LIMIT $start, $display";
$r = mysqli_query($connection, $q);
if($r) {
    echo "Ok";
} else {
    echo "Problem".mysqli_error($connection);
}

//Table header: 
echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
    <tr> 
        <td align ="left"><b>id</b></td>
        <td align ="left"><b>Username </b></td>
        <td align ="left"><b>Email</b></td>
        <td align ="left"><b>Password</b></td>
    </tr>
    </table>';

    //Fetch and print all the records ...
    $bg = '#eeeeee'; //Set the initial background color. 
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee'); //Switch the background color. 

        echo '<tr bgcolor="' . $bg . '"> 
        <td align="left">'. $row['id']. "<br/>". '</td>

        <td align="left">' . $row['username']. "<br/>". '</td>

        <td align="left" >' . $row['email']. "<br/>". '</td>

        <td align="left"  >' . $row['password']. "<br/>". '</td> </tr>
        ';

    } //END of while loop.

    echo '</table>';
    mysqli_free_result($r);
    mysqli_close($connection);

    //Make the links to other pages, if necessary. 
    if ($pages > 1) {
        // Add some spacing and start a paragraph: 
        echo '<br/><p>';

        //Determine what page the script is on: 
        $current_page = ($start/$display) + 1; 

        //IF it's not the first page, make a previous button: 
        if ($current_page != 1) {
            echo '<a href="pagination.php?s=' . ($start - $display) . '$p =' .$pages . '">Previous</a> ';
        }
        //Make all the numbered pages: 
        for ($i = 1; $i <= $pages; $i++) {
            if($i != $current_page) {
                echo '<a href="pagination.php?s=' .
                (($display * ($i - 1))) . '&p=' .
                $pages . '">' . $i . '</a> ';  
            } else {
                echo $i . ' ';
            }
        } //End of FOR loop.

        //If it's not the last page, make a Next button: 
        if ($current_page != $pages) { 
            echo '<a href="pagination.php?s=' .
            ($start + $display) . '&p=' . $pages .
            '">Next</a>';
        }
        echo '</p>'; //Close the paragraph.
    } // End of links section. 
?> 