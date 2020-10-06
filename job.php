<?php
	$page = 'list';
	include 'inc/header.php';
    include 'lib/Database.php';
	Session::checkSession();
?>


<div class="job_first">
    <div class="container">
        <div class="row">
            <div class="search_job">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <h2 class="text-center"><i class="fa fa-search" aria-hidden="true"></i> From Industrial Job Resource</h2>
                    <div class="search_form text-center">
                        <form action="search.php" method="get">
                            <input type="text"  class="input_size" name="search" placeholder="Job Name Here" required />  
                            <input type="text" class="input_size" name="search2" placeholder="Area Name Here" />
                            <input type="submit" class="submit_size" name="submit" value="Search">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
 $db = new Database();
 $format = new Format();
?>

<!--
====================================
Post jobs
====================================
-->
<div class="post_jobs">
    <div class="container">
        <div class="raw">
            <div class="col-lg-9 col-md-9 col-xs-12 col-sm-12 panel panel-default">
               

<!-- pagination -->
 
    <?php
       $per_page = 4;
       if (isset($_GET['page'])) {
           $page = $_GET['page'];
       }else{
         $page=1;
       }
       $start_form = ($page-1) * $per_page;
    ?>

    <!-- pagination -->
               <?php
                   $query = "SELECT * FROM tbl_post limit $start_form, $per_page";
                   $post = $db->select($query);
                   if ($post) {
                    foreach($post as $valuedata){
               ?>

                <div class="single_job panel panel-default">

                    <h3><a href="job_details.php?id=<?php echo $valuedata['id']; ?>"><?php echo $valuedata['title']; ?></a></h3>
                    <p><img class="pull-right" src="assets/img/job/<?php echo $valuedata['image']; ?>" alt=""></p>
                    <p class=""><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $format->formateDate($valuedata['date']); ?></p>
                    <h5><i class="fa fa-bandcamp" aria-hidden="true"></i> <?php echo $valuedata['cname']; ?></h5>
                    <h5><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $format->textshorten($valuedata['area'],10); ?></h5>
                    <h5><i class="fa fa-graduation-cap" aria-hidden="true"></i> <?php echo $valuedata['edu']; ?></h5>
                    <p> <i class="fa fa-suitcase" aria-hidden="true"></i> <?php echo $valuedata['expr']; ?></p>  

                </div>
                
                <?php } ?>   <!--foreach loop end-->

                <!--Pagination Start-->
               <?php
                  $query = "Select * from tbl_post";
                  $result = $db->select($query);
                  $result->execute();
                  $count = $result->rowCount(); //total rows = total post
                  $total_pages = ceil($count/$per_page); //ceil() is use to avoid fraction

                  echo "<span class='pagination'><a href='job.php?page=1'>".'first'."</a>";
                  for ($i=2; $i <= $total_pages ; $i++) { 
                       echo "<a href='job.php?page=".$i."'>".$i."</a>";
                    }
                  echo "<a href='job.php?page=$total_pages'>".'last'."</a></span>"; ?>

                <!--Pagination End-->

                <?php  } else{ header("location:404.php"); } ?>

            </div>
            
            <?php include "job/sidebar1.php"; ?>
            
            
        </div>
    </div>
</div>


<?php include "inc/footer.php"; ?>