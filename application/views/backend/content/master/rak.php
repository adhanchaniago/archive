<!-- ================================================== VIEW ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
<div class="page">
	<div class="page-title blue">
		<h3>
			<?php echo $breadcrumb; ?>
		</h3>
		<p>Informasi Mengenai
			<?php echo $breadcrumb; ?>
		</p>
	</div>
	<div class="page-content container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h5 class="panel-title">View Data
							<?php echo $breadcrumb; ?>
						</h5>
					</div>
					<!-- ========== Flashdata ========== -->
					<?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
					<?php if ($this->session->flashdata('success')) { ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check sign"></i>
						<?php echo $this->session->flashdata('success'); ?>
					</div>
					<?php } else if ($this->session->flashdata('warning')) { ?>
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check sign"></i>
						<?php echo $this->session->flashdata('warning'); ?>
					</div>
					<?php } else { ?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-warning sign"></i>
						<?php echo $this->session->flashdata('error'); ?>
					</div>
					<?php } ?>
					<?php } ?>
					<!-- ========== End Flashdata ========== -->
					<div class="panel-body container-fluid table-detail">
						<div class="table-full table-view">
							<div class="navigation-btn">
								<form action="" method="post" id="form">
									<div class='row margin-bottom'>
										<div class='btn-search'>Cari Berdasarkan :</div>
										<div class='col-md-3 col-sm-12'>
											<div class='button-search'>
												<?php array_pilihan('cari', $berdasarkan, $cari);?>
											</div>
										</div>
										<div class='col-md-3 col-sm-12 select-search'>
											<div class="input-group">
												<input type="text" name="q" class="form-control" value="<?php echo $q;?>" />
												<span class="input-group-btn">
													<button type="submit" name="kirim" class="btn btn-primary" type="button">
														<i class="fa fa-search"></i>
													</button>
												</span>
											</div>
										</div>
									</div>
									<div class='btn-navigation'>
										<div class='pull-right'>
											<a class="btn btn-primary" href="<?php echo site_url();?>master/rak">
												<i class="fa fa-refresh"></i>
											</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<?php 
									$i	= $page+1;
									$like_rak[$cari]			= $q;
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_rak('', 'rak_created', 'ASC', $batas, $page, '', $like_rak) as $row){
									?>


			<div class="col-md-3">
				<div class="panel">
					<div class="" style="padding: 30px 10px 10px 10px; text-align: center">
						<?php echo $row->rak_nama;?>
					</div>
					<div class="text-center action" style="border-top: 1px solid #ddd;padding: 10px 0px;">
						<a class="btn-update" href="<?php echo site_url();?>master/rak/edit/<?php echo $row->rak_id;?>">
							<i class="icon wb-pencil"></i>
						</a>
						<a class="btn-detail" href="<?php echo site_url();?>master/rak/detail/<?php echo $row->rak_id;?>">
							<i class="icon wb-info"></i>
						</a>
						<a class="btn-delete" href="javascript:;" data-id="<?php echo $row->rak_id;?>" data-toggle="modal" data-target="#modal-konfirmasi"
						title="<?php echo $row->rak_id;?>">
							<i class="icon wb-trash"></i>
						</a>
					</div>
				</div>
			</div>

			<?php
				$i++;
				} 
				?>


				<div class="col-md-12">
					<div class="wrapper">
						<div class="paging">
							<div id='pagination'>
								<div class='pagination-right'>
									<ul class="pagination">
										<?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'master/rak/view', $id=""); }?>
									</ul>
								</div>
							</div>
						</div>
						<div class="total">Total :
							<?php echo $jml_data;?>
						</div>
					</div>
				</div>
		</div>
		<?php } else {
		?>

			<div class="col-md-12">
				<div class="panel">
					<div class="table-responsive">
						<table class="table table-hover">
							<tbody>
								<tr>
									<td class="text-center">Belum ada data!.</td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>

			<?php } ?>
		</div>
	</div>
	</div>
	</div>
	<a href="<?php echo site_url();?>master/rak/tambah">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-plus" aria-hidden="true"></i>
		</button>
	</a>
</div>
<!-- ========== Modal Konfirmasi ========== -->
<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>

			<div class="modal-body" style="background:#d9534f;color:#fff">
				Apakah Anda yakin ingin menghapus data ini?
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-danger" id="hapus-rak">Ya</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
			</div>
		</div>
	</div>
</div>
<!-- ========== End Modal Konfirmasi ========== -->
<!-- ================================================== END VIEW ================================================== -->

<!-- ================================================== TAMBAH ================================================== -->
<?php } elseif ($action == 'tambah') { ?>
<div class="page">
	<div class="page-title blue">
		<h3>
			<?php echo $breadcrumb; ?>
		</h3>
		<p>Informasi Mengenai
			<?php echo $breadcrumb; ?>
		</p>
	</div>
	<div class="page-content container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah Rak</h5>
					</div>
					<div class="panel-body container-fluid">
						<form action="<?php echo site_url();?>master/rak/tambah" method="post" id="exampleStandardForm" autocomplete="off">
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Nama Rak</label>
								<input type="text" class="form-control input-sm" id="rak_nama" name="rak_nama" placeholder="Nama Rak" required/>
							</div>
							<div class="form-group form-material">
								<div class='button center'>
									<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
									<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>master/rak'"
									/>
								</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a href="<?php echo site_url();?>master/rak">
			<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
				<i class="icon wb-eye" aria-hidden="true"></i>
			</button>
		</a>
	</div>
</div>
<!-- ================================================== END TAMBAH ================================================== -->

<!-- ================================================== EDIT ================================================== -->
<?php } elseif ($action == 'edit') { ?>
<div class="page">
		<div class="page-title blue">
			<h3>
				<?php echo $breadcrumb; ?>
			</h3>
			<p>Informasi Mengenai
				<?php echo $breadcrumb; ?>
			</p>
		</div>
		<div class="page-content container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h5 class="panel-title">Edit Rak</h5>
						</div>
						<div class="panel-body container-fluid">
							<form action="<?php echo site_url();?>master/rak/edit/<?php echo $rak_id;?>" method="post" id="exampleStandardForm" autocomplete="off">
								<div class="form-group form-material">
									<label class="control-label" for="inputText">ID Rak</label>
									<input type="text" value="<?php echo $rak_id; ?>" class="form-control input-sm" id="rak_id" name="rak_id" placeholder="Masukan ID Rak"
									value="<?php echo $rak_id;?>" disabled required/>
								</div>
								<div class="form-group form-material">
									<label class="control-label" for="inputText">Nama Rak</label>
									<input type="text" value="<?php echo $rak_nama; ?>" class="form-control input-sm" id="rak_nama" name="rak_nama" placeholder="Masukan Nama Rak"
									value="<?php echo $rak_nama;?>" required/>
								</div>
								<div class='button center'>
									<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
									<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>master/rak'"
									/>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a href="<?php echo site_url();?>master/rak">
			<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
				<i class="icon wb-eye" aria-hidden="true"></i>
			</button>
		</a>
	</div>
	<!-- ================================================== END EDIT ================================================== -->

	<!-- ================================================== DETAIL ================================================== -->
	<?php } elseif ($action == 'detail') { ?>
	<div class="page">
		<div class="page-title blue">
			<h3>
				<?php echo $breadcrumb; ?>
			</h3>
			<p>Informasi Mengenai
				<?php echo $breadcrumb; ?>
			</p>
		</div>
		<div class="page-content container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h5 class="panel-title">Detail
								<?php echo $breadcrumb; ?> <?php echo $rak->rak_nama; ?>
							</h5>
						</div>

						<div class="panel-body container-fluid table-detail">
							<div class="table-full table-view">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<th>No</th>
											<th>Tanggal</th>
											<th>Judul</th>
											<th>Kejadian</th>
											<th class="text-center action">Dokumen Kliping</th>
										</thead>
										<tbody>
											<?php 
									$i	= 1;
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_arsip2('', 'arsip_created', 'DESC', $batas, '', '', '') as $row){
									?>
											<tr>
												<td>
													<?php echo $i; ?>
												</td>
												<td>
													<?php echo dateIndo1($row->arsip_created);?>
												</td>
												<td>
													<?php echo $row->berita_judul; ?>
												</td>
												<td>
													<?php echo $row->berita_kejadian; ?>
												</td>
												<td class="text-center action">
											
												<a class="btn-update" href="<?php echo site_url();?>master/arsip/edit/<?php echo $row->arsip_id;?>">
												<i class="icon wb-pencil"></i>
											</a>
											<a class="btn-detail" href="<?php echo site_url();?>master/arsip/detail/<?php echo $row->arsip_id;?>">
												<i class="icon wb-info"></i>
											</a>
											<a class="btn-delete" href="javascript:;" data-id="<?php echo $row->arsip_id;?>" data-toggle="modal" data-target="#modal-konfirmasi"
											title="<?php echo $row->arsip_id;?>">
												<i class="icon wb-trash"></i>
											</a>
													<a class="btn-update" target="_blank" href="<?php echo site_url();?>assets/files/arsip_dok/<?php echo 
													$row->arsip_dok;?>">
														<i class="icon wb-print"></i>
													</a>
												</td>
											</tr>
											<?php
										$i++;
									} 
								} else {
									?>
												<tr>
													<td class="text-center" colspan="5">Rak kosong!.</td>
												</tr>
												<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
</div>



<a href="<?php echo site_url();?>master/rak/view">
	<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
		<i class="icon wb-eye" aria-hidden="true"></i>
	</button>
</a>
</div>
<?php }  ?>
<!-- ================================================== END DETAIL ================================================== -->
