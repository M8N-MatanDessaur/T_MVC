<aside>
    <h1>T</h1>
    <nav>
        <ul>
            <li><a href="shop.php">Our Teas</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li>
                <a href="cart.php" style="position:relative">My Cart
                    <span class="cart-items-count">
                        <?php 
                        if(isset($_SESSION["cart"])){
                            echo count($_SESSION["cart"]);
                        }
                        else{
                            echo 0;
                        }
                        ?>
                    </span>
                </a>
            </li>
        </ul>
    </nav>
</aside>