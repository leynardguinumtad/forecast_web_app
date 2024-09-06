<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Document</title>
</head>


<body>
    <h4>Multivariate Seasonality Result</h4>
    <div class="container">
        <div class="row">
            <div id="chart-container" class="col-md-8 border border-dark">
                <!-- Dynamic charts will be inserted here -->
            </div>
            <div class="col-md-4 border border-dark">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
    </div>

    <script>
        // Fetch and parse JSON data from the server-side
        const jsonData = @json($data); // Server-side rendered data
        const data = JSON.parse(jsonData);

        // Function to dynamically create charts for each variable
        function createCharts(data) {
            const chartContainer = document.getElementById('chart-container');
            const index = data.seasonality.index;

            // Loop through each variable in the seasonality object (except the index)
            Object.keys(data.seasonality).forEach((key) => {
                if (key !== 'index') {
                    // Create a new canvas for each variable
                    const canvas = document.createElement('canvas');
                    canvas.id = `chart-${key}`;
                    chartContainer.appendChild(canvas);

                    // Initialize the chart
                    new Chart(canvas, {
                        type: 'line',
                        data: {
                            labels: index, // X-axis will be the index (date)
                            datasets: [{
                                label: key, // The label will be the variable name (var1, var2, ...)
                                data: data.seasonality[key], // Data for this variable
                                borderColor: getRandomColor(),
                                fill: false
                            }]
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: `Seasonality for ${key}`
                            }
                        }
                    });
                }
            });
        }

        // Function to generate random colors for each chart line
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Call the function to create charts
        createCharts(data);

    </script>

</body>
</html>