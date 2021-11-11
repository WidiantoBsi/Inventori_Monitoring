<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>Pemesanan</h2>
		</div>

		<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('alert');?>" ></div>
		<!-- Data Pemesanan -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>
							DATA PEMESANAN
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
										<th>Keterangan</th>
										<th>Tanggal</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no=1;
									foreach ($devisi as $rw){ //data pesanan
										$idbrg = $rw->Id_barang;
										$where = array('Id_Barang' => $idbrg);
										$DV = $this->DB_SIS->edit_data($where,'db_barang')->result();
										foreach ($DV as $bc){
											$Brg = $bc->Barang;
										}
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $Brg ;?></td>
											<td><?php echo $rw->Item ;?></td>
											<td><?php echo $rw->Keterangan ;?></td>
											<td><?php echo $rw->Tanggal ;?></td>
											<td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Trima<?php echo $rw->Id_Pesanan;?>" title="Terima"><i class="fa fa-download "></i></button>
												<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#Kirim<?php echo $rw->Id_Pesanan;?>" title="Kirim"><i class="fa fa-paper-plane"></i></button></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Data Terima Barang -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								DATA Terima Barang
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
										foreach ($terima as $row){ 
											$id = $row->ID;
											$idbrg = $row->Id_Barang;
											$where = array('Id_Barang' => $idbrg);
											$DBC = $this->DB_SIS->edit_data($where,'db_barang')->result();
											foreach ($DBC as $bb) {
												$Brg = $bb->Barang;
											}
											$where2 = array('Id_Devisi' => $row->Id_Devisi); //cek nama Devisi
											$DI = $this->DB_SIS->edit_data($where2,'db_devisi')->result();
											foreach ($DI as $d){
												$Nama = $d->NamaDevisi;
											}
											?>
											<tr>
												<td><?php echo $no++;?></td>
												<td><?php echo $Brg ;?></td>
												<td><?php echo $row->Item ;?></td>
												<td><?php echo $Nama ;?></td>
												<td><?php echo $row->Tanggal ;?></td>
												<td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Print<?php echo $row->ID;?>" title="Print"><i class="fa fa-print "> Print</i></button>
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

		<!--  Modal Add Terima -->
		<?php 
		foreach($devisi as $dt){ // data penerimaaan
			$ID = $dt->Id_Pesanan;
			$Id = $dt->Id_barang;
			$Item = $dt->Item;
			$Tgl = $dt->Tanggal;
			$IdDev = $dt->Id_Devisi;
			$where = array('Id_barang' => $Id); //cek nama barang
			$DVI = $this->DB_SIS->edit_data($where,'db_barang')->result();
			foreach ($DVI as $bcd){
				$NamaBrg = $bcd->Barang;
			}
			$where2 = array('Id_Devisi' => $IdDev); //cek nama Devisi
			$DV = $this->DB_SIS->edit_data($where2,'db_devisi')->result();
			foreach ($DV as $bd){
				$NamaDV = $bd->NamaDevisi;
			}
			?>
			<div class="modal fade" id="Trima<?php echo $ID;?>" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<form action="<?php echo base_url('AdmDevisi/').'AddTerima'; ?>" method="post" enctype="multipart/form-data">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="largeModalLabel">Terima Barang</h4>
							</div>
							<div class="modal-body">
								<div class="form-group form-float">
									<div class="form-line">
										<p>
											<b>Nama Barang</b>
										</p>
										<input type="hidden" name="ID"  value="<?php echo $Id ?>">
										<input type="text" class="form-control" name="Brg" value="<?php echo $NamaBrg ?>" disabled>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<p>
											<b>Item</b>
										</p>
										<input min="0" max="<?php echo $Item?>" type="number" class="form-control" name="item" value="<?php echo $Item ?>" required>
										<div class="help-info">Max: <?php echo $Item?></div>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<p>
											<b>Devisi</b>
										</p>
										<input type="hidden" name="DEV"  value="<?php echo $IdDev ?>">
										<input type="text" class="form-control" name="DEV" value="<?php echo $NamaDV ?>" disabled>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="date" class="form-control" name="date" value="<?php echo $Tgl ?>" required>
										<label class="form-label"></label>
									</div>
									<div class="help-info">MM-DD-YYYY format</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-link btn-primary">Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- =========================== Kirim Pesanan ============================== -->
			<div class="modal fade" id="Kirim<?php echo $ID;?>" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<form action="<?php echo base_url('AdmDevisi/').'AddKirim'; ?>" method="post" enctype="multipart/form-data">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="largeModalLabel">Kirim Barang</h4>
							</div>
							<div class="modal-body">
								<div class="form-group form-float">
									<div class="form-line">
										<p>
											<b>Nama Barang</b>
										</p>
										<input type="hidden" name="ID"  value="<?php echo $Id ?>"> <!-- Id Barang -->
										<input type="text" class="form-control" name="Brg" value="<?php echo $NamaBrg ?>" disabled>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<p>
											<b>Item</b>
										</p>
										<input type="hidden" name="item"  value="<?php echo $Item ?>">
										<input type="text" class="form-control" name="item" value="<?php echo $Item ?>" disabled>
									</div>
								</div>
								
								<div class="form-group form-float">
									<div class="form-line">
										<p>
											<b>Devisi</b>
										</p>
										<select class="form-control" name="Devisi">
											<?php foreach ($DEV as $aa){ ?>
												<option value="<?php echo $aa->Id_Devisi ?>"><?php echo $aa->NamaDevisi ;?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<p>
											<b>Tanggal</b>
										</p>
										<input type="hidden" name="idPsn"  value="<?php echo $ID ?>">
										<input type="date" class="form-control" name="date" value="<?php echo $Tgl ?>" required>
										<label class="form-label"></label>
									</div>
									<div class="help-info">MM-DD-YYYY format</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-link btn-primary">Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?php } ?>
		<script type="text/javascript">
			function reset(){
				document.getElementById("item").value = "";
				document.getElementById("ket").value = "";
				document.getElementById("tgl").value = "";
			}
		</script>