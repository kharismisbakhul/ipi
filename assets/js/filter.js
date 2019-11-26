$(window).on("load", function () {
	$('.tombol').addClass('pMuncul');
	$('.box').addClass('bMuncul');
	$('.box2').addClass('bMuncul');
	//Pilihan Dimensi
	$.ajax({
		url: segments[0] + "/IpiApps/data/getTahun",
		method: "get",
		dataType: "json",

		success: function (data) {
			// alert("SUKSES");
			$("#start-date").append(
				`<option value= "` + data[0] + `">Pilih Tahun</option>`
			);
			$("#end-date").append(
				`<option value= "` + data[data.length - 1] + `">Pilih Tahun</option>`
			);
			data.forEach(function (dataTahun) {
				$("#start-date").append(
					`<option value="` + dataTahun + `">` + dataTahun + `</option>`
				);
			});
			$("#start-date").on("change", function () {
				var tahun_awal = $("#start-date").val();
				$("#end-date").html(``);
				$("#end-date").append(`<option>Pilih Tahun</option`);
				if (tahun_awal != "Pilih Tahun") {
					$.ajax({
						url: segments[0] + "/IpiApps/data/getTahunSelected/" + tahun_awal,
						method: "get",
						dataType: "json",

						success: function (dataT) {
							dataT.forEach(function (dataTahunSampai) {
								$("#end-date").append(
									`<option value="` + dataTahunSampai + `">` + dataTahunSampai + `</option>`
								);
							});
						}
					});
				} else {}
			});
		}
	});
});
