var options = {
	series: [32500, 29700, 24200],
	chart: {
		height: 270,
		type: "polarArea",
	},
	labels: ["USA", "India", "Brazil"],
	fill: {
		opacity: 1,
	},
	stroke: {
		width: 1,
		colors: ["#ffffff", "#ffffff", "#ffffff"],
	},
	colors: ["#e87609", "rgba(0, 0, 0, 0.1)", "rgba(0, 0, 0, 0.2)"],
	yaxis: {
		show: false,
	},
	legend: {
		show: false,
	},
	tooltip: {
		y: {
			formatter: function (val) {
				return val;
			},
		},
	},
	plotOptions: {
		polarArea: {
			rings: {
				strokeWidth: 0,
			},
			spokes: {
				strokeWidth: 0,
			},
		},
	},
};

var chart = new ApexCharts(document.querySelector("#paymentsData"), options);
chart.render();
