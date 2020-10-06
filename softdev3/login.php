<?php
$page = 'login';
include "inc/header.php";
include "lib/User.php";
Session::checkLogin();
?>

<?php
   $user = new User();
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $usrLogin = $user->userLogin($_POST); 
   }
?>

  <!--Login Form Start-->
<div class="container wow fadeIn delay-2s login_page" style="margin-top:40px">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><strong> Log In to continue</strong> </div>
                <div class="panel-body">
			
       			<?php
                  if (isset($usrLogin)) {
                      echo $usrLogin;
                  }
                ?>

			<form role="" action="" method="POST">
				<fieldset>
					<div class="row">
						<div class="center-block">
							<img class="profile-img" src="assets/img/user.png" alt="">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-10  col-md-offset-1 ">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-user"></i>
									</span>
									<input class="form-control" placeholder="Email" name="email" type="text" autofocus >
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-lock"></i>
									</span>
									<input type="password" class="form-control" placeholder="Password" name="password"  autocomplete="new-password">
								</div>
							</div>
							<div class="form-group">
								<input type="submit" name="login" class="btn btn-lg btn-primary btn-block" value="Log In">
							</div>
						</div>
					</div>
				</fieldset>
			</form>
                </div>
                <div class="panel-footer ">
                    Don't have an account! <a href="register.php" onClick=""> Sign Up Here </a>
                </div>
            </div>
        </div>
    </div>
</div>
  <!--Login Form End-->
<?php
 include "inc/footer.php";
?>
   
    
    
