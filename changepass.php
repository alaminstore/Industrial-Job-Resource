  <?php
      include 'lib/User.php ';
      include 'inc/header.php ';
      Session::checkSession();
    ?>

    <?php
      if (isset($_GET['id'])) {
         $userid = (int)$_GET['id'];
         $sesid = Session::get("id");
         if ($userid != $sesid) {  //if id isn't math with Session / logedin id then change to order page
             header("Location: index.php");
         }
      }
      $user = new User();
          if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['updatepass'])){
             $updatepasss = $user->updatePassword($userid , $_POST);
          }
    ?>

<div class="changepassword">
  <div class="container">
    <div class="row">
     <div class=" panel panel-default">
      <div class="panel-heading">
        <h2>Change Password <span class="pull-right"> <a class="btn btn-primary" href="profile.php?id=<?php echo $userid; ?>">Back To Profile</a></span></h2>
      </div>
      <div class="panal-body">
         <div style="max-width:600px;margin:30px auto;">
  <?php
    if (isset($updatepasss)) {
        echo $updatepasss;
    }
  ?>

           <form action="" method="POST">
              <div class="form-group">
                  <label for="old_pass">Old Password</label>
                  <input type="password" name="old_pass" placeholder="Old Password" id="old_pass" class="form-control">
              </div>

              <div class="form-group">
                  <label for="password">New Password</label>
                  <input type="password" name="password" placeholder="New Password" id="new_pass" class="form-control">
              </div>
              <button type="submit"  name="updatepass" class="btn btn-success">Update Password</button> 
           </form>
         </div>
      </div>
     </div>
   </div>
 </div>
</div>

     <?php
         include 'inc/footer.php ';
     ?>
