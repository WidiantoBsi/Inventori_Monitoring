const flashdata = $('.flash-data').data('flashdata');

if (flashdata=='Berhasil') {
	swal("Berhasil", "Data Berhasil disimpan.", "success")
}else if(flashdata=='Hapus'){
	swal({
		title: "Data Terhapus.",
		text: "Data Berhasil Terhapus.",
		type: "info",
		confirmButtonText: "OK",
		closeOnConfirm: false
	});
}else if(flashdata=='Update') {
	swal("Berhasil", "Data Berhasil Update!", "info");
}else if (flashdata=='Gagal') {
	swal("Gagal!", "Data Yang Di Input Salah!", "warning");
}