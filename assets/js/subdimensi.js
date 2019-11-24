var url2 = $(location).attr("href");
var segments = url2.split("/");
var action2 = segments[5];
var data2 = action2.split("?");

let iniUrl2 = segments[0] + "/IpiApps/Admin/subdimensiApi?" + data2[1];
let nama_indikator = [];
let nama_subdimensi = [];
let tahun = [];
let nilaiSubdimensi = [];
let nilaiIndikator = [];
let nilaiReal = [];
let max_tahun;
let min_tahun;
$(document).ready(function () {
	$.ajax({
		url: iniUrl2,
		method: "get",
		dataType: "json",
		startTime: performance.now(),
		beforeSend: function (data) {
			$("#chart-subdimensi").hide();
			$(".chart").append(
				`<img src="` + segments[0] + `/IpiApps/assets/img/loader.gif" width="10%" alt="no data" class="rounded mx-auto d-block loader">`
			);
			$(".header-table").hide();
			$(".header-table-root").append(
				`<img src="` + segments[0] + `/IpiApps/assets/img/loader.gif" width="10%" alt="no data" class="rounded mx-auto d-block loader">`
			);
			$(".temp-tahun").remove();
			$(".temp-table").remove();
		},
		success: function (data) {
			// alert("SUKSES");
			// console.log(data);

			$(".loader").remove();
			$(".header-table").show();
			$("#chart-subdimensi").show();


			for (var i in data["tahun"]) {
				tahun.push(data["tahun"][i].tahun);
			}
			for (var i in data["n_indikator"]) {
				nama_indikator.push(data["n_indikator"][i].nama_indikator);
			}

			let dataTampungSub2 = [];
			let index = 1
			for (var i in data["nilai_indikator"]) {
				nilaiReal = [];
				nilaiReal = data['nilai_indikator'][i];
				dataTampungSub2[index] = nilaiReal
				index++
			}

			let dataTampungSub = [];
			for (var i in data["indikator"]) {
				nilaiIndikator = [];
				for (var j in tahun) {
					nilaiIndikator.push(data["indikator"][i][tahun[j]]);
				}
				dataTampungSub[i] = nilaiIndikator;
			}
			_getDataToTableSub(data, dataTampungSub, tahun);

			for (var i in data["n_subdimensi"]) {
				nama_subdimensi.push(data["n_subdimensi"].nama_sub_dimensi);
			}
			for (var i in data["subdimensi"]) {
				nilaiSubdimensi.push(data["subdimensi"][i]);
			}

			let setDataDimensi = [];
			setDataDimensi.push({
				label: nama_subdimensi[0],
				type: "line",
				borderColor: "#FF0606",
				data: nilaiSubdimensi,
				borderDashOffset: 1,
				fill: false,
				spanGaps: true
			});
			let color = [
				"#45aaf2",
				"#4b7bec",
				"#a55eea",
				"#20bf6b",
				"#0fb9b1",
				"#8e44ad",
				"#34495e",
				"#f1c40f",
				"#16a085",
				"#7f8c8d",
				"#3d3d3d",
				"#18dcff",
				"#ffb8b8",
				"#2c2c54",
				"#ff5252",
				"#ff793f",
				"#d1ccc0",
				"#ffda79",
				"#ccae62",
				"#cd6133",
				"#b33939"
			];
			let count = 1;
			for (var i in data["n_indikator"]) {
				console.log(dataTampungSub[data["n_indikator"][i].kode_indikator]);
				setDataDimensi.push({
					label: nama_indikator[i],
					type: "bar",
					backgroundColor: color[i],
					data: dataTampungSub[data["n_indikator"][i].kode_indikator]
				});
			}

			const canvas = document.querySelector("#chart-subdimensi");
			const ctx = canvas.getContext("2d");
			var x = new Chart(ctx, {
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
						position: "bottom",

						display: true
					},
					tooltips: {
						// enabled: false,
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
						caretPadding: 10,
						footerFontColor: 'red',
						callbacks: {
							afterFooter: function (tooltipItem, data) {

								if (tooltipItem[0]['datasetIndex'] != 0) {
									return "Data Riil: " + dataTampungSub2[tooltipItem[0]['datasetIndex']][tooltipItem[0]['label']]

								}

							}
						}

					}
				}
			});
		},
		error: function (data) {

			// console.log(data);
			$(".loader").remove();
			$("#chart-subdimensi").remove();
			$(".chart").append(
				`<p class="text-center">Data tidak dapat dikalkulasi !</p>	
				<img src="` + segments[0] + `/IpiApps/assets/img/no_data.png" class="rounded mx-auto d-block img-data" width="30%" alt="no data">`
			);
		}
	});
});
// Akhir Indeks Pembangunan Inklusif

//untutk data table
function _getDataToTableSub(data, dataTampungSub) {
	// console.log(data);
	$('.header-table').append(`
    <th class="py-5" rowspan="2" colspan="2">Sub-Dimensi</th>
    <th colspan="` + data['tahun'].length + `">Skor</th>`)
	data["tahun"].forEach(function (p) {
		$(".tahun-sub").append(
			`<th scope="col" class="temp-tahun">` + p.tahun + `</th>`
		);
	});

	$(".iniData-subdimensi").append(`<tr class="subdimensi"></tr>`);

	$(".subdimensi").append(
		`
        <td colspan="2" scope="col">` +
		data["n_subdimensi"].nama_sub_dimensi +
		`</td>
        `
	);

	for (var i in data["subdimensi"]) {
		$(".subdimensi").append(
			`
        <td class="n-sub-dimensi" scope="col">` +
			parseFloat(data["subdimensi"][i]).toFixed(2) +
			`</td>
        `
		);
	}
	var tableTr = "";
	var count = 1;
	for (var i in data["n_indikator"]) {
		tableTr += "<tr class='temp-table'>";
		tableTr += "<td>" + count++ + "</td>";
		tableTr += "<td class='text-left'>" + data["n_indikator"][i].nama_indikator + "</td>";
		for (var j in tahun) {
			tableTr +=
				"<td>" +
				parseFloat(
					dataTampungSub[data["n_indikator"][i].kode_indikator][j]
				).toFixed(2) +
				"</td>";
		}
		tableTr += "</tr>";
	}
	$(".iniData-subdimensi").append(tableTr);
}
//akhir
