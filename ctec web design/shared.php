<?php
// store shared information in this file, such as headers, menu, and footers

//HTML Header
$HTMLHeader = 
"<!DOCTYPE html>
<html>
<head>
	<title>Casa Azul</title>
	<link rel='stylesheet' href='https://ctech4321.edr7491.uta.cloud/termproject2/ctec%20web%20design/css/style.css' type='text/css'>
</head>
<body>
";

//Course identifier
$course = "<div class='course'>Casa Azul</div>";

// Page title
$SubTitle_Admin = "<h1>Product Catalog Management</h1>";

// Product Admin Nav
$admin_nav = "<nav class='flexboxContainer'><div>
                <div class='buttonBox'><a href='admin_form.php'><span class='button'>+</span> Add a new item</a></div>
                <div class='buttonBox'><a href='admin_productList.php'><span class='button'> ./ </span> List all items</a></div>
              </div></nav>
                ";
$admin_nav1 = "
<nav id='admin'>
    
        <li><a href='admin_productList.php'>Admin Menu Editing</a></li>
        
        <li id='logout'><a href='login.php?logout'>Log out</a></li>
    
</nav>
";
$admin_nav2 = "
<nav id='admin'>
    
        <li><a href='admin_productList2.php'>Admin Menu Editing</a></li>
        
        <li id='logout'><a href='login2.php?logout'>Log out</a></li>
    
</nav>
";

$admin_nav3 = "<nav class='flexboxContainer'><div>
                <div class='buttonBox'><a href='admin_form2.php'><span class='button'>+</span> Add a new item</a></div>
                <div class='buttonBox'><a href='admin_productList2.php'><span class='button'> ./ </span> List all items</a></div>
              </div></nav>
                ";
//Page Footer
/*$PageFooter = "
<footer>
	<a href='http://cyjang.utasites.cloud/ctec4321/'>Back to the course site</a>
</footer>
";*/
?>