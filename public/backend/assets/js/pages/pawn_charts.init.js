function getChartColorsArray(e) {
    e = $(e).attr("data-colors");
    return (e = JSON.parse(e)).map(function (e) {
        e = e.replace(" ", "");
        if (-1 == e.indexOf("--")) return e;
        e = getComputedStyle(document.documentElement).getPropertyValue(e);
        return e || void 0;
    });
}


var barColors = getChartColorsArray("#bar_chart"),
    options = {
        chart: { height: 350, type: "bar", toolbar: { show: !1 } },
        plotOptions: { bar: { horizontal: !0 } },
        dataLabels: { enabled: !1 },
        series: [
            { data: [380, 430, 450, 475, 550, 584, 780, 1100, 1220, 1365] },
        ],
        colors: barColors,
        grid: { borderColor: "#f1f1f1" },
        xaxis: {
            categories: [
                "South Korea",
                "Canada",
                "United Kingdom",
                "Netherlands",
                "Italy",
                "France",
                "Japan",
                "United States",
                "China",
                "Germany",
            ],
        },
    };
(chart = new ApexCharts(
    document.querySelector("#bar_chart"),
    options
)).render();

