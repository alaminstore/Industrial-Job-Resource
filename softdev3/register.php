<?php
	$page = 'register';
	include "inc/header.php";
	include "lib/User.php";
	Session::checkLogin();
?>
<?php
   $user = new User();
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
        $usrRegi = $user->userRegistration($_POST); //pass all resistration form's data in this method  and then implement this in User class.
   }
?>

<div class="reg">
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class=" wow zoomIn delay-2s"> User Registration</h2>
                </div>
                <div class="panal-body">
                    <div style="max-width:600px;margin:30px auto;">

					<?php
					  if (isset($usrRegi)) {
						  echo $usrRegi;
					  }
					?>
					<form action="" method="POST">
						<div class="form-group">
							<label for="name">Your Name:</label>
							<input type="text" name="name" id="name" placeholder="Full Name" class="form-control" autofocus>
						</div>

						<div class="form-group">
							<label for="username">User Name:</label>
							<input type="text" name="username" id="username" value="" placeholder="Username" class="form-control">
						</div>

						<div class="form-group">
							<label for="email">Email Address:</label>
							<input type="text" name="email" id="email" placeholder="Email" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">Mobile Number:</label>
							<input type="tel" name="mobile" id="phone" placeholder="Mobile numbar" class="form-control">
						</div>
						<div class="form-group">
							<label for="gender">Gender:</label><br>
							<input type="radio" name="gender" value="Male" checked> Male &nbsp;
							<input type="radio" name="gender" value="Female"> Female &nbsp;
						</div>
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" name="password" id="password" placeholder="Password" value=""  autocomplete="new-password" class="form-control">
						</div>
						<button type="reset" name="register" class="btn btn-info"><i class="fa fa-repeat" aria-hidden="true"></i>
                         Reset</button>
                          &nbsp;
						<button type="submit" name="register" class="btn btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i>
                         Submit Here</button>
					</form>
                        
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-footer">
                    <h4>Do you face any Problem & need to inquiry more, come to our office</h4>
                </div>
            </div>
        </div>
    </div>
</div>
                  
<?php 
 require_once "inc/footer.php";
?>
                   
