<?php
  include 'inc/header.php';
  include_once 'lib/User.php';
  include_once 'lib/Database.php';
  include_once 'helper/format.php';
  Session::checkSession();
?>
<?php
    $db = new Database();
    $user = new User();
    $format = new Format();


 if (isset($_GET['userId'])) {
       $currentid = $_GET['userId'];
     //  echo $currentid;
  }

?>

<?php

if (isset($_GET['jnameId'])) {
       $job_name_id = $_GET['jnameId'];
      // echo $job_name_id;
  }

?>

  <?php /*
  $query = "SELECT * FROM tbl_user Where id = $currentid";
  $post = $db->select($query);
   if ($post) {
    foreach($post as $valuedata){
      echo $valuedata['name']."<br>";
      echo $valuedata['username'];
      echo $valuedata['email'];
    } }*/
?> 
 


<?php


if(isset($_REQUEST['submit_inter']))
{
  
      $fullname  = $_REQUEST['full_name'];
      $address   = $_REQUEST['address'];
      $email     = $_REQUEST['email'];
      $mobile    = $_REQUEST['mobile'];
      $website   = $_REQUEST['website'];
      $job_name  = $_REQUEST['job_name'];
      $company   = $_REQUEST['company'];
      $jdate     = $_REQUEST['jdate'];
      $username  = $_REQUEST['user_name'];
      $zip       = $_REQUEST['zip'];
      $re_email  = $_REQUEST['re_email'];
      $re_mobile = $_REQUEST['re_mobile'];
      $gender    = $_REQUEST['gender'];

      

     $upload_pdf=uniqid() .date("Y-m-d-H-i-s") .$_FILES["pdf_file"]["name"];  //value
     move_uploaded_file($_FILES["pdf_file"]["tmp_name"],"upload/cv/" .$upload_pdf);

    if(empty($address) || empty($zip) || empty($re_email) || empty($website) || empty($re_mobile) ){
      $errorMsg="<div class='alert alert-danger'><strong>Error ! </strong>Field must not be empty.</div>";
    }
    if (strlen($re_mobile) < 11 || strlen($re_mobile) > 11) {
       $errorMsg="<div class='alert alert-danger'><strong>Wrong ! </strong>Write your correct mobile number.</div>";
    }
    if(empty($upload_pdf)){
      $errorMsg="Please Select Pdf file";
    }
    
    if(!isset($errorMsg))
    {

    $isql = "INSERT into tbl_interview(fullname,username,cr_address,zipcode,email,alt_email,mobile,alt_mobile,website,gender,ap_job,cname,j_date,pdf)
        values(:fullname ,:username,:cr_address,:zipcode,:email,:alt_email,:mobile,:alt_mobile,:website,:gender,:ap_job,:cname,:j_date,:pdf)";
             $query = $db->pdo->prepare($isql); //A prepared statement is a feature used to execute the same (or similar) SQL statements repeatedly with high efficiency.
             $query->bindvalue(':fullname'     , $fullname);
             $query->bindvalue(':username' , $username);
             $query->bindvalue(':cr_address'    , $address);
             $query->bindvalue(':zipcode'    , $zip);
             $query->bindvalue(':email'    , $email);
             $query->bindvalue(':alt_email'   , $re_email);
             $query->bindvalue(':mobile'   , $mobile);
             $query->bindvalue(':alt_mobile' , $re_mobile);
             $query->bindvalue(':website' , $website);
             $query->bindvalue(':gender' , $gender);
             $query->bindvalue(':ap_job' , $job_name);
             $query->bindvalue(':cname' , $company);
             $query->bindvalue(':j_date' , $jdate);
             $query->bindvalue(':pdf' , $upload_pdf);


             $result = $query->execute();
    
      if($result)
      {
        $insertMsg="<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong><i class='fa fa-check' aria-hidden='true'></i></strong> You have successfully Submitted your info.</div>"; //execute query success message
      }
  
  } 
}

?>







<br>
<div class="apply_option">
 <div class="container">
    <div class="row">
      <div class="navbar navbar-default">
       <h3 class="text-center">Apply Form!</h3>
    </div>
  </div>
 </div>  
</div>

<div class="attention">
  <div class="container">
    <div class="row">
      <div class="notice">
        <marquee behavior="" direction="">After Submission your info, Our team will contact with you.</marquee>
      </div>
    </div>
  </div>
</div>

<div class="apply_form">

  <div class="container">



<?php
    if(isset($errorMsg))
    {
      ?>
            <div class="">
              <strong><?php echo $errorMsg; ?></strong>
            </div>
            <?php
    }
    if(isset($insertMsg)){
    ?>
      <div class="">
        <strong> <?php echo $insertMsg; ?></strong>
      </div>
        <?php
    }
