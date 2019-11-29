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
											<a class="btn btn-primary" href="<?php echo site_url();?>master/berita">
												<i class="fa fa-refresh"></i>
											</a>
										</div>
									</div>
								</form>
							</div>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<th>No</th>
										<th>No Kliping</th>
										<th>Nama Koran</th>
										<th>Hari</th>
										<th>Tanggal</th>
										<th class="text-center">Halaman</th>
										<th>Kolom</th>
										<th>Kejadian</th>
										<th>Judul</th>
										<th class="text-center">Arsip</th>
										<th class="text-center">Aksi</th>
									</thead>
									<tbody>
										<?php 
									$i	= $page+1;
									$like_berita[$cari]			= $q;
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_berita('', 'berita_created', 'DESC', $batas, $page, '', $like_berita) as $row){
									?>
										<tr>
											<td>
												<?php echo $i; ?>
											</td>
											<td>
											<?php echo $row->berita_id; ?>/<?php echo $row->berita_namabagian; ?>/<?php echo $row->berita_bulan; ?>/<?php echo $row->berita_tahun; ?>
											</td>
											<td>
												<?php echo $row->berita_koran;?>
											</td>
											<td>
												<?php echo $row->berita_hari;?>
											</td>
											<td>
												<?php echo dateIndo1($row->berita_created);?>
											</td>
											<td class="text-center">
												<?php echo $row->berita_halaman;?>
											</td>
											<td>
												<?php echo $row->berita_kolom;?>
											</td>
											<td>
												<?php echo $row->berita_kejadian;?>
											</td>
											<td>
												<?php echo $row->berita_judul;?>
											</td>
											<td class="text-center"> 
											<?php 
											$whereberita['berita_id'] = $row->berita_id;
											$whereberita2['b.berita_id'] = $row->berita_id;
											$data			= $this->ADM->count_all_arsip2($whereberita, '');
											if ($data > 0) { ?>
												Arsip sudah ditambah
										<?php	} else { ?>
							
											<a class="btn-update" href="<?php echo site_url();?>master/arsip/tambah/<?php echo $row->berita_id;?>">
												<i class="icon wb-plus"></i>
											</a>
									<?php  } ?>
											</td>
											<td class="text-center action">
												<a class="btn-update" href="<?php echo site_url();?>master/berita/edit/<?php echo $row->berita_id;?>">
													<i class="icon wb-pencil"></i>
												</a>
												<a class="btn-detail" href="<?php echo site_url();?>master/berita/detail/<?php echo $row->berita_id;?>">
													<i class="icon wb-info"></i>
												</a>
												<a class="btn-delete" href="javascript:;" data-id="<?php echo $row->berita_id;?>" data-toggle="modal" data-target="#modal-konfirmasi"
												title="<?php echo $row->berita_id;?>">
													<i class="icon wb-trash"></i>
												</a>
													<a class="btn-update" target="_blank" href="<?php echo site_url();?>master/beritapdf/<?php echo $row->berita_id;?>">
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
												<td class="text-center" colspan="10">Belum ada data!.</td>
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
												<?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'master/berita/view', $id=""); }?>
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
	<a href="<?php echo site_url();?>master/berita/tambah">
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
				<a href="javascript:;" class="btn btn-danger" id="hapus-berita">Ya</a>
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
						<h5 class="panel-title">Tambah Berita</h5>
					</div>
					<div class="panel-body container-fluid">
						<form action="<?php echo site_url();?>master/berita/tambah" method="post" id="exampleStandardForm" autocomplete="off">
							<div class="form-group form-material">
								<label class="control-label" for="inputText">ID Berita</label>
								<input type="number" class="form-control input-sm" id="berita_id" name="berita_id" placeholder="ID Berita" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Nama Bagian</label>
								<input type="text" class="form-control input-sm" value="HH" disabled required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Bulan</label>
								<select type="text" class="form-control input-sm" id="berita_bulan" name="berita_bulan" placeholder="Bulan" required/>
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
								</select>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Tahun</label>
								<select type="text" class="form-control input-sm" id="berita_tahun" name="berita_tahun" placeholder="Tahun" required/>
								<option value="2000">2000</option>
								<option value="2001">2001</option>
								<option value="2002">2002</option>
								<option value="2003">2003</option>
								<option value="2004">2004</option>
								<option value="2005">2005</option>
								<option value="2006">2006</option>
								<option value="2007">2007</option>
								<option value="2008">2008</option>
								<option value="2009">2009</option>
								<option value="2010">2010</option>
								<option value="2011">2011</option>
								<option value="2012">2012</option>
								<option value="2013">2013</option>
								<option value="2014">2014</option>
								<option value="2015">2015</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
								<option value="2019">2019</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option>
								</select>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Nama Koran</label>
								<input type="text" class="form-control input-sm" id="berita_koran" name="berita_koran" placeholder="Nama Koran" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Halaman</label>
								<input type="number" class="form-control input-sm" id="berita_halaman" name="berita_halaman" placeholder="Halaman" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Kolom</label>
								<input type="text" class="form-control input-sm" id="berita_kolom" name="berita_kolom" placeholder="Kolom" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Kejadian</label>
								<input type="text" class="form-control input-sm" id="berita_kejadian" name="berita_kejadian" placeholder="Kejadian" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Judul</label>
								<input type="text" class="form-control input-sm" id="berita_judul" name="berita_judul" placeholder="Judul" required/>
							</div>
							<div class='button center'>
								<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
								<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>master/berita'"
								/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>master/berita">
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
						<h5 class="panel-title">Edit Berita</h5>
					</div>
					<div class="panel-body container-fluid">
						<form action="<?php echo site_url();?>master/berita/edit/<?php echo $berita_id;?>" method="post" id="exampleStandardForm"
						autocomplete="off">
							<div class="form-group form-material">
								<label class="control-label" for="inputText">ID Berita</label>
								<input type="text" value="<?php echo $berita_id; ?>" class="form-control input-sm" id="berita_id" name="berita_id" placeholder="Masukan ID Berita"
								value="<?php echo $berita_id;?>" disabled required/>
							</div>

							<div class="form-group form-material">
								<label class="control-label" for="inputText">Nama Bagian</label>
								<input type="text" class="form-control input-sm" value="HH" disabled required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Bulan</label>
								<select type="text" class="form-control input-sm" id="berita_bulan" name="berita_bulan" placeholder="Bulan" required/>
								<option value="<?php echo $berita_bulan; ?>">
									<?php echo $berita_bulan; ?>
								</option>
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
								</select>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Tahun</label>
								<select type="text" class="form-control input-sm" id="berita_tahun" name="berita_tahun" placeholder="Tahun" required/>
								<option value="<?php echo $berita_tahun; ?>">
									<?php echo $berita_tahun; ?>
								</option>
								<option value="2000">2000</option>
								<option value="2001">2001</option>
								<option value="2002">2002</option>
								<option value="2003">2003</option>
								<option value="2004">2004</option>
								<option value="2005">2005</option>
								<option value="2006">2006</option>
								<option value="2007">2007</option>
								<option value="2008">2008</option>
								<option value="2009">2009</option>
								<option value="2010">2010</option>
								<option value="2011">2011</option>
								<option value="2012">2012</option>
								<option value="2013">2013</option>
								<option value="2014">2014</option>
								<option value="2015">2015</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
								<option value="2019">2019</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option>
								</select>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Nama Koran</label>
								<input type="text" value="<?php echo $berita_koran; ?>" class="form-control input-sm" id="berita_koran" name="berita_koran"
								placeholder="Masukan Nama Koran" value="<?php echo $berita_koran;?>" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Halaman</label>
								<input type="number" value="<?php echo $berita_halaman; ?>" class="form-control input-sm" id="berita_halaman" name="berita_halaman"
								placeholder="Halaman" value="<?php echo $berita_halaman;?>" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Kolom</label>
								<input type="text" value="<?php echo $berita_kolom; ?>" class="form-control input-sm" id="berita_kolom" name="berita_kolom"
								placeholder="Masukan Kolom" value="<?php echo $berita_kolom;?>" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Kejadian</label>
								<input type="text" value="<?php echo $berita_kejadian; ?>" class="form-control input-sm" id="berita_kejadian" name="berita_kejadian"
								placeholder="Masukan Kejadian" value="<?php echo $berita_kejadian;?>" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Judul</label>
								<input type="text" value="<?php echo $berita_judul; ?>" class="form-control input-sm" id="berita_judul" name="berita_judul"
								placeholder="Masukan Judul" value="<?php echo $berita_judul;?>" required/>
							</div>
							<div class='button center'>
								<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
								<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>master/berita'"
								/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>master/berita">
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
					<a href="<?php echo site_url();?>master/berita" class="bluee">
						<div class="button">
							<span>View Data</span>
							<button class="btn-raised btn btn-sm btn-floating blue" type="button">
								<i class="icon wb-eye" aria-hidden="true"></i>
							</button>
						</div>
					</a>
					<a href="<?php echo site_url();?>master/berita/hapus/<?php echo $berita->berita_id;?>">
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
												<?php echo $berita->berita_id; ?>/<?php echo $berita->berita_namabagian; ?>/<?php echo $berita->berita_bulan; ?>/<?php echo $berita->berita_tahun; ?>
												</strong>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Nama Koran</strong>
											</td>
											<td>:
												<?php echo $berita->berita_koran;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Hari</strong>
											</td>
											<td>:
												<?php echo $berita->berita_hari;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Tanggal</strong>
											</td>
											<td>:
												<?php echo dateIndo1($berita->berita_created);?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Halaman</strong>
											</td>
											<td>:
												<?php echo $berita->berita_halaman;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Kolom</strong>
											</td>
											<td>:
												<?php echo $berita->berita_kolom;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Kejadian</strong>
											</td>
											<td>:
												<?php echo $berita->berita_kejadian;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Judul</strong>
											</td>
											<td>:
												<?php echo $berita->berita_judul;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Terakhir Diubah</strong>
											</td>
											<td>:
												<?php echo dateIndo($berita->berita_updated);?>
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
	<a href="<?php echo site_url();?>master/beritapdf/<?php echo $berita->berita_id;?>">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-print" aria-hidden="true"></i>
		</button>
	</a>
</div>
<?php }  ?>
<!-- ================================================== END DETAIL ================================================== -->
