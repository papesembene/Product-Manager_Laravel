var options = {
	chart: {
		height: 186,
		type: "bar",
		toolbar: {
			show: false,
		},
	},
	plotOptions: {
		bar: {
			columnWidth: "60%",
			borderRadius: 8,
			distributed: true,
			dataLabels: {
				position: "top",
			},
		},
	},
	series: [
		{
			name: "Tickets",
			data: [20, 30, 40, 50, 60, 70],
		},
	],
	legend: {
		show: false,
	},
	xaxis: {
		categories: ["Active", "Solved", "Closed", "Open", "Critical", "High"],
		axisBorder: {
			show: false,
		},
		yaxis: {
			show: false,
		},

		tooltip: {
			enabled: true,
		},
		labels: {
			show: true,
			rotate: -45,
			rotateAlways: true,
		},
	},
	grid: {
		borderColor: "rgba(255, 255, 255, .20)",
		strokeDashArray: 5,
		xaxis: {
			lines: {
				show: true,
			},
		},
		yaxis: {
			lines: {
				show: false,
			},
		},
	},
	tooltip: {
		y: {
			formatter: function (val) {
				return val;
			},
		},
	},
	colors: [
		"#e87609",
		"rgba(0, 0, 0, 0.2)",
		"#e87609",
		"rgba(0, 0, 0, 0.2)",
		"#e87609",
		"rgba(0, 0, 0, 0.2)",
	],
};
var chart = new ApexCharts(document.querySelector("#ticketsData"), options);
chart.render();
