<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>Pesanan</h2>
		</div>

		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>
							DATA PESANAN
						</h2>
					</div>
					<div class="body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="example">
								<thead>
									<tr>
										<th>No</th>
										<th>Barang</th>
										<th>Item</th>
										<th>Devisi</th>
										<th>Keterangan</th>
										<th>Tanggal</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no=1;
									foreach ($Pesanan as $row){ 
										$id = $row->Id_barang;
										$idbrg = $row->Id_Devisi;
										$where = array('Id_Barang' => $id);
										$DB = $this->DB_SIS->edit_data($where,'db_barang')->result();
										foreach ($DB as $b) {
											$Brg = $b->Barang;
										}
										$where2 = array('Id_Devisi' => $idbrg);
										$DV = $this->DB_SIS->edit_data($where2,'db_devisi')->result();
										foreach ($DV as $bc){
											$NamaDV = $bc->NamaDevisi;
										}
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $Brg ;?></td>
											<td><?php echo $row->Item ;?></td>
											<td><?php echo $NamaDV ;?></td>
											<td><?php echo $row->Keterangan ;?></td>
											<td><?php echo $row->Tanggal ;?></td>
											<td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#EditBrg<?php echo $row->Id_Pesanan;?>" title="Kirim"><i class="fa fa-edit"></i></button>
											</button>
											<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delet<?php echo $row->Id_Pesanan;?>" title="Hapus"><i class="fa fa-trash-o"></i></button>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('alert');?>" ></div>
	<!-- Data Pesanan Devisi -->
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>
						DATA PESANAN DEVISI
					</h2>
				</div>
				<div class="body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="example">
							<thead>
								<tr>
									<th>No</th>
									<th>Barang</th>
									<th>Item</th>
									<th>Devisi</th>
									<th>Tanggal</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								foreach ($Detail as $DB){ 
									$id = $DB->Id_Devisi;
									$idbrg = $DB->Id_barang;
									$where = array('Id_Barang' => $idbrg);
									$D = $this->DB_SIS->edit_data($where,'db_barang')->result();
									foreach ($D as $b) {
										$Brg = $b->Barang;
									}
									$where2 = array('Id_Devisi' => $id);
									$DV = $this->DB_SIS->edit_data($where2,'db_devisi')->result();
									foreach ($DV as $bc){
										$NamaDV = $bc->NamaDevisi;
									}
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $Brg ;?></td>
										<td><?php echo $DB->Item ;?></td>
										<td><?php echo $NamaDV ;?></td>
										<td><?php echo $DB->Tanggal ;?></td>
										<td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Kirim<?php echo $DB->Tanggal;?>" title="Add"><i class="fa fa-paper-plane"> Kirim</i>
										</td>
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
</section>

<!--  Modal Edit Pesanan -->
<?php 
foreach($Pesanan as $rw){
	$Id = $rw->Id_Pesanan;
	$idbrg = $rw->Id_barang;
	$IdDev = $rw->Id_Devisi;
	$Item = $rw->Item;
	$Tgl = $rw->Tanggal;
	$Ket = $rw->Keterangan;
	$where = array('Id_Devisi' => $IdDev);
	$DV = $this->DB_SIS->edit_data($where,'db_devisi')->result();
	foreach ($DV as $bc){
		$NamaDV = $bc->NamaDevisi;
	}
	$where2 = array('Id_barang' => $idbrg);
	$BR = $this->DB_SIS->edit_data($where2,'db_barang')->result();
	foreach ($BR as $cc){
		$Barang = $cc->Barang;
		$Jml = $cc->Item;
	}
	?>
	<div class="modal fade" id="EditBrg<?php echo $Id;?>" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<form action="<?php echo base_url('Admin/').'EditPesen'; ?>" method="post" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="largeModalLabel">Edit Pesanan</h4>
					</div>
					<div class="modal-body">
						<div class="form-group form-float">
							<div class="form-line">
								<p>
									<b>Produk</b>
								</p>
								<input type="text" class="form-control" name="Brg" value="<?php echo $Barang ?>" disabled>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
								<p>
									<b>Item</b>
								</p>
								<input type="hidden" name="ID"  value="<?php echo $Id ?>">
								<input min="0" max="<?php echo $Jml ?>" type="number" class="form-control" name="item" value="<?php echo $Item ?>" required>
								<div class="help-info">Max: <?php echo $Jml; ?></div>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
								<p>
									<b>Devisi</b>
								</p>
								<select class="form-control" name="Devisi">
									<?php foreach ($devisi as $ab){ ?>
										<option value="<?php echo $ab->Id_Devisi ?>"><?php echo $ab->NamaDevisi ;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
								<input type="date" class="form-control" name="date" value="<?php echo $Tgl ?>" required>
								<label class="form-label"></label>
							</div>
							<div class="help-info">MM-DD-YYYY format</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
								<p>
									<b>Keterangan</b>
								</p>
								<input type="text" name="Keterangan" class="form-control" value="<?php echo $Ket ?>" required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-link waves-effect">EDIT</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- =========================== Delet Pesanan ============================== -->
	<div class="modal animated shake" id="delet<?php echo $Id; ?>">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content" style="margin-top:100px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" style="text-align:center;">Hapus Data Pesanan?</h4>
				</div>
				<form action="<?php echo base_url('Admin').'/HapusPesen'; ?>" method="post">
					<div class="modal-body">
						<input type="hidden" name="Id" value="<?php echo $Id?>">
						Apakah Anda yakin ingin menghapus data ini?
					</div>   
					<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
						<button type="submit" class="btn-sm btn-danger">Delete</button>
						<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>
<!-- Modal Kirim Barang Ke devisi -->
<?php 
foreach($Detail as $Dev){
	$idbrg = $Dev->Id_barang;
	$IdDev = $Dev->Id_Devisi;
	$Item = $Dev->Item;
	$Tgl = $Dev->Tanggal;
	$where = array('Id_Devisi' => $IdDev);
	$DIV = $this->DB_SIS->edit_data($where,'db_devisi')->result();
	foreach ($DIV as $bic){
		$Nama = $bic->NamaDevisi;
	}
	$where2 = array('Id_barang' => $idbrg);
	$BRG = $this->DB_SIS->edit_data($where2,'db_barang')->result();
	foreach ($BRG as $cci){
		$BrgDev = $cci->Barang;
		$Ttl = $cci->Item;
	}
	?>
	<div class="modal fade" id="Kirim<?php echo $Tgl;?>" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<form action="<?php echo base_url('Admin/').'KirimDev'; ?>" method="post" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="largeModalLabel">Kirim Barang</h4>
					</div>
					<div class="modal-body">
						<div class="form-group form-float">
							<div class="form-line">
								<p>
									<b>Produk</b>
								</p>
								<input type="hidden" name="IdPesan"  value="<?php echo $ID ?>">
								<input type="text" class="form-control" name="Brg" value="<?php echo $BrgDev ?>" disabled>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
								<p>
									<b>Item</b>
								</p>
								<input type="hidden" name="Brg"  value="<?php echo $idbrg ?>">
								<input min="0" max="<?php echo $Ttl ?>" type="number" class="form-control" name="item" value="<?php echo $Item ?>" required>
								<div class="help-info">Max: <?php echo $Ttl; ?></div>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
								<p>
									<b>Devisi</b>
								</p>
								<input type="hidden" name="Devisi"  value="<?php echo $IdDev ?>">
								<input type="text" class="form-control" value="<?php echo $Nama ?>" disabled>
							</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
								<input type="date" class="form-control" name="date" value="<?php echo $Tgl ?>" required>
								<label class="form-label"></label>
							</div>
							<div class="help-info">MM-DD-YYYY format</div>
						</div>
						<div class="form-group form-float">
							<div class="form-line">
								<p>
									<b>Keterangan</b>
								</p>
								<input type="text" name="Keterangan" class="form-control" placeholder="Keterangan" required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-link waves-effect">Kirim</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>