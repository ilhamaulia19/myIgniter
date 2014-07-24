<!-- File update_product_view.php -->
<html>
	<head>
		<title>CRUD dengan CodeIgniter</title>
	</head>
	<body>
		<h1>Update Product</h1>
        <?php
            //Kita akan melakukan looping terhadap variable $product yang telah dikirimkan melalui controller
            foreach($product->result() as $detail){
        ?>
		<form method="post" action="<?= base_url() ?>index.php/products/updateProductDb">
			<!-- action merupakan halaman yang dituju ketika tombol submit dalam suatu form ditekan -->
            <input type="hidden" value="<?php echo $detail->productId; ?>" name="productId" />
			<input type="text" placeholder="Product Name" name="productName" value="<?php echo $detail->productName; ?>" /> <!-- Value akan diisi berdasarkan data yang sudah ada di database, $detail->productName disini maksudnya adalah menunjuk productName yang merupakan attribute yang ada di table msProduct pada database -->
			<input type="text" placeholder="Stock" name="stock" value="<?php echo $detail->stock; ?>" /> <!-- Sama seperti di atas, hanya saja disini kita menampilkan stok -->
			<input type="submit" value="Update" />
		</form>
        <?php
            }    
        ?>
	</body>
</html>