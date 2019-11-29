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
            border: 1px solid #000;
            border-left: 0px !important;
            border-right: 0px !important;
            padding: 10px 0px !important;
		}

		table th {
			padding: 3px;
			font-weight: bold;
			text-align: center;
		}

		table td {
			border: 0 !important;
			padding: 7px;
			vertical-align: top;
		}

		table thead tr {
			color: #fff;
			background: #4e342e;
		}

		table tbody tr td {
			color: #000;
			background: #efebe9;
		}

		table tbody tr th {
			color: #000;
			background: #efebe9;
		}

		table th.no-border {
			border: 0;
			padding: 3px;
			font-weight: bold;
			text-align: center;
		}

		table td.no-border {
			border: 0;
			padding: 7px;
			vertical-align: top;
		}

		table thead tr.no-border {
			color: #fff;
			background: #4e342e;
		}

		table tbody tr.no-border td.no-border {
			color: #000;
			background: #efebe9;
		}

		table tbody tr.no-border th.no-border {
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
	<h3 class="satu">BERITA PEMBANGUNAN PENDIDIKAN
	</h3>
	<h3 class="dua">DINAS PENDIDIKAN PROVINSI JAWA BARAT</h3>
	<h3 class="tiga">Nomor: <?php echo $berita->berita_id; ?>/<?php echo $berita->berita_namabagian; ?>/<?php echo $berita->berita_bulan; ?>/<?php echo $berita->berita_tahun; ?></h3>
	<table>
		<tr>
            <td width="50%">Media Harian/Mingguan/Bulanan/Tabloid</td>
            <td>: <?php echo $berita->berita_koran;?></td>
		</tr>
		<tr>
            <td width="50%">Terbitan, Hari/Tanggal/Bulan/Tahunan</td>
            <td>: <?php echo $berita->berita_hari;?>, <?php echo dateIndo1($berita->berita_created);?></td>
		</tr>
		<tr>
            <td width="50%">Edisi/Halaman/Kolom</td>
            <td>: <?php echo $berita->berita_halaman;?>/<?php echo $berita->berita_kolom;?></td>
		</tr>
	</table>
</body>

</html>
