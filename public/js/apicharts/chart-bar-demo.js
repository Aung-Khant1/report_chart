// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: monthlyreportpermonthotherapislabel,
        datasets: [{
                label: "Telenor And Other API(s)",
                backgroundColor: "rgba(22,117,124,1)",
                borderColor: "rgba(2,117,216,1)",
                data: monthlyreportpermonthtelenordirectdata,
            },
            {
                label: "MPT",
                backgroundColor: "rgba(12,212,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: monthlyreportpermonthotherapisdata,
            }
        ],
    },
    options: {
        scales: {
            xAxes: [{
                gridLines: {
                    display: false
                },
                ticks: {
                    maxTicksLimit: 12
                }
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 400000,
                    maxTicksLimit: 12
                },
                gridLines: {
                    display: true
                }
            }],
        },
        legend: {
            display: true,
            position: 'bottom',
        }
    }
});