<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wix+Madefor+Display:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
    <title>Your Korean Chef</title>
    <?php
        include('includes/models.php');
        session_start();
        $cats = get_cats();
        if(isset($_GET['catID']))
        {
            $_SESSION['catID'] = $_GET['catID'];
        } else {
            $_SESSION['catID'] = 0;
        }
        
        $ingredients = get_ingredients();
     
    ?>

</head>

<body>
    <header></header>