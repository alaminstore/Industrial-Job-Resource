<?php
include "inc/header.php";   
include "lib/Database.php";   
?>

<?php
  $db = new Database();
  $format = new Format();
?>

<?php
   if (!isset($_GET['id']) || $_GET['id'] == NULL) {
       header("location:404.php");
   }else{
      $id = $_GET['id'];
   }
?>

<div class="top_step bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="address">

            <?php
               $query = "Select * from tbl_post Where id = $id"; //here $id = get id, which is sent from index page for details
               $post = $db->select($query);
                   if ($post) {
                    foreach($post as $valuedata){
            ?>


                    <h3><?php echo $valuedata['title']; ?></h3>
                    <div class="details panel panel-default">

                      <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $format->formateDate($valuedata['date']); ?></p>
                      <p><img class="pull-right" src="assets/img/job/<?php echo $valuedata['image']; ?>" alt="Company-logo"></p>
                      <h5><i class="fa fa-bandcamp" aria-hidden="true"></i> <?php echo $valuedata['cname']; ?></h5>
                      <h5><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $valuedata['area']; ?></h5>

                        <div class="dets panel-default">
                            <h4>Vacancy</h4>
                            <p> <?php echo $valuedata['vacancy']; ?> </p>
                            <h4>Job Type</h4>
                            <p> <?php echo $valuedata['jobtype']; ?> </p>
                            <h4>Job Responsibilities</h4>
                            <p class="para"><?php echo $valuedata['details']; ?></p> 
                            <h4>Employment Status</h4>
                            <p><?php echo $valuedata['status'];?></p>
                            <h4>Experience Requirements</h4>
                            <p><?php echo $valuedata['expr']; ?></p>
                            <h4>Salary</h4>
                             <p><?php echo $valuedata['salary']; ?></p>                            
                        </div>
                      
                       <div class="apply text-center">
                        <h4 style="color:red;">*Photograph must be enclosed with the resume*</h4> <hr>
                          <a class="btn btn-success" href="apply.php?userId=<?php echo $sesid;?> & jnameId=<?php echo $valuedata['id'];?>"> Apply Online </a>
                       </div>                       
 
                    </div> 

                    <?php } ?> <!--foreach loop end-->
                    
                </div>
            </div>
            
         <?php include "job/sidebar2.php"; ?>
            
        </div>
    </div>
</div>

 <!--Related post-->

<div class="job_short bg">
    <div class="container">
        <div class="row">
            <div class="all_job">
               <h2 class="text-center">Related Post</h2>
           <?php
               $catid = $valuedata['cat'];
               $rquery = "Select * from tbl_post Where cat = '$catid' order by rand() limit 6"; //here $id -> get id, which is sent from job page for details
               $catpost = $db->select($rquery);
                 if ($catpost) {
                  foreach($catpost as $cat_valuedata){

            ?>
                
                <div class="col-md-4 col-lg-4">
                    <div class="job-featured">
                        <div class="icon">
                            <img src="assets/img/job/<?php echo $cat_valuedata['image']; ?>" alt="logo">
                        </div>
                        <div class="content">
                            <h3><a href="job_details.php?id=<?php echo $cat_valuedata['id']; ?>"> <?php echo $cat_valuedata['title'];?></a></h3>
                            <p class="brand"><?php echo $cat_valuedata['cname'];?></p>
                            <div class="tags">
                                <span><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $cat_valuedata['area'];?></span> &nbsp;
                                <span><i class="fa fa-briefcase" aria-hidden="true"></i> <?php echo $cat_valuedata['expr'];?></span>
                            </div>
                            <span class="full-time"><?php echo $cat_valuedata['status'];?></span>
                        </div>
                    </div>
                </div>
              
               <?php } } else{ echo "No related post available."; } ?>

            </div>
        </div>
    </div>
</div>

<?php  } else{ header("location:404.php"); } ?>

<?php include "inc/footer.php"; ?>