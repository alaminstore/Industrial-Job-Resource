<?php
  $page = 'profile';
  include 'lib/User.php';
  include 'inc/header.php';
  include_once 'lib/Database.php';
  Session::checkSession();
?>






<?php
   if(isset($_GET['id'])){   //Get the sent id.
       $userid = (int)$_GET['id'];
   }
     $user = new User();

     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
         $updateusr = $user->UpdateUserData($userid , $_POST); 
      }
    
         $sesid = Session::get("id");
         if ($userid != $sesid) {  //if id isn't math with Session / logedin id then change to order page
             header("Location:profile.php?id=$sesid");

         }

?>
<br>
<div class="showUpdate">
  <div class="container">
    <div class="row">
      <?php
        if (isset($updateusr)) {
            echo $updateusr;
        }
      ?>
    </div>
  </div>
</div>


<?php
$db = new Database();

 if(isset($_GET['notf'])){
     $n_id = $_GET['notf'];
     $db->pdo->query("Update notifications set read_n='0' where id= $n_id ");
  }
?>



<div class="profile">
    <div class="container">
        <div class="row">
            <div class=" panel panel-default">
                <div class="panel-heading">
                    <h3><i class="fa fa-leaf"></i> User Profile <span class="pull-right"> 
                      <a class="btn btn-primary" href="index.php">Back To Home</a></span></h3>
                </div>
                <div class="panal-body">
              <?php
                $data = $db->pdo->query("Select * from notifications");
                $new_data = $db->pdo->query("Select * from notifications where read_n='1' ");
                $count = $new_data->rowCount();
                ?>
                    <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                      <i class="fa fa-bell" aria-hidden="true"></i> <?php if($count>0){ echo "(".$count.")";} ?>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                    <?php
                        foreach($data as $value){ 
                         if($value['read_n'] == '1'){ ?>
                         <li class="alert-danger"><a href="?notf=<?php echo $value['id']; ?>"> <?php echo $value['title']; ?> </a></li>

                         <?php }else{ ?>
                        <li><a href="#"><?php echo $value['title']; ?></a></li>
                         <?php }
                    } ?>
                    </ul>
                </div>




                  
                    <div style="max-width:600px;margin:30px auto;">
                        <?php
                            $userdata = $user->GetUserById($userid);
                             if($userdata){?>

                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $userdata->name;?>">
                            </div>

                            <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $userdata->username;?>">
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="text" name="email" id="email" class="form-control" value="<?php echo $userdata->email;?>">
                            </div>

                             <?php
                               $checkId = Session::get("id"); //get this id from userLogin() to catch the correct loggedin user.
                               if($userid == $checkId){?>

                                <button type="submit"  id="one" name="update" class="btn btn-success">Update</button>
                                <a class="btn btn-info"  id="two" href="changepass.php?id=<?php echo $userid; ?>">Change Password</a>
                              <?php  }
                            ?>
                        </form>
                       <?php } ?>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>


     <?php
         include 'inc/footer.php ';
     ?>
