@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="css.css">
<section>
<?php
	function qrydb($query,$conn,$productID) {
		static $products;
		
		if ($query == "ALL PRODUCTS") {
			if ($products == NULL) {
				$qry = "SELECT p_quantity, p_name, p_price, p_discount_price, p_discount_active, p_description, p_image FROM products WHERE p_id = '$productID';";
				$products = mysqli_query($conn ,$qry);
				//var_dump($products);
			} else {
				//echo "fetched from cache!";
			}
			return $products;
		} else {
			return mysqli_query($conn ,$qry);
		}
    }
	
	$productID = 1;
	$conn = mysqli_connect("localhost", "root", "root", "taro");
	$result = qrydb("ALL PRODUCTS",$conn,$productID);
	$result = qrydb("ALL PRODUCTS",$conn,$productID);
	
	//$qry = "SELECT p_quantity, p_name, p_price, p_discount_price, p_discount_active, p_description, p_image FROM products WHERE p_id = '$productID';";
	//$result = mysqli_query($conn ,$qry);
	
	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
		$quantity = $row["p_quantity"];
		$productName = $row["p_name"];
		if (p_discount_active == 1) {
			$productPrice = $row["p_discount_price"];
		} else {
			$productPrice = $row["p_price"];
		}
			$productDescription = $row["p_description"];
		}
	}
	echo "<h2>";
	echo $productName;
	echo " - <price>$";
	echo $productPrice;
	echo '</price></h2>
	
	<p style="float:right; font-size: 150%; "><a href="basket.php">Basket</a><p>
	<section>
	<form action="product.php" method="post" enctype="multipart/form-data">
		<p>
		<input type="submit" name="addbasket" value="Add to basket">
		Quantity:
		<input type="number" name="quantity" min="1" max="'; echo $quantity; echo '">
		('; echo $quantity; echo ' in stock)
	</form>
	
	</p>
	</section>

	';

	echo "</h2><br><picsection>";
			$dirname = "images/01/";
			$images = glob($dirname."*.*");
			foreach($images as $image) {
				$filepath = $dirname;
				$filepath .= basename($image);
				echo '<img><a href="'.$image.'"><img src="'.$filepath.'" /></a></img>';
			}
	echo '<p>Click the pictures to see them in full-screen</p></picsection><br><section><p>';
	echo $productDescription;
	echo "</p></section>";
	
?>
<?php
if(isset($_POST['addbasket'])){
	$q = $_POST['quantity'];
	$qry = "INSERT INTO baskets (user_id, product_id, quantity) VALUES ('$UserID','$productID','$q');";
	$result = mysqli_query($conn ,$qry);
	echo "<section><p>Added ";
	echo $q;
	echo " to basket</p></section>";
	
	}
?>
</section>

@endsection