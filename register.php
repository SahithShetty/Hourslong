<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

    $account = new Account($con);

    if(isset($_POST["submitButton"])) {
        
        $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);
        
        $success = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

        if($success) {
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index.php");
        }
    }

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}  
?>
<style>
     body {
    height: 100%;
    padding: 0;
    margin: 0;
    font-family: 'Arial', sans-serif;
}
    .wrapper {
    min-width: 1050px;
    min-height: 100%;
    background-color: #141414;
}
    .background{
    background:  linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url("https://miro.medium.com/max/1400/1*5lyavS59mazOFnb55Z6znQ.png") no-repeat center center/cover;
}
.showcase-top{
    position: relative;
    z-index: 2;
    height: 90px;
    background: none;
}

.showcase-top img{
    width: 140px;
    position: absolute;
    top: 50%;
    left: 0;
    transform: translate(40% , -50%);
}

.signInContainer {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.column {
    background-color:rgba(0,0,0,0.5);
    min-height: 500px;
    max-height: 100%;
    width: 400px;
    box-shadow: rgba(0,0,0, 0.1) 0 1px 2px;
    padding: 10px 35px;
    overflow-y: auto;
   
}

.column form {
    display: flex;
    flex-direction: column;
    padding-top: 24px;
    color:white;
    
}
.column form input{
    background:none;
    color:white;
}

.column form input[type="text"],
.column form input[type="email"],
.column form input[type="password"] {
    font-size: 18px;
    margin: 10px 10px;
    border: 6px;
    border-bottom: 1px solid #dedede;
    padding:10px;
    width:300px;
    align-items:center;
}

.column form input[type="submit"] {
    background-color: red;
    color: #fff;
    height: 46px;
    width: 120px;
    border: none;
    border-radius: 3px;
    font-weight: 500;
    margin-top: 10px;
    margin-bottom: 20px;
    font-size: 16px;
    margin-left:30%;
}

.column .header {
    padding: 20px 10px;
}

.column h3 {
    font-size: 44px;
    font-weight: 400;
    line-height: 32px;
    margin: 0;
    padding-top: 16px;
    color:white;
}

.column .header span {
    font-size: 14px;
}

.column .header img {
    width: 100px;
}

.signInMessage {
    font-size: 14px;
    font-weight: 400;
    text-decoration: none;
    color:white;
}
.footer{
    max-width: 100%;
    overflow: auto;
    background-color:black;

}

.footer ,
.footer a{
    color: #999999;
    font-size: 0.9rem;
    text-decoration:none;
   
}

.footer p{
    margin-left:285px;
    color: #fff;
    font-weight: bolder;
}

.footer .footer-cols{
    display: grid;
    grid-template-columns: repeat(4 , 1fr);
    grid-gap: 5px;
    margin-left:250px;
    max-width:70%;
    
}

.footer li{
    line-height: 2.4;
}
.footer ul {
    list-style:none;
}
    </style>
<!DOCTYPE html>
<html>
<head>
        <title>Welcome to Hourslong</title>
       
    </head>
    <body>
    <div class="background">
    <header class="showcase">
        <div class="showcase-top">
            <img src="landing page/logo2.png" alt="Hourslong Logo">
        </div>
    </header>
        <div class="signInContainer">

            <div class="column">

                <div class="header">
                   
                    <h3>Sign Up</h3>
                    
                </div>

                <form method="POST">

                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <input type="text" name="firstName" placeholder="First name" value="<?php getInputValue("firstName"); ?>" required>

                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <input type="text" name="lastName" placeholder="Last name" value="<?php getInputValue("lastName"); ?>" required>
                    
                    <?php echo $account->getError(Constants::$usernameCharacters); ?>
                    <?php echo $account->getError(Constants::$usernameTaken); ?>
                    <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username"); ?>" required>

                    <?php echo $account->getError(Constants::$emailsDontMatch); ?>
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <input type="email" name="email" placeholder="Email" value="<?php getInputValue("email"); ?>" required>

                    <input type="email" name="email2" placeholder="Confirm email" value="<?php getInputValue("email2"); ?>" required>
                    
                    <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                    <?php echo $account->getError(Constants::$passwordLength); ?>
                    <input type="password" name="password" placeholder="Password" required>

                    <input type="password" name="password2" placeholder="Confirm password" required>

                    <input type="submit" name="submitButton" value="SUBMIT">

                </form>

                <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>

            </div>

        </div>
        <footer class="footer">
        <p>Questions? Call 000-800-040-1843</p>
        <div class="footer-cols">
            <ul>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Investor Relations</a></li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Speed Test</a></li>
            </ul>
            <ul>
                <li><a href="#">Help Centre</a></li>
                <li><a href="#">Jobs</a></li>
                <li><a href="#">Cookie Preferences</a></li>
                <li><a href="#">Watch for Free</a></li>
            </ul>
            <ul>
                <li><a href="#">Account</a></li>
                <li><a href="#">Ways to Watch</a></li>
                <li><a href="#">Corporate Information</a></li>
                <li><a href="#">Legal Notices</a></li>
            </ul>
            <ul>
                <li><a href="#">Media Centre</a></li>
                <li><a href="#">Terms of Use</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Hourslong Originals</a></li>
            </ul>
        </div>
</div>
</footer>
    </body>
</html>