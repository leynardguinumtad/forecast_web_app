<!DOCTYPE html>
<html>

<head>
    <title>Univariate Data Processing</title>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

</head>

<body>
    <div class="container">
        <h1>Univariate Data Processing</h1>
        <div class="row">
            <div class="col-md-12">
                <div id="chart-container">
                    <canvas id="chart"></canvas>
                </div>
                <div id="processing-options">
                    <h3>Data Cleaning and Processing</h3>
                    <form id="processing-form">
                        <label>Fill Missing Value (NaN) with:</label><br>
                        <input type="radio" name="fill-method" value="forward"> Forward Fill<br>
                        <input type="radio" name="fill-method" value="backward"> Backward Fill<br>
                        <input type="radio" name="fill-method" value="average"> Average of the series<br>
                        <input type="radio" name="fill-method" value="zero"> Fill with zeros<br>
                    </form>
                </div>
            </div>
        </div>
        <button type="button" id="submit-button" name="submit-button">Save</button>
    </div>




    <script>
        $(document).ready(function() {
            const data = @json($data);
            const headers = @json($headers);
            let originalData = JSON.parse(JSON.stringify(data)); // Deep copy of original data
            let tempData = JSON.parse(JSON.stringify(originalData));
            let chartInstance = null; // Variable to store the current chart instance



            const chartCanvas = document.getElementById('chart');

            // Ensure that data is valid
            if (data && data.length > 0 && headers.length > 1) {
                const values = originalData.map(row => parseFloat(row[1]) || null); // Handle NaN as null
                const dates = originalData.map(row => new Date(row[0]));
                const label = headers[1];

                showChart(label, dates, values);
            } else {
                console.error('Invalid data or headers');
            }

            function showChart(label, dates, values) {
                // Destroy existing chart if it exists
                if (chartInstance) {
                    chartInstance.destroy();
                }
                const ctx = chartCanvas.getContext('2d');
                chartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: label,
                            data: values,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            fill: false
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    unit: 'day'
                                },
                                title: {
                                    display: true,
                                    text: 'Date'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: label
                                }
                            }
                        }
                    }
                });
            }

            function fillMissingValues(method) {
                tempData = JSON.parse(JSON.stringify(originalData)); // Reset tempData to original each time

                switch (method) {
                    case 'forward':
                        for (let i = 1; i < tempData.length; i++) {
                            if (tempData[i][1] === null || tempData[i][1] === '') {
                                tempData[i][1] = tempData[i - 1][1];
                            }
                        }
                        break;
                    case 'backward':
                        for (let i = tempData.length - 2; i >= 0; i--) {
                            if (tempData[i][1] === null || tempData[i][1] === '') {
                                tempData[i][1] = tempData[i + 1][1];
                            }
                        }
                        break;
                    case 'average':
                        let sum = 0;
                        let count = 0;
                        for (let i = 0; i < tempData.length; i++) {
                            if (tempData[i][1] !== null && tempData[i][1] !== '') {
                                sum += parseFloat(tempData[i][1]);
                                count++;
                            }
                        }
                        const average = sum / count;
                        for (let i = 0; i < tempData.length; i++) {
                            if (tempData[i][1] === null || tempData[i][1] === '') {
                                tempData[i][1] = average;
                            }
                        }
                        break;
                    case 'zero':
                        for (let i = 0; i < tempData.length; i++) {
                            if (tempData[i][1] === null || tempData[i][1] === '') {
                                tempData[i][1] = 0;
                            }
                        }
                        break;
                }

                const values = tempData.map(row => parseFloat(row[1]));
                const dates = tempData.map(row => new Date(row[0]));
                showChart(headers[1], dates, values);
            }


            function generateCSV(data) {
                let csvContent = "Date,Value\n"; // Header
                data.forEach(row => {
                    csvContent += `${row[0]},${row[1]}\n`; // Correct interpolation
                });
                return csvContent;
            }

            document.querySelectorAll('input[name="fill-method"]').forEach(input => {
                input.addEventListener('change', () => {
                    const method = document.querySelector('input[name="fill-method"]:checked')
                        .value;
                    fillMissingValues(method);
                });
            });


            document.getElementById('submit-button').addEventListener('click', () => {
                const csvData = generateCSV(tempData);
                console.log('content of the csv data: ', csvData);

                //extract the additional data from the controller. 
                const type = @json($type);
                const freq = @json($freq);
                const description = @json($description);
                const filename = @json($filename);



                // Create a FormData object to send the CSV and other data
                const blob = new Blob([csvData], {
                    type: 'text/csv'
                });
                const formData = new FormData();
                formData.append('csv_file', blob, 'data.csv');



                formData.append('type', type);
                formData.append('freq', freq);
                formData.append('description', description);
                formData.append('filename', filename);


                // Inspect FormData
                for (let [key, value] of formData.entries()) {
                    console.log(key, value);
                }


                // Send the data using AJAX
                $.ajax({
                    url: '{{ route('save') }}', // URL to your Laravel route
                    type: 'POST',
                    data: formData,
                    processData: false, // Prevent jQuery from automatically transforming the data into a query string
                    contentType: false, // Let the browser set the content type
                    success: function(response) {
                        console.log('Data saved successfully:');

                        // Redirect the user manually
                        window.location.href = response.redirect_url;
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving data:', error);
                    }
                });
            });

        });
    </script>
</body>

</html>
