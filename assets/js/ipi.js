var url = $(location).attr("href");
var segments = url.split("/");
var action = segments[5];
var data = action.split("?");

let iniUrl = segments[0] + "/IpiApps/Admin/ipiApi?" + data[1];
let nama_dimensi = [];
let nama_ipi = [];
let tahun = [];
let nilaiIpi = [];
let nilaiDimensi = [];
let max_tahun;
let min_tahun;

$(document).ready(function () {
	$.ajax({
		url: iniUrl,
		method: "get",
		dataType: "json",
		startTime: performance.now(),
		beforeSend: function (data) {
			$("#ipi-chart").hide();
			$(".header-table").hide();
			$(".chart").append(
				`<img src="` + segments[0] + `/IpiApps/assets/img/loader.gif" width="10%" alt="no data" class="rounded mx-auto d-block loader">`
			);
			$(".header-table-root").append(
				`<img src="` + segments[0] + `/IpiApps/assets/img/loader.gif" width="10%" alt="no data" class="rounded mx-auto d-block loader">`
			);
		},
		success: function (data) {
			$(".loader").remove();
			$(".header-table").show();
			$("#ipi-chart").show();
			for (var i in data["tahun"]) {
				tahun.push(data["tahun"][i].tahun);
			}
			for (var i in data["n_dimensi"]) {
				nama_dimensi.push(data["n_dimensi"][i].nama_dimensi);
			}

			let dataTampung = [];
			for (var i in data["dimensi"]) {
				nilaiDimensi = [];
				for (var j in tahun) {
					nilaiDimensi.push(data["dimensi"][i][tahun[j]]);
				}
				dataTampung[i] = nilaiDimensi;
			}
			_getDataToTable(data, dataTampung, tahun);

			nama_ipi.push(data["n_ipi"]);

			for (var i in data["ipi"]) {
				nilaiIpi.push(data["ipi"][i]);
			}
			let setDataDimensi = [];
			setDataDimensi.push({
				label: nama_ipi[0],
				type: "line",
				borderColor: "#FF0606",
				data: nilaiIpi,
				borderDashOffset: 1,
				fill: false,
				spanGaps: true
			});
			let color = ["#eb4d4b", "#6ab04c", "#f0932b"];
			let count = 1;
			for (var i in data["n_dimensi"]) {
				setDataDimensi.push({
					label: nama_dimensi[i],
					type: "bar",
					backgroundColor: color[i],
					data: dataTampung[data["n_dimensi"][i].kode_d]
				})
				$('#dimensi' + data["n_dimensi"][i].kode_d).css('background-color', color[i]);
			}

		},
		error: function (data) {
			$(".loader").remove();
			$("#ipi-chart").remove();
			$(".chart").append(
				`
				<p class="text-center">Data tidak dapat dikalkulasi !</p>	
				<img src="` + segments[0] + `/IpiApps/assets/img/no_data.png" class="rounded mx-auto d-block" width="30%" alt="no data">`
			);
		}
	});
});
// Akhir Indeks Pembangunan Inklusif

//untutk data table
function _getDataToTable(data, dataTampung) {
	$('.header-table').append(`
    <th class="py-5" rowspan="2" colspan="2">Dimensi</th>
    <th colspan="` + data['tahun'].length + `">Skor</th>`)
	data["tahun"].forEach(function (p) {
		$(".tahun-ipi").append(`<th scope="col" class="align-middle">` + p.tahun + `</th>`);
	});

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

	var tableTr = "";
	var count = 1;
	for (var i in data["n_dimensi"]) {
		tableTr += "<tr>";
		tableTr += "<td>" + count++ + "</td>";
		tableTr += "<td class='text-left'>" + data["n_dimensi"][i].nama_dimensi + "</td>";
		for (var j in tahun) {
			tableTr +=
				"<td>" +
				parseFloat(dataTampung[data["n_dimensi"][i].kode_d][j]).toFixed(2) +
				"</td>";
		}
		tableTr += "</tr>";
	}
	$(".iniDataIpi").append(tableTr);
}
//akhir