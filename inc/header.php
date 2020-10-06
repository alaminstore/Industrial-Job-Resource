<?php include "helper/Format.php"; ?>

<?php
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath.'/../lib/Session.php';
    Session::init();
    $sesid = Session::get("id");
 ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Industrial Job Resource</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/img/icon.png">	
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>

<?php
   if(isset($_GET['action']) && $_GET['action'] == "logout"){
	   Session::destroy();
   }
?>
<!-- Header top area start -->
<div class="header-top-area">
    <div class="container">
        <div class="row">
            <div class="top-area">
                <div class="col-md-7">
                    <a href="mailto:industrialjobresource@gmail.com"><i class="fa fa-envelope"></i>&nbsp; industrialjobresource@gmail.com</a> <span class="seprator">&nbsp; | &nbsp;</span>
                    <i class="fa fa-phone"></i> <a href="tel:880177897819">+880 17 7897819</a> <span class="seprator">&nbsp; | &nbsp;</span>
                     <i class="fa fa-clock-o"></i> Sat - Tues , 10am - 8pm
                </div>
                <div class="col-md-5 text-right">
                    <p>We are always here to find a new day..</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header top area end -->

<!-- Start Header -->
<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-12 col-xs-12">
                <!-- Logo -->
                <div class="logo">
                    <a href="index.php"><img src="assets/img/logo.png" class="img-responsive" alt="logo"></a>
                </div>
                <!--/ End Logo -->
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
                <div class="nav-area">
                    <!-- Main Menu -->
                    <nav class="mainmenu">
                        <div class="mobile-nav"></div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav menu"> 
							<?php
							    $id = Session::get("id");
							?>
                                <li class="<?php if($page=='home'){echo 'active';}?>"><a href="index.php">Home</a></li>
                                <li class="<?php if($page=='contact'){echo 'active';}?>"><a href="contact.php">Contact</a></li>
                                <li class="<?php if($page=='client'){echo 'active';}?>"><a href="client.php">Client_req</a></li>

							<?php
								$loginusr = Session::get("login");
                                if($loginusr == true){?>								
								<li class="<?php if($page=='profile'){echo 'active';}?>"><a href="profile.php?id=<?php echo $id;?>">Profile</a></li>
                                <li class="<?php if($page=='list'){echo 'active';}?>"><a href="job.php">jobs</a></li>
							    <li><a href="?action=logout">Logout</a></li>
								<?php }else{ ?>
								
								<li class="<?php if($page=='login'){echo 'active';}?>"><a href="login.php">Login</a></li>
                                <li class="<?php if($page=='register'){echo 'active';}?>"><a href="register.php">Register</a></li>
								<?php }
							?>
                                <?php
                                  if ($sesid == 1) { ?>
                                 <li class="<?php if($page=='admin'){echo 'active';}?>"><a href="admin.php">Admin</a></li>
                                 <li class="<?php if($page=='post'){echo 'active';}?>"><a href="post.php">Post Job</a></li>
                              <?php     }
                                ?>

                            </ul>
                        </div>
                    </nav>
                    <!--/ End Main Menu -->
                </div>
            </div>
        </div>
    </div>
</header>
<!--/ End Header -->
                
               