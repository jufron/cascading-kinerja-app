
function chartBar (props) {
    const {
        element,
        data = [65, 59, 80, 81, 56],
        labels = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'],
        backgroundColor = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 99, 132, 1)',
        ],
        borderColor = [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgba(255, 99, 132, 1)',

        ],
        options,
    } = props;

    const stackedBar = new Chart(element, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: backgroundColor,
                borderColor: borderColor,
                borderWidth: 1
            }],
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            ...(options && { ...options })
        }
    })
}
