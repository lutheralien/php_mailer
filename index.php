<?php

error_reporting(E_ERROR | E_PARSE);
require 'includes/PHPMailer.php';    
require 'includes/SMTP.php';
require 'includes/Exception.php';


// use PHPMailer\PHPMailer\PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function randomString($n) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';
  for ($i = 0; $i < $n; $i++) {
      $index = rand(0, strlen($characters) -1 );
      $str .=$characters[$index];
  }
  return $str;
}

$errors =  [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


$name = $_POST['name'];
// echo $name.'<br>';

$car_number = $_POST['car_number'];
// echo $car_number.'<br>';

$car_make = $_POST['car_make'];
// echo $car_make.'<br>';

$location = $_POST['location'];
// echo $location.'<br>';


$momo_number = $_POST['momo_number'];
// echo $momo_number.'<br>';
if ($momo_number == NULL) {
  $momo_number = 'CASH';
}

$verification_type = $_POST['verification_type'];
// echo $verification_type.'<br>';

echo '<pre>';
// var_dump($_FILES);
if ($_FILES['user_image']['name'] == NULL ){
  $errors[] = 'Upload All Images';
}

$image1 = $_FILES['user_image'];
$imagePath1 = './'.'images/'.randomString(8).'/'.$image1['name'];
mkdir(dirname($imagePath1));
// echo $imagePath1;
move_uploaded_file($image1['tmp_name'], $imagePath1);
echo '</pre>';

echo '<pre>';
$image2 = $_FILES['user_image_2'];
$imagePath2 = './'.'images/'.randomString(8).'/'.$image2['name'];
mkdir(dirname($imagePath2));
// echo $imagePath2;
move_uploaded_file($image2['tmp_name'], $imagePath2);
 echo '</pre>';

 echo '<pr>';
$image3 = $_FILES['user_image_3'];
$imagePath3 = './'.'images/'.randomString(8).'/'.$image3['name'];
mkdir(dirname($imagePath3));
// echo $imagePath3;
move_uploaded_file($image3['tmp_name'], $imagePath3);

if (!$name || !$car_number || !$car_make || !$location || !$imagePath1 || !$imagePath2 || !$imagePath3 || !$verification_type) {
  $errors[] = 'Fill All Required Forms!';

}
if (empty($errors)) {
  $mail = new PHPMailer(true);

  //Enable SMTP debugging.
  // $mail->SMTPDebug = 3;                               
  //Set PHPMailer to use SMTP.
  $mail->isSMTP();            
  //Set SMTP host name                          
  $mail->Host = "smtp.hostinger.com";
  //Set this to true if SMTP host requires authentication to send email
  $mail->SMTPAuth = true;                          
  //Provide username and password     
  $mail->Username = "noreply@digitrustapps.com";                 
  $mail->Password = 'iA$tS;8^AnT$#1';                           
  //If SMTP requires SSL encryption then set it
  $mail->SMTPSecure = "ssl";                           
  //Set TCP port to connect to
  $mail->Port = 465;                                   
  
  $mail->From = "noreply@digitrustapps.com";
  $mail->FromName = "ALIENX";
  //Add Email Addresses Here!
  $mail->addAddress("", "NoReply");
  $mail->addAddress("", "NoReply");
  
  $mail->isHTML(true);
  
  $mail->Subject = "Subject Text";
  $mail->Body = "<p><b style=`color:blue;`>Name: $name</b></p></br><p><b>Car_make: $car_make</b></p></br><p><b>Car_number: $car_number</b></p></br><p><b>Car_location: $location</b></p></br><p><b>Verification_Type: $verification_type</b></p></br><p><b>Mobile Money Number: $momo_number</b></p>";
  
  
  $mail->AltBody = "This is the plain text version of the email content";
  $mail->addAttachment($imagePath1, "frontPhoto.jpg");        
  $mail->addAttachment($imagePath2, "backPhoto.jpg");        
  $mail->addAttachment($imagePath3, "OdometerPhoto.jpg");        
  
  try {
      $mail->send();
      
       header("Location: ./thank_you.html", TRUE, 301);
      
       
 

      
  
  } catch (Exception $e) {
      echo "Mailer Error: " . $mail->ErrorInfo;
  }
  
}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="./public/js/jquery-3.6.1.min.js"></script>
    <link
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="./public/css/style.css">
    <style>
        /* CSS comes here */

        body {
          background-color: #2a508b;
        }
        #video {
            border: 1px solid black;
            width: 320px;
            height: 240px;
        }
    
        #photo {
            border: 1px solid black;
            width: 320px;
            height: 240px;
        }
    
        #canvas {
            display: none;
        }
    
        .camera {
            width: 340px;
            display: inline-block;
        }
    
        .output {
            width: 340px;
            display: inline-block;
        }
    
        #startbutton {
            display: block;
            position: relative;
            margin-left: auto;
            margin-right: auto;
            bottom: 36px;
            padding: 5px;
            background-color: #23f134;
            border: 1px solid rgba(255, 255, 255, 0.7);
            font-size: 14px;
            color: rgba(255, 255, 255, 1.0);
            cursor: pointer;
        }
    
        .contentarea {
            font-size: 16px;
            font-family: Arial;
            text-align: center;
        }
        
        p>audio,
        p>video,
        p>img{
            max-width:30%;
        }
   
        .myDiv{
            display:none;
            padding:10px;
            margin-top:20px;
        }  
        #showOne{
            border:1px solid red;
        }
        #loading {
  /* (A1) COVER FULL PAGE */
  position: fixed;
  top: 0; left: 0; z-index: 999;
  width: 100vw; height: 100vh;
 
  /* (A2) SPINNER IMAGE */
  background-color: black;
  background-image: url("w.gif");
  background-position: center;
  background-repeat: no-repeat;
}
* {
  margin: 0;
  padding: 0;
}

.loader {
  display: none;
  top: 50%;
  left: 50%;
  position: absolute;
  transform: translate(-50%, -50%);
}

.loading {
  border: 2px solid rgb(0, 0, 0);
  width: 60px;
  height: 60px;
  border-radius: 50%;
  border-top-color: #add617;
  border-left-color: #20f3b0;
  animation: spin 1s infinite ease-in;
  
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}
.button {
        background-color: #008cba; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
      }
      .button:disabled {
        opacity: 0.5;
      }
      .hide {
        display: none;
      }

        </style>
</head>
<body>
<!-- <div id="loader"></div> -->
<div class="se-pre-con" id="loader"></div>

<?php if (!empty($errors)): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php foreach ($errors as $error): ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

</div>
    <form method="post" class="form" id="myform" enctype="multipart/form-data">
      
    
        <div class="progressbar">
          <div class="progress" id="progress"></div>
          
          <div
            class="progress-step progress-step-active"
            data-title="Account"
          ></div>
          
          <div class="progress-step" data-title="Verify"></div>
          <!-- <div class="progress-step" data-title="Complete"></div> -->
        </div>
        <div class="step-forms step-forms-active">
          <div class="group-inputs">
            <label for="username">name</label>
            <input type="text" name="name"  id="username" />
          </div>
          <div class="group-inputs">
            <label for="position">Car Number</label>
            <input type="text" name="car_number" id="position"  />
          </div>
          <div class="group-inputs">
            <label for="email">Car Make & Model</label>
            <input type="text" name="car_make" id="email"  />
          </div>
          <div class="group-inputs">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" />
          </div>
          <select id="myselection" class="form-control">
        <option>Transaction Type</option>
        <option value="One">CASH</option>
        <option value="Two">MOBILE MONEY</option>
      
     </select>
     <br>
     <div id="showTwo" class="myDiv">
      <label for="num">ENTER NUMBER</label>
        <input type="number" id="num" name="momo_number">
     </div>
     <br>
     <select name="verification_type" class="form-control" id='verify'>
        <option>VERIFICATION TYPE</option>
        <option value="Servicing/Maintenance">Servicing/Maintenance </option>
        <option value="Branding">Branding</option>
        
     </select>
     <br>
          <div class="">
            <a href="#" class="btn btn-next width-50 ml-auto">Next</a>
            <!-- <button type="submit">Submit</button> -->
          </div>
        </div>
        <div class="step-forms">

          <div class="group-inputs">
           
          <h4>1)Verify That the two Doors are shown In The Photo Taken</h4>
          <h4>2)Slide Phone For Wider Space</h4>

<br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop" id="phone">
                Capture Back View
              </button> 

              <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Back View</h5>
                      <p>Stand At The Back Right Corner To Capture Side 2</p>

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      

                      <main>
              <label for="capture" style="color: #23f134; text-align: center;"> <h5>Capture Image</h3></label>
            
              <input type="file" id="capture" accept="image/*" capture name="user_image" class="inputfile" hidden/>     
             
                            <!-- <label for="capture">Capture Media</label> -->
                            
                                                                              
                        
                        <p><img src="" id="img" alt=""/></p>
                        
                    </main>
            
                    </div>
                  
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <!-- <button type="submit" class="btn btn-primary" id="submit">Submit</button> -->
                    
                    </div>
                  </div>
                </div>
              </div>
          
          </div>
          <div class="group-inputs">
            <!-- <label for="phone">Front View</label> -->
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#staticBackdrop2" id="phone">
                Capture Front View
              </button>
              <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">input
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Front View</h5>
                      <p>Stand At The Front Left Corner To Capture Side 1</p>

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <main>
                        <label for="capture2" style="color: #23f134; text-align: center;"> <h5>Capture Image</h3></label>
                                   
                                     <input type="file" id="capture2" accept="image/*" capture name="user_image_2" class="inputfile" hidden />     
                                    
                                                   <!-- <label for="capture">Capture Media</label> -->
                                                   
                                                                                                     
                                               
                                               <p><img src="" id="img2" alt=""/></p>
                                               
                                           </main>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <!-- <button type="button" class="btn btn-primary">submit</button> -->
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="group-inputs">
            <!-- <label for="phone">Odometer View</label> -->
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#staticBackdrop3" id="phone">
                Capture Odometer
              </button>
              <div class="modal fade" id="staticBackdrop3" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Odometer view</h5>
                      <p>Make Sure To Capture ODO With Visible or Clear Numbers</p>
                      
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <main>
                        <label for="capture3" style="color: #23f134; text-align: center;"> <h5>Capture Image</h3></label>
                                   
                                     <input type="file" id="capture3" accept="image/*" capture name="user_image_3" class="inputfile" hidden/>     
                                    
                                                   <!-- <label for="capture">Capture Media</label> -->
                                                   
                                                                                                     
                                               
                                               <p><img src="" id="img3" alt=""/></p>
                                               
                                           </main>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="btns-group">
            <a href="#" class="btn btn-prev">Previous</a>
            <button class="button" type="submit" onclick="spinner()">Submit</button>
            
            <div class="loader">
  <div class="loading">
  </div>
</div>


          </div>
        </div>
       


          <div class="group-inputs">
            
        
        </div>
        <p>Designed By <a href="https://lutheralien.github.io/webio/">Alienx &#128125;</a> </p>

      </form>

      
</body>
<div id="loading"></div>
    
<script>
$(document).ready(function(){
    $('#myselection').on('change', function(){
    	var demovalue = $(this).val(); 
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });
});
</script>
<script>
  window.onload = () => {
    // JUST DEFINE EMPTY ARRAY [] IF NO CSS/JS TO LOAD
    loader(
      ["my.css"],
      ["my.js", "https://cdnjs.cloudflare.com/ajax/libs/WHATEVER/"]
    );
  };
  </script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script type="text/javascript">
    function spinner() {
        document.getElementsByClassName("loader")[0].style.display = "block";
    }
</script>
   <script src="./public/js/1c-loader.js"></script>
   <script src="./public/js/loaderThankYou.js"></script>
<script src="./public/js/script.js"></script>
<script src="./public/js/video.js"></script>
<script src="./public/js/video2.js"></script>
<script src="./public/js/video3.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</html>
  