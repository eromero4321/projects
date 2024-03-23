<?php
// acquire shared info from other files
include("dbconn.inc.php"); // database connection 
include("shared.php"); // stored shared contents, such as HTML header and page title, page footer, etc. in variables

// make database connection
$conn = dbConnect();

?>
<?php 
	print $HTMLHeader; 
	print $course;
?>
<header>
	<h1><?= $SubTitle_Admin ?></h1>
</header>
<?php print $admin_nav2; ?>
<script>
function confirmDel(title, LinkID) {
// javascript function to ask for deletion confirmation

	url = "admin_delete2.php?LinkID="+LinkID;
	var agree = confirm("Delete this item: <" + title + "> ? ");
	if (agree) {
		// redirect to the deletion script
		location.href = url;
	}
	else {
		// do nothing
		return;
	}
}
</script>

<?php echo $admin_nav3 ?>

<main>
<?php
// Retrieve the product & category info

	$sql = "SELECT peoplesreviews.LinkID, peoplesreviews.UsersName, peoplesreviews.Review, reviewcategory.ReviewName FROM peoplesreviews, reviewcategory WHERE peoplesreviews.CID = reviewcategory.CID ORDER BY reviewcategory.CID";
	$stmt = $conn->stmt_init();

	if ($stmt->prepare($sql)){

		$stmt->execute();
		$stmt->bind_result($LinkID, $UsersName, $Review, $ReviewName);
	
		$tblRows = "";
		while($stmt->fetch()){
            $UsersName_js = str_replace('"', "'", $UsersName); // replace double quotes by the single quote in the title to avoid trouble in the javascript function.
			$UsersName_js = htmlspecialchars($UsersName_js, ENT_QUOTES); // convert quotation marks in the product title to html entity code.  This way, the quotation marks won't cause trouble in the javascript function call ( href='javascript:confirmDel ...' ) below.  

			$tblRows = $tblRows."<tr><td>$UsersName</td><td>$Review</td>
								 <td>$ReviewName</td>
							     <td><a href='admin_form2.php?LinkID=$LinkID'>Edit</a> | <a href='javascript:confirmDel(\"$UsersName_js\",$LinkID)'>Delete</a> </td></tr>";
		}
		
		$output = "
        <table class='itemList'>\n
		<tr><th>Name</th><th>Review</th><th>Review Category</th><th>Options</th></tr>\n".$tblRows.
		"</table>\n";
					
		$stmt->close();
	} else {

		$output = "Query to retrieve product information failed.";
	
	}

	$conn->close();
?>
	
		

<div class='flexboxContainer'>
    <div>
        <h2>Product List</h2>
        <?php echo $output ?>
    </div>
</div>
</main>



</body>
</html>