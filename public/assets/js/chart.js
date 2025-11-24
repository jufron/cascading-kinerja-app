function chart (props) {
    const {targetElement, chartType, labels, datasets, options = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        layout: {
            padding: {
                top: 10,
                bottom: 10
            }
        }
    }} = props;

    new Chart(targetElement, {
        type: chartType,
        data: {
            labels: labels,
            datasets: datasets
        },
        options: options
    });
}
