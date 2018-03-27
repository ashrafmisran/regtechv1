var ctx = document.getElementById("myChart").getContext('2d');
var set = {
    RTL520125: {
        date: [10, 11, 12, 13, 14, 15, 16],
        deposit: [0, 12, 5, 5, 6, 8, 15],
        withdraw: [0, 9, 4, 0, 0, 5, 2],
        balance: [0, 3, 4, 9, 15, 18, 31],
    },
    RTL520126: {
        date: [11, 12, 13, 14, 15, 16],
        deposit: [],
        withdraw: []
    },
    RTL520127: {
        date: [11, 12, 13, 14, 15, 16],
        deposit: [],
        withdraw: []
    }
}

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        // Set the client acc no and time period
        labels: set ['RTL520125']['date'],
        datasets: [
            /*{
                            // Threshold
                            label: 'Threshold',
                            type: 'line',
                            data: [10, 10, 10, 10, 10, 10, 10],
                            borderWidth: 2,
                            backgroundColor: 'rgba(0,0,0,0)'
                        },*/
            {
                // Trust balance
                label: 'Trust Balance',
                type: 'line',
                data: set ['RTL520125']['balance'],
                borderWidth: 2,
                borderColor: 'blue',
                pointHitRadius: 80,
                //steppedLine: 'before',
                showLines: false
            }, {
                // Deposit
                label: 'Deposit',
                data: set ['RTL520125']['deposit'],
                borderWidth: 5,
                backgroundColor: 'rgba(0,166,78,0.6)',
                type: 'bar'
            }, {
                // Withdraw
                label: 'Withdrawal',
                data: set ['RTL520125']['withdraw'],
                borderWidth: 5,
                backgroundColor: 'rgba(226,195,116,0.6)',
                type: 'bar'
            }, {
                // Settlement
                label: 'Settlement',
                data: set ['RTL520125']['deposit'],
                borderWidth: 5,
                backgroundColor: 'rgba(67,102,175,0.6)',
                type: 'bar'
            }, {
                // Sales proceed
                label: 'Sales proceed',
                data: set ['RTL520125']['withdraw'],
                borderWidth: 5,
                backgroundColor: 'rgba(226,58,68,0.6)',
                type: 'bar'
            }
        ]
    },
    options: {
        animation: {
            duration: 0, // general animation time
        },
        title: {
            display: false,
            text: 'Trust Account for Account No RTL520125',
            fontSize: 20
        },
        elements: {
            line: {
                tension: 0
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: false
                }
            }]
        }
    }
});