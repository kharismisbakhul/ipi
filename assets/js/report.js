var url = $(location).attr("href");
var segments = url.split("/");
var action = segments[6];
var data = action.split("?");

let iniUrl = segments[0] + "/IpiApps/Admin/reportApi?" + data[1];
let tahun = [];
let nilaiIpi = [];
let nilaiDimensi = [];
let max_tahun;
let min_tahun;

$(document).ready(function () {
	$(".table-global").hide();
	$.ajax({
		url: iniUrl,
		method: "get",
		dataType: "json",
		startTime: performance.now(),
		beforeSend: function (data) {
			var x = performance.now()
			console.log(x)
			$(".loading-progress").append(
				`<img src="` + segments[0] + `/IpiApps/assets/img/loader.gif" width="10%" alt="no data" class="rounded mx-auto d-block loader">`
			);
			move(x)
		},
		success: function (data) {

			$('.loader').remove();
			$('.report').remove();
			$(".table-global").show();
			_getDataToTable(data);


		},
		done: function () {

		},
		error: function (data) {
			$(".loader").remove();
			$('.report').remove();
			$(".data-report").remove();
			$(".global").append(
				`
				<p class="text-center">Data tidak dapat dikalkulasi !</p>
				<img src="` + segments[0] + `/IpiApps/assets/img/no_data.png" class="rounded mx-auto d-block" width="30%" alt="no data">`
			);
		}
	})
});


// Akhir Indeks Pembangunan Inklusif


function move(x) {
	var z = performance.now()
	var y = z - x
	console.log(y * 1800);
	var bar = new ProgressBar.Line(progressTimer, {
		strokeWidth: 4,
		easing: 'easeInOut',
		duration: y * 1800,
		color: '#3867d6',
		trailColor: '#eee',
		trailWidth: 1,
		svgStyle: {
			width: '100%',
			height: '100%'
		},
		text: {
			style: {
				// Text color.
				// Default: same as stroke color (options.color)
				color: '#999',
				position: 'absolute',
				right: '0',
				top: '30px',
				padding: 0,
				margin: 0,
				transform: null
			},
			autoStyleContainer: false
		},
		from: {
			color: '#FFEA82'
		},
		to: {
			color: '#ED6A5A'
		},
		step: (state, bar) => {
			bar.setText(Math.round(bar.value() * 100) + ' %');
		}
	});
	bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
	bar.text.style.fontSize = '2rem';

	bar.animate(1.0);
}

function _getDataToTable(data) {
	$(".iniDataIpi").append(`<tr class="ipi"></tr>`);
	for (var i in data["ipi"]) {
		$(".ipi").append(
			`
        <td scope="col">` + parseFloat(data["ipi"][i]).toFixed(2) + `</td>
        `
		);
	}
	for (var i in data['dimensi']) {
		for (var j in data['tahun']) {
			$(".dimensi" + i).append(
				`
            <td scope="col">` +
				parseFloat(data["dimensi"][i][data['tahun'][j].tahun]).toFixed(2) +
				`</td>
            `
			)

		}
	}

	for (var i in data['sub_dimensi']) {
		for (var j in data['tahun']) {

			$(".subdimensi" + i).append(
				`
            <td scope="col">` +
				parseFloat(data["sub_dimensi"][i][data['tahun'][j].tahun]).toFixed(2) +
				`</td>
            `
			)
		}
	}

	// for (var i in data['min_max']) {
	// 	$(".indikator" + i).append(
	// 		`
	// 		<td scope="col">` +
	// 		parseFloat(data["min_max"][i]['max']['nilai']).toFixed(2) +
	// 		`</td>
	// 		<td scope="col">` +
	// 		parseFloat(data["min_max"][i]['min']['nilai']).toFixed(2) +
	// 		`</td>
	// 	`
	// 	)
	// }

	// console.log(data['indikator'])
	for (var i in data['sub_dimensi']) {
		for (var j in data['indikator'][i]) {
			for (var k in data['tahun']) {
				$(".indikator" + j).append(
					`
            <td scope="col">` +
					parseFloat(data["indikator"][i][j][data['tahun'][k].tahun]).toFixed(2) +
					`</td>
            `
				)
			}
		}
	}
}
