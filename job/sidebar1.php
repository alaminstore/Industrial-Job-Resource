<!-- Category page -->
<?php
  include_once "lib/Database.php";
?>
<?php
  $db = new Database();
?>

<div class="job_categoty">
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 panel panel-default ">
        <h4 class="text-center">Jobs Category</h4><hr>
        <div class="cat">
            <ul>
                <?php
                   $cquery = "SELECT *  FROM tbl_category"; //here $id = get id, which is sent from index page for details
                   $catpost = $db->select($cquery);
                   if ($catpost) {
                    foreach($catpost as $c_data){
                ?>
                <li class="gap">
                    <a href="cat_posts.php?category=<?php echo $c_data['id'];?>">
                      <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp; <?php echo $c_data['cat_name'];?>
                    </a>
                </li>

                <?php } } else{ ?>
                 <li class="gap"> <i class="fa fa-times" style="color:#d10808;" aria-hidden="true"></i> &nbsp; No category Created.</li>
               <?php } ?>
            </ul>
        </div>
    </div>
</div>