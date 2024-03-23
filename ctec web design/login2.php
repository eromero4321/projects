<?php
// start the session
session_start();

// clear out session value
if (isset($_GET['logout'])){
    $_SESSION['access'] = false;
}

// check to see if there's a form submission of user name and password
if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    //echo "u: $username - p: $password <br>";
    
    // add additional validation here if necessary
    
    // validate user name and password
    // -- in this example, only one set of user name and password is valid so it's hard-coded here.  If there are multiple accounts, you may want to check the user input against your database records to grand access
    
    if ($username == "ctec" && $password == "4321") {
        // grant access
        $_SESSION['access'] = true;
        // redirect it to the admin page #1
        header('Location: admin_productList2.php');
        exit;
    } else {
        // error message
        $message = "<div class='error'>The user name and password you provided are incorrect.  Please try again.</div>";
    }

} else if (isset($_POST['username']) || isset($_POST['password'])){
    $message = "<div class='error'>Please enter both the user name and password to log in.</div>";
    
}else {
    $message = "<div>Enter Username:ctec Password:4321 to edit your review or delete it.</div>";
    
}

?>
<?php
    include("shared.php"); // stored shared contents, such as HTML header and page title, page footer, etc. in variables
?>
<?php 
	print $HTMLHeader; 
	print $course;
?>




<main style='background-color: #cccccc;'>

    <h2>Log In</h2>
    
    <?= $message ?>
    
    <form action="" method="post">
        User name: <input type='text' name="username"> 
        Password: <input type='text' name="password">
        <br>
        <input type="submit" name="submit" value="Log in">        
    </form>

</main>

<a href='review.php?CID=1'>Go back to Casa Azul</a>

</body>
</html>