function getChartColorsArray(e) {
    e = $(e).attr("data-colors");
    return (e = JSON.parse(e)).map(function (e) {
        e = e.replace(" ", "");
        if (-1 == e.indexOf("--")) return e;
        e = getComputedStyle(document.documentElement).getPropertyValue(e);
        return e || void 0;
    });
}

const data = window.appData;
var columnColors = getChartColorsArray("#column_chart"),
    options = {
        chart: { height: 350, type: "bar", toolbar: { show: !1 } },
        plotOptions: { bar: { horizontal: !1, columnWidth: "45%" } },
        dataLabels: { enabled: !1 },
        stroke: { show: !0, width: 2, colors: ["transparent"] },
        series: [
            { name: "เพิ่มเงินต้น", data: data[0] },
        ],
        colors: columnColors,
        xaxis: {
            categories: [
                "ม.ค.",
                "ก.พ.",
                "มี.ค.",
                "เม.ย.",
                "พ.ค.",
                "มิ.ย.",
                "ก.ค.",
                "ส.ค.",
                "ก.ย.",
                "ต.ค.",
                "พ.ย.",
                "ธ.ค.",
            ],
        },
        yaxis: {
            title: { text: "จำนวน (บาท)", style: { fontWeight: "500" } },
        },
        grid: { borderColor: "#f1f1f1" },
        fill: { opacity: 1 },
        tooltip: {
            y: {
                formatter: function (e) {
                    return "จำนวน " + e + " บาท";
                },
            },
        },
    };
(chart = new ApexCharts(
    document.querySelector("#column_chart"),
    options
)).render();


var columnColors = getChartColorsArray("#column_chart2"),
    options = {
        chart: { height: 350, type: "bar", toolbar: { show: !1 } },
        plotOptions: { bar: { horizontal: !1, columnWidth: "45%" } },
        dataLabels: { enabled: !1 },
        stroke: { show: !0, width: 2, colors: ["transparent"] },
        series: [
            { name: "เพิ่มเงินต้น", data: data[1] },
        ],
        colors: columnColors,
        xaxis: {
            categories: [
                "ม.ค.",
                "ก.พ.",
                "มี.ค.",
                "เม.ย.",
                "พ.ค.",
                "มิ.ย.",
                "ก.ค.",
                "ส.ค.",
                "ก.ย.",
                "ต.ค.",
                "พ.ย.",
                "ธ.ค.",
            ],
        },
        yaxis: {
            title: { text: "จำนวน (รายการ)", style: { fontWeight: "500" } },
        },
        grid: { borderColor: "#f1f1f1" },
        fill: { opacity: 1 },
        tooltip: {
            y: {
                formatter: function (e) {
                    return "จำนวน " + e + " รายการ";
                },
            },
        },
    };
(chart = new ApexCharts(
    document.querySelector("#column_chart2"),
    options
)).render();
