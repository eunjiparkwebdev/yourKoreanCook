<?php
  include('includes/bundle.php');

?>
<main>
    <div class="cucumber-wrapper">
        <img class="cucumber" src="./assets/images/cucumber.png" alt="cucumber picture"
            style="filter: drop-shadow(5px 5px 5px #3f3533);">
    </div>
    <div class="flex-container">
        <div class="flex-item box-1">
            <div class="shoppingIconContainer">
                <i class="fa-solid fa-cart-shopping fa-lg" style="color: #ffffff;" class="shoppingIcon"></i>
                <span class="itemCount">0</span>
            </div>
            <div class="grid-container">
                <div class="grid-item item1">

                    <h1 class="bibimbop-title">Korean Rice Bowl<br>Bibimbop</h1>
                    <!-- <div class="">
                        <i class="fa-solid fa-circle-plus fa-xl" style="color: #000;"></i>
                    </div> -->
                    <div class="boxButton">
                        <a href="order.php" title="order">
                            <div class="btn btn-one">
                                <span>ORDER NOW</span>
                            </div>
                        </a>
                        <div class="icon-wrapper">
                            <div class="icon"><img src="./assets/icons/dairy-free.png" width="27"></div>
                            <div class="icon"><img src="./assets/icons/gluten-free.png" width="27"></div>
                        </div>
                    </div>
                </div>
                <div class="bibimbop-wrapper grid-item item2">

                    <img class="bibimbop" src="./assets/images/bibimbop.png">
                </div>

            </div>



            <div class="about-container">

                <div class="about-item">
                    <h1 class="about-title">SIMPLE, HEALTHY, ELEGANT</h1>

                </div>
                <div class="about-item item3">
                    <p class="about-description">
                        Bibimbap is a very healthy dish given that it predominantly consists of protein mixed with a
                        variety of nutritious vegetables, and rounded out with carbs from the rice, making it a very
                        well-balanced, nutritious meal. A serving of the dish is 473 calories, with 34 grams of protein,
                        21 grams of fat, and 50 grams of carbs.
                    </p>
                </div>


            </div>

            <div class="customize-container1">


                <div class="customize-item1 meatless">
                    <img src="./assets/images/tofubibim.png" />
                    <h4 class="option-description">
                        VEGAN OPTION
                    </h4>
                </div>
                <div class="customize-item1 tofu">
                    <img src="./assets/images/veggiebibim.png" />
                    <h4 class="option-description">
                        VEGETARIAN OPTION
                    </h4>
                </div>
                <div class="customize-p">
                    <h2 class="about-title">CUSTOMIZE YOUR INGREDIENTS</h2>
                    <p class="about-description">
                        With your korean cook, we decided to charge you a flat dish price regardless of which
                        ingredients
                        you choose. If you decide to omit protein, we will throw in more vegetables! If you're not a
                        veggie eater,
                        we will put on more protein!
                    </p>

                </div>


            </div>





        </div>




        <div class="flex-item box-2">
            <div class="onion-wrapper">
                <img src="./assets/images/greenonion.png" />
            </div>

            <div class="grid-container">
                <div class="grid-item item1">
                    <h2 class="bulgogi-title">Marinated Beef <br>Rice Bowl<br>Bulgogi</h2>
                    <p class="bulgogi-description">Bulgogi is a traditional Korean dish that consists of thinly sliced
                        beef, typically marinated
                        in
                        a mixture of soy sauce, sugar, sesame oil,pear puree, garlic, and other natural seasonings.</p>
                    <div class="boxButton">
                        <a href="order.php" title="order">
                            <div class="btn btn-one">
                                <span>ORDER NOW</span>
                            </div>
                        </a>
                        <div class="icon-wrapper">
                            <div class="icon"><img src="./assets/icons/dairy-free.png" width="27"></div>
                            <div class="icon"><img src="./assets/icons/gluten-free.png" width="27"></div>
                        </div>
                    </div>
                </div>
                <div class="beefBowl-wrapper grid-item item2">
                    <img class="beefBowl" src="./assets/images/beefbowl.png">
                </div>

            </div>

            <div class="about-container">

                <div class="about-item">
                    <h1 class="about-title">JUICY, TENDER, SAVORY, SWEET</h1>

                </div>
                <div class="about-item item4">

                    <p class="about-description">
                        Bulgogi, or Korean beef barbecue, is undoubtedly one of the most quintessentially Korean dishes
                        there are: gorgeously thin slices of ribeye, tenderloin, or sirloin marinated in a savory-sweet
                        sauce and quickly cooked over flame or stove top griddle. Bul, meaning "fire," and gogi, meaning
                        "meat," originated
                        in Korea's Goguryeo era (the 1st century BCE to the 7th century CE), and once you taste these
                        perfectly caramelized morsels of sweet and savory meat, you'll understand why this dish has
                        stood the test of time.
                    </p>
                </div>



            </div>

            <div class="customize-container2">

                <div class="customize-p2">
                    <h2 class="addon-title">ADD ONS</h2>


                </div>

                <div class="customize-item2 egg">
                    <img src="./assets/images/friedegg.png" />
                    <h4 class="option-description2">
                        FRIED EGG
                    </h4>
                </div>
                <div class="customize-item2 sauce">
                    <img src="./assets/images/guchujang.png" />
                    <h4 class="option-description2">
                        SPICY SAUCE
                    </h4>
                </div>


            </div>



        </div>
    </div>
</main>
<?php
include('./components/footer.php')
?>