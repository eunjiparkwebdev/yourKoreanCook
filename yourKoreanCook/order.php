<?php
    include('includes/bundle.php');

?>


<div id="popupContainer" class="popup-container">
    <div class="popup-box">
        <span id="closeBtn" class="close-btn">&times;</span>
        <p>Click on <span><i class="fa-solid fa-square-plus fa-beat-fade fa-lg" style="color: #27343a;"></i></span>
            to
            start
            customizing your order.</p>
    </div>
</div>


<main id="order-page">
    <div class="checkout-container">
        <div class="order-banner">
            <a href="index.php"><i class="fa-solid fa-circle-arrow-left fa-2x" style="color: #363a37;"></i></a>
            <h1 class="your-order">Your Order</h1>
        </div>




    </div>
    <form action="" method="post" id="cart-item-form">


        <table id="cart-table" class="item-list">
            <thead>
                <tr>
                    <th class="section-header header-menu">Menu</th>
                    <th class="section-header header-desc">Description</th>
                    <th class="section-header header-option ">Options</th>
                    <th class="section-header header-quantity ">Quantity</th>
                    <th class="section-header header-Remove ">Remove</th>
                    <th class="section-header header-total-price ">Price</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($cats as $cat) : 
                     ?>

                <tr class="cart-row original-row" id="cart-row">
                    <td class="item-image">
                        <img src="<?php echo $cat['catImage']?>" alt="picture of bibimbop" />
                        <button id="addMore<?php echo $cat['catName']?>">&plus;</button>

                    </td>
                    <td class="item-details">
                        <div class="full-top">
                            <div class="product-list-item">
                                <div id="dishContainer" class="name" title="<?php echo $cat['catDesc'] ?>">
                                    <?php echo $cat['catName']; ?>
                                </div>

                            </div>
                        </div>

                    <td class="item-ingredient-options">

                        <?php 
                                $options = get_ingredients_by_cat($cat['catID']); ?>
                        <div class="options original-option original-row">
                            <!-- Looping through ingredients from ingredients table  -->
                            <?php 
$options = get_ingredients_by_cat($cat['catID']);
?>
                            <?php 
    foreach ($options as $option) : 
        $ingredientID = $option['ingredientID'];
        $ingredientName = $option['ingredientName'];
        $isChecked = $option['ingredientBool'] ? 'checked' : '';
    ?>
                            <label for="addOn<?php echo $ingredientID ?>"><?php echo $ingredientName; ?></label>
                            <input type="checkbox" id="addOn<?php echo $ingredientID ?>" name="ingredientName[]"
                                class="ingredient-input" value="<?php echo $ingredientName ?>"
                                <?php echo $isChecked ?> />
                            <?php endforeach; ?>
                        </div>
                    </td>
                    <td class="item-quantity">
                        <span class="original-quantity original-row">1</span>
                    </td>
                    <td class="item-price ">
                        <button class="removeBtn original-remove-btn original-row">&minus;</button>
                        <!-- <div class="removeBtn original-remove-btn original-row removeDiv"><i
                                class="fa-solid fa-minus fa-lg" style="color: #ffffff;"></i></div> -->

                    </td>
                    <td class=" item-total ">
                        <span class=" mobile-only price-label" aria-hidden="true">Item Price: $</span>
                        <span id="<?php echo $cat['catName']?>Total">
                            <?php echo $cat['catPrice'] ?>
                        </span>

                    </td>
                </tr>
                <input type="hidden" name="dishContent" id="dishContent">
            </tbody> <?php endforeach; ?>
        </table>

        <div class="total-container">
            <h5><span id='bibimbopQty' class="category-count">0</span> Bibimbop <input type="hidden" name="bibimContent"
                    id="bibimContent">
            </h5>
            <h5><span id='bulgogiQty' class="category-count">0</span> Bulgogi <input type="hidden" name="bulgogiContent"
                    id="bulgogiContent">
            </h5>
            <!-- calculate totalprice * 0.13 -->
            <h5>Tax(HST/GST): $<span id='taxAmount'>0</span><input type="hidden" name="taxContent" id="taxContent">
            </h5>
            <!-- calculate totalprice + tax -->
            <h1>Total: $<span id="grandTotal">0</span><input type="hidden" name="grandTotalContent"
                    id="grandTotalContent"></h1>
            <button type="button" id="submitBtn1" class="btn-container" onclick="openForm()">
                <div class="btn btn-pay">
                    <span>CHECK OUT</span>
                </div>
            </button>
        </div>
    </form>

    <!----pop up div----->
    <div class="popup">
        <div class="formPopup" id="popupForm">
            <form action="checkout.php" class="formContainer" method="post" id="user-form">
                <input type="hidden" id="dynamicDataContent" name="dynamicDataContent" value="">
                <h2>Your Order Detail</h2>
                <h5><span id='bbpQty'>0</span> Bibimbop<input type="hidden" name="bbContent" id="bbContent">
                </h5>
                <h5><span id='bggQty'>0</span> Bulgogi<input type="hidden" name="bgContent" id="bgContent">
                </h5>
                <!-- calculate totalprice * 0.13 -->
                <h5>Tax(HST/GST): $<span id='taxAmt'>0</span>
                </h5>
                <!-- calculate totalprice + tax -->
                <h1>Total: $<span id="addTotal">0</span><input type="hidden" name="calculateTotal" id="calculateTotal">
                </h1>
                <label for="email">
                    <strong>E-mail</strong>
                </label>

                <input type="text" id="email" placeholder="Your Email" name="userEmail" required>
                <label for="psw">
                    <strong>Your Name</strong>
                </label>
                <input type="text" id="yourNickName" placeholder="Your Name" name="userName" required>
                <label for="phone"><strong>phone number</strong></label>

                <input type="tel" id="phone" name="userPhone" placeholder="Format: 123-456-7890"
                    pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>

                <button type="submit" id="submitBtn2" class="btn">Complete Your Order</button>
                <button type="button" class="btn cancel" onclick="closeForm(); return true;">Close</button>
            </form>
        </div>
    </div>

</main>

<?php

include('components/footer.php'); ?>