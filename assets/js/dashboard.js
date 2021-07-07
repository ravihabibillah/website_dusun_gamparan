$(function () {
	$.getJSON("http://localhost/asik-pbj/api/v1/graphic/getAllData", function (data) {
		let graphics = JSON.stringify(data);
		graphics = JSON.parse(graphics);

		const typeGraphic = ['line', 'bar', 'radar', 'pie', 'doughnut', 'polarArea', 'bubble', 'scatter'];
		// get json data graphic
		for (let key in graphics['data']) {
			$.getJSON("http://localhost/asik-pbj/api/v1/graphic/getData/" + graphics['data'][key]['id'], function (dataGraphic) {

				let graphic = JSON.stringify(dataGraphic);
				graphic = JSON.parse(graphic);

				let graphicData = {
					datasets: [],
				};

				let dataContent = [];
				let labelContent = [];
				let colorContent = [];
				let filterGraphic = ['doughnut', 'pie', 'polar'];

				for (let key in graphic['datasets']) {
					let newDataSets = {};
					if (filterGraphic.includes(graphic['type'])) {
						dataContent.push(graphic['datasets'][key]['data']);
						labelContent.push(graphic['datasets'][key]['label']);
						colorContent.push(graphic['datasets'][key]['color'].toString());
					} else {
						Object.assign(newDataSets, {
							label: graphic['datasets'][key]['label'],
							data: graphic['datasets'][key]['data'],
							backgroundColor: graphic['datasets'][key]['color'].toString(),
							borderColor: graphic['datasets'][key]['color'].toString(),
							pointBackgroundColor: graphic['datasets'][key]['color'].toString(),
							fill: false
						});
						graphicData['datasets'].push(newDataSets);
					}
				}

				if (graphic['type'] == 'doughnut' || graphic['type'] == 'pie' || graphic == 'polar') {
					graphicData['datasets'].push({
						data: dataContent,
						backgroundColor: colorContent
					})
					graphicData.labels = labelContent;
				} else {
					graphicData.labels = graphic['labels'];
				}

				console.log(graphicData);

				let graphicOptions = {
					responsive: true,
				};

				//set label y mulai dari 0
				if (graphic['type'] == 'bar' || graphic['type'] == 'line') {
					graphicOptions = {
						responsive: true,
						scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero: true
				                }
				            }]
				        }
					}
				}

				let ctxNew = document.getElementById(dataGraphic['type'] + 'Chart' + graphic['id']).getContext('2d');

				new Chart(ctxNew, {
					type: dataGraphic['type'],
					data: graphicData,
					options: graphicOptions
				});
			});
		}
	});
});
