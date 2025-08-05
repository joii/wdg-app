function getChartColorsArray(e) {
    e = $(e).attr("data-colors");
    return (e = JSON.parse(e)).map(function (e) {
        e = e.replace(" ", "");
        if (-1 == e.indexOf("--")) return e;
        e = getComputedStyle(document.documentElement).getPropertyValue(e);
        return e || void 0;
    });
}

const data = window.appData;// Data from controller
var columnColors = getChartColorsArray("#column_chart"),
    options = {
        chart: { height: 350, type: "bar", toolbar: { show: !1 } },
        plotOptions: { bar: { horizontal: !1, columnWidth: "45%" } },
        dataLabels: { enabled: !1 },
        stroke: { show: !0, width: 2, colors: ["transparent"] },
        series: [
            { name: "ขายฝาก", data: data[0] },
            { name: "ต่อดอก", data: data[1] },
            {
                name: "เพิ่มเงินต้น",
                data: data[2],
            },
            {
                name: "ลดเงินต้น",
                data: data[3],
            },
        ],
        colors: columnColors,
        xaxis: {
            categories: [
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
            ],
        },
        yaxis: {
            title: { text: "$ (thousands)", style: { fontWeight: "500" } },
        },
        grid: { borderColor: "#f1f1f1" },
        fill: { opacity: 1 },
        tooltip: {
            y: {
                formatter: function (e) {
                    return "$ " + e + " thousands";
                },
            },
        },
    };
(chart = new ApexCharts(
    document.querySelector("#column_chart"),
    options
)).render();