?>  


  <form action=""  method="POST" class="well"  id="contact_form" enctype="multipart/form-data">

    <fieldset>
   <?php 
    $query = "SELECT * FROM tbl_user Where id = $currentid";
    $post = $db->select($query);
    if ($post) {
    foreach($post as $valuedata){ ?>

    <div class="col-md-6 form-horizontal">   <!-- Left -->

        <div class="form-group">
          <label class="col-md-4 col-lg-4 control-label">Full Name</label>
          <div class="col-md-8 col-lg-8 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
               <input class="form-control" name="full_name" placeholder="FullName" type="text" value="<?php echo $valuedata['name']; ?>" readonly="">
            </div>
          </div>
        </div> 
        <div class="form-group">
         <label class="col-md-4 col-lg-4 control-label">Current-Address</label>
         <div class="col-md-8 col-lg-8 inputGroupContainerr">
           <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span> <input class="form-control" name="address" placeholder="Address" type="text" value="<?php if(isset($address)){echo $address;}?>">
           </div>
         </div>
       </div> 

        <div class="form-group">
         <label class="col-md-4 col-lg-4 control-label">E-Mail</label> 
         <div class="col-md-8 col-lg-8 inputGroupContainer">
           <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span> <input class="form-control" name="email" placeholder="E-Mail Address" type="text" value="<?php echo $valuedata['email'];?>" readonly="">
           </div>
         </div>
       </div> 

       <div class="form-group">
         <label class="col-md-4 col-lg-4 control-label">Phone #</label>
         <div class="col-md-8 col-lg-8 inputGroupContainer">
           <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span> <input class="form-control" name="mobile" placeholder="017xxxxxxxx" type="text" value="0<?php echo $valuedata['mobile'];?>" readonly="">
           </div>
         </div>
       </div> 

       <div class="form-group">
         <label class="col-md-4 col-md-4 control-label">Website(Optional)</label>
         <div class="col-md-8 col-lg-8 inputGroupContainer">
           <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
              <input class="form-control" name="website" placeholder="Website or domain name" type="text"
               value="<?php if(isset($website)){echo $website;}?>">
           </div>
         </div>
       </div> 

  <?php 
    $jobquery = "SELECT * FROM tbl_post Where id = $job_name_id";
    $job_post = $db->select($jobquery);
    if ($job_post) {
    foreach($job_post as $jobdata){?>
       <div class="form-group">
         <label class="col-md-4 col-md-4 control-label">Applied Job</label>
         <div class="col-md-8 col-lg-8 inputGroupContainer">
           <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span> <input class="form-control" name="job_name" placeholder="--" type="text" value="<?php echo $jobdata['title'];?>" readonly="">
           </div>
         </div>
       </div> 

      <div class="form-group">
         <label class="col-md-4 col-md-4 control-label">Company Name</label>
         <div class="col-md-8 col-lg-8 inputGroupContainer">
           <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-eye-open"></i></span> <input class="form-control" name="company" placeholder="--" type="text" value="<?php echo $jobdata['cname'];?>" readonly="">
           </div>
         </div>
       </div>
       <div class="form-group">
         <label class="col-md-4 col-md-4 control-label">Job's Date</label>
         <div class="col-md-8 col-lg-8 inputGroupContainer">
           <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-eye-open"></i></span> <input class="form-control" name="jdate" placeholder="--" type="text" value="<?php echo $format->formateDate($jobdata['date']);?>" readonly="">
           </div>
         </div>
       </div> <br>
     <?php } }?>

<!---->
     </div>

 
     <div class="col-md-6 form-horizontal">   <!-- Right -->

        <div class="form-group">
          <label class="col-md-4 col-lg-4 control-label">User Name</label>
          <div class="col-md-8 col-lg-8 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
               <input class="form-control" name="user_name" placeholder="Last Name" type="text" value="<?php echo $valuedata['username']; ?>"
               readonly="">
            </div>
          </div>
        </div> 
          
        <div class="form-group">
         <label class="col-md-4  col-lg-4 control-label">Zip Code</label>
         <div class="col-md-8 col-lg-8 inputGroupContainer">
           <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span> <input class="form-control" name="zip" placeholder="Zip Code" type="text" value="<?php if(isset($zip)){echo $zip;} ?>">
           </div>
         </div>
       </div> 


       <div class="form-group">
         <label class="col-md-4 col-lg-4 control-label">Alternate-E-Mail</label>
         <div class="col-md-8 col-lg-8 inputGroupContainer">
           <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span> <input class="form-control" name="re_email" placeholder="E-Mail Address" type="text" value="<?php if(isset($re_email)){echo $re_email;}?>">
           </div>
         </div>
       </div> 

       <div class="form-group">
         <label class="col-md-4 col-lg-4 control-label">Alternate-Phone #</label>
         <div class="col-md-8 col-lg-8 inputGroupContainer">
           <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span> <input class="form-control" name="re_mobile" placeholder="017xxxxxxxx" type="text" value="<?php if(isset($re_mobile)){echo $re_mobile;}?>">
           </div>
         </div>
       </div> 

       <div class="form-group">
          <label class="col-md-4 col-lg-4 control-label">Gender</label>
          <div class="col-md-8 col-lg-8 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span> <input class="form-control" name="gender" placeholder="Gender" type="text" value="<?php echo $valuedata['gender'];?>" readonly="">
            </div>
          </div>
        </div> 


       <div class="form-group form-horizontal">
          <label class="col-md-4 col-lg-4 control-label">Cv Upload(Pdf)</label>
          <div class="col-md-8 col-lg-8 inputGroupContainer">
            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-cloud-upload"></i></span>
              <input type="file"  class="form-control" name="pdf_file" id="pdf_file" accept="application/pdf">
            </div>
          </div>
        </div> 
<!---->
     </div>

     <?php } } ?>

      <div class="form-group">
         <div class="col-md-12 col-lg-12 text-center">
          <button class="btn btn-primary"  name="submit_inter" type="submit">Submit Online <span class="glyphicon glyphicon-send"></span></button> 
         </div>
      </div>

      </fieldset>
    </form>
  </div>

</div>

<?php include "inc/footer.php"; ?>

 <!--
 <div class="alert alert-success" id="success_message" role="alert">
         Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.
       </div>->