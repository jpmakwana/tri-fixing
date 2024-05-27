<style>
    #site-header-wrap .mini-cart-1 li a:hover {
        background: #27e491 !important;
        border-color: #27e491;
        color: #27e491;


    }

    @media (min-width: 1200px) {
        #site-header-wrap .mini-cart-1 li a {
            padding: 12px 24px !important;
        }
    }

    @media (min-width: 992px) {
        .primary-menu>li>a {
            color: #ffffff;
        }
    }

    @media (min-width: 992px) {
        .primary-menu li.menu-item-has-children>a.abc:after {
            font-family: FontAwesome;
            content: '\f107';
            position: absolute;
            top: 1px;
            margin-left: 5px;
            display: none;
        }
    }
</style>

<?php
define("SCRIPTNAME", basename($_SERVER['PHP_SELF']));
function activeClass($script, $multi = '')
{
    if ($multi != "") {
        $scr = explode(",", $script);
        if (in_array(SCRIPTNAME, $scr)) {
            echo 'current-menu-item';
        }
    } else {
        if (SCRIPTNAME == $script) {
            echo 'current-menu-item';
        }
    }
}
?>

<header class="site-header">
    <div id="site-header-wrap" class="header-layout is-sticky">
        <div class="clearfix">
            <div id="headroom" class="site-header-main">
                <div class="container">
                    <div class="row">
                        <a class="logo" href="index.php" title="TekhFixers - Mobile Device and Electronics Repair WordPress Theme" rel="home">
                            <img src="images/all/logo.png" alt="TekhFixers - Mobile Device and Electronics Repair WordPress Theme" />
                        </a>
                        <a class="logo logo-sticky" href="index.php" title="TekhFixers - Mobile Device and Electronics Repair WordPress Theme" rel="home">
                            <img src="images/all/logo-blue.png" alt="TekhFixers - Mobile Device and Electronics Repair WordPress Theme" />
                        </a>
                        <span class="btn-nav-mobile open-menu"> <span></span> </span>
                        <nav id="site-navigation" class="main-navigation">
                            <ul id="mastmenu" class="primary-menu clearfix">
                                <li id="menu-item-375" class="menu-item menu-item-type-post_type enu-item-object-page menu-item-375 <?php activeClass("index.php") ?>">
                                    <a href="index.php">Home</a>
                                </li>
                                <li id="menu-item-375" class="menu-item menu-item-type-post_type enu-item-object-page menu-item-375 <?php activeClass("about-us.php") ?>">
                                    <a href="about-us.php">About Us</a>
                                </li>
                                <li id="menu-item-42" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-42 <?php activeClass("services.php,category.php,screenrepair.php,batteryreplacement.php,camerarepair.php,speakerrepair.php", "Multi") ?>">
                                    <a href="services.php">Services</a>
                                    <ul class="sub-menu">
                                        <li id="menu-item-1481" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1481 <?php activeClass("category.php") ?>">
                                            <a href="category.php">Fix Your Device</a>
                                        </li>
                                        <li id="menu-item-776" class="menu-item menu-item-type-post_type menu-item-object-services menu-item-776 <?php activeClass("screenrepair.php") ?>">
                                            <a href="screenrepair.php">Single Service</a>
                                        </li>
                                        <li id="menu-item-904" class="menu-item menu-item-type-post_type menu-item-object-services menu-item-904 <?php activeClass("batteryreplacement.php") ?>">
                                            <a href="batteryreplacement.php">Battery
                                                Replace</a>
                                        </li>
                                        <li id="menu-item-775" class="menu-item menu-item-type-post_type menu-item-object-services menu-item-775 <?php activeClass("camerarepair.php") ?>">
                                            <a href="camerarepair.php">Camera Repair</a>
                                        </li>
                                        <li id="menu-item-778" class="menu-item menu-item-type-post_type menu-item-object-services menu-item-778 <?php activeClass("speakerrepair.php") ?>">
                                            <a href="speakerrepair.php">Speaker Repair</a>
                                        </li>
                                    </ul>
                                </li>
                                <li id="menu-item-47" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-47 <?php activeClass("blog.php,the-easiest-way-to-apply-a-screen-protector.php", "multi") ?>">
                                    <!-- <a href="blog-grid/index.html">Latest News</a> -->
                                    <a href="#">Latest News</a>

                                    <ul class="sub-menu">
                                        <li id="menu-item-49" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-49 <?php activeClass("blog.php") ?>">
                                            <a href="blog.php">Lastest News</a>
                                        </li>
                                        <li id="menu-item-774" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-774 <?php activeClass("the-easiest-way-to-apply-a-screen-protector.php") ?>">
                                            <a href="the-easiest-way-to-apply-a-screen-protector.php">Blog
                                                Post</a>
                                        </li>
                                    </ul>
                                </li>
                                <li id="menu-item-44" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-44 <?php activeClass("gallery.php") ?>">
                                    <a href="gallery.php">Gallery</a>
                                </li>

                                <li id="menu-item-40" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-40 <?php activeClass("contact.php") ?>">
                                    <a href="contact.php">Contact Us</a>
                                </li>

                                <?php
                                if (isset($_SESSION['USER_ID']) && $_SESSION['USER_ID'] > 0) {
                                ?>
                                    <li id="menu-item-47" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-47 <?php activeClass("my-account.php,logout.php", "multi") ?>">
                                        <a href="my-account.php" style="font-size: 30px;" class="abc"><i class="fa fa-user"></i></a>
                                        <ul class="sub-menu">
                                            <li id="menu-item-49" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-49 <?php activeClass("my-account.php") ?>">
                                                <a href="my-account.php">My Account</a>
                                            </li>
                                            <li id="menu-item-774" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-774 <?php activeClass("logout.php") ?>">
                                                <a href="logout.php">LogOut</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li id="menu-item-40" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-40 <?php activeClass("login.php") ?>">
                                        <a href="login.php">Login</a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>

                            <ul class="mini-cart mini-cart-1" style="margin: 0 15px 0 15px;">
                                <li> <a href="category.php" target="_self" class="btn btn-default size-default  wpb_bounceInDown bounceInDown">
                                        Get Quotation <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>