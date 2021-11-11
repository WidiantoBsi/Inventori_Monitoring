$Nama = <?php echo $this->session->userdata('username'); ?>
$Email = <?php echo $this->session->userdata('email'); ?>
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
							<input type="text" class="form-control" name="Pengguna" id="nama" maxlength="80" minlength="5" value="<?php echo $Nama ?>" disabled>
							<label class="form-label">Nama Pengguna</label>
						</div>
					</div>
					<div class="form-group form-float">
						<div class="form-line">
							<input type="email" class="form-control" name="Email" id="nama" maxlength="80" minlength="5" value="<?php echo $Email ?>" disabled>
							<label class="form-label">Email</label>
						</div>
					</div>
					<div class="form-group form-float">
						<div class="form-line">
							<input type="email" class="form-control" name="Email" id="nama" maxlength="80" minlength="5" value="<?php echo $Email ?>" disabled>
							<label class="form-label">Password</label>
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