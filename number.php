<!-- new index-->

<?php
if(isset($_POST['enterpin']))
{
	$pin=$_POST['pin'];
    $numb=$_POST['num'];
    $un='';
	$data=file_get_contents("data.json");
    $data=json_decode($data,true);
    foreach($data as $row)
    {
        if($numb==$row["number"])
        {
            if($pin==$row["pin"])
            {
                $un=$row['uname'];
                $url="welcome.php?uname=".$un;
                header("location:".$url);
                exit();
            }
            else
            {
                echo " wrong ";
            }
        }
        else
        {
              echo "Your account doesnot exists";
        }
    }

}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>OTP Page</title>
    <style>
        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4F4D48;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #696969;
        }

        #my {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>
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
                </div>
                <div class="mx-2 text-light">
                    <h3>You're about to login</h3>
                </div>
            </nav>

            <div id="my">
        <form method="post" action="number.php">
            <label>Enter Contact No.</label>
            <input id="fname" type="text" name="num" placeholder="Enter Phone no.">
    
            <label>Enter OTP</label>
            <input id="lname" type="text" name="pin" placeholder="Enter OTP">
        
            <input type="submit" name="enterpin" value="Submit">
        </form>
    </div>
	<!-- <form method="post" action="number.php">
		<p>
			<input type="text" name="num" placeholder="entert number">
		</p>
		<p>
			<input type="text" name="pin" placeholder="enter_pin">
		</p>
		<p>
			<input type="submit" name="enterpin">
		</p>
	</form> -->

</body>
</html>