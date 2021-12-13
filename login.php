<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: addblogs.html");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$mail = $password = "";
$mail_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["mail"]))){
        $mail_err = "Please enter email.";
    } else{
        $mail = trim($_POST["mail"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($mail_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, mail FROM users WHERE mail = ? and password = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $mail, $password);
            
            // Set parameters
            // $param_mail = $mail;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $mail);
                    if(mysqli_stmt_fetch($stmt)){
                        // Password is correct, so start a new session
                        session_start();
                            
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;  
                        
                        echo "Welcome " . $_SESSION["username"] . "!";
                        
                        // Redirect user to welcome page
                        header("location: addblogs.html");
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
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Admin Login</title>
      <link rel="stylesheet" href="css/loginstyle.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
      <div class="wrapper">
         <div class="title-text">
            <div class="title login">
                Login
            </div>
           
         </div>
         <div class="form-container">
        
            <div class="form-inner">
               <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login">
                  <div class="field">
                     <input type="text" id='mail' name='mail' placeholder="Email Address" required>
                  </div>
                  <div class="field">
                     <input type="password" id='password' name='password' placeholder="Password" required>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" value="Login">
                  </div>
                  <div class="signup-link">
                    <a href="home.html"> Click here to go back to Home page</a>
                  </div>
               </form>
              
            </div>
         </div>
      </div>
     
   </body>
</html>