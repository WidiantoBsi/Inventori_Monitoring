<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>Pemesanan</h2>
		</div>

		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>Add Pemesanan</h2>
						<ul class="header-dropdown m-r--5">
							<li>
								<a href="javascript:void(0);" onclick="reset()" data-toggle="cardloading" data-loading-effect="ios">
									<i class="material-icons">loop</i>
								</a>
							</li>
						</ul>
					</div>
					<div class="body">
						<form action="<?php echo base_url('AdmDevisi/').'PsnDevisi'; ?>" method="post" enctype="multipart/form-data" id="form_advanced_validation" >
							<div class="form-group form-float">
								<div class="form-line">
									<p>
										<b>Produk</b>
									</p>
									<select class="form-control" name="Brg">
										<?php foreach ($Barang as $aa){ ?>
											<option value="<?php echo $aa->Id_Barang ?>"><?php echo $aa->Barang ;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<p>
										<b>Item</b>
									</p>
									<input min="1" type="number" class="form-control" name="item" placeholder="Item" id="item" required>
									<!-- <div class="help-info">Max: <?php echo $aa->Item ?></div> -->
								</div>
							</div>
							
							<div class="form-group form-float">
								<div class="form-line">
									<input type="date" class="form-control" name="date" id="tgl" required>
									<label class="form-label"></label>
								</div>
								<div class="help-info">MM-DD-YYYY format</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<p>
										<b>Keterangan</b>
									</p>
									<input type="hidden" name="IdDev"  value="<?php echo $this->session->userdata('id'); ?>">
									<input min="0" type="text" name="Keterangan" class="form-control" placeholder="Keterangan" id="ket" required>
								</div>
							</div>
							<button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('alert');?>" ></div>
		<?php if ($this->session->flashdata('alert2')) { ?>
		<div class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Data Sudah Ada sebelumnya, cek kembali!
		</div>
		<?php } ?>

		<!-- Basic Examples -->
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
										<th>Devisi</th>
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
											<td><?php echo $row->Tanggal ;?></td>
											<td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#EditBrg<?php echo $row->Id_barang;?>" title="Add"><i class="fa fa-edit "></i></button>
												<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delet<?php echo $row->Id_barang;?>" title="Hapus"><i class="fa fa-trash-o"></i></button></td>
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

	<!--  Modal Edit Admin -->
	<?php 
	foreach($Pesanan as $rw){
		$id = $rw->Id_barang;
		$IdDev = $rw->Id_Devisi;
		$Item = $rw->Item;
		$Tgl = $rw->Tanggal;
		$where = array('Id_Devisi' => $IdDev);
		$DV = $this->DB_SIS->edit_data($where,'db_devisi')->result();
		foreach ($DV as $bc){
			$NamaDV = $bc->NamaDevisi;
		}
		$where2 = array('Id_barang' => $id);
		$BR = $this->DB_SIS->edit_data($where2,'db_barang')->result();
		foreach ($BR as $br){
			$NamaBR = $br->Barang;
		}
		?>
		<div class="modal fade" id="EditBrg<?php echo $id;?>" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form action="<?php echo base_url('AdmDevisi/').'EditPesen'; ?>" method="post" enctype="multipart/form-data">
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
									<input type="text" class="form-control" name="Brg" value="<?php echo $NamaBR ?>" disabled>
								</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<p>
										<b>Item</b>
									</p>
									<input type="hidden" name="ID"  value="<?php echo $id ?>">
									<input min="0" type="number" class="form-control" name="item" value="<?php echo $Item ?>" required>
								</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<p>
										<b>Devisi</b>
									</p>
									<input type="hidden" name="Devisi"  value="<?php echo $IdDev ?>">
									<input min="1" type="text" class="form-control" name="Brg" value="<?php echo $NamaDV ?>" disabled>
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
							<button type="submit" class="btn btn-link waves-effect">EDIT</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- =========================== Delet Pesanan ============================== -->
		<div class="modal animated shake" id="delet<?php echo $id; ?>">
			<div class="modal-dialog modal-dialog-scrollable" role="document">
				<div class="modal-content" style="margin-top:100px;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" style="text-align:center;">Hapus Data Pemesanan?</h4>
					</div>
					<form action="<?php echo base_url('AdmDevisi').'/HapusPesen'; ?>" method="post">
						<div class="modal-body">
							<input type="hidden" name="Id" value="<?php echo $id?>">
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
	<script type="text/javascript">
		function reset(){
			document.getElementById("item").value = "";
			document.getElementById("ket").value = "";
			document.getElementById("tgl").value = "";
		}
	</script>