<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>
<?php
// define variables and set to empty values
$found = $memEmail = $memPsw = $email = $psw= $pswErr= $emiErr= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = test_input($_POST["email"]);
  
  
	$psw = test_input($_POST["psw"]);
  
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emiErr = "Invalid email format";
	}
// Check connection
//if (!$conn) {
//  die("Connection failed: " . mysqli_connect_error());
//}
//echo "Connected successfully";
	if ($pswErr!="" && $emiErr != ""){ 
	$myfile = fopen(".htcredentials.txt", "r");
	$contents = fread($myfile, filesize(".htcredentials.txt"));
	fwrite($myfile, $psw."\n");
	fclose($myfile);
	$contents=str_split("\n",$contents);
	foreach($contents as $x){
	     $y = split(", ",$x);
	     if ($email == $y[0] && $psw == $y[1]){
		echo "<script type=\"text/javascript\">location.href = '/';</script>";
	     } 
	     else {
		$pswErr = "Either the username or password is incorrect";
	     }	
	}

}}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="container">
    <h1>Register</h1>
    <p>Its a work in progress...Please fill in this form to signin.(Use dummyaccount@example.com and password123)</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>
    <span class="error"><?php echo $emiErr;?></span><br /><br />
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
   <span class="error"><?php echo $pswErr;?></span><br /><br /> 
   <button type="submit" class="registerbtn">Sign in</button>
    
  </div>
  
  
</form>




</body>
</html>
