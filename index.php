<?php
        if(isset($_SESSION['user'])){
            if($_SESSION['user'] == "admin"){
                header("location:admin/admin.php");
            }else if($_SESSION['user'] == 'worker'){
                header("location:admin/admin.php");
            }else{
            header("location:user/user.php");
        }
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BJLC Shop</title>
    <link rel="stylesheet" href="css/index.css">
    
    <!-- box Icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon"> -->
</head>
<body>
    
    <!-- Scroll to tap -->
    <!-- <a href="#" class="scroll-top"><i class='bx bx-up-arrow-alt'></i></a> -->
    <a href="#" class="top"><i class='bx bxs-caret-up-circle bx-tada scroll-top' ></i></a>
    <!-- header -->
    <header>
        <div class="nav container">
            <!-- Menu Icon -->
            <div class="menu-icon">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <!-- NavList -->
            <ul class="navbar ">
                <li><a href="#home">Home</a></li>
                <li><a href="#popular">Popular</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#products">Products</a></li>
                <li><a href="#newsletter">Register</a></li>
            </ul>
            <!-- logo -->
            <a href="index.php" class="logo">
                BJLC
            </a>
    
            <!-- nav-Icon -->
            <div class="nav-icons">
                <i class='bx bx-cart' id="cart-icon"></i>
                <a href="Login.php"> <i class='bx bx-user'  id="user-icon"></i> </a>
            </div>
          
            <!-- Cart -->
            <div class="cart">
                <div class="cart-content">
                    <!-- box 1 -->
                    <div class="cart-box">
                        <img src="./img/Motolite.png" alt="">
                        <div class="cart-text">
                            <h3>Motolite Champion</h3>
                            <span>900</span>
                            <span>x1</span>
                        </div>
                        <i class='bx bxs-trash-alt'></i>
                    </div>
            

                    <div class="total">
                        <h3>1 items</h3>
                        <span>Total 900</span>
                    </div>

                    <a href="#" class="btn">Proceed to Pay</a>
                </div>
            </div>
       
        </div>
    </header>
    <!-- Home Section  -->
    <section class="home container" id="home">
        <div class="home-text">
            <h1><span>Auto Supply </span><br>and Accessories</h1>
            <p>This is BJLC's online store with  <br> easy to use and fast delivery.</p>
            <a href="#" class="btn">Shop more</a>
        </div>
        <!-- Home Image -->
        <div class="home-img">
            <img src="./img/Motolite.png" alt="">
        </div>
    </section>
    <section class="popular container" id="popular">
        <div class="heading">
            <h2>Popular</h2>
            <a href="#">See All</a>
        </div>
        <!-- Popular Content -->
        <div class="popular-content">

            <!-- Box 1 -->
            <div class="box">
                <img src="./img/Engine Oil GreenTech.png" alt="">
                <div class="box-text">
                    <div class="title-price">
                        <h3> GreenTech</h3>
                        <span>Engine Oil</span><br>
                        <span>₱</span><span> 900</span><span>.00</span>
                    </div>
                    <a href="#"><i class='bx bxs-cart' ></i></a>
                </div>
            </div>

            <!-- Box 2 -->
            <div class="box">
                <img src="./img/Motolite.png" alt="">
                <div class="box-text">
                    <div class="title-price">
                        <h3>Motolite Champion </h3>
                        <span>Battery</span><br>
                        <span>₱</span><span> 900</span><span>.00</span>
                    </div>
                    <a href="#"><i class='bx bxs-cart' ></i></a>
                </div>
            </div>

            <!-- Box 3 -->
            <div class="box">
                <img src="./img/Preston.png" alt="">
                <div class="box-text">
                    <div class="title-price">
                        <h3>Preston</h3>
                        <span>Break Fluid</span><br>
                        <span>₱</span><span> 900</span><span>.00</span>
                    </div>
                    <a href="#"><i class='bx bxs-cart' ></i></a>
                </div>
            </div>
            <!-- Box 4 -->
            <div class="box">
                <img src="./img/Headlight.png" alt="">
                <div class="box-text">
                    <div class="title-price">
                        <h3>Headlight</h3>
                        <span>₱</span><span> 900</span><span>.00</span>
                    </div>
                    <a href="#"><i class='bx bxs-cart' ></i></a>
                </div>
            </div>
            
            </div>
        </div>
    </section>
    <!-- Popular Section End -->

    <!-- About Section -->
    <section class="about container" id="about">
        <div class="about-img">
            <img src="./img/chair ball.png" alt="">
        </div>
        <!-- About Text -->
        <div class="about-text">
            <h2>About Us</h2>
            <p>Our mission is to give our client a dependable source for premium motor and harware accessories to provide a large range of products to accomodate various demands and tastes, to gurantee excellent customer service and reasonable prices.</p>
            <div class="features">
                <i class='bx bxs-check-square'><span>Lower Prices</span></i>
                <i class='bx bxs-check-square'><span>Easy Returns</span></i>
                <i class='bx bxs-check-square'><span>Quality Assurance</span></i>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Product Section -->
    <section class="products container" id="products">
        <div class="heading">
            <h2>Product Shop</h2>
            <a href="#">See All</a>
        </div>
        <!-- Product Content -->
        <div class="products-content">
             <!-- Box 1 -->
             <div class="box">
                <img src="./img/Preston.png" alt="">
                <div class="box-text">
                    <div class="title-price">
                        <h3>Preston</h3>
                        <span>Break Fluid</span><br>
                        <span>₱</span><span> 900</span><span>.00</span>
                    </div>
                    <a href="#"><i class='bx bxs-cart' ></i></a>
                </div>
            </div>

            <!-- Box 2 -->
            <div class="box">
                <img src="./img/Motolite.png" alt="">
                <div class="box-text">
                    <div class="title-price">
                        <h3>Motolite Champion </h3>
                        <span>Battery</span><br>
                        <span>₱</span><span> 900</span><span>.00</span>
                    </div>
                    <a href="#"><i class='bx bxs-cart' ></i></a>
                </div>
            </div>

              <!-- Box 3 -->
            <div class="box">
                <img src="./img/Preston.png" alt="">
                <div class="box-text">
                    <div class="title-price">
                        <h3>Preston</h3>
                        <span>Break Fluid</span><br>
                        <span>₱</span><span> 900</span><span>.00</span>
                    </div>
                    <a href="#"><i class='bx bxs-cart' ></i></a>
                </div>
            </div>
               <!-- Box 4 -->
            <div class="box">
                <img src="./img/Headlight.png" alt="">
                <div class="box-text">
                    <div class="title-price">
                        <h3>Headlight</h3>
                        <span>₱</span><span> 900</span><span>.00</span>
                    </div>
                    <a href="#"><i class='bx bxs-cart' ></i></a>
                </div>
            </div>
            
              <!-- Box 5 -->
              <div class="box">
                <img src="./img/Engine Oil GreenTech.png" alt="">
                <div class="box-text">
                    <div class="title-price">
                        <h3> GreenTech</h3>
                        <span>Engine Oil</span><br>
                        <span>₱</span><span> 900</span><span>.00</span>
                    </div>
                    <a href="#"><i class='bx bxs-cart' ></i></a>
                </div>
            </div>
              <!-- Box 6 -->
             <div class="box">
                <img src="./img/Preston.png" alt="">
                <div class="box-text">
                    <div class="title-price">
                        <h3>Preston</h3>
                        <span>Break Fluid</span><br>
                        <span>₱</span><span> 900</span><span>.00</span>
                    </div>
                    <a href="#"><i class='bx bxs-cart' ></i></a>
                </div>
            </div>
               <!-- Box 7 -->
               <div class="box">
                <img src="./img/Engine Oil GreenTech.png" alt="">
                <div class="box-text">
                    <div class="title-price">
                        <h3> GreenTech</h3>
                        <span>Engine Oil</span><br>
                        <span>₱</span><span> 900</span><span>.00</span>
                    </div>
                    <a href="#"><i class='bx bxs-cart' ></i></a>
                </div>
            </div>
              <!-- Box 8 -->
            <div class="box">
                <img src="./img/Headlight.png" alt="">
                <div class="box-text">
                    <div class="title-price">
                        <h3>Headlight</h3>
                        <span>₱</span><span> 900</span><span>.00</span>
                    </div>
                    <a href="#"><i class='bx bxs-cart' ></i></a>
                </div>
            </div>

        </div>
    </section>
     <!-- Product Content End -->

     <!-- Newsletter -->
        <section id="newsletter" class="newsletter">
            <div class="newsletter-content container">

                <div class="newsletter-text">
                    <h2>SING UP AND WIN!</h2>
                    <p>Sign up and Get A chance to avail our 50% DISCOUNT this 11.11 .</p>
                </div>
                <!-- Form  -->
                <form action="Signup.php" method="post">
                    <?php

                        if(isset($_GET['error'])){?>
                            <input type="text" class="error" readonly value="<?php echo "Invalid " . $_GET['error']?>">
                            <?php echo "<script>alert('Inavlid $_GET[error]');</script>"?>
                        <?php }?>

                    <input type="email" name="email" id="" placeholder="Enter your email.." required>
                    <input type="text" name="uid" placeholder="Enter your username.." required>
                    <input type="password" name="pwd" placeholder="Enter your password.." required>
                    <p><?php $error ?></p>
                    <input type="password" name="pwdRepeat" placeholder="Confirm password.." required>
                    <input type="submit" value="Register" name="submit" class="btn">
                </form>
                <?php

                ?>
            </div>
        </section>
     <!-- Newsletter End-->


     <!-- Footer section -->
     <div class="footer container">
        <div class="footer-box">
            <h3>The Company</h3>
            <a href="#">About us</a>
            <a href="#">Help</a>
            <a href="#">Blog</a>
            <a href="#">Privacy Policy</a>
        </div>
        <div class="footer-box">
            <h3>Popular Categories</h3>
            <a href="#">Battery</a>
            <a href="#">Oil</a>
            <a href="#">Screw </a>
            <a href="#">Tires</a>
        </div>
        <div class="footer-box">
            <h3>More Information</h3>
            <a href="#">Shipping</a>
            <a href="#">Delivery & Returns</a>
            <a href="#">Contact Us</a>
            <a href="#">Sitemap</a>
        </div>
        <div class="footer-box">
            <h3>Social</h3>
            <div class="social">
                <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                <a href="#"><i class='bx bxl-instagram' ></i></a>
                <a href="#"><i class='bx bxl-twitter'></i></a>
            </div>
        </div>
     </div>
     <!-- Footer section End-->

     <!-- Copyright  -->
     <div class="copyright">
        <p>&#169; Group 2  All Right Reserved</p>
     </div>

    <script src="js/index.js"></script>

</body>
</html>