<?php
 $page = 'admin';
 include 'inc/header.php ';
 include 'lib/User.php';
 include_once 'lib/Database.php';
 Session::checkSession();
?>

 <?php
 $sesid = Session::get("id");
 if ($sesid!=1) {
    header("location:404.php");
 }else{?>
  <div class="admin_panel">
      <div class="container">
          <div class="row">
           <br>


          <?php
             $loginmsg = Session::get("loginmsg");
             if(isset($loginmsg)){
                 echo $loginmsg;
             }   
             Session::set("loginmsg" , NULL);   //After one refresh auto hide..
         ?>
         
             <div class="panel panel-default ">
                <div class="panel-heading">
                    <h3 class="admin_header">
                        <span><i class="fa fa-list"></i> User List</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<button type="button" class="btn btn-default glyphicon glyphicon-share-alt" data-toggle="modal" data-target="#exampleModalCenter">
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title text-center" id="exampleModalLongTitle">Notify All Users</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="notification">
            <div class="container">
   
             <div class="row">
 <?php
 $db = new Database();
if(isset($_POST['submit_notify'])){
    $title = $_POST['title'];
    $q1 = "insert into posts(title) values('$title')";
    $q2 = "insert into notifications(title,read_n) values('$title','1')";
    $db->pdo->query($q1);
    $db->pdo->query($q2);
}
?>

                    <form action="" method="POST">
                        <textarea style="max-width:568px;" class="form-control" name="title" cols="30" rows="10"></textarea><br>
                        <input type="submit" class="btn btn-primary" name="submit_notify">
                    </form>

                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


                        <span class="pull-right">Welcome !<strong>

                  <?php
                        $username = Session::get("username");
                         if(isset($username)){
                             echo $username;
                         }                                           
                    ?> </strong></span></h3>
                    <!-- Button trigger modal -->
                </div>







                <div class="panal-body">
                    <table class="table table-striped">
                    <tr>
                        <th width="10%">Serial</th>
                        <th width="20%">Name</th>
                        <th width="15%">Username</th>
                        <th width="30%">Email Address</th>
                        <th width="15%">Phone Number</th>
                        <th width="20%">Gender</th>
                                                
                    </tr>
                    <?php
                        $user = new User();
                        $userdata = $user->getUserData();
                            if($userdata){
                            $i=0;
                            foreach($userdata as $valuedata){ $i++; ?>
                            
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $valuedata['name'];?></td>
                            <td><?php echo $valuedata['username'];?></td>
                            <td><?php echo $valuedata['email'];?></td>
                            <td><?php echo "0".$valuedata['mobile'];?></td>
                            <td><?php echo $valuedata['gender'];?></td>
<!--                             <td>
   <a class="btn btn-primary" href="profile.php?id=<?php echo $valuedata['id'];?>">view</a> send the user id to profile.php page
</td> -->
                        </tr>              
                                <?php }
                                   }else{
                                echo "Data not found!";
                                 }
                    ?>
                    
                    </table>
                </div>
             </div>
          </div>
      </div>
  </div> 

<?php }
 ?>


 <?php
     include 'inc/footer.php ';
 ?>