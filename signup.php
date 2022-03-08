<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = $phone_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(strlen(trim($_POST["psw"])) < 8){
        $password_err = "Password must have atleast 8 characters.";
    } else{
        $password = trim($_POST["psw"]);
    }
    
    $confirm_password = trim($_POST["psw-repeat"]);
    if(empty($password_err) && ($password != $confirm_password))
    {
            $confirm_password_err = "Password did not match.";
    }   

    if(strlen(trim($_POST["phone"])) != 10){
        $phone_err="Enter Valid phone number";
    }

    $username = trim($_POST["username"]);
    $gender = trim($_POST["gender"]);
    $dob= trim($_POST["dob"]);
    $locality= trim($_POST["locality"]);
    $phone= trim($_POST["phone"]);

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($phone_err)){
        
        $sql = "INSERT INTO users (name,role,gender,password) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_role, $param_gender, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = $password; 
            $param_gender = $gender;  
            $param_role="Visitor";
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_execute(mysqli_prepare($link, "UPDATE users SET USER_ID = CONCAT('V',ID) where id=(select ID FROM users ORDER BY ID DESC LIMIT 1);"));
                $id=(mysqli_query($link, "SELECT USER_ID FROM users ORDER BY ID DESC LIMIT 1") ->fetch_array()[0] );
                
                mysqli_stmt_execute(mysqli_prepare($link, "INSERT INTO visitor VALUES ('".$id."', '".$dob."', '".$locality."');"));
                mysqli_stmt_execute(mysqli_prepare($link, "INSERT INTO phone_number VALUES ('".$phone."','".$id."');"));

                // Redirect to login page
                echo "  <script> alert('Your User Id is: $id.');</script> ";
                echo "  <script> window.location.href= 'login.php'; </script> ";

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>



<!DOCTYPE html>
<html>
<link type="text/css" rel="stylesheet" href="signup.css">
<body>
    <div id="logo"><a href="home.php">EMS</a> Register Form</div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="username"><b>User Name</b> </label><br>
    <input type="text" placeholder="Enter First Name" name="username" value="<?php echo $username; ?>" required><br>


    <label for="dob"><b>Date Of Birth</b> </label><br>
    <input type="date" placeholder="Enter DOB" name="dob" value="<?php echo $dob; ?>" max="2004-01-01" required><br>

    <label for="places"><b>Locality</b> </label><br>
    <input list="places" placeholder="Enter Locality" value="<?php echo ""; ?>" name="locality"required><br>
    <datalist id="places">
        <option value="Andheri">
        <option value="Alipore">
        <option value="Gurugram">
        <option value="T nagar">
    </datalist>

    <label for="phone">Phone Number</label>
    <input type="number" id="phone" name="phone" placeholder="Enter Phone Number" value="<?php echo $phone; ?>" pattern="[0-9]{10}">
    <span style="color: red;"><?php echo $phone_err; ?></span><br>

    <label for="gender"><b>Gender</b></label><br><br>
    
    <input type="radio" name="gender" value="M">
    <label for="M">Male</label>&nbsp;&#160;
    <input type="radio" name="gender" value="F">
    <label for="F">Female</label>&nbsp;&#160;
    <input type="radio" name="gender" value="O">
    <label for="O">Others</label><br>


    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
    <span style="color: red;"><?php echo $password_err; ?></span>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
    <span style="color: red;"><?php echo $confirm_password_err; ?></span>
    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <input type="reset" class="cancelbtn" value="Cancel">
      <input type="submit" name="save" class="signupbtn" value="Register">
    </div>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
  </div>
</form>

</body>
</html>
