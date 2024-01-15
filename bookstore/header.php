<?php session_start();
ob_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <title>anik158.com | Ahsan's BookHive</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
</head>

<body class="is-preload">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Header -->
        <header id="header">
            <div class="inner">
                <!-- Logo -->
                <a href="index.php" class="logo">
                    <span class="fa fa-book"></span>
                    <span class="title">Ahsan's BookHive</span>
                </a>

                <!-- Nav -->
                <nav>
                    <ul>
                        <li><a href="#menu">Menu</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <!-- Menu -->
        <nav id="menu">
            <h2>Menu</h2>
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li>
                    <a href="#" class="dropdown-toggle">About</a>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="testimonials.php">Testimonials</a></li>
                        <li><a href="terms.php">Terms</a></li>
                    </ul>
                </li>

                <?php if (isset($_SESSION['userid'])): ?>
                    <li><a href="logout.php">Sign Out</a></li>
                    <li><a href="userprofile.php">
                            <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </a></li>
                <?php else: ?>
                    <li><a href="signup_log.php">Sign Up/In</a></li>
                    <li><a href="admin/admin_login.php">Admin</a></li>
                <?php endif; ?>

                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </nav>