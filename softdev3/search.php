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
   if (!isset($_GET['search']) || $_GET['search'] == NULL AND !isset($_GET['search2']) || $_GET['search2'] == NULL) {
       /*header("location:404.php");*/
       return false;
   }
   elseif (isset($_GET['search']) AND !isset($_GET['search2']) || $_GET['search2'] == NULL) {
     $search = $_GET['search'];
     $query = "SELECT * FROM tbl_post where title LIKE '%$search%'";
   }
  else if (isset($_GET['search2']) AND !isset($_GET['search']) || $_GET['search'] == NULL) {
         return false;
   }
   else{ // if both value are in input box
      $search = $_GET['search'];
      $search2 = $_GET['search2'];
      $query = "SELECT * FROM tbl_post where title LIKE '%$search%' AND area LIKE '%$search2%' ";
   }
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
                            <input type="submit" class="submit_size" name="submit" value="search">                   
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
                      <h4>Sorry not found !</h4>
              <?php } ?>
        </div>
        <?php include "job/sidebar1.php"; ?>
    </div>
</div>


<?php include "inc/footer.php"; ?>

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
