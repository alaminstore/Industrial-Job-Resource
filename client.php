<?php
	$page = 'client';
	include "inc/header.php";
	include "lib/User.php";
?>
<?php
   $user = new User();
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['client_req'])) {
        $client = $user->client_req($_POST); //pass all resistration form's data in this method  and then implement this in User class.
   }
?>

 <div class="client_area">
 	<div class="container">
 		<div class="row">
 		<div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class=" wow zoomIn delay-2s"> Employee Seeker</h2>
                </div>
                <div class="panal-body">
                    <div style="max-width:600px;margin:30px auto;">

                   <?php
					  if (isset($client)) {
						  echo $client;
					  }
					?>


					<form action="" method="POST">
						<div class="form-group">
							<label for="name">Your Name:</label>
							<input type="text" name="cl_name" id="name" placeholder="Your Name" class="form-control" autofocus>
						</div>
						<div class="form-group">
							<label for="name">Your Email:</label>
							<input type="email" name="cl_email" id="email" placeholder="Your Email" class="form-control" autofocus>
						</div>

						<div class="form-group">
							<label for="Company">Company Name:</label>
							<input type="text" name="cname" id="cname" value="" placeholder="Company Name" class="form-control">
						</div>

						<div class="form-group">
							<label for="Job_Name">Job Name:</label>
							<input type="text" name="jname" id="email" placeholder="Job name" class="form-control">
						</div>
						<div class="form-group">
							<label for="location">Location:</label>
							<input type="text" name="location" id="location" placeholder="Location" class="form-control">
						</div>
						<div class="form-group">
							<label for="jtype">Job Type:</label>
							<input type="text" name="job_type" id="job_type" placeholder="Full Time / Part Time" class="form-control">
						</div>
						<div class="form-group">
							<label for="salary">Salary</label>
							<input type="text" name="salary" id="salary" placeholder="Amout of salary" class="form-control">
						</div>
	
						<div class="form-group">
							<label for="education">Employee Education:</label>
							<input type="text" name="edu_exp" id="edu_exp" placeholder="Education" value=""  class="form-control">
						</div>
						<div class="form-group">
							<label for="Requirement">Requirement</label>
							<input type="text" name="exptr" id="exptr" placeholder="Experience" value=""  class="form-control">
						</div>
						<div class="form-group">
							<label for="Details">Details:</label>
							<textarea name="details_cl" id="details_cl"  class="form-control" cols="30" rows="10"></textarea>
						</div>
						<div class="form-group">
							<label for="Phone">Your phonenumber</label>
							<input type="text" name="phone" id="phone" placeholder="Phone Number" value=""   class="form-control">
						</div>
						<button type="reset" name="register" class="btn btn-info"><i class="fa fa-repeat" aria-hidden="true"></i>
                         Reset</button>
                          &nbsp;
						<button type="submit" name="client_req" class="btn btn-info"><i class="fa fa-sign-in" aria-hidden="true"></i>
                         Submit Here</button>
					</form>
                        
                    </div>
                </div>
            </div>	
 		</div>
 	</div>
 </div>



<?php 
  include 'inc/footer.php';
?>