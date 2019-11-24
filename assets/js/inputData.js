var url = $(location).attr("href");
var segments = url.split("/");
// Function Data Dimensi
function selectDimensi() {
	nilai = 0;
	$(".nilai").val(nilai);
	let kode_d = $('.dimensi').val();
	let a = $('.dimensi').val();
	if (a) {
		// Pilihan Sub Dimensi
		$.ajax({
			url: segments[0] + '/IpiApps/data/getSubDimensi/' + kode_d,
			method: 'get',
			dataType: 'json',
			success: function (dataSD) {
				// console.log(dataSD)
				$('.temp-id-sd').remove();
				$('.temp-id-i').remove();
				$('.temp-id-t').remove();
				$('.nilai').removeAttr('value');

				for (var i in dataSD) {
					$('#subDimensi').append(`<option value='` + dataSD[i].kode_sd + `' class='temp-id-sd'>` + dataSD[i].nama_sub_dimensi + `</option>`);
				}
			}
		})
	}
}

//Input Data
$(window).on('load', function () {
	let nilai = 0;
	let status_user = $('#kode_user').attr('value');
	$(".nilai").val(nilai);
	$.ajax({
		url: segments[0] + '/IpiApps/data/getDimensi',
		method: 'get',
		dataType: 'json',
		success: function (data) {
			// console.log(data)
			$('.temp-id-d').remove();
			$('.temp-id-sd').remove();
			$('.temp-id-i').remove();
			$('.temp-id-t').remove();
			$('.nilai').removeAttr('value');
			if (status_user == 0) {
				$('#dimensi').append(`<option value='Pilih Dimensi'>Pilih Dimensi</option>`);
			}
			$('#subDimensi').append(`<option>Pilih Sub Dimensi</option>`);
			$('#indikator').append(`<option>Pilih Indikator</option>`);
			$('.tahun').empty();
			$('#tahun').append(`<option>Pilih Tahun</option>`);

			for (var i in data) {
				if (status_user == data[i].kode_d || status_user == 0) {
					$('#dimensi').append(`<option value='` + data[i].kode_d + `'  class='temp-id-d'>` + data[i].nama_dimensi + `</option>`);
				}
			}

			if (status_user != 0) {
				selectDimensi();
			}
		}
	});

	//Milih Dimensi
	$('.dimensi').on('change', function () {
		selectDimensi();
	})
	//Milih Sub Dimensi
	$('.subDimensi').on('change', function () {
		nilai = 0;
		$(".nilai").val(nilai);
		var c = $('#subDimensi').val();

		if (c) {
			// Pilihan Indikator
			$.ajax({
				url: segments[0] + '/IpiApps/data/getIndikator/' + c,
				method: 'get',
				dataType: 'json',
				success: function (dataI) {
					// console.log(dataI)
					$('.temp-id-i').remove();
					$('.temp-id-t').remove();
					$('.nilai').removeAttr('value');


					for (var i in dataI) {
						$('#indikator').append(`<option value="` + dataI[i].kode_indikator + `" class='temp-id-i'>` + dataI[i].nama_indikator + `</option>`);
					}
				}
			})
		}
	})
	//Milih Indikator
	//Normal
	$('.indikator').on('change', function () {
		nilai = 0;
		$(".nilai").val(nilai);
		$('.temp-id-t').remove();
		ind = $('#indikator').val();
		let cek = $('.nilai').val()
		// console.log('cuy = ' + cek)
		//Pilihan Tahun
		if (ind) {
			//Append Tahun
			$.ajax({
				url: segments[0] + '/IpiApps/data/getTahun',
				method: 'get',
				dataType: 'json',
				success: function (dataTahun) {
					// console.log(dataTahun)
					$('.temp-id-t').remove();
					$('.nilai').removeAttr('value');

					for (var i in dataTahun) {
						$('#tahun').append(`<option class="temp-id-t" value="` + dataTahun[i] + `">` + dataTahun[i] + `</option>`);
					}

				}
			})
		}
	})
	//Milih Tahun
	$('.tahun').on('change', function () {
		$(".nilai").val(nilai);
		tahun = $('#tahun').val();
		if (tahun) {
			$.ajax({
				url: segments[0] + '/IpiApps/data/getNilai?i=' + ind + '&t=' + tahun,
				method: 'get',
				dataType: 'json',
				success: function (nilai_indikator) {
					// console.log(nilai_indikator)
					$(".nilai").removeAttr('value');
					nilai = parseFloat(nilai_indikator['nilai']).toFixed(2)
					$(".nilai").val(nilai);
				}

			})
		}
	})


	$('.hps').on('click', function () {
		let indikator = $('#modal-indikator-hapus').val()
		Swal.fire({
			title: 'Are you sure?',
			text: "",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Logout'
		}).then(function (result) {
			if (result.value) {
				window.location = window.location.origin + "/IpiApps/auth/logout";
			}
		})
	})
})

//Regex
$('.nilai').on('change', function () {
	var length = $('.nilai').val().length;
	var value = $('.nilai').val();
	var cek = value.search("[A-Za-z, ]");
	$('.nilai').attr('pattern', "[^A-Za-z, ]" + "{" + length + "}")
	if (cek != -1) {
		$('.nilai').attr('onchange', "setCustomValidity('Masukkan angka')")
	} else {
		$('.nilai').attr('onchange', "setCustomValidity('')")
	}
})
