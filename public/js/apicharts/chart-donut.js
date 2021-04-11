// Set new default font family and font color to mimic Bootstrap's default styling

Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("myDonutChart");
var myDonutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [`MPT (${thisyeardatas[0]})`,`Telenor And Other API(s) (${thisyeardatas[1]})`],
        datasets: [{
            data: thisyeardatas,
            backgroundColor: ['rgba(22,117,124,1)', 'rgba(12,212,216,1)'],
        }],
    },
    options: {
        legend: {
            display: true,
            position: 'bottom'
        }
    }
});