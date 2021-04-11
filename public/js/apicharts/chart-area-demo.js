// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: dailyreportdatedata,
        datasets: [{
                label: "Telenor And Other API(s) ",
                lineTension: 0.3,
                backgroundColor: "rgba(0,0,0,0)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: dailyreporttelenordirectdata,
            },
            {
                label: "MPT ",
                lineTension: 0.3,
                backgroundColor: "rgba(0,0,0,0)",
                borderColor: "rgba(2,17,116,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(211,181,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: dailyreportotherapidata,
            }
        ],
    },
    options: {
        scales: {
            xAxes: [{
                time: {
                    unit: 'date'
                },
                gridLines: {
                    display: false
                },
                ticks: {
                    maxTicksLimit: 32
                }
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 20000,
                    maxTicksLimit: 6
                },
                gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                }
            }],
        },
        legend: {
            display: true,
            position: 'bottom'
        }
    }
});