//Hapus Indikator
$('.hapus-indikator').on('click', function () {
	//Pilihan Dimensi
	$.ajax({
		url: segments[0] + '/IpiApps/data/getDimensi',
		method: 'get',
		dataType: 'json',

		success: function (data) {

			$('.temp-d').remove();
			$('#modal-dimensi-hapus').append(`<option class='temp-d'>Pilih Dimensi</option>`);
			$('#modal-subDimensi-hapus').append(`<option class='temp-sd'>Pilih Sub Dimensi</option>`);
			$('#modal-indikator-hapus').append(`<option class='temp-i'>Pilih Indikator</option>`);
			for (var i in data) {
				$('#modal-dimensi-hapus').append(`<option value='` + data[i].kode_d + `'  class='temp-d'>` + data[i].nama_dimensi + `</option>`);
			};

		}
	});

	//Milih Dimensi
	$('.modal-dimensi-hapus').on('change', function () {
		var a = $('#modal-dimensi-hapus').val();
		if (a) {
			$.ajax({
				url: segments[0] + '/IpiApps/data/getSubDimensi/' + a,
				method: 'get',
				dataType: 'json',
				success: function (dataSD) {
					console.log('subdimensi')
					console.log(dataSD)
					$('.temp-sd').remove()
					$('#modal-subDimensi-hapus').append(`<option class='temp-sd'>Pilih Sub Dimensi</option>`);
					for (var i in dataSD) {
						$('#modal-subDimensi-hapus').append(`<option value='` + dataSD[i].kode_sd + `' class='temp-sd'>` + dataSD[i].nama_sub_dimensi + `</option>`);
					};
				}
			})
		}
	})
	// Pilihan Indikator
	$('.modal-subDimensi-hapus').on('change', function () {
		var c = $('#modal-subDimensi-hapus').val();
		console.log('cek' + c)
		if (c) {
			$.ajax({
				url: segments[0] + '/IpiApps/data/getIndikator/' + c,
				method: 'get',
				dataType: 'json',
				success: function (dataI) {
					console.log(dataI)
					$('.temp-i').remove()
					$('#modal-indikator-hapus').append(`<option class='temp-i'>Pilih Indikator</option>`);
					for (var i in dataI) {
						$('#modal-indikator-hapus').append(`<option value="` + dataI[i].kode_indikator + `"  class='temp-i'>` + dataI[i].nama_indikator + `</option>`);
					};
				}
			})
		}
	});
})
