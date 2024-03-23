<?php
// acquire shared info from other files
include("dbconn.inc.php"); // database connection 
include("shared.php"); // stored shared contents, such as HTML header and page title, page footer, etc. in variables

// make database connection
$conn = dbConnect();

$pid = ""; // place holder for product id information


//See if a product id is available from the client side. If yes, then retrieve the info from the database based on the product id.  If not, present the form.
if (isset($_GET['LinkID'])) { // note that the spelling 'pid' is based on the query string variable name

	// product id available, validate the information, then compose a query accordingly to retrieve information.

	$LinkID = intval($_GET['LinkID']); // force all input into an integer.  If the input is a string or empty, it will be converted to 0.

	// validate the product id -- check to see if it is greater than 0
		if ($LinkID>0 ){
			//compose the query
			$sql = "DELETE from CasaAzulMenu WHERE LinkID = ?"; // note that the spelling "PID" is based on the field name in the database product table.

			$stmt = $conn->stmt_init();

			if ($stmt->prepare($sql)){

				$stmt->bind_param('i',$LinkID);

				if ($stmt->execute()){ // $stmt->execute() will return true (successful) or false
					$output = "<span class='success'>Success!</span><p>The selected record has been successfully deleted.</p>";
				} else {
					$output = "<div class='error'>The database operation to delete the record has been failed.  Please try again or contact the system administrator.</div>";
				}
				
			}
				
			
		} else {
			// product id <= 0. reset $pid. prepare error message
			$LinkID = "";
			// compose an error message
			$output = "<p><b>!</b> If you are expecting to delete an exiting item, there are some error occured in the process -- the product you selected is not recognizable. Please contact the webmaster.  Thank you.</p>";
		}
} else {
	// $_GET['LinkID'] is not set, which means that no product id is provided
	$output = "<p><b>!</b> To manage product records, please follow the link below to visit the admin page.  Thank you. </p>";
}

?>
<br>
<?php 
	print $HTMLHeader; 
	print $course;
?>
<header>
	<h1><?= $SubTitle_Admin ?></h1>
</header>

<main class='flexboxContainer'>
    
    <div>   
        <?= $output ?>
        
        <p>Back to the <a href='admin_productList.php'>product list page</a></p>
    </div>

</main>





<?php print $PageFooter; ?>

</body>
</html>