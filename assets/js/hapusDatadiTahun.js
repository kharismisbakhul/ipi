//Hapus Indikator
$('.hapus-data-tahun').on('click', function () {
	//Pilihan Tahun
	$.ajax({
		url: segments[0] + '/IpiApps/data/getTahun',
		method: 'get',
		dataType: 'json',
		success: function (dataTahun) {
			$('.modal-tahun-hapus').empty();
			$('.modal-tahun-hapus').append(`<option>Pilih Tahun</option>`);
			dataTahun.forEach(function (dataT) {
				$('#modal-tahun-hapus').append(`<option>` + dataT + `</option>`);
			});
		}
	});
});
