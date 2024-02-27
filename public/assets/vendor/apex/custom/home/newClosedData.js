var options = {
	chart: {
		height: 285,
		type: "line",
		toolbar: {
			show: false,
		},
	},
	dataLabels: {
		enabled: false,
	},
	stroke: {
		curve: "straight",
		width: 3,
		colors: ["#e87609", "#ffffff", "#fabb05"],
	},
	series: [
		{
			name: "New",
			data: [10, 40, 15, 40, 20, 35, 20],
		},
		{
			name: "Closed",
			data: [2, 21, 4, 20, 6, 22, 39],
		},
	],
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
		padding: {
			top: 0,
			right: 0,
			bottom: 10,
			left: 0,
		},
	},
	xaxis: {
		categories: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
	},
	yaxis: {
		labels: {
			show: false,
		},
	},
	colors: ["#e87609", "#ffffff", "#fabb05"],
	markers: {
		size: 0,
		opacity: 0.3,
		colors: ["#e87609", "#ffffff", "#fabb05"],
		strokeColor: "#ffffff",
		strokeWidth: 2,
		hover: {
			size: 7,
		},
	},
};

var chart = new ApexCharts(document.querySelector("#newClosedGraph"), options);

chart.render();
