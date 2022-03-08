<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["userid"]))){
        $username_err = "Please enter user id.";
    } else{
        $username = trim($_POST["userid"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT user_id, name, password, role, gender FROM users WHERE user_id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $name, $new_password, $role, $gender);
                    if(mysqli_stmt_fetch($stmt)){
                        if($new_password==$password){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["userid"] = $username;                            
                            $_SESSION["username"] = $name;  
                            $_SESSION["password"] = $password; 
                            
                            
                            echo "  <script> alert('$role');</script> ";

                            if ($gender=='M'){                                
                                $_SESSION["gender"]="Male";
                            }
                            else if($gender=='F'){
                                $_SESSION["gender"]="Female";
                            }
                            else{
                                $_SESSION["gender"]="Others";
                            }
                            
                            if ($role=="Admin"){
                                $_SESSION["admin"] = true;     
                                header("location: admin.php");
                            }
                            else{
                                $_SESSION["admin"] = false;     
                                header("location: visitor.php");
                            }
                        } 
                        else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
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
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>


<div id="logo"><a href="home.php">EMS</a> Login Form</div><br>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="imgcontainer">
    <img src="images/user.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="userid"><b>User ID</b></label>
    <input type="text" placeholder="Enter User ID" name="userid" required class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
    <span class="invalid-feedback"><?php echo $username_err; ?></span>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
    <span class="invalid-feedback"><?php echo $password_err; ?></span>

    <button type="submit">Login</button><br>
    <span class="invalid-feedback" style="text-align: center;"><?php echo $login_err; ?></span><br>

    <div style="float: left;">
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </div>                                       
    <div style="float: right;">Don't have an account? <a href="signup.php">Sign up now</a>.
    </div><br>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="reset" class="cancelbtn">Clear</button>
    <span class="psw">Forgot <a href="javascript:alert('Login to Reset Password');">password?</a></span>
  </div>
</form>

</body>
</html>
    