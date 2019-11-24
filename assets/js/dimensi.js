var url = $(location).attr("href");
var segments = url.split("/");
let status_user = $('#kode_user').attr('value');
let iniUrl = '';
if (segments[4] == "operator") {
	iniUrl = segments[0] + "/IpiApps/Admin/dimensiApi?d=" + status_user;
} else {
	if (segments[5] == null) {
		var action = segments[4];
		var data = action.split("?");
		iniUrl = segments[0] + "/IpiApps/Admin/dimensiApi?d=" + status_user + "&" + data[1];
	} else {
		var action = segments[5];
		var data = action.split("?");
		// console.log(segments[5]);
		iniUrl = segments[0] + "/IpiApps/Admin/dimensiApi?" + data[1];
	}
}
let nama_sb_dimensi = [];
let nama_dimensi = [];
let tahun = [];
let nilaiDimensi = [];
let nilaiSubDimensi = [];
let max_tahun;
let min_tahun;

$(document).ready(function () {
	$.ajax({
		url: iniUrl,
		method: "get",
		dataType: "json",
		startTime: performance.now(),
		beforeSend: function (data) {
			$("#chart-dimensi").hide();
			$(".header-table").hide();
			$(".rescale-chart").hide();
			$(".chart").append(
				`<img src="` + segments[0] + `/IpiApps/assets/img/loader.gif" width="10%" alt="no data" class="rounded mx-auto d-block loader">`
			);
			$(".header-table-root").append(
				`<img src="` + segments[0] + `/IpiApps/assets/img/loader.gif" width="10%" alt="no data" class="rounded mx-auto d-block loader">`
			);
		},
		success: function (data) {
			// console.log(data);
			$(".loader").remove();
			$(".header-table").show();
			$(".rescale-chart").show();
			$("#chart-dimensi").show();
			for (var i in data["tahun"]) {
				tahun.push(data["tahun"][i].tahun);
			}
			for (var i in data["n_sb_dimensi"]) {
				nama_sb_dimensi.push(data["n_sb_dimensi"][i].nama_sub_dimensi);
			}

			let dataTampung = [];
			for (var i in data["sub_dimensi"]) {
				nilaiSubDimensi = [];
				for (var j in tahun) {
					nilaiSubDimensi.push(data["sub_dimensi"][i][tahun[j]]);
				}
				dataTampung[i] = nilaiSubDimensi;
			}
			_getDataToTable(data, dataTampung);

			for (var i in data["n_dimensi"]) {
				nama_dimensi.push(data["n_dimensi"][i].nama_dimensi);
			}
			for (var i in data["dimensi"]) {
				nilaiDimensi.push(data["dimensi"][i]);
			}
			let setDataDimensi = [];
			setDataDimensi.push({
				label: nama_dimensi[0],
				type: "line",
				borderColor: "#FF0606",
				data: nilaiDimensi,
				borderDashOffset: 1,
				fill: false,
				spanGaps: true
			});
			let color = ["#2d98da", "#20bf6b", "#fc5c65"];
			let count = 1;
			for (var i in data["n_sb_dimensi"]) {
				setDataDimensi.push({
					label: nama_sb_dimensi[i],
					type: "bar",
					backgroundColor: color[i],
					data: dataTampung[data["n_sb_dimensi"][i].kode_sd]
				})
				$('#subdimensi' + data["n_sb_dimensi"][i].kode_sd).css('background-color', color[i]);;
			}

			const canvas = document.querySelector("#chart-dimensi");
			const ctx = canvas.getContext("2d");
			new Chart(ctx, {
				type: "bar",
				data: {
					labels: tahun,
					datasets: setDataDimensi
				},
				options: {
					responsive: false,
					maintainAspectRatio: false,
					layout: {
						padding: {
							left: 0,
							right: 0,
							top: 10,
							bottom: 0
						}
					},
					scales: {
						xAxes: [{
							time: {
								unit: "year"
							},
							gridLines: {
								display: true,
								drawBorder: false
							},
							ticks: {
								min: 2,
								max: 0,
								maxTicksLimit: 7
							},
							maxBarThickness: 70
						}],
						yAxes: [{
							ticks: {
								min: 0,
								max: 10,
								maxTicksLimit: 20,
								padding: 30
								// Include a dollar sign in the ticks
							},
							gridLines: {
								color: "rgb(220, 221, 225)",
								zeroLineColor: "rgb(234, 236, 244)",
								drawBorder: false,
								borderDash: [5, 5],
								zeroLineBorderDash: [2]
							}
						}]
					},
					annotation: {
						annotations: [{
								type: "box",
								yScaleID: "y-axis-0",
								yMin: 0,
								yMax: 4,
								borderColor: "rgba(255, 51, 51, 0.1",
								borderWidth: 2,
								backgroundColor: "rgba(255, 51, 51, 0.1)"
							},
							{
								type: "box",
								yScaleID: "y-axis-0",
								yMin: 4,
								yMax: 7,
								borderColor: "rgba(255, 255, 0, 0.1)",
								borderWidth: 1,
								backgroundColor: "rgba(255, 255, 0, 0.1)"
							},
							{
								type: "box",
								yScaleID: "y-axis-0",
								yMin: 7,
								yMax: 10,
								borderColor: "rgba(0, 204, 0, 0.1)",
								borderWidth: 1,
								backgroundColor: "rgba(0, 204, 0, 0.1)"
							}
						]
					},
					legend: {
						display: true
					},
					tooltips: {
						titleMarginBottom: 10,
						titleFontColor: "#6e707e",
						titleFontSize: 14,
						backgroundColor: "rgb(255,255,255)",
						bodyFontColor: "#858796",
						borderColor: "#dddfeb",
						borderWidth: 1,
						xPadding: 1,
						yPadding: 6,
						displayColors: false,
						caretPadding: 10
					}
				}
			});
		},
		error: function (data) {
			$(".loader").remove();
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
function _getDataToTable(data, dataTampung) {
	$('.header-table').append(`
    <th class="py-5" rowspan="2" colspan="2">Sub-Dimensi</th>
    <th colspan="` + data['tahun'].length + `">Skor</th>`)
	data["tahun"].forEach(function (p) {
		$(".tahun-dimensi").append(`<th scope="col" class="align-middle">` + p.tahun + `</th>`);
		// console.log(p.tahun);
	});

	$(".iniData").append(`<tr class="dimensi"></tr>`);

	data["n_dimensi"].forEach(function (p) {
		$(".dimensi").append(
			`
        <td colspan="2" scope="col">` +
			p.nama_dimensi +
			`</td>
        `
		);
	});
	for (var i in data["dimensi"]) {
		$(".dimensi").append(
			`
        <td class="n-dimensi" scope="col">` +
			parseFloat(data["dimensi"][i]).toFixed(2) +
			`</td>
        `
		);
	}

	var tableTr = "";
	var count = 1;
	for (var i in data["n_sb_dimensi"]) {
		tableTr += "<tr>";
		tableTr += "<td>" + count++ + "</td>";
		tableTr += "<td class='text-left'>" + data["n_sb_dimensi"][i].nama_sub_dimensi + "</td>";
		for (var j in tahun) {
			tableTr +=
				"<td>" +
				parseFloat(dataTampung[data["n_sb_dimensi"][i].kode_sd][j]).toFixed(2) +
				"</td>";
		}
		tableTr += "</tr>";
	}
	$(".iniData").append(tableTr);
}
//akhir
