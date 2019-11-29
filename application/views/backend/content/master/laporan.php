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
								</form>
							</div>

							<div class="navigation-btn">
								<form action="" method="post" id="form">
									<div class='row margin-bottom'>
										<div class='btn-search'>Cari Laporan per Bulan :</div>
										<div class='col-md-3 col-sm-12'>
											<div class='button-search'>
												<select type="text" value="<?php echo $month ?>" class="form-control" id="month" name="month" placeholder="Bulan"
												required/>
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
										</div>
										<div class='col-md-3 col-sm-12 select-search'>
											<select type="text" value="<?php echo $year ?>" class="form-control" id="year" name="year" placeholder="Tahun"
											required/>
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
									</div>
									<div class='btn-navigation'>
										<div class='pull-right'>

											<button type="submit" name="kirim" class="btn btn-primary" type="button">
												Cari
											</button>
											<a class="btn btn-primary" href="<?php echo site_url();?>master/laporan">
												<i class="fa fa-refresh"></i>
											</a>
										</div>
									</div>
								</form>
							</div>

							<?php if ($this->input->post('month')) {?>
							<div style="color: red; margin-bottom: 20px;" class="text-center">Pencarian Bulan : <?php echo $this->input->post('month'); ?> - Tahun : <?php echo $this->input->post('year'); ?></div>
							<?php } ?>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<th width=100>No</th>
										<th width=200>Tanggal</th>
										<th width=300>Judul</th>
										<th width=250>Kejadian</th>
									</thead>
									<tbody>
										<?php 
									$i	= $page+1;
									
									$like_berita[$cari]			= $q;
									if ($this->input->post('month')) {
										$month = $this->input->post('month');
										$year = $this->input->post('year');
										}

								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_berita2('', 'berita_created', 'DESC', $batas, $page, $month, $year, $like_berita) as $row){
									?>
										<tr>
											<td>
												<?php echo $i; ?>
											</td>
											<td>
												<?php echo dateIndo1($row->berita_created);?>
											</td>
											<td>
												<?php echo $row->berita_judul;?>
											</td>
											<td>
												<?php echo $row->berita_kejadian;?>
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
	<?php 	if ($jml_data > 0){if ($this->input->post('year')) { 
	?>
	<a href="<?php echo site_url();?>master/laporanpdf/<?php echo $this->input->post('year'); ?>/<?php echo $this->input->post('month'); ?>">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-print" aria-hidden="true"></i>
		</button>
	</a>
	<?php } else {?>
		<a href="<?php echo site_url();?>master/laporanpdf">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-print" aria-hidden="true"></i>
		</button>
	</a>
	<?php } }?>
</div>
<?php }  ?>
<!-- ================================================== END TAMBAH ================================================== -->
