$(document).ready(function () {
    var randomScalingFactor = function () {
        return Math.round(Math.random() * 100);
    };
//    var config = {
//        type: 'pie',
//        data: {
//            datasets: [{
//                    data: [
//                        randomScalingFactor(),
//                        randomScalingFactor(),
//                        randomScalingFactor(),
//                        randomScalingFactor(),
//                        randomScalingFactor(),
//                    ],
//                    backgroundColor: [
//                        window.chartColors.red,
//                        window.chartColors.orange,
//                        window.chartColors.yellow,
//                        window.chartColors.green,
//                        window.chartColors.blue,
//                    ],
//                    label: 'Dataset 1'
//                }],
//            labels: [
//                "Red",
//                "Orange",
//                "Yellow",
//                "Green",
//                "Blue"
//            ]
//        },
//        options: {
//            responsive: true
//        }
//    };
//    if ($("#chartjs_pie").length > 0) {
//        var ctx = document.getElementById("chartjs_pie").getContext("2d");
//        window.myPie = new Chart(ctx, config);
//    }
});

$(document).ready(function ()
{
    var color = Chart.helpers.color;
    var barChartData = {
        labels: ["My Swim Club", "My Football Club", "My Tri Club", "My Netball Club", "My Holiday Camp"],
        datasets: [{
                type: 'bar',
                label: 'Dataset 1',
                backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
                borderColor: window.chartColors.red,
                data: [
                    randomScalingFactor(),
                ]
            }, {
                type: 'bar',
                label: 'Dataset 2',
                backgroundColor: color(window.chartColors.blue).alpha(0.2).rgbString(),
                borderColor: window.chartColors.blue,
                data: [
                    randomScalingFactor(),
                ]
            }, {
                type: 'bar',
                label: 'Dataset 3',
                backgroundColor: color(window.chartColors.green).alpha(0.2).rgbString(),
                borderColor: window.chartColors.green,
                data: [
                    randomScalingFactor(),
                ]
            }, {
                type: 'bar',
                label: 'Dataset 3',
                backgroundColor: color(window.chartColors.green).alpha(0.2).rgbString(),
                borderColor: window.chartColors.green,
                data: [
                    randomScalingFactor(),
                ]
            }, {
                type: 'bar',
                label: 'Dataset 3',
                backgroundColor: color(window.chartColors.green).alpha(0.2).rgbString(),
                borderColor: window.chartColors.green,
                data: [
                    randomScalingFactor(),
                ]
            }]
    };

    



});