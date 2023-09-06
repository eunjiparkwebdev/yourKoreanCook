<?php

function add_user($userEmail, $userPhone, $userName)
{
    global $db;
    $query = "INSERT INTO user (userID, userEmail, userPhone, userName) VALUES (NULL, '$userEmail', '$userPhone', '$userName')";
    $result = $db->query($query);
    

    if ($result) {
        // Retrieve the auto-generated userID
        $userID = $db->lastInsertId();
        
    } else {
        echo "Error inserting user: " . $db->errorInfo()[2];;

}

return $userID;

}
?>