// Set new default font family and font color to mimic Bootstrap's default styling

Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("myDonutChart");
var myDonutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: thisyearlabels,
        datasets: [{
            data: thisyeardatas,
            backgroundColor: ['#dc3545', '#007bff'],
        }],
    },
    options: {
        legend: {
            display: true,
            position: 'bottom'
        }
    }
});