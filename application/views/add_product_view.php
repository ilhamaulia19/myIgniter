<!-- File add_product_view.php -->
<html>
	<head>
		<title>CRUD dengan CodeIgniter</title>
	</head>
	<body>
		<h1>Add New Product</h1>
		<form method="post" action="<?= base_url() ?>index.php/products/addProductDb">
			<!-- action merupakan halaman yang dituju ketika tombol submit dalam suatu form ditekan -->
			<input type="text" placeholder="Product Name" name="productName" />
			<input type="text" placeholder="Stock" name="stock" />
			<input type="submit" />
		</form>
	</body>
</html>