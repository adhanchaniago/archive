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
										<div class='btn-search'>Cari dari :</div>
										<div class='col-md-3 col-sm-12'>
											<div class='button-search'>
											<input type="date" value="<?php echo $first_date ?>" class="form-control" id="arsip_bulan" name="arsip_bulan" placeholder="Bulan" required/>
											</div>
										</div>
										<div class='col-md-3 col-sm-12 select-search'>
											<input type="date" value="<?php echo $second_date ?>" class="form-control" id="arsip_tahun" name="arsip_tahun" placeholder="Tahun" required/>
										</div>
									</div>
									<div class='btn-navigation'>
										<div class='pull-right'>
											
										<button type="submit" name="kirim" class="btn btn-primary" type="button">
											Cari
										</button>
											<a class="btn btn-primary" href="<?php echo site_url();?>master/arsip">
												<i class="fa fa-refresh"></i>
											</a>
										</div>
									</div>
								</form>
							</div>
							<?php if ($this->input->post('arsip_bulan')) {?>
							<div style="color: red; margin-bottom: 20px;" class="text-center">Pencarian dari <?php echo dateIndo1($this->input->post('arsip_bulan').' 00:00:00'); ?> - <?php echo dateIndo1($this->input->post('arsip_tahun').' 00:00:00'); ?></div>
							<?php } ?>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<th>No</th>
										<th>No Kliping</th>
										<th>Tanggal Pengarsipan</th>
										<th>Dokumen Arsip</th>
										<th class="text-center">Aksi</th>
									</thead>
									<tbody>
										<?php 
									$i	= $page+1;
									if ($this->input->post('arsip_bulan')) {
									$first_date = $this->input->post('arsip_bulan').' 00:00:00';
									$second_date = $this->input->post('arsip_tahun').' 00:00:00';
									}
								if ($jml_data > 0){
									
									foreach ($this->ADM->grid_all_arsip('', 'arsip_created', 'DESC', $batas, $page, $first_date, $second_date, '') as $row){
									?>
										<tr>
											<td>
												<?php echo $i; ?>
											</td>
											<td>
											<?php echo $row->berita_id;?>/<?php echo $row->berita_namabagian;?>/<?php echo $row->berita_bulan;?>/<?php echo $row->berita_tahun;?>
											</td>
											<td>
												<?php echo dateIndo1($row->arsip_created); ?>
											</td>
											<td>
												<a target="_blank" href="<?php echo site_url();?>assets/files/arsip_dok/<?php echo $row->arsip_dok;?>" target="_blank">
													<?php echo $row->arsip_dok; ?>
												</a>
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
											</td>
										</tr>
										<?php
										$i++;
									} 
								} else {
									?>
											<tr>
												<td class="text-center" colspan="9">Belum ada data!.</td>
											</tr>
											<?php } ?>
									</tbody>
								</table>
							</div>
							
							<div class="wrapper">
								<div class="paging">
									<div id='pagination'>
										<div class='pagination-right'>
											<ul class="pagination">
												<?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'master/arsip/view', $id=""); }?>
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
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>master/arsip/tambah">
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
				<a href="javascript:;" class="btn btn-danger" id="hapus-arsip">Ya</a>
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
						<h5 class="panel-title">Tambah arsip</h5>
					</div>
					<div class="panel-body container-fluid">
						<form action="<?php echo site_url();?>master/arsip/tambah" method="post" enctype="multipart/form-data" id="exampleStandardForm"
						autocomplete="off">
							<div class="form-group form-material">
								<label class="control-label" for="inputText">ID Pencatatan</label>
								<input type="text" class="form-control input-sm" value="<?php echo $where ?>"  id="berita_id" name="berita_id" readonly required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Nama Rak</label>
								<select type="text" class="form-control input-sm" id="rak_id" name="rak_id" placeholder="Nama Rak" required/>
								<option value=""></option>

								<?php 
									foreach ($this->ADM->grid_all_rak('', 'rak_created', 'DESC', 10000, '', '', '') as $row){
									?>
								<option value="<?php echo $row->rak_id;?>">
									<?php echo $row->rak_nama;?>
								</option>
								<?php } ?>
								</select>
							</div>
							<div style="margin-bottom: 20px !important;margin-top: 20px !important;font-weight:500">
								<label class="control-label" for="inputText" style="font-weight:500">File</label>
								<input type="file" class="form-control btn-sm input-sm" size="100" name="arsip_dok" id="arsip_dok">
							</div>
							<div class='button center'>
								<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
								<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>master/arsip'"
								/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>master/arsip">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-eye" aria-hidden="true"></i>
		</button>
	</a>
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
						<h5 class="panel-title">Edit Arsip</h5>
					</div>
					<div class="panel-body container-fluid">
						<form enctype="multipart/form-data" action="<?php echo site_url();?>master/arsip/edit/<?php echo $arsip_id;?>" method="post"
						id="exampleStandardForm" autocomplete="off">
							<div class="form-group form-material">
								<label class="control-label" for="inputText">ID Pencatatan</label>
								<select type="text" class="form-control input-sm" id="berita_id" name="berita_id" placeholder="ID Pencatatan" required/>
								<option value="<?php echo $berita_id;?>">
									<?php echo $berita_id;?> |
									<?php echo $berita_kejadian;?> |
									<?php echo $berita_judul;?>
								</option>

								<?php 
									foreach ($this->ADM->grid_all_berita('', 'berita_created', 'DESC', 10000, '', '', '') as $row){
									?>
								<option value="<?php echo $row->berita_id;?>">
									<?php echo $row->berita_id;?> |
									<?php echo $row->berita_kejadian;?> |
									<?php echo $row->berita_judul;?>
								</option>
								<?php } ?>
								</select>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">ID arsip</label>
								<input type="text" value="<?php echo $arsip_id; ?>" class="form-control input-sm" id="arsip_id" name="arsip_id" placeholder="Masukan ID arsip"
								value="<?php echo $arsip_id;?>" disabled required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Nama Rak</label>
								<select type="text" class="form-control input-sm" id="rak_id" name="rak_id" placeholder="Nama Rak" required/>

								<option value="<?php echo $rak_id;?>">
									<?php echo $rak_nama;?>
								</option>

								<?php 
									foreach ($this->ADM->grid_all_rak('', 'rak_created', 'DESC', 10000, '', '', '') as $row){
									?>
								<option value="<?php echo $row->rak_id;?>">
									<?php echo $row->rak_nama;?>
								</option>
								<?php } ?>
								</select>
							</div>
							<?php if ($arsip_dok){?>
							<div for="arsip_dok" class="control-label" style="font-weight:500">File</div>
							<?php echo $arsip_dok;?>
							<div style="margin-bottom: 20px !important;margin-top: 20px !important;font-weight:500">
								<label class="control-label" for="inputText" style="font-weight:500">Ganti File</label>
								<input type="file" class="form-control btn-sm input-sm" size="100" name="arsip_dok" id="arsip_dok">
							</div>
							<?php } else {?>
							<div style="margin-bottom: 20px !important;margin-top: 20px !important">
								<label class="control-label" for="inputText" style="font-weight:500">File</label>
								<input type="file" class="form-control btn-sm input-sm" size="100" name="arsip_dok" id="arsip_dok">
							</div>
							<?php } ?>
							<div class='button center'>
								<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
								<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>master/arsip'"
								/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>master/arsip">
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
			<div class="col-md-3">
				<div class="page-content-left">
					<h3>Aksi
						<?php echo $breadcrumb; ?>
					</h3>
					<p>Aksi yang terdapat pada
						<?php echo $breadcrumb; ?>:</p>
					<a href="<?php echo site_url();?>master/arsip" class="bluee">
						<div class="button">
							<span>View Data</span>
							<button class="btn-raised btn btn-sm btn-floating blue" type="button">
								<i class="icon wb-eye" aria-hidden="true"></i>
							</button>
						</div>
					</a>
					<a href="<?php echo site_url();?>master/arsip/hapus/<?php echo $arsip->arsip_id;?>">
						<div class="button">
							<span>Delete Data</span>
							<button class="btn-raised btn btn-sm btn-floating red" type="button">
								<i class="icon wb-trash" aria-hidden="true"></i>
							</button>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-9">
				<div class="panel">
					<div class="panel-heading">
						<h5 class="panel-title">Detail
							<?php echo $breadcrumb; ?>
						</h5>
					</div>
					<div class="panel-body container-fluid table-detail">
						<div class="table-full table-detail">
							<div class="table-responsive">
								<table class="table table-hover">
									<tbody>
										<tr>
											<td width="200" class="title">
												<strong>No Kliping</strong>
											</td>
											<td>:
												<strong>
													<?php echo $arsip->berita_id;?>/<?php echo $arsip->berita_namabagian;?>/<?php echo $arsip->berita_bulan;?>/<?php echo $arsip->berita_tahun;?>
												</strong>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Nama Koran</strong>
											</td>
											<td>:
												<?php echo $arsip->berita_koran;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Hari</strong>
											</td>
											<td>:
												<?php echo $arsip->berita_hari;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Tanggal Berita</strong>
											</td>
											<td>:
												<?php echo dateIndo1($arsip->berita_created);?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Tanggal Arsip</strong>
											</td>
											<td>:
												<?php echo dateIndo1($arsip->arsip_created);?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Halaman</strong>
											</td>
											<td>:
												<?php echo $arsip->berita_halaman;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Kolom</strong>
											</td>
											<td>:
												<?php echo $arsip->berita_kolom;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Kejadian</strong>
											</td>
											<td>:
												<?php echo $arsip->berita_kejadian;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Judul</strong>
											</td>
											<td>:
												<?php echo $arsip->berita_judul;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Terakhir Diubah</strong>
											</td>
											<td>:
												<?php echo dateIndo($arsip->arsip_updated);?>
											</td>
										</tr>
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
<?php }  ?>
<!-- ================================================== END DETAIL ================================================== -->
