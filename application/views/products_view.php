<!-- File products_view.php -->
<html>
	<head>
		<title>CRUD dengan CodeIgniter</title>
	    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/plugins/dataTables/dataTables.bootstrap.css') ?>" rel="stylesheet">
	</head>
	<body>
	<div class="container">
		<?php 
			$jumlahProduk = $listProducts->num_rows(); //$listProduct berasal dari data yang dilempar dari controller, yaitu $data['listProducts']. num_rows() digunakan untuk menghitung jumlah baris yang dimiliki ketika kita melakukan select dari database
		?>
			<a href="<?= base_url() ?>index.php/products/addProduct">Tambah Produk</a>
		<?php
            if($jumlahProduk > 0){ //Apabila data produk yang ada di dalam database lebih dari 0 maka baru ditampilkan
		?>
			<!-- Kalau ada datanya, maka kita akan tampilkan dalam table -->
	<h1>Products List</h1>
        <div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
					<tr>
						<th>No. </th>
						<th>Product ID</th>
						<th>Product Name</th>
						<th>Stock(s)</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						//Kita akan melakukan looping sesuai dengan data yang dimiliki
						$i = 1; //nantinya akan digunakan untuk pengisian Nomor
						foreach ($listProducts->result() as $row) {
					?>
					<tr>
						<td><?= $i++ ?></td>
						<td><?= $row->productId ?></td> <!-- karena berbentuk objek, maka kita menggunakan panah (->) untuk menunjuk field yang ada di database -->
						<td><?= $row->productName ?></td>
						<td><?= $row->stock ?></td>
						<td>
							<!-- Akan melakukan update atau delete sesuai dengan id yang diberikan ke controller -->
							<a href="<?= base_url() ?>index.php/products/updateProduct/<?= $row->productId ?>">Update</a> 
							| 
							<a href="<?= base_url() ?>index.php/products/deleteProductDb/<?= $row->productId ?>">Delete</a>
						</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
			</div>
	</div>
		<?php
			}
		?>
	<script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/dataTables/jquery.dataTables.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/dataTables/dataTables.bootstrap.js') ?>"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>
	</body>
</html>