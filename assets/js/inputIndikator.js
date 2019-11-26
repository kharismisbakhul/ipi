//Tambah Indikator
$('.tambah-indikator').on('click', function () {
	//Pilihan Dimensi
	$.ajax({
		url: segments[0] + '/IpiApps/data/getDimensi',
		method: 'get',
		dataType: 'json',

		success: function (data) {
			console.log(data)
			$('.temp-i-d').remove()
			$('.temp-i-sd').remove()
			$('#modal-dimensi').append(`<option  class='temp-i-d'>Pilih Dimensi</option>`);
			$('#modal-subDimensi').append(`<option  class='temp-i-sd'>Pilih Sub Dimensi</option>`);
			for (var i in data) {
				$('#modal-dimensi').append(`<option value='` + data[i].kode_d + `'  class='temp-i-d'>` + data[i].nama_dimensi + `</option>`);
			};

		}
	});

	//Milih Dimensi
	$('.modal-dimensi').on('change', function () {
		$('.temp-i-sd').remove();
		var a = $('#modal-dimensi').val();
		if (a) {
			// Pilihan Sub Dimensi
			$.ajax({
				url: segments[0] + '/IpiApps/data/getSubDimensi/' + a,
				method: 'get',
				dataType: 'json',
				success: function (dataSD) {
					for (var i in dataSD) {
						$('#modal-subDimensi').append(`<option value='` + dataSD[i].kode_sd + `' class='temp-i-sd'>` + dataSD[i].nama_sub_dimensi + `</option>`);
					}
				}
			});
		}
	})
});