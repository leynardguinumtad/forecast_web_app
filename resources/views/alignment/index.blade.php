@extends('layouts.base')

@section('title', 'Time series alignment')

@section('page-title', 'Time series alignment')

@section('content')
    <div class="container mx-auto p-2">
        <!-- Card Container -->
        <div class="bg-gray-50 rounded-lg shadow-md p-4 w-full">
            <div class="flex justify-end items-center mb-4">
                <div class="relative">
                    <!-- Dropdown Button -->
                    <button id="dropdown-button" class="bg-gray-200 text-gray-700 p-2 rounded-md focus:outline-none">
                        Add
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                        <ul class="py-1">
                            <li class="flex items-center">
                                <!-- Styled File Input -->
                                <label for="file-upload"
                                    class="cursor-pointer text-gray-700 px-2 py-2 hover:bg-gray-200 w-full text-left">
                                    Add via Upload
                                </label>
                                <input type="file" id="file-upload" class="hidden" />
                            </li>
                            <li>
                                <button id="ts-add-via-api-open-meteo-btn"
                                    class="dropdown-item text-left w-full px-4 py-2 hover:bg-gray-200" data-toggle="modal"
                                    data-target="#ts-add-via-api-open-meteo-modal">Add via Third
                                    Party Source</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Save Button -->
                <button id="save-btn" class="bg-blue-500 text-white px-4 py-2 ml-4 rounded-md hover:bg-blue-600">
                    Save
                </button>
            </div>
        </div>

        <div id="data-container" class="mt-4 w-full">
            <!-- Your content and visualization can go here -->
        </div>


        <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 hidden"
            id="ts-add-via-api-open-meteo-modal" style="display:none;">
            <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-2/3">
                <div class="flex justify-between items-center border-b pb-2 mb-2">
                    <h5 class="text-lg font-semibold">Open Meteo</h5>
                    <button type="button" class="text-gray-600 hover:text-gray-800" data-dismiss="modal"
                        aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="weather_code_daily" name="daily"
                                        value="weather_code">
                                    <label class="ml-2" for="weather_code_daily">Weather code</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="temperature_2m_max_daily"
                                        name="daily" value="temperature_2m_max">
                                    <label class="ml-2" for="temperature_2m_max_daily">Maximum Temperature (2 m)</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="temperature_2m_min_daily"
                                        name="daily" value="temperature_2m_min">
                                    <label class="ml-2" for="temperature_2m_min_daily">Minimum Temperature (2 m)</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="temperature_2m_mean_daily"
                                        name="daily" value="temperature_2m_mean">
                                    <label class="ml-2" for="temperature_2m_mean_daily">Mean Temperature (2 m)</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="apparent_temperature_max_daily"
                                        name="daily" value="apparent_temperature_max">
                                    <label class="ml-2" for="apparent_temperature_max_daily">Maximum Apparent Temperature
                                        (2
                                        m)</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="apparent_temperature_min_daily"
                                        name="daily" value="apparent_temperature_min">
                                    <label class="ml-2" for="apparent_temperature_min_daily">Minimum Apparent Temperature
                                        (2
                                        m)</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="apparent_temperature_mean_daily"
                                        name="daily" value="apparent_temperature_mean">
                                    <label class="ml-2" for="apparent_temperature_mean_daily">Mean Apparent Temperature (2
                                        m)</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="sunrise_daily" name="daily"
                                        value="sunrise">
                                    <label class="ml-2" for="sunrise_daily">Sunrise</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="sunset_daily" name="daily"
                                        value="sunset">
                                    <label class="ml-2" for="sunset_daily">Sunset</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="daylight_duration_daily"
                                        name="daily" value="daylight_duration">
                                    <label class="ml-2" for="daylight_duration_daily">Daylight Duration</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="sunshine_duration_daily"
                                        name="daily" value="sunshine_duration">
                                    <label class="ml-2" for="sunshine_duration_daily">Sunshine Duration</label>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="precipitation_sum_daily"
                                        name="daily" value="precipitation_sum">
                                    <label class="ml-2" for="precipitation_sum_daily">Precipitation Sum</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="rain_sum_daily" name="daily"
                                        value="rain_sum">
                                    <label class="ml-2" for="rain_sum_daily">Rain Sum</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="snowfall_sum_daily" name="daily"
                                        value="snowfall_sum">
                                    <label class="ml-2" for="snowfall_sum_daily">Snowfall Sum</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="precipitation_hours_daily"
                                        name="daily" value="precipitation_hours">
                                    <label class="ml-2" for="precipitation_hours_daily">Precipitation Hours</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="wind_speed_10m_max_daily"
                                        name="daily" value="wind_speed_10m_max">
                                    <label class="ml-2" for="wind_speed_10m_max_daily">Maximum Wind Speed (10 m)</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="wind_gusts_10m_max_daily"
                                        name="daily" value="wind_gusts_10m_max">
                                    <label class="ml-2" for="wind_gusts_10m_max_daily">Maximum Wind Gusts (10 m)</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="wind_direction_10m_dominant_daily"
                                        name="daily" value="wind_direction_10m_dominant">
                                    <label class="ml-2" for="wind_direction_10m_dominant_daily">Dominant Wind Direction
                                        (10
                                        m)</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="shortwave_radiation_sum_daily"
                                        name="daily" value="shortwave_radiation_sum">
                                    <label class="ml-2" for="shortwave_radiation_sum_daily">Shortwave Radiation
                                        Sum</label>
                                </div>
                                <div class="flex items-center mb-2">
                                    <input class="form-checkbox" type="checkbox" id="et0_fao_evapotranspiration_daily"
                                        name="daily" value="et0_fao_evapotranspiration">
                                    <label class="ml-2" for="et0_fao_evapotranspiration_daily">Reference
                                        Evapotranspiration
                                        (ET₀)</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <!-- Date Pickers -->
                            <label for="start-date" class="block text-sm font-medium mb-1">Start Date</label>
                            <input type="date" id="start-date"
                                class="form-input block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="end-date" class="block text-sm font-medium mb-1">End Date</label>
                            <input type="date" id="end-date"
                                class="form-input block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <!-- Map Display -->
                            <button type="button" id="use-current-loc-btn"
                                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Use Current
                                Location</button>
                            <button type="button" id="get-from-maps-btn"
                                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Open Map</button>

                            <div id="map" class="mt-4 h-96 hidden"></div>
                            <p id="selected-location" class="mt-2 text-sm">Latitude: <span id="lat"></span>,
                                Longitude:
                                <span id="long"></span>
                            </p>
                        </div>

                        <button type="submit" id="fetch-data-open-meteo-btn"
                            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Fetch</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // -----------------------------------------------------------------------------------------------------

        function render_combinedArray_as_table() {
            // Clear previous data
            $('#data-container').empty();

            // Create table with minimalistic styling
            const table = $('<table class="min-w-full bg-white border-collapse">');
            const thead = $('<thead class="bg-gray-100">');
            const tbody = $('<tbody>');

            // Create table headers
            let headerRow = $('<tr>');
            headerRow.append(
                '<th class="text-left text-gray-600 font-semibold py-2 px-3">Date</th>'); // First column for date

            let colorIndex = 0; // Color index for each group of headers

            headers_array.forEach((headers, index) => {
                const colorClass = groupColors[index % groupColors.length]; // Rotate through the colors
                headers.forEach(header => {
                    headerRow.append(
                        `<th class="text-left text-gray-600 font-semibold py-2 px-3 ${colorClass}">${header}</th>`
                    );
                });
            });

            thead.append(headerRow);
            table.append(thead);

            // Create table rows
            combinedArray.forEach(row => {
                const tableRow = $('<tr>');
                row.forEach((cell, index) => {
                    // Apply color to cells that belong to the same header group
                    const headerGroupIndex = Math.floor((index - 1) / headers_array[0].length);
                    const cellColorClass = groupColors[headerGroupIndex % groupColors.length];

                    // Apply gray background if value is missing or empty
                    const cellContent = cell === '' ?
                        `<td class="py-2 px-3 bg-gray-200 text-gray-500">${cell}</td>` :
                        `<td class="py-2 px-3 ${cellColorClass}">${cell}</td>`;
                    tableRow.append(cellContent);
                });
                tbody.append(tableRow);
            });

            table.append(tbody);
            $('#data-container').append(table);
        }

        function align() {
            const dict1 = Object.fromEntries(array1.map(row => [row[0], row.slice(1)]));
            const dict2 = Object.fromEntries(array2.map(row => [row[0], row.slice(1)]));
            const allKeys = [...new Set([...array1.map(row => row[0]), ...array2.map(row => row[0])])].sort();

            const maxColumns1 = Math.max(...array1.map(row => row.length - 1));
            const maxColumns2 = Math.max(...array2.map(row => row.length - 1));

            combinedArray = allKeys.map(key => {
                const row1 = dict1[key] || Array(maxColumns1).fill('');
                const row2 = dict2[key] || Array(maxColumns2).fill('');
                return [key, ...row1, ...row2];
            });

            console.log('combined Array: ', combinedArray);

            return combinedArray;
        }

        function convertToCSV(combinedArray, headers_array) {
            let csvContent = "";

            // Add the header row to CSV (combining 'Date' and headers_array)
            const headers = ['Date', headers_array.flat().join(',')];
            csvContent = headers + "\n";


            // Add data rows to CSV
            combinedArray.forEach(row => {
                const csvRow = row.map(cell => (cell === '' ? '' : cell)); // Handle empty values
                csvContent += csvRow.join(',') + "\n";
            });

            return csvContent;
        }


        $(document).ready(function() {

            let map;
            let marker;
            let lat;
            let lon;
            $('#ts-add-via-api-open-meteo-btn').click(function() {
                $('#ts-add-via-api-open-meteo-modal').removeClass('hidden').hide().fadeIn(200);
                $('#ts-add-via-api-open-meteo-modal > div').removeClass('scale-95').addClass('scale-100');
            });

            // Close modals
            $('[data-dismiss="modal"]').click(function() {
                $(this).closest('.fixed').css('display', 'none');
            });

            // Close modals when clicking outside the modal content
            $('.fixed').click(function(e) {
                if ($(e.target).is(this)) {
                    $(this).fadeOut(200, function() {
                        $(this).addClass('hidden');
                    });
                }
            });

            // Initialize and show Google Map when "Open Map" button is clicked
            $('#get-from-maps-btn').on('click', function() {
                $('#map').css('display', 'block');

                // Initialize Google Map
                if (!map) {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {
                            lat: -34.397,
                            lng: 150.644
                        }, // Set default center
                        zoom: 8
                    });

                    // Add marker on click
                    map.addListener('click', function(e) {
                        placeMarkerAndPanTo(e.latLng, map);
                    });
                }
            });

            // Place a marker on map and pan to it
            function placeMarkerAndPanTo(latLng, map) {


                if (marker) {
                    marker.setPosition(latLng);
                } else {
                    marker = new google.maps.Marker({
                        position: latLng,
                        map: map
                    });
                }
                map.panTo(latLng);

                lat = latLng.lat();
                lon = latLng.lng();



                // Update the latitude and longitude in the form
                $('#lat').text(lat);
                $('#long').text(lon);
            }



            // Geolocation: Use current location
            $('#use-current-loc-btn').on('click', function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {

                        lat = position.coords.latitude;
                        lon = position.coords.longitude;

                        console.log(lat);
                        console.log(lon);

                        if (map) {
                            // Update the map's center and place a marker
                            let currentLocation = new google.maps.LatLng(lat, lon);
                            map.setCenter(currentLocation);
                            placeMarkerAndPanTo(currentLocation, map);
                        }

                        $('#lat').text(lat);
                        $('#long').text(lon);

                    }, function(error) {
                        console.error("Error retrieving location: ", error);
                    });
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
            });


            $('#fetch-data-open-meteo-btn').on('click', function(e) {

                e.preventDefault();

                // Extract latitude and longitude
                let lat = $('#lat').text().trim(); // Assuming lat and long values are stored here
                let long = $('#long').text().trim();

                // Get the selected checkboxes
                let selectedDaily = [];
                $('input[name="daily"]:checked').each(function() {
                    selectedDaily.push($(this).val());
                });

                // If no checkboxes are selected, alert the user
                if (selectedDaily.length === 0) {
                    alert('Please select at least one data field');
                    return;
                }

                // Build the API request URL
                let apiUrl = 'https://archive-api.open-meteo.com/v1/archive';
                let startDate = $('#start-date').val(); // Extracting start date
                let endDate = $('#end-date').val(); // Extracting end date

                let dailyParams = selectedDaily.join(',');

                let requestUrl =
                    `${apiUrl}?latitude=${lat}&longitude=${long}&start_date=${startDate}&end_date=${endDate}&daily=${dailyParams}&timezone=auto`;


                console.log(requestUrl);

                // Send the AJAX request
                $.ajax({
                    url: requestUrl,
                    type: 'GET',
                    success: function(response) {
                        // Handle the response from the server
                        console.log('Data fetched successfully:', response);


                        // You can display the data in the modal or elsewhere in the app
                        // =================================================================================================
                        csvData = generateCSV(response, selectedDaily);
                        console.log("generated csv raw", csvData);

                        // we will convert the csv data to 2D array. 
                        let rows = csvData.trim().split('\n');

                        // Split the first row (headers) by commas
                        let headers = rows[0].split(',');
                        // Loop through the rest of the rows and split each by commas
                        let values = rows.slice(1).map(row => row.split(','));
                        console.log(rows);
                        console.log(headers);
                        console.log(values);



                        array2 = values;
                        array1 = combinedArray;
                        combinedArray = align();

                        headers_array.push(headers.slice(1));
                        render_combinedArray_as_table();


                        // Close the modal
                        $('#ts-add-via-api-open-meteo-modal').fadeOut(200, function() {
                            $(this).addClass('hidden');
                        });

                        // ========================================================================================
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        alert('Failed to fetch data. Please try again.');
                    }
                });


                function convertDate(inputDate) {
                    // Parse the input date string into a Date object
                    const parsedDate = new Date(inputDate);
                    // Format the date as MM/dd/yyyy (full year format)
                    const formattedDate = dateFns.format(parsedDate, 'MM/dd/yyyy');
                    return formattedDate;
                }


                function generateCSV(data, selectedVariables) {
                    // Extract time array from the response
                    const timeArray = data.daily.time;

                    // Initialize CSV content with headers
                    let csvContent = 'time,' + selectedVariables.join(',') + '\n';

                    // Loop through each day (time array)
                    for (let i = 0; i < timeArray.length; i++) {
                        // Start each row with the time (date)
                        // let row = [timeArray[i]];
                        let row = [convertDate(timeArray[i])];

                        // For each selected variable, add the corresponding value to the row
                        selectedVariables.forEach(variable => {

                            row.push(data.daily[variable][i]);


                        });

                        // Add the row to CSV content
                        csvContent += row.join(',') + '\n';
                    }
                    return csvContent;
                }



            });



        });
        // ----------------------------------------------------------------------------------------------------------------
        // The time series data passed from the controller
        const timeSeriesData = @json($timeSeriesData);
        const data = timeSeriesData['data'];

        // Initialize the 2D array
        let array1 = [];
        let array2 = [];
        let combinedArray = [];
        let headers_array = [];

        // Colors for each group of headers (files)
        const groupColors = ['bg-red-50', 'bg-blue-50', 'bg-green-50', 'bg-yellow-50', 'bg-purple-50'];

        // Iterate over the timeSeriesData to form the 2D array
        data.forEach(item => {
            let row = [item.date, ...item.values]; // Combine date and values in one array
            array1.push(row); // Push to 2D array
        });

        // Excluding the index
        headers_array.push(timeSeriesData.header.slice(1));
        combinedArray = array1;

        render_combinedArray_as_table();

        $(document).ready(function() {
            $('#dropdown-button').on('click', function() {
                $('#dropdown-menu').toggleClass('hidden');
            });



            $('#file-upload').on('change', function(event) {
                const file = event.target.files[0];
                array1 = combinedArray;

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const text = e.target.result;
                        const rows = text.split('\n');
                        let headers = [];

                        // Process the first row (headers)
                        if (rows.length > 0) {
                            headers = rows[0].split(',');
                            headers_array.push(headers.slice(1));
                        }

                        // Process remaining rows (data)
                        rows.slice(1).forEach(row => {
                            const values = row.split(',');
                            if (values.length > 1) {
                                array2.push([values[0], ...values.slice(1).map(Number)]);
                            }
                        });

                        // Call the function to align the array1 and array2
                        combinedArray = align();
                        array2 = [];

                        // Render the combinedArray in the screen
                        render_combinedArray_as_table();
                    };
                    // Read file as text
                    reader.readAsText(file);
                }
            });
        });


        $(document).ready(function() {



            $('#save-btn').click(function(e) {
                const csvContent = convertToCSV(combinedArray, headers_array);


                console.log(csvContent);
                // make a temporary variable for header and the data. 
                csvContent_temp_array = csvContent.split('\n');
                let headers = csvContent_temp_array[0];
                let data = csvContent_temp_array.slice(1).join('\n');

                console.log("header of temp: ", headers);
                console.log("data: ", data);


                $.ajax({
                    url: '{{ route('seqal.save_preprocess') }}', // Replace with your actual route
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Add CSRF token here
                    },
                    data: {
                        file_id: timeSeriesData['file_id'],
                        type: 'multivariate',
                        filename: timeSeriesData['filename'],
                        freq: timeSeriesData['freq'],
                        description: timeSeriesData['description'],
                        headers: headers,
                        data: data,
                    },
                    success: function(response) {
                        window.location.href = response.redirect_url;
                    },
                    error: function(error) {
                        alert('An error occurred. Please try again.');
                    }
                });


            });
        });
    </script>
@endsection
