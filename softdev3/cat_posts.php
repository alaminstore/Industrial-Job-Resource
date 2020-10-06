<?php
	$page = 'list';
	include 'inc/header.php';
  include 'lib/Database.php';
	Session::checkSession();
?>
<?php
 $db = new Database();
 $format = new Format();
?>

<?php
   if (!isset($_GET['category']) || $_GET['category'] == NULL) {
       header("location:404.php");
   }else{
      $category = $_GET['category'];
   }
?>

<div class="cat_page">
    <div class="container">
        <div class="row">
            <div class="search_job">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <h2 class="text-center"><i class="fa fa-leaf" aria-hidden="true"></i> Category Post Here....</h2>
                    <div class="search_form text-center">
                        <form action="search.php" method="get">
                            <input type="text"  class="input_size" name="search" placeholder="Job Name Here" required="required" />
                            <input type="text" class="input_size" name="search2" placeholder="Job Name Here" />
                            <input type="submit" class="submit_size" name="submit" value="Search">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="post_jobs">
    <div class="container">
        <div class="raw">
            <div class="col-lg-9 col-md-9 col-xs-12 col-sm-12 panel panel-default">
              <?php
                   $query = "SELECT * FROM tbl_post where cat = $category ";
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
             <?php } } else{?> 
                      <h4>Sorry no category post created.</h4>
                      <a href="job.php"><button class="btn btn-primary"><i class="fa fa-arrow-right"></i> Back to Job Page</button></a>
                      <br><br>
              <?php } ?>
        </div>
        <?php include "job/sidebar1.php"; ?>
    </div>
</div>


<?php include "inc/footer.php"; ?>

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
