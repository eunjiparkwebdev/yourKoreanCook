<?php
  include('includes/bundle.php');

// Initialize variables with default values
$userEmail = "";
$userPhone = "";
$userName = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["userEmail"])) {
        $userEmail = $_POST["userEmail"];
    } else {
       echo "User Email not present";
    }
      
    if (isset($_POST["userPhone"])) {
        $userPhone = $_POST["userPhone"];
    } else {
        echo "User phone not present";
    }
      
    if (isset($_POST["userName"])) {
        $userName = $_POST["userName"];
    } else {
        echo "User name not present";
    }
    $userID = add_user($userEmail, $userPhone, $userName);
    $orderNumber = "Order Number: " . $userID . "<br>";
    

if ($userID) {  
  if (isset($_POST["calculateTotal"])) {
    $totalPrice = $_POST["calculateTotal"];
  
} else {
   echo "total not present  ";
}
    $openDate = date('Y-m-d H:i:s'); // Capture the current datetime
    $status = "P";
    $cartID = create_cart($openDate, $status, $userID, $totalPrice);

} else {
    echo "Error adding user.";
}

if($cartID){
    $dynamicData = $_POST['dynamicDataContent'];
    $dynamicDataArray = json_decode($dynamicData, true);

    if ($dynamicDataArray === null) {
        // JSON decoding failed
        echo "Error decoding JSON data.";
    } else {
        // JSON decoding succeeded
        $successCount = 0; // Variable to count the successful additions

        foreach ($dynamicDataArray as $rowData) {
            $dishName = $rowData['name'];
            $ingredients = $rowData['ingredients'];
            $price = $rowData['price'];
             // Call the add_item() function to add the item to the database
            $result = add_item($dishName, $ingredients, $price, $cartID);
            // Check the result of the add_item() function
            if ($result) {
                // The item was successfully added to the database
                $successCount++;
            }
        }
        if ($successCount === count($dynamicDataArray)) {
          $orderMessage = " " . "<br>";
          $dishCounts = array(); // Initialize an array to store the counts
          $subtotal = 0; // Initialize subtotal
      
          // Order submitted successfully, fetch the combined data
          $query = "SELECT c.cartID, c.openDate, c.status, u.userName, u.userEmail, u.userPhone, i.dishName, i.ingredients, i.price
                    FROM cart AS c
                    JOIN user AS u ON c.userID = u.userID
                    JOIN item AS i ON c.cartID = i.cartID
                    WHERE c.cartID = $cartID";
      
          $result = $db->query($query);
      
          if ($result && $result->rowCount() > 0) {
            echo "<main id='checkout-page'>
            <div class='checkout-container-checkout'>
            <div class='wrapper'> <svg class='checkmark' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 52 52'> <circle class='checkmark__circle' cx='26' cy='26' r='25' fill='none'/><path class='checkmark__check' fill='none' d='M14.1 27.2l7.1 7.2 16.7-16.8'/>
            </svg>
            </div>
            <div class='order-banner-checkout'>
            <h1 class='orderNumberh1'>Order completed!</h1>
            <p>Thanks, " . $userName . "</p>
            <h3 class='orderNumberh3'>" . $orderNumber . "</h3>
          </div>";
          
            echo "<table id='checkout-table'>
                                <thead>
                                    <tr>
                                        <th class='header-dish'>Dish</th>
                                        <th class='header-price'>Price</th>
                                        <th class='header-ingredients'>Ingredients</th>
                                    </tr>
                                </thead>
                                <tbody>";
              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                  // Access the fetched data
                  $dishName = $row['dishName'];
                  $ingredients = $row['ingredients'];
                  $price = $row['price'];
      
                  // Increment the count for each dish name
                  if (isset($dishCounts[$dishName])) {
                      $dishCounts[$dishName]++;
                  } else {
                      $dishCounts[$dishName] = 1;
                  }
      // Display the dish details in a table row
      echo "<tr class='checkout-row'>
      <td class='item-menu'>" . $dishName . "</td>
      <td class='item-desc'>$" . $price . "</td>
      <td class='item-option'>" . $ingredients . "</td>
    </tr>";

                  // Append dish details to the order message
                //   $orderMessage .= "- Dish: " . $dishName . ", Price: " . $price . ", Ingredients: " . $ingredients . "<br>";
                  $subtotal += $price;
              }
              echo "</tbody></table>";
              // Append the dish counts to the order message
              $orderMessage .= "You have ordered" . "<br>";
              foreach ($dishCounts as $dishName => $count) {
                  $orderMessage .= $count . " " . $dishName .  "<br>";
              }
      
              $taxRate = 0.13;
              $taxAmount = $subtotal * $taxRate;
      
              // Calculate total price including tax
              $totalPrice = $subtotal + $taxAmount;

              $taxAmountFormatted = number_format($taxAmount, 2);
              $totalPriceFormatted = number_format($totalPrice, 2);
      
              echo "<div class='order-details1'>
              <p>$orderMessage</p>
              <p>Subtotal: $" . $subtotal . "</p>
              <p>Tax (13%): $" . $taxAmountFormatted . "</p>
              <p><b>Total Price: $" . $totalPriceFormatted . "</b></p>
          </div>";
      
          // Display additional order-related information
          echo "<div class='order-details2'>
              <p>We have emailed you at " . $userEmail . " with the order details.</p>
              <p>Payment of $" . $totalPriceFormatted . " will be processed when you pick up the food.</p>
              <p>You will receive a text to your phone number " . $userPhone . " as soon as the order is ready to be picked up!</p>
              <a href='index.php' title='gobackhome'>
              <div class='btn btn-gobackhome'>
                  <span>GO HOME</span>
              </div>
          </a>
          </div>
     
          </div>
          </main>";
          } else {
              echo "Error fetching combined data.";
          }
      }
      
      
}
}

}

?>

<?php
include('./components/footer.php')
?>