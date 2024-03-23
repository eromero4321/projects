
<?php
//just use category_list.php not link list menu
// acquire shared info from other files
include("dbconn.inc.php"); // database connection 
include("shared.php"); // stored shared contents, such as HTML header and page title, page footer, etc. in variables

// make database connection
$conn = dbConnect();

?>
<?php 
//	print $HTMLHeader; 

?>


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" content="HTML Template">
        <meta name="description" content="Elizabeth Romero - 1001807491 | HTML Template">
        <meta name="author" content="Elizabeth Romero">

        <title>Review</title>
        <link rel="stylesheet" href="css/style.css">
    </head><body>
    
    
      <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <nav class="navbar">
                        <a class="navbar-brand" href="index.html">Navbar</a> <button class="navbar-toggler" data-target="#navigation" type="button"><span class="fa-solid fa-bars"></span></button>
                        <div class="navigation collapse" id="navigation">
                            <ul class="navbar-nav">
                                <li class="active">
                                    <a href="index.html">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li>
                                    <a href="about.html">About</a>
                                </li>
                                
                                <li>
                                    <a href="menu.php?CID=3">Menu</a>
                                </li>
                                
                                <!--<li class="dropdown collapse">
                                    <a class="dropdown-toggle" href="#">Gift Cards</a>
                                    <div class="dropdown-menu">
                                        <a href="./products.html"> Birthday</a>
                                        <a href="./individualproducts.html">Holidays</a> 
                                        
                                    </div>
                                </li>-->
                                 <li>
                                    <a href="review.php?CID=2">Reviews</a>
                                </li>
                                <li>
                                    <a href="delivery.html">Order Now</a>
                                </li>
                                <li>
                                    <a href="contact.html">Contact</a>
                                    
                                    
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

    <main>
<h1>Review Categories</h1>
    
<?php
//send the query to the database and get results
    /* 
    The SQL query below is based on a (product) category table that I have:
        Table name: category
        Field names: CategoryID, CategoryName

	 When modifying this script for your own use, you will have to edit this SQL query using your table name and field names. For the exercise, you are going to use this script to list all categories in your (link) category table.
    */
	$sql = "SELECT ReviewName, CID FROM reviewcategory order by ReviewName ASC ;";
	
	/* create a prepared statement */
	$stmt = $conn->stmt_init();
		
	if ($stmt->prepare($sql)) {

		/* execute statement */
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($ReviewName, $CID);

		echo "<nav>";
		/* fetch values */
		while ($stmt->fetch()) {
			echo " |<a href='review.php?CID=$CID'>$ReviewName</a>";
		}
		echo "</nav>";

		/* close statement */
		$stmt->close();

	} else {
		print ("query failed");
	}

/* close connection */
$CID= $_GET['CID'];
	$sql = "SELECT `LinkID`, `UsersName`,`Review`, `CID` FROM peoplesreviews WHERE CID= ?;";
	
	/* create a prepared statement */
	$stmt = $conn->stmt_init();
		
	if ($stmt->prepare($sql)) {

    /*Bind parameter */
    $stmt->bind_param('i', $CID);


		/* execute statement */
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($LinkID, $UsersName, $Review , $CID);
        
        $hasResults= false;
		
		/* fetch values */
		while ($stmt->fetch()) {
			echo "<ul> $UsersName: <br/> $Review<br/></a><br/></ul>\n";
			$hasResults= true;
		}
		

		/* close statement */
		$stmt->close();

if(! $hasResults){
    echo "<div class='error'> Currently, No record is found for this category.
    Check out our other categories of our items above ⬆️ or come back at a later time⏰!
    </div>";
}

	} else {
		print ("query failed");
	}

/* close connection */
$conn->close();
	
	
?>
<a href='login2.php'><b>Edit or Delete Your Review!</b></a>
</main>

<!--<?php print $PageFooter; ?>-->


         <footer>
             
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-4">
                        <h3>Casa Azul </h3>
                        <p><b>Location</b>
<br>300 West Central Avenue
<br>Fort Worth, TX 76164
<br><br>(817)386-0800
<br><br>hello@casaazulcoffee.com



</p>
                    </div>
                    <div class="col-md-3 col-lg-2">
                        <h4>Menu</h4>
                        <ul class="unstyled footer-nav">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About</a></li>
                            
                         
                            <li><a href="menu.php?CID=3">Menu</a></li>
                             <li>
                                    <a href="review.php?CID=2">Reviews</a>
                                </li>
                            <li><a href="delivery.html">Order Now</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                  <div class="col-lg-6"><p><br><b>Hours</b>
                        <br>Monday 6:00am - 4:00pm
<br>Tuesday 6:00am - 4:00pm
<br>Wednesday 6:00am - 4:00pm
<br>Thursday 6:00am - 4:00pm
<br>Friday 6:00am - 4:00pm
<br>Saturday 8:00am - 4:00pm
<br>Sunday 8:00am - 4:00pm</p>

<br><br><a href="https://www.google.com/maps/dir//casa+azul+coffee/data=!4m6!4m5!1m1!4e2!1m2!1m1!1s0x864e77607046f533:0xb6cdc199b750a483?sa=X&ved=2ahUKEwj7-pWg4-WCAxUll2oFHQLBBKUQ9Rd6BAhVEAA">Get Directions</a>

                                </div>
                           
                            <a href="404.html" class="btn btn-primary">404</a>
                            <a href="505.html" class="btn btn-primary">505</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            © Class Project All Rights Reserved. Elizabeth Romero | 1001807491
                        </div>
                        <div class="col-md-4">
                        <ul class="inline social-media">
                            <li><a href="https://www.facebook.com/CasaAzulCoffee/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="https://twitter.com/i/flow/login?redirect_after_login=%2FCasaAzulCoffee" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                           
                            <li><a href="https://www.instagram.com/casaazulcoffee/?hl=en" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa-solid fa-phone"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </footer>

        <script src="js/app.js"></script>
    </body>
</html>