<?php
$page = 'contact';
include 'inc/header.php';
?>
<?php

if(isset($_POST['contact'])){
    
    if(empty($_POST['full'])){
        $nameerror =  'Full name required';
    }
    else{
        $full_name = $_POST['full'];
    }
    
    if(empty($_POST['email'])){
        $emailerror ='Email address required';
    }
    else{
        $email_address = $_POST['email'];
    }

    if(empty($_POST['phone'])){
        $phoneerror = 'Phone number required';
    }
    else{
        $phone = $_POST['phone'];
    }
    
    $message = $_POST['message'];
    
    
     if(!empty($full_name) && !empty($email_address) && !empty($phone)){
    
     $msg = " 
     
       <table>
          <tr>
            <td>Full Name :</td>
            <td>".$full_name."</td> 
          </tr>
          <tr>
            <td>Email Address :</td>
            <td>".$email_address."</td> 
          </tr>

           <tr>
            <td>Phone Number :</td>
            <td>".$phone."</td>
          </tr>
        </table>

        <table>
           <tr>

            <td>
            Message :<br>
            </td>
            <td>".$message."</td>
          </tr>

        </table>

           ";

   // $msg = '<strong>' . $full_name . '</strong>' . $email_address . $phone . $message;

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // More headers
    $headers .= 'From: <'. $email_address .'>' . "\r\n";
    
    $mail = mail('alaminphone5@gmail.com','From My Site', $msg , $headers);
    if(isset($mail)){
        $sent = 'Message has been sent successfully';
    } 
 }

}

?>


<div class="contact_page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <h3>Contact Information</h3>
                <hr>
                <div class="snumber">
                    <h3>Hotline</h3>
                    <h4><i class="fa fa-phone" aria-hidden="true"></i> Dial: <a href="tel:18954"></i> 18954</a> from any number.</h4>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact_main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 bg">
                <div class="col-md-6">
                    <div class="message_body">
                        
                        <div style="max-width:600px;margin:30px auto;">

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">FullName :</label>
                                    <input value="<?php if(isset($full_name)){echo $full_name;}?>" type="text" class="form-control" name="full" placeholder="Your Name..">
                                    <h5 class=text-danger>
                                        <?php
                          if(isset($nameerror)){
                              echo $nameerror;
                          }
                        ?>
                                    </h5>
                                </div>
                                <div class="form-group">
                                    <label for="">Email :</label>
                                    <input value="<?php if(isset($email_address)){echo $email_address;}?>" type="email" class="form-control" name="email" Placeholder="*******@gmail.com">
                                    <h5 class=text-danger>
                                        <?php
                          if(isset($emailerror)){
                              echo $emailerror;
                          }
                        ?>
                                    </h5>
                                </div>
                                <div class="form-group">
                                    <label for="">PhoneNumber :</label>
                                    <input value="<?php if(isset($phone)){echo $phone;}?>" type="tel" class="form-control" name="phone" Placeholder="017************">
                                    <h5 class=text-danger>
                                        <?php
                          if(isset($phoneerror)){
                              echo $phoneerror;
                          }
                        ?>
                                    </h5>
                                </div>
                                <div class="form-group">
                                    <label for="">Message :</label>
                                    <textarea class="form-control" name="message" id="ctext_area" cols="30" rows="10"> <?php if(isset($message)){echo $message;}?></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" name="contact"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Email Send</button>
                                </div>

                                <h2 class="text-success">
                                    <?php
                       if(isset($sent)){
                        echo $sent;
                        }    
                    ?>
                                </h2>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                  <div class="other_contact">
                    <h3 class="text-center">==Area Wise Contact Number==</h3><br><hr>
                    <p>IP phone:  &nbsp;  <strong>+8801768523652</strong> &nbsp; from any number. </p>
                    <p>T&amp;T Phone :    55012152, 55012154, 55012120 & 55012122, 55012153.</p><hr>
                    <table class="table table-bordered">
                        <thead>
    
                         <h5 style="background: #e9e6c9; padding: 7px;border: 2px solid #e6e2bd;;border-radius:2px; margin: 0;"><i class="fa fa-chevron-right" aria-hidden="true"></i> For any Job's requirement query (for the clients outside Dhaka).</h5>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sylhet: </td>
                                <td><span>+880 1847187946</span></td>
                                

                            </tr>
                            <tr>
                                <td>Chittagong:</td>
                                <td><span> +880 1847187946 </span></td>
                             

                            </tr>
                            <tr>
                                <td>Bagerhat:</td>
                                <td><span>+880 1847187946 </span></td>
                               

                            </tr>
                            <tr>
                                <td>Netrokona:</td>
                                <td><span> +880 1847187946 </span></td>
                               

                            </tr>
                            <tr>
                                <td>Bagerhat:</td>
                                <td><span> +880 1847187946 </span></td>
                                

                            </tr>
                        </tbody>
                    </table>
                    
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "inc/footer.php"; ?>