<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>User Pengguna</h2>
		</div>

		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>Add Pengguna</h2>
						<ul class="header-dropdown m-r--5">
							<li>
								<a href="javascript:void(0);" onclick="reset()" data-toggle="cardloading" data-loading-effect="ios">
									<i class="material-icons">loop</i>
								</a>
							</li>
						</ul>
					</div>
					<div class="body">
						<form action="<?php echo base_url('Admin/').'AddPengguna'; ?>" method="post" enctype="multipart/form-data" id="form_advanced_validation" >
							<label for="email_address">ID Pengguna</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" class="form-control" value="<?php echo $ID ?>" disabled>
									<input type="hidden" name="ID" value="<?php echo $ID ?>">
								</div>
							</div>
							<label for="email_address">Nama Pengguna</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="Nama" class="form-control" name="Pengguna" placeholder="Nama Pengguna">
								</div>
							</div>
							<label for="email_address">Email</label>
							<div class="form-group">
								<div class="form-line">
									<input type="email" id="Email" class="form-control" name="Email" placeholder="Email">
								</div>
							</div>
							<label for="email_address">Devisi</label>
							<div class="form-group">
								<div class="form-line">
									<select class="form-control" name="Dev">
										<option value="<?php echo 'Y' ?>"><?php echo 'Admin' ;?></option>
										<?php foreach ($Dev as $aa){ ?>
											<option value="<?php echo $aa->Id_Devisi ?>"><?php echo $aa->NamaDevisi ;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<br>
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
										<th>ID User</th>
										<th>Nama Pengguna</th>
										<th>Email</th>
										<th>Devisi</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no=1;
									foreach ($User as $item){
										$id = $item->Id_Adm;
										$idDev = $item->Id_Devisi;
										$where = array('Id_Devisi' => $idDev);
										$DbDEv = $this->DB_SIS->edit_data($where,'db_devisi')->result();
										foreach ($DbDEv as $ab){
										$NamaDV = $ab->NamaDevisi;
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $id ;?></td>
											<td><?php echo $item->Nama ;?></td>
											<td><?php echo $item->Email ;?></td>
											<td><?php echo $NamaDV ;?></td>
											<td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#EditUser<?php echo $id;?>" title="Edit"><i class="fa fa-edit "></i> Edit</button>
												<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delet<?php echo $id;?>" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</button></td>
											</tr>
										<?php } } ?>
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
	foreach($User as $row){
		$Id = $row->Id_Adm;
		$Nama = $row->Nama;
		$Email = $row->Email;
		?>
		<div class="modal fade" id="EditUser<?php echo $Id;?>" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form action="<?php echo base_url('Admin/').'EditUser'; ?>" method="post" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="largeModalLabel">Edit Pengguna</h4>
						</div>
						<div class="modal-body">
							<div class="form-group form-float">
								<div class="form-line">
									<input type="hidden" name="ID"  value="<?php echo $Id ?>">
									<input type="text" class="form-control" name="Pengguna" id="nama" maxlength="80" minlength="5" value="<?php echo $Nama ?>" required>
									<label class="form-label">Nama Pengguna</label>
								</div>
							</div>
								<div class="form-group form-float">
								<div class="form-line">
									<input type="email" class="form-control" name="Email" id="nama" maxlength="80" minlength="5" value="<?php echo $Email ?>" required>
									<label class="form-label">Email</label>
								</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<p>
											<b>Devisi</b>
										</p>
										<select class="form-control" name="Dev">
											<?php 
											foreach ($Dev as $aa){ ?>
												<option value="<?php echo $aa->Id_Devisi; ?>"><?php echo $aa->NamaDevisi ;?></option>
											<?php } ?>
										</select>
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

		<!-- =========================== Delet Produk ============================== -->
		<div class="modal animated shake" id="delet<?php echo $Id; ?>">
			<div class="modal-dialog modal-dialog-scrollable" role="document">
				<div class="modal-content" style="margin-top:100px;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" style="text-align:center;">Hapus Data Pengguna?</h4>
					</div>
					<form action="<?php echo base_url('Admin').'/HapusUser'; ?>" method="post">
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
			document.getElementById("Nama").value = "";
			document.getElementById("Email").value = "";
		}
	</script>