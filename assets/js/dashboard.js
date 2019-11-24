//Updated
var url = $(location).attr("href");
var segments = url.split("/");
var action = segments[4];
var data;
let iniUrl;
if (segments[5]) {
	data = segments[5].split("?");
	iniUrl = segments[0] + "/IpiApps/Admin/ipiApi?" + data[1];
} else {
	iniUrl = segments[0] + "/IpiApps/Admin/ipiApi";
}

let nama_dimensi = [];
let nama_ipi = [];
let tahun = [];
let nilaiIpi = [];
let nilaiDimensi = [];
let max_tahun;
let min_tahun;
// $("#Search-Button").on("click", function() {
// 	$(".iniDataIpi").html("");
// });

$(document).ready(function () {
	$.ajax({
		url: iniUrl,
		method: "get",
		dataType: "json",
		startTime: performance.now(),
		beforeSend: function (data) {
			$("#ipi-chart").hide();
			$(".header-table").hide();
			$(".tahun-ipi").hide();
			$(".filter-tahun").hide();
		},
		success: function (data) {
			// console.log(data);
			$(".loader").remove();
			$("#ipi-chart").show();
			$(".filter-tahun").show();
			$(".header-table").show();
			$(".tahun-ipi").show();
			for (var i in data["tahun"]) {
				tahun.push(data["tahun"][i].tahun);
			}

			_getDataToTable(data);

			nama_ipi.push(data["n_ipi"]);

			for (var i in data["ipi"]) {
				nilaiIpi.push(data["ipi"][i]);
			}

			var dataTampung = [];
			dataTampung.push({
				label: nama_ipi[0],
				type: "line",
				borderColor: "#FF0606",
				data: nilaiIpi,
				borderDashOffset: 1,
				fill: false,
				spanGaps: true,
				backgroundColor: "#e74c3c"
			});
			// console.log(nilaiIpi);
			// console.log(dataTampung);

		},
		error: function (data) {
			// alert("ERROR");
			// console.log(data);
			$(".loader").remove();
			$(".filter-tahun").show();
			$("#chart-subdimensi").remove();
			$(".chart").append(
				`<p class="text-center">Data tidak dapat dikalkulasi !</p>	
				<img src="` + segments[0] + `/IpiApps/assets/img/no_data.png" class="rounded mx-auto d-block" width="30%" alt="no data">`
			);
		}
	});
});
// Akhir Indeks Pembangunan Inklusif

//untutk data table
function _getDataToTable(data) {
	$('.header-table').append(`
    <th class="py-5" rowspan="2" colspan="2">Dimensi</th>
    <th colspan="` + data['tahun'].length + `">Skor</th>`)
	data["tahun"].forEach(function (p) {
		$(".tahun-ipi").append(`<th scope="col" class="align-middle">` + p.tahun + `</th>`);
	});

	$(".iniDataIpi").html("");
	$(".iniDataIpi").append(`<tr class="ipi"></tr>`);

	$(".ipi").append(
		`
        <td colspan="2" scope="col">` +
		data["n_ipi"] +
		`</td>
        `
	);

	for (var i in data["ipi"]) {
		$(".ipi").append(
			`
        <td class="n_ipi" scope="col">` +
			parseFloat(data["ipi"][i]).toFixed(2) +
			`</td>
        `
		);
	}
}
//akhir


$('.carousel').carousel({
	interval: 5000
})