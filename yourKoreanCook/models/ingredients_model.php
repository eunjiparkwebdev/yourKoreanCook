<?php 

function get_ingredients(){
    global $db;
    $query = 'SELECT * FROM ingredients';
    $result = $db -> query($query);
    return $result;

}


function get_ingredients_by_cat($catID){
    
    global $db;
    $query = "SELECT IG.ingredientID, IG.ingredientName, IG.ingredientDesc, IG.ingredientBool, IG.ingredientPrice FROM ingredients AS IG WHERE $catID = IG.catID";
    $rows = [];
    $query_result = $db -> query($query);
    while( $row = $query_result -> fetch(PDO::FETCH_ASSOC))
    {
        $rows[] = $row;
    }

return $rows;

}

?>