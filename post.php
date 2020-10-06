<?php
  $page = 'post';
  include 'inc/header.php';
  include_once 'lib/User.php';
  include_once 'lib/Database.php';
  Session::checkSession();
?>

<?php
   $db = new Database();
   $user = new User();
?>



<?php

if(isset($_REQUEST['job_post_sibmit']))
{
  
      $title  = $_REQUEST['title'];
      $cat    = $_REQUEST['cat'];
      $cname  = $_REQUEST['cname'];
      $area   = $_REQUEST['area'];
      $edu    = $_REQUEST['edu'];
      $expr   = $_REQUEST['expr'];
      $vacancy= $_REQUEST['vacancy'];
      $jobtype= $_REQUEST['jobtype'];
      $details= $_REQUEST['details'];
      $status = $_REQUEST['status'];
      $salary = $_REQUEST['salary'];
      $tag    = $_REQUEST['tag'];

      
     $replace_blank = str_replace(" ","_", $_FILES["image_file"]["name"]);
     $image_file=uniqid() .date("Y-m-d-H-i-s") .$replace_blank;  //value
     move_uploaded_file($_FILES["image_file"]["tmp_name"],"assets/img/job/" .$image_file);
    

    if(empty($title) || empty($cat) || empty($cname) || empty($area) || empty($edu) || empty($expr) || empty($vacancy) || empty($jobtype) || empty($status) || empty($salary) || empty($tag) || empty($image_file) ){
      $errorMsg="<div class=''><strong>Error ! </strong>Field must not be empty.</div>";
    }

    if(!isset($errorMsg))
    {

    $postsql = "INSERT into tbl_post(cat,title,image,cname,area,edu,expr,vacancy,jobtype,details,status,salary,tag)
        values(:cat,:title,:image,:cname,:area,:edu,:expr,:vacancy,:jobtype,:details,:status,:salary,:tag)";
             $query = $db->pdo->prepare($postsql); //A prepared statement is a feature used to execute the same (or similar) SQL statements repeatedly with high efficiency.
             $query->bindvalue(':cat'     , $cat);
             $query->bindvalue(':title' , $title);
             $query->bindvalue(':image'    , $image_file);
             $query->bindvalue(':cname'    , $cname);
             $query->bindvalue(':area'    , $area);
             $query->bindvalue(':edu'   , $edu);
             $query->bindvalue(':expr'   , $expr);
             $query->bindvalue(':vacancy' , $vacancy);
             $query->bindvalue(':jobtype' , $jobtype);
             $query->bindvalue(':details' , $details);
             $query->bindvalue(':details' , $details);
             $query->bindvalue(':status' , $status);
             $query->bindvalue(':salary' , $salary);
             $query->bindvalue(':tag' , $tag);

             $result = $query->execute();
    
      if($result)
      {
        $insertMsg="<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong><i class='fa fa-check' aria-hidden='true'></i></strong>Successfully add job post .</div>"; //execute query success message
      }
  
  } 
}

?>

<?php  //only for admin
$sesid = Session::get("id");
 if ($sesid!=1) {
    header("location:404.php");
 }else{?>

<div class="post_page"> 

<div class="job_post">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
				<h3 class="text-center">==Job post page==</h3><hr>
			<div class="form_job">
              <div class="wrapper">
<?php
    if(isset($errorMsg))
    {
      ?>
            <div class='alert alert-danger'>
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



        	<form action="post.php" method="post" enctype="multipart/form-data">
	         <input type="text" class="fields form-control" id="title" name="title" placeholder="Title Here">

	         <select name="cat" class="fields form-control">
			    <option value="volvo">-Select Category-</option>
			    <?php
                   $query = "SELECT * FROM tbl_category";
                   $post = $db->select($query);
                   if ($post) {
                    foreach($post as $valuedata){
               ?>
			    <option value="<?php echo $valuedata['id']; ?>"><?php echo $valuedata['cat_name']; ?></option>
			<?php } }else{ echo "No Category created.";} ?>
			</select>

	         <input type="text" class="fields form-control"  name="cname" placeholder="Company Name">
	         <input type="text" class="fields form-control" id name="area" placeholder="Area of this Company">
	         <input type="text" class="fields form-control"  name="edu" placeholder="Interviwee Education">
	         <input type="text" class="fields form-control"  name="expr" placeholder="Have any experiance?">
	         <input type="text" class="fields form-control"  name="vacancy" placeholder="Job vacancy">
	         <input type="text" class="fields form-control"  name="jobtype" placeholder="Job type(Main theme)">
	         <input type="text" class="fields form-control"  name="status" placeholder="Status(full/part time)">
	         <input type="text" class="fields form-control"  name="salary" placeholder="Salary">
	         <input type="text" class="fields form-control"  name="tag" placeholder="Tag">
	         <input type="file" class="fields form-control"  name="image_file" accept="image/png, image/jpg , image/jpeg" >
	         <textarea  id="" name="details" class="fields form-control" cols="30" rows="10"></textarea>
             <input type="submit" id="submit" name="job_post_sibmit" class="sub_btn btn btn-success" value="Submit" onClick="return check()">
          </form>
          </div>
			</div>
		</div>
		</div>
	</div>
</div>


<?php

if(isset($_REQUEST['cat_submit']))
{
  
    $cat_add  = $_REQUEST['cat_add'];

    if(empty($cat_add)){
      $error_Cat_Msg="<div><strong>Error ! </strong>Fillup with category name</div>";
    }

    if(!isset($error_Cat_Msg))
    {

    $catsql = "INSERT into tbl_category(cat_name)values(:cat_name)";
             $cat_query = $db->pdo->prepare($catsql); 
             $cat_query->bindvalue(':cat_name' , $cat_add);
             $cat_result = $cat_query->execute();
    
      if($cat_result)
      {
        $catMsg="<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong><i class='fa fa-check' aria-hidden='true'></i></strong>Successfully categor added.</div>"; //execute query success message
      }
  
  } 
}

?>

<div class="category_created">
	<div class="container">
		<div class="row">
			<div class="category_add">
				<div class="wrapper">

<?php
    if(isset($error_Cat_Msg))
    {
      ?>
            <div class='alert alert-danger'>
              <strong><?php echo $error_Cat_Msg; ?></strong>
            </div>
            <?php
    }
    if(isset($catMsg)){
    ?>
      <div class="">
        <strong> <?php echo $catMsg; ?></strong>
      </div>
        <?php
    }
?>  

				<form action="post.php" method="post">
					<input type="text" class="fields form-control" name="cat_add">
					<input type="submit" name="cat_submit" value="Add Category" class=" sub_btn btn btn-success">
				</form>
			 </div>
			</div>
		</div>
	</div>
</div>
</div>


		<?php } ?>

		<?php include "inc/footer.php"; ?>
