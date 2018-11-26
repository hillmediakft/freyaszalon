var NewsletterStat = function () {

    var opensChart = function () {

        console.log(opens_data)

        $.plot("#opens_chart", [opens_data], {
            series: {
                bars: {
                    show: true,
                    barWidth: 0.6,
                    align: "center"
                }
            },
            xaxis: {
                mode: "categories",
                tickLength: 0
            },
            grid: {
                hoverable: true,
                borderWidth: 2,
                margin: 10,
                backgroundColor: {colors: ["#ffffff", "#EEEEEE"]}

            },
            yaxis: {
                position: "right" // or "right"
            },
        });
        $(document).ready(function () {
            $("#opens_chart").UseTooltip();
        });



        var previousPoint = null, previousLabel = null;

        $.fn.UseTooltip = function () {
            $(this).bind("plothover", function (event, pos, item) {
                if (item) {
                    if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                        previousPoint = item.dataIndex;
                        previousLabel = item.series.label;
                        $("#tooltip").remove();

                        var x = item.datapoint[0];
                        var y = item.datapoint[1];

                        var color = item.series.color;

                        //console.log(item.series.xaxis.ticks[x].label);                

                        showTooltip(item.pageX,
                                item.pageY,
                                color,
                                item.series.xaxis.ticks[x].label + "<br><strong>" + y + " megnyitás</strong>");
                    }
                } else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        };

        function showTooltip(x, y, color, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y - 40,
                left: x - 50,
                border: '2px solid ' + color,
                padding: '3px',
                'font-size': '9px',
                'border-radius': '5px',
                'background-color': '#fff',
                'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
                opacity: 0.9
            }).appendTo("body").fadeIn(200);
        }
    }
    
    var clicksChart = function () {

        console.log(clicks_data)

        $.plot("#clicks_chart", [clicks_data], {
            series: {
                bars: {
                    show: true,
                    barWidth: 0.6,
                    align: "center"
                }
            },
            xaxis: {
                mode: "categories",
                tickLength: 0
            },
            grid: {
                hoverable: true,
                borderWidth: 2,
                margin: 10,
                backgroundColor: {colors: ["#ffffff", "#EEEEEE"]}

            },
            yaxis: {
                position: "right" // or "right"
            },
        });
        $(document).ready(function () {
            $("#clicks_chart").UseTooltip();
        });



        var previousPoint = null, previousLabel = null;

        $.fn.UseTooltip = function () {
            $(this).bind("plothover", function (event, pos, item) {
                if (item) {
                    if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                        previousPoint = item.dataIndex;
                        previousLabel = item.series.label;
                        $("#tooltip").remove();

                        var x = item.datapoint[0];
                        var y = item.datapoint[1];

                        var color = item.series.color;

                        //console.log(item.series.xaxis.ticks[x].label);                

                        showTooltip(item.pageX,
                                item.pageY,
                                color,
                                item.series.xaxis.ticks[x].label + "<br><strong>" + y + " kattintás</strong>");
                    }
                } else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        };

        function showTooltip(x, y, color, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y - 40,
                left: x - 50,
                border: '2px solid ' + color,
                padding: '3px',
                'font-size': '9px',
                'border-radius': '5px',
                'background-color': '#fff',
                'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
                opacity: 0.9
            }).appendTo("body").fadeIn(200);
        }
    }    

    var pieChart = function () {

        console.log(data);

        // e-mail opens chart
        if ($('#pie_chart').size() !== 0) {
            $.plot($("#pie_chart"), data, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 1,
                            formatter: function (label, series) {
                                return '<div style="font-size:9pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                            },
                            background: {
                                opacity: 0.8
                            }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });
        }
    }

    return {
        init: function () {
            if (!jQuery.plot) {
                return;
            }
            pieChart();
            opensChart();
            clicksChart();
        },
    };

}();

$(document).ready(function () {
    NewsletterStat.init(); // init Newsletter page

});