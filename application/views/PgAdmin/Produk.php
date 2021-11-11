<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>Produk</h2>
		</div>

		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>Add Produk</h2>
						<ul class="header-dropdown m-r--5">
							<li>
								<a href="javascript:void(0);" onclick="reset()" data-toggle="cardloading" data-loading-effect="ios">
									<i class="material-icons">loop</i>
								</a>
							</li>
						</ul>
					</div>
					<div class="body">
						<form action="<?php echo base_url('Admin/').'AddBarang'; ?>" method="post" enctype="multipart/form-data" id="form_advanced_validation" >
							<div class="form-group form-float">
								<div class="form-line">
									<input type="hidden" name="ID"  value="<?php echo $ID ?>">
									<input type="text" class="form-control" name="Barang" id="nama" maxlength="80" minlength="5" required>
									<label class="form-label">Nama Barang</label>
								</div>
								<div class="help-info">Min. 5, Max. 80 characters</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="number" class="form-control" name="Item" id="item" required>
									<label class="form-label">Jumlah Item</label>
								</div>
								<div class="help-info">Item</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="date" class="form-control" name="date" id="tgl" required>
									<label class="form-label"></label>
								</div>
								<div class="help-info">MM-DD-YYYY format</div>
							</div>
							<button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('alert');?>" ></div>
		<!-- Basic Examples -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>
							DATA PRODUK
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
										<th>Tanggal</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no=1;
									foreach ($hasil as $item)
										{ $id = $item->Id_Barang;
											?>
											<tr>
												<td><?php echo $no++;?></td>
												<td><?php echo $item->Barang ;?></td>
												<td><?php echo $item->Item ;?></td>
												<td><?php echo $item->Tanggal ;?></td>
												<td><?php echo $item->Status ;?></td>
												<td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#EditBrg<?php echo $id;?>" title="Add"><i class="fa fa-edit "></i> Edit</button>
													<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delet<?php echo $id;?>" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</button></td>
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
			foreach($hasil as $row){
				$Id = $row->Id_Barang;
				$Nama = $row->Barang;
				$Item = $row->Item;
				$Tgl = $row->Tanggal;
				?>
				<div class="modal fade" id="EditBrg<?php echo $Id;?>" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<form action="<?php echo base_url('Admin/').'EditBrg'; ?>" method="post" enctype="multipart/form-data">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="largeModalLabel">Edit Barang</h4>
								</div>
								<div class="modal-body">
									<div class="form-group form-float">
										<div class="form-line">
											<input type="hidden" name="ID"  value="<?php echo $Id ?>">
											<input type="text" class="form-control" name="Barang" id="nama" maxlength="80" minlength="5" value="<?php echo $Nama ?>" required>
											<label class="form-label">Nama Barang</label>
										</div>
										<div class="help-info">Min. 5, Max. 80 characters</div>
										<label for="exampleFormControlInput1">Nama Barang</label>
									</div>

									<div class="form-group form-float">
										<div class="form-line">
											<input type="number" class="form-control" name="Item" value="<?php echo $Item ?>" required/>
											<label class="form-label">Item</label>
										</div>
										<div class="help-info">Jumlah Barang</div>
										<label for="exampleFormControlInput1">Item</label>
									</div>

									<div class="form-group form-float">
										<div class="form-line">
											<input type="date" class="form-control" name="Tgl" value="<?php echo $Tgl ?>" required/>
											<label class="form-label"></label>
										</div>
										<div class="help-info">MM-DD-YYYY format</div>
										<label for="exampleFormControlInput1"></label>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-link waves-effect">EDIT</button>
								</div>
							</form>
						</div>
					</div>
				</div>

			<!-- =========================== Delet Produk ============================== -->
				<div class="modal animated shake" id="delet<?php echo $Id; ?>">
					<div class="modal-dialog modal-dialog-scrollable" role="document">
						<div class="modal-content" style="margin-top:100px;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" style="text-align:center;">Hapus Data Produk?</h4>
							</div>
							<form action="<?php echo base_url('Admin').'/HapusBrg'; ?>" method="post">
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
		<script type="text/javascript">
			function reset(){
				document.getElementById("nama").value = "";
				document.getElementById("item").value = "";
				document.getElementById("tgl").value = "";
			}
		</script>