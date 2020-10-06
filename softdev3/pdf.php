<?php
	include 'inc/header.php';
    include_once 'lib/User.php';
	include_once 'helper/format.php';
	Session::checkSession();
?>

<?php 
  if (isset($_GET['msg'])) {
  	   echo "<span style='color:green;'>".$_GET['msg']."</span>";
  }
 ?>
   <div class="file_upload_s">
   	<div class="container">
   		<div class="row">
   			<form action="" method="POST" enctype="multipart/form-data">
			 <div class="form-group form-horizontal">
	          <label class="col-md-4 col-lg-4 control-label">Cv Upload(Pdf)</label>
	          <div class="col-md-8 col-lg-8 inputGroupContainer">
	            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-cloud-upload"></i></span>
	              <input type="file"  class="form-control" name="pdf_file" id="pdf_file" accept="application/pdf"><br>
	            </div>
	          </div>
	        </div> 
   			</form>
   		</div>
   	</div>
   </div>
<?php include "inc/footer.php"; ?>
