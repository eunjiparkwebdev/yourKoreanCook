<?php
 
function create_cart($openDate, $status, $userID, $totalPrice){

    global $db;
    $query = "INSERT INTO cart (cartID, openDate, status, userID, totalPrice) VALUES (NULL, '$openDate', '$status', '$userID', '$totalPrice')";
    if ($db->query($query)) {
        return $db->lastInsertId(); // Returns the generated primary key value (cartID)
    } else {
        return false;
    }

 }

?>