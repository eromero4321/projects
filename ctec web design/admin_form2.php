<?php
// acquire shared info from other files
include("dbconn.inc.php"); // database connection 
include("shared.php"); // stored shared contents, such as HTML header and page title, page footer, etc. in variables

// make database connection
$conn = dbConnect();

// This form is used for both adding or updating a record.
// When adding a new record, the form should be an empty one.  When editing an existing item, information of that item should be preloaded onto the form.  How do we know whether it is for adding or editing?  Check whether a product id is available -- the form needs to know which item to edit.

$LinkID = ""; // place holder for product id information.  Set it as empty initally.  You may want to change its name to something more fitting for your application.  However, please note this variable is used in several places later in the script. You need to replace it with the new name through out the script.

// Set all values for the form as empty.  To prepare for the "adding a new item" scenario.  
$UsersName = "";

$Review = "";

$CID = "";

$errMsg = "";

// check to see if a product id available via the query string
if (isset($_GET['LinkID'])) { // note that the spelling 'pid' is based on the query string variable name.  When linking to this form (form.php), if a query string is attached, ex. form.php?pid=3 , then that information will be detected here and used below.

	$LinkID = intval($_GET['LinkID']); // get the integer value from $_GET['pid'] (ensure $pid contains an integer before use it for the query).  If $_GET['pid'] contains a string or is empty, intval will return zero.

	// validate the product id -- $pid should be greater than zero.
	if ($LinkID > 0){
			
		//compose a select query
		$sql = "SELECT UsersName, Review, CID from peoplesreviews WHERE LinkID = ?"; // note that the spelling "PID" is based on the field name in my product table (database).
			
		$stmt = $conn->stmt_init();

		if($stmt->prepare($sql)){
			$stmt->bind_param('i',$LinkID);
			$stmt->execute();
				
			$stmt->bind_result($UsersName, $Review, $LinkID); // bind the five pieces of information necessary for the form.
			
			$stmt->store_result();
				
			// proceed only if a match is found -- there should be only one row returned in the result
			if($stmt->num_rows == 1){
				$stmt->fetch();
			} else {
				$errMsg = "<div class='error'>Information on the record you requested is not available.  If it is an error, please contact the webmaster.  Thank you.</div>";
				$LinkID = ""; // reset $Cid
			}

		} else {
			// reset $Cid
			$LinkID = "";
			// compose an error message
			$errMsg = "<div class='error'> If you are expecting to edit an exiting item, there are some error occured in the process -- the selected product is not recognizable.  Please follow the link below to the product adminstration interface or contact the webmaster.  Thank you.</div>";
		}
		
		$stmt->close();
	} // close if(is_int($pid))
	
}

// function to create the options for the category drop-down list.  
//  -- the value of parameter $selectedCID comes from the function call
function CategoryOptionList($selectedLinkID){
	
	$list = ""; //placeholder for the CD category option list
	
	global $conn;
	// retrieve category info from the database to compose a drop down list
	$sql = "SELECT CID, ReviewName FROM reviewcategory order by CID";
	
	$stmt = $conn->stmt_init();

	if ($stmt->prepare($sql)){
		
		$stmt->execute();
		$stmt->bind_result($CID, $ReviewName);

		while ($stmt->fetch()) {
			// while going through the rows in the results, check if the category id of the current row matches the parameter ($CID) provided by the function call
			if ($CID == $selectedCID){
				$selected = "Selected";
			} else {
				$selected = "";
			}
			// create an option based on the current row
			$list = $list."<option value='$CID' $selected>$ReviewName</option>";
		}
	}
	$stmt->close();
	return $list;
}
?>
<?php 
	print $HTMLHeader; 
	print $course;
?>
<header>
	<h1><?= $SubTitle_Admin ?></h1>
</header>

<?php echo $admin_nav3 ?>

<main class='flexboxContainer'>

<div>
    
<h2>Product Information Form</h2>

    <p><?= $errMsg ?></p>

<form action="admin_edit2.php" method="POST">
* Required
	<!-- pass the pid information using a hidden field -->
	<input type="hidden" name="LinkID" value="<?=$LinkID?>">

	<table class='formTable'>
		<tr><th>Name*:</th><td><input type="text" name="UsersName" size="45" value="<?= htmlentities($UsersName) ?>"></td></tr>
	
		
		
		<tr><th>Review Category*:</th><td><select name="CID"><?= CategoryOptionList($CID)?></select></td></tr>
		<tr><th>Review:</th><td><textarea name="Review" cols="43" rows="6"><?= htmlentities($Review) ?></textarea></td></tr>
		<tr><td colspan=2><input type=submit name="Submit" value="Submit Product Information"></td></tr>
	</table>

</form>
</div>
</main>

<?php print $PageFooter; ?>

</body>
</html>