<?php
	include_once 'Session.php';
	include 'Database.php';
?>
<?php
    class User{
    	private $db;
        
    	public function __construct(){
            $this->db = new Database();
    	}
   
/*
===========================
Registration part Start
===========================
*/
    	public function userRegistration($data){ //get all post's value by data parameter.
    		$name      = $data['name'];
    		$username  = $data['username'];
    		$email     = $data['email'];
            $mobile    = $data['mobile'];
    		$gender    = $data['gender'];
    		$password  = $data['password'];
    		$mailChk   = $this->emailcheck($email);

    		if($name == "" OR $username == "" OR $email == "" OR $mobile == "" OR $gender == "" OR $password == ""){
    		     $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be empty.</div>";
    		     return $msg;  
    	     }

    	     if (strlen($username) < 3){
    	        $msg = "<div class='alert alert-dengar'><strong>Error ! </strong>username is too small.</div>";
    		    return $msg;
    	     }elseif(preg_match('/[^a-z0-9_-]+/i',$username)){
    	        $msg = "<div class='alert alert-danger'><strong>Error !</strong>Username must only contain alphanumerical , dashes and underscores!</div>";
    		     return $msg;  
    	     }

    	     if (filter_var($email , FILTER_VALIDATE_EMAIL) == false) {
    	     	 $msg = "<div class='alert alert-danger'>Sorry !<strong></strong>The email is not valid.</div>";
    		     return $msg;
    	     }
    	     if ($mailChk == true) {
    	     	 $msg = "<div class='alert alert-danger'>Sorry !<strong></strong>This email alreary exist.</div>";
    		     return $msg;
    	     }
             if (strlen($mobile) < 11 || strlen($mobile) > 11){
                $msg = "<div class='alert alert-danger'>Sorry !<strong></strong>Insert the currect mobile number.</div>";
                return $msg;
             }
            
             $password  = md5($data['password']);
             $sql = "INSERT into tbl_user(name , username , email ,mobile, gender , password) values(:name , :username , :email , :mobile , :gender , :password)";
             $query = $this->db->pdo->prepare($sql); //A prepared statement is a feature used to execute the same (or similar) SQL statements repeatedly with high efficiency.
             $query->bindvalue(':name'     , $name);
             $query->bindvalue(':username' , $username);
             $query->bindvalue(':email'    , $email);
             $query->bindvalue(':mobile'    , $mobile);
             $query->bindvalue(':gender'   , $gender);
             $query->bindvalue(':password' , $password);
             $result = $query->execute();
             if ($result) {
             	$msg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong><i class='fa fa-check' aria-hidden='true'></i></strong> You have successfully registred.</div>";
    		     return $msg;
             }else{
             	 $msg = "<div class='alert alert-danger'>Sorry !<strong></strong>Something wrong to add your information.</div>";
    		     return $msg;
             }

    	}
        
/*
===========================
Registration part End
===========================
*/

    	 public function emailcheck($email){ //Check mail part for registration & login.
             $sql = "SELECT * FROM tbl_user WHERE email = :email";  // here $email is :email
             $query = $this->db->pdo->prepare($sql);
             $query->bindvalue(':email' , $email);
             $query->execute();
             if ($query->rowcount() > 0) {
             	return true;
             }else{
             	return false;
             }
    	}

/*
===========================
Registration part Start
===========================
*/
        public function getLoginUser($email , $password){   //get email & password data from login input boxs.
            $sql = "SELECT * from tbl_user where email = :email AND password = :password LIMIT 1";
            $query = $this->db->pdo->prepare($sql);
            $query->bindvalue(':email' , $email);
            $query->bindvalue(':password' , $password);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        }

        public function userLogin($data){
			 
			$email    = $data['email'];
			$password = md5($data['password']);
			$mailChk = $this->emailCheck($email);

			if ($email == "" OR $password == "") {
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong> Field must not be empty </div>";
				return $msg;
                }

            if (filter_var($email , FILTER_VALIDATE_EMAIL) == false) {
                 $msg = "<div class='alert alert-danger'>Sorry !<strong></strong>The email is not valid.</div>";
                 return $msg;
             }
             if ($mailChk == false) {
                 $msg = "<div class='alert alert-danger'>Sorry !<strong></strong>This email is not exist.Registration first.. </div>";
                 return $msg;
             }
			 
        $result = $this->getLoginUser($email,$password);//result r value gula session r modde assign korbe
        if ($result) {
        	Session::init();
        	Session::set("login", true);
        	Session::set("id", $result->id);
        	Session::set("name", $result->name);
        	Session::set("username", $result->username);
        	Session::set("loginmsg", "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong> <i class='fa fa-check-circle' aria-hidden='true'></i> 
                                      </strong> You are loggedin !</div>");
        	header("Location:index.php");

        }else{
        	$msg = "<div class='alert alert-danger'> <strong>Error ! </strong>Data not found !</div>";
        	return $msg;
          }
        }
/*
===========================
Login part End
===========================
*/

/*
===========================
Read Data Start
===========================
*/
    public function getUserData(){  //Read & show all registration data in admin page
        $sql="Select * from tbl_user where id!=1 ORDER  BY id DESC";
        $query = $this->db->pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }    
/*
===========================
Read Data End
===========================
*/
 
    public function GetUserById($id){  //Show user info on profile page's input box as a value
            $sql = "SELECT * from tbl_user where id = :id ";
            $query = $this->db->pdo->prepare($sql);
            $query->bindvalue(':id' , $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;   
    }

/*
===========================
Read Data End
===========================
*/    

/*
===========================
Update User info
===========================
*/
    public function UpdateUserData($id , $data){    
         $name      = $data['name'];
         $username  = $data['username'];
         $email     = $data['email'];

        if ($name == "" OR $username == "" OR $email == "") {
          $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Field must not be empty.. </div>";
          return $msg;
        }

         $sql = "UPDATE tbl_user SET 
                 name     = :name,
                 username = :username,
                 email    = :email
                 WHERE id = :id";

         $query = $this->db->pdo->prepare($sql);
         $query->bindValue(':name', $name);
         $query->bindValue(':username', $username);
         $query->bindValue(':email', $email);
         $query->bindValue(':id', $id);
         $result = $query->execute();
         if ($result) {
          $msg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Seccess ! </strong>User data updated successfully!</div>";
          return $msg;
         }else{
          $msg = "<div class='alert alert-danger'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Sorry ! </strong>There is a problem to update your data!</div>";
          return $msg;
         }
    }

/*
===========================
Update User Password Start
===========================
*/


    private function checkPassword($id , $old_pass){  //Check old password by id
       $password = md5($old_pass);
       $sql = "SELECT password FROM tbl_user WHERE id = :id AND password = :password"; 
       $query = $this->db->pdo->prepare($sql);
       $query->bindValue(':id', $id);
       $query->bindValue(':password', $password);
       $query->execute();
       if ($query->rowCount() > 0) {
           return true;
       }else{
           return false;
       }
    } 

    public function updatePassword($id , $data){
        $old_pass = $data['old_pass'];
        $new_pass = $data['password'];
        $chk_pass = $this->checkPassword($id , $old_pass);
        if ($old_pass == "" OR $new_pass == "") {
           $msg = "<div class='alert alert-danger'> <strong>Error! </strong>Field must not be empty.</div>";
              return $msg;
        }
        if ($chk_pass == false) {
           $msg = "<div class='alert alert-danger'> <strong>Error! </strong>Old password not exist.</div>";
           return $msg;
        }
        if (strlen($new_pass) < 6) {
           $msg = "<div class='alert alert-danger'> <strong>Error! </strong> password is too small , must need to be more than 6 character.</div>";
           return $msg;
        }
        $password = md5($new_pass);
        $sql = "UPDATE tbl_user set
                    password     = :password
                    WHERE id = :id ";
             $query = $this->db->pdo->prepare($sql);
             $query->bindValue(':password', $password);
             $query->bindValue(':id', $id);
             $result = $query->execute();
             if ($result) {
              $msg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Seccess ! </strong>User's Password  updated successfully!</div>";
              return $msg;
             }else{
              $msg = "<div class='alert alert-danger'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Sorry ! </strong>There is a problem to update your password!</div>";
              return $msg;
             }
          
    }


/*
==============----------------->
*/


public function client_req($clt){ //get all post's value by data parameter.
            $name        = $clt['cl_name'];
            $email       = $clt['cl_email'];
            $cname       = $clt['cname'];
            $jname       = $clt['jname'];
            $location    = $clt['location'];
            $job_type    = $clt['job_type'];
            $salary      = $clt['salary'];
            $edu_exp     = $clt['edu_exp'];
            $exptr       = $clt['exptr'];
            $details_cl  = $clt['details_cl'];
            $phone       = $clt['phone'];

            if($name == "" OR $email == "" OR $cname == "" OR $jname == "" OR $location == "" OR $job_type == "" OR $salary == "" OR $edu_exp == "" OR $exptr == "" OR $details_cl == "" OR $phone == ""){
                 $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be empty.</div>";
                 return $msg;  
             }

             if (strlen($name) < 3){
                $msg = "<div class='alert alert-dengar'><strong>Error ! </strong>Your name is too small.</div>";
                return $msg;
             }

             if (strlen($phone) < 11 || strlen($phone) > 11){
                $msg = "<div class='alert alert-danger'>Sorry !<strong></strong>Insert the currect mobile number.</div>";
                return $msg;
             }
            
             $sql = "INSERT into tbl_client(cl_name , email , cname ,jname, area , job_type , salary , edu_exp , exptr , details_cl , phone)
              values(:cl_name , :email , :cname ,:jname, :area , :job_type , :salary , :edu_exp , :exptr , :details_cl , :phone)";
             $query = $this->db->pdo->prepare($sql); //A prepared statement is a feature used to execute the same (or similar) SQL statements repeatedly with high efficiency.
             $query->bindvalue(':cl_name'     , $name);
             $query->bindvalue(':email' , $email);
             $query->bindvalue(':cname'    , $cname);
             $query->bindvalue(':jname'    , $jname);
             $query->bindvalue(':area'   , $location);
             $query->bindvalue(':job_type' , $job_type);
             $query->bindvalue(':salary'   , $salary);
             $query->bindvalue(':edu_exp'  , $edu_exp);
             $query->bindvalue(':exptr'    , $exptr);
             $query->bindvalue(':details_cl' , $details_cl);
             $query->bindvalue(':phone'    , $phone);
             $cl_result = $query->execute();
             if ($cl_result) {
                $msg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong><i class='fa fa-check' aria-hidden='true'></i></strong> You have successfully Submit your Request.As soon as we contact with you.</div>";
                 return $msg;
             }else{
                 $msg = "<div class='alert alert-danger'>Sorry !<strong></strong>Something wrong to add your information.</div>";
                 return $msg;
             }

        }


}
 
?>


