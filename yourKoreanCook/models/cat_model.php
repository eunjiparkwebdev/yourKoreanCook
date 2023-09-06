<?php

// include('includes/bundle.php');

function get_cats(){

    global $db;
    $query = 'SELECT * FROM cat';
    $result = $db -> query($query);
    return $result;
}

?>