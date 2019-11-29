<div class="page">
	<div class="page-title blue">
		<h3>Dashboard</h3>
		<p>Informasi Mengenai Halaman Awal pada website</p>
	</div>
	<div class="page-content">
		<!-- ========== Flashdata ========== -->
		<?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
		<?php if ($this->session->flashdata('success')) { ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<i class="fa fa-close sign"></i>
			<?php echo $this->session->flashdata('success'); ?>
		</div>
		<?php } else if ($this->session->flashdata('warning')) { ?>
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<i class="fa fa-close sign"></i>
			<?php echo $this->session->flashdata('warning'); ?>
		</div>
		<?php } else { ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<i class="fa fa-close sign"></i>
			<?php echo $this->session->flashdata('error'); ?>
		</div>
		<?php } ?>
		<?php } ?>
		<!-- ========== End Flashdata ========== -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Selamat datang di Sistem Informasi Pengarsipan Kliping Berita Pendidikan Humas Disdik Jabar</h3>
			</div>
			<div class="panel-body container-fluid">
				<div class="blockquote gray">
					<?php 
		if ($jml_data > 0){ ?>
					<h3>Berita Terbaru
					</h3>
					<?php } else { ?>
					<h3>Berita Masih Kosong
					</h3>
					<?php }  ?>
				</div>
			</div>
		</div>
		<?php 
		if ($jml_data > 0){
			foreach ($this->ADM->grid_all_berita('', 'berita_created', 'DESC', 4, '', '', '') as $row){ ?>
		<div class="col-md-3">
			<div class="panel">
				<div class="panel-body container-fluid">
					<div>
						<?php echo $row->berita_id;?> -
						<?php echo $row->berita_koran;?>
					</div>
					<div>
						Judul :
						<?php echo $row->berita_judul;?>
					</div>
					<div>
						Tanggal :
						<?php echo dateIndo1($row->berita_created);?>
					</div>
				</div>
				<a style="color: white !important; text-decoration: none;" href="<?php echo site_url();?>master/berita/detail/<?php echo $row->berita_id;?>">
					<div style="background: #039BE5; padding: 10px; text-align: center">
						Detail
					</div>
				</a>
			</div>
		</div>
		<?php }  ?>

		<?php } else { ?>

		<?php }  ?>
	</div>
</div>
