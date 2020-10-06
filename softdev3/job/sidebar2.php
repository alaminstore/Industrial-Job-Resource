<!-- Lastest post page -->

<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <h3>Lastest Posts</h3>
    <div class="lastest_post">

        <?php
           $query = "SELECT * FROM tbl_post ORDER BY date DESC limit 6";
           $lastest_post = $db->select($query);
           if ($lastest_post) {
            foreach($lastest_post as $lastest_posts_data){
        ?>
        <div class="lastest ">
            <h4><a href="job_details.php?id=<?php echo $lastest_posts_data['id']; ?>"> <i class="fa fa-asterisk" aria-hidden="true"></i> 
             <?php echo $lastest_posts_data['title']; ?> </a></h4>
            <p class="pull-right"><i class="fa fa-clock-o" aria-hidden="true"></i> 
                <?php echo $format->formateDate($lastest_posts_data['date']); ?> </p>
            <p><img class="img-responsive" src="assets/img/job/<?php echo $lastest_posts_data['image']; ?>" alt=""></p>
        </div>
    <?php  } }else{ header("location:404.php"); } ?>
    <div class="see_all text-center">
      <a class="btn btn-info" href="job.php">=See All Jobs=</a>
    </div>

    </div>
</div>