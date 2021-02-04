// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';


// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [yesterday.label[0], yesterday.label[1]],
        datasets: [{
            data: [yesterday.data[0], yesterday.data[1]],
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