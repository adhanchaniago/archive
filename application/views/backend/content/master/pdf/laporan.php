<!DOCTYPE html>
<html>

<head>
	<title></title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
			margin: 0 auto;
			font-size: 14px;
		}

		table th {
			border: 1px solid #000;
			padding: 3px;
			font-weight: bold;
			text-align: center;
		}

		table td {
			border: 1px solid #000;
			padding: 7px;
			vertical-align: top;
		}

		table thead tr {
			color: #fff;
			background: #039BE5;
		}

		table tbody tr td {
			color: #000;
			background: #efebe9;
		}

		table tbody tr th {
			color: #000;
			background: #efebe9;
		}

		h3 {
			text-align: center;
			font-weight: 400;
			font-size: 16px;
		}

		h3.satu {
			text-transform: uppercase;
		}

		h3.dua {
			text-transform: uppercase;
		}

		h3.tiga {
        }
	</style>
</head>

<body>
	
<h3 class="satu">Laporan List Berita</h3>
	<h3 class="dua">Dinas Pendidikan Pemerintah Daerah Provinsi Jawa Barat</h3>
	<h3 class="tiga"><?php 
									if ($filter1) { ?>
									Bulan : <?php echo $filter2 ?> - Tahun : <?php echo $filter1 ?>
										<?php } else { ?>
											Keseluruhan
											<?php } ?></h3>
	<br>
	<br>
	<table>
		<thead>
			<tr>
				<th width="7%">No</th>
				<th width="25%">Tanggal</th>
				<th width="38%">Judul</th>
				<th width="30%">Kejadian</th>
			</tr>
		</thead>
		<?php 
									$i	= 1;
									
									if ($filter1) {
										$month = $filter2;
										$year = $filter1;
										} else {
										$month =  '';
										$year = '';
										}

									foreach ($this->ADM->grid_all_berita2('', 'berita_created', 'DESC', 10000, '', $month, $year, '') as $row){
									?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo dateIndo1($row->berita_created) ?></td>
			<td><?php echo $row->berita_judul ?></td>
			<td><?php echo $row->berita_kejadian ?></td>
		</tr>
		<?php 
										$i++;
										 } ?>
	</table>
</body>

</html>
