function getChartColorsArray(e) {
    e = $(e).attr("data-colors");
    return (e = JSON.parse(e)).map(function (e) {
        e = e.replace(" ", "");
        if (-1 == e.indexOf("--")) return e;
        e = getComputedStyle(document.documentElement).getPropertyValue(e);
        return e || void 0;
    });
}

var columnColors2 = getChartColorsArray("#column_chart_pawn"),
    options2 = {
        chart: { height: 350, type: "bar", toolbar: { show: !1 } },
        plotOptions: { bar: { horizontal: !1, columnWidth: "45%" } },
        dataLabels: { enabled: !1 },
        stroke: { show: !0, width: 2, colors: ["transparent"] },
        series: [
            { name: "ขายฝาก", data: [46, 57, 59, 54, 62, 58, 64, 60, 66] },
            { name: "ต่อดอก", data: [74, 83, 102, 97, 86, 106, 93, 114, 94] },

        ],
        colors: columnColors2,
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
(chart2 = new ApexCharts(
    document.querySelector("#column_chart_pawn"),
    options2
)).render();
// var columnDatalabelColors = getChartColorsArray("#column_chart_datalabel"),
//     options = {
//         chart: { height: 350, type: "bar", toolbar: { show: !1 } },
//         plotOptions: {
//             bar: { borderRadius: 10, dataLabels: { position: "top" } },
//         },
//         dataLabels: {
//             enabled: !0,
//             formatter: function (e) {
//                 return e + "%";
//             },
//             offsetY: -22,
//             style: { fontSize: "12px", colors: ["#304758"] },
//         },
//         series: [
//             {
//                 name: "Inflation",
//                 data: [2.5, 3.2, 5, 10.1, 4.2, 3.8, 3, 2.4, 4, 1.2, 3.5, 0.8],
//             },
//         ],
//         colors: columnDatalabelColors,
//         grid: { borderColor: "#f1f1f1" },
//         xaxis: {
//             categories: [
//                 "Jan",
//                 "Feb",
//                 "Mar",
//                 "Apr",
//                 "May",
//                 "Jun",
//                 "Jul",
//                 "Aug",
//                 "Sep",
//                 "Oct",
//                 "Nov",
//                 "Dec",
//             ],
//             position: "top",
//             labels: { offsetY: -18 },
//             axisBorder: { show: !1 },
//             axisTicks: { show: !1 },
//             crosshairs: {
//                 fill: {
//                     type: "gradient",
//                     gradient: {
//                         colorFrom: "#D8E3F0",
//                         colorTo: "#BED1E6",
//                         stops: [0, 100],
//                         opacityFrom: 0.4,
//                         opacityTo: 0.5,
//                     },
//                 },
//             },
//             tooltip: { enabled: !0, offsetY: -35 },
//         },
//         yaxis: {
//             axisBorder: { show: !1 },
//             axisTicks: { show: !1 },
//             labels: {
//                 show: !1,
//                 formatter: function (e) {
//                     return e + "%";
//                 },
//             },
//         },
//         title: {
//             text: "Monthly Inflation in Argentina, 2002",
//             floating: !0,
//             offsetY: 330,
//             align: "center",
//             style: { color: "#444", fontWeight: "500" },
//         },
//     };
// (chart = new ApexCharts(
//     document.querySelector("#column_chart_datalabel"),
//     options
// )).render();

