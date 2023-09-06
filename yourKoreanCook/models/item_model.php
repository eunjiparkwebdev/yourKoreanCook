<?php

function add_item($dishName, $ingredients, $price, $cartID)
{
    global $db;
    $query = "INSERT INTO item (itemID, dishName, ingredients, price, cartID) VALUES (NULL, '$dishName', '$ingredients', '$price', '$cartID')";
    $result = $db->query($query);
    return $result;
}

?>