<!-- new index-->

<?php

$message ='';
$error ='';
if(isset($_POST["submit"]))
{
 if(empty($_POST["uname"]))
 {
    $error = "<lable class ='text-danger'> Enter username</lable>";
 }
 else
 {
    if(file_exists('data.json'))
    {
        $current=file_get_contents('data.json');
        $array_data=json_decode($current,true);
        $extra=array('uname'=> $_POST['uname'],'uemail'=>$_POST['uemail'],'passwor'=>$_POST['pass'],'number'=>$_POST['num'],'pin'=>rand(0,9).rand(0,9).rand(0,9).rand(0,9));
        $array_data[]=$extra;
        $final=json_encode($array_data);
        if(file_put_contents('data.json',$final))
        {
            $message="you are signed up";
        }

    }
    else
    {
        $error='Json file not exixts';
    }
 }
}
?>
<?php
require_once "vendor/autoload.php";
use Twilio\Rest\Client;
$sid='AC036e50bda5693102d0b2c5e63eb2c3cc';
$token='c30f5f0e0e81996cc81ad01aa5411ecd';
$em='';
$pass1='';
if(isset($_POST["submit1"]))
{
    $em = $_POST['emm'];
    $pass1=$_POST['passw'];
    $data=file_get_contents("data.json");
    $data=json_decode($data,true);
    foreach($data as $row)
    {
        if($em==$row["uemail"])
        {
            if($pass1==$row["passwor"])
            {
                $client =new Client($sid,$token);
                $client->messages->create($row['number'],array(
                "from"=>"+12027592023", "body"=>"Your OTP is ". $row['pin']));
                header("location: number.php");
                break;

            }
            else
            {
                echo " password is incorrect";
            }
        }
        
    }

}

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


    <title>Good Health</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
    <img src="lpunss.png" width="70" height="40" alt="" loading="lazy">
  </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <div class="mx-2">
                <button class="btn btn-danger" data-toggle="modal" data-target="#loginModal">Login</button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#signupModal">Register</button>
            </div>
        </div>
    </nav>

    <!-- Button trigger modal -->


    <!--Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="emm">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="passw">
                        </div>
                        <!--<div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>-->
                        <button type="submit" class="btn btn-primary" name="submit1" id="mybtn">Login</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->


    <!--Signup Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register Here</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <?php
                        if(isset($error))
                        {
                            echo $error;
                        }
                        ?>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="name" class="form-control" id="username" name="uname">
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="uemail">
                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
                        </div>
                        <!--<div class="form-group">
                            <label for="cexampleInputPassword1">Confirm Password</label>
                            <input type="password" class="form-control" id="cexampleInputPassword1">
                          </div>-->
                          <div class="form-group">
                            <label for="number">Contact no.</label>
                            <input type="text" class="form-control" id="number" name="num">
                          </div>
                        <button type="submit" class="btn btn-primary" value="Append" name="submit">Create Account</button>
                        <?php
                        if(isset($message))
                        {
                            echo $message;
                        }
                        ?>

                      </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="1.jpg" class="d-block w-100" alt="...">
        </div>
      <div class="carousel-item">
        <img src="2.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="3.jpg" class="d-block w-100" alt="...">
      </div>
    </div>

    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>


    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
  <div class="col-md-5 p-lg-5 mx-auto my-5">
    <h1 class="display-4 font-weight-normal">Today's Quote</h1>
    <p class="lead font-weight-normal">“A designer knows he has achieved perfection not when there is nothing left to add, but when there is nothing left to take away."</p>
    <p>- Antoine de Saint-Exupéry</p>
    <a class="btn btn-outline-secondary" href="#">Coming soon</a>
  </div>
  <div class="product-device shadow-sm d-none d-md-block"></div>
  <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>

<div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-lg-4">
          <img class="rounded-circle" src="product.jpg" width="140" height="140">
        <!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg> -->
        <h2>Products</h2>
        <p>You’ve seen the craze for learning code. But what exactly is coding? Coding is what makes it possible for us to create computer software, apps and websites. Your browser, your OS, the apps on your phone, Facebook, and this website – they’re all made with code.</p>
        <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <img class="rounded-circle" src="market.jpg" width="140" height="140">
        <!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg> -->
        <h2>Marketing</h2>
        <p>Marketing is the study and management of exchange relationships.[1][2] It is the business process of identifying, anticipating and satisfying customers' needs and wants. Because marketing is used to attract customers, it is one of the primary components of business management and commerce.Marketers can direct product to other businesses (B2B marketing) or directly to consumers (B2C marketing).</p>
        <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <img class="rounded-circle" src="service.jpg" width="140" height="140">
        <!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg> -->
        <h2>Service</h2>
        <p>This could be your personal tailor or a brand such as Raymond, where you have the option of customizing a shirt as per your need and size. You can get any design stitched on the shirt. This customization feature is nothing but a form of service which is provided by the brand, thus falling into the category of service based companies.</p>
        <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Can't Wait. <span class="text-muted">It’ll blow your mind.</span></h2>
        <p class="lead">In my opinion, blogs these days are based on their titles. So if you are currently looking to get some hits up for your blog, you need a click-bait title. And trust me when I tell you this, its nothing wrong to have a click bait title as long as the content doesn’t contain what your title claims. So if you want to have a click bait title for your blog, you need to figure out your ways with words but only if you have the relevant content supporting it.
         Coming to the topics that you can cover in your technology blogs, there are a lot these days. Shit changes every second day.</p>
      </div>
      <div class="col-md-5">
         <img src="code.jpg" width="500" height="500">
        <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Once you find answers to the above queries you will know what to write on your blog. Tech is a big subject, don’t try to swallow everything. Try to write specific articles, if you are interested in smartphones write only about smartphones. If you are only interested in Android, write only Android or you want to publish internet tips or write about various software, publish only such articles. Just pick your topics based on your interest and area where you have good knowledge.</p>
      </div>
      <div class="col-md-5 order-md-1" >
          <!-- <img src="c.jpg" width="500" height="500"> -->
        <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
        <p class="lead">In my knowledge, your blogs are highlighted when you have a relevant title and the content related to the same. There are certain topics that revolve around technology and should be relevant & trending at that given point of time. Some of the trending topics right now to put a highlight on your technology blog would be as follows:Blockchain technology,Cloud computing,Artificial intelligence,Virtual Reality,Chatbots,Automation,Digital Marketing,E-commerce,Internet of things These are some of the topics that should be covered in a bunch, for your technology blog.</p>
      </div>
      <div class="col-md-5">
         <img src="ai.jpg" width="500" height="500">
        <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div>

<!-- Footer -->
<footer class="page-footer font-small special-color-dark pt-4 bg-dark">

  <!-- Footer Elements -->
  <div class="container">

    <!-- Social buttons -->
    <ul class="list-unstyled list-inline text-center">
      <li class="list-inline-item">
        <a class="btn-floating btn-fb mx-1">
          <i class="fab fa-facebook-f"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-tw mx-1">
          <i class="fab fa-twitter"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-gplus mx-1">
          <i class="fab fa-google-plus-g"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-li mx-1">
          <i class="fab fa-linkedin-in"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-dribbble mx-1">
          <i class="fab fa-dribbble"> </i>
        </a>
      </li>
    </ul>
    <!-- Social buttons -->

  </div>
  <!-- Footer Elements -->

  <!-- Copyright -->
  <div class="text-center text-light py-3 ">© Copyright. All Rights Reserved
      <p>Designed by: Deepak Jain </p>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
    

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>


    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!--<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
          <h1 class="display-4 font-weight-normal">Punny headline</h1>
          <p class="lead font-weight-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this example based on Apple’s marketing pages.</p>
          <a class="btn btn-outline-secondary" href="#">Coming soon</a>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
      </div>
      <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
  <div class="product-device shadow-sm d-none d-md-block"></div>-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>

</body>

</html>
