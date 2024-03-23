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
?><?php print $admin_nav1; ?>
<header>
	<h1><?= $SubTitle_Admin ?></h1>
</header>

<script>
function confirmDel(title, LinkID) {
// javascript function to ask for deletion confirmation

	url = "admin_delete.php?LinkID="+LinkID;
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

<?php echo $admin_nav ?>

<main>
<?php
// Retrieve the product & category info

	$sql = "SELECT CasaAzulMenu.LinkID, CasaAzulMenu.MenuItem, CasaAzulMenu.Price, CasaAzulMenu.Description, CasaAzulMenu.PictureURL, CasaAzulCategory.CategoryName FROM CasaAzulMenu, CasaAzulCategory WHERE CasaAzulMenu.CID = CasaAzulCategory.CID ORDER BY CasaAzulCategory.CID";
	$stmt = $conn->stmt_init();

	if ($stmt->prepare($sql)){

		$stmt->execute();
		$stmt->bind_result($LinkID, $MenuItem, $Price, $Description, $PictureURL, $CategoryName);
	
		$tblRows = "";
		while($stmt->fetch()){
            $MenuItem_js = str_replace('"', "'", $MenuItem); // replace double quotes by the single quote in the title to avoid trouble in the javascript function.
			$MenuItem_js = htmlspecialchars($MenuItem_js, ENT_QUOTES); // convert quotation marks in the product title to html entity code.  This way, the quotation marks won't cause trouble in the javascript function call ( href='javascript:confirmDel ...' ) below.  

			$tblRows = $tblRows."<tr><td>$MenuItem</td><td>$Price</td><td>$Description</td><td><img src='$PictureURL' width= '150' alt='Picture'></td>
								 <td>$CategoryName</td>
							     <td><a href='admin_form.php?LinkID=$LinkID'>Edit</a> | <a href='javascript:confirmDel(\"$MenuItem_js\",$LinkID)'>Delete</a> </td></tr>";
		}
		
		$output = "
        <table class='itemList'>\n
		<tr><th>Menu Item</th><th>Price</th><th>Description</th><th>Picture Url</th><th>Drink Category</th><th>Options</th></tr>\n".$tblRows.
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

<?php print $admin_nav1; ?>

</body>
</html>