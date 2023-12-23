<?php
// URL of the JSON data
$url = "https://6525799a67cfb1e59ce755ee.mockapi.io/api/v1/post/";
// Create a stream context that disables SSL verification
$context = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
]);
// Fetch the JSON data from the URL using the context
$jsonData = file_get_contents($url, false, $context);

// Check if the data was fetched successfully
if ($jsonData === false) {
    die("Failed to fetch JSON data from the URL.");
}
// Convert the JSON data to an associative array
$arrayData = json_decode($jsonData, true);

// Check if the JSON decoding was successful
if ($arrayData === null) {
    die("Failed to decode JSON data.");
}
//$data = array containing the API. All the code above is used to convert the API into a PHP Array
$data = $arrayData; 

//uncomment code below to view the $data content

// var_dump($data);    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>API Data Table</title>
        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container mt-5">
        <?php
        // Output the data in an HTML table
        if (isset($data) && is_array($data)) {
            echo '<table class="table table-bordered table-striped">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Name</th>';
            echo '<th>Profile Picture</th>';
            echo '<th>Date Created</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($data as $item) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($item['id']) . '</td>';
                echo '<td>' . htmlspecialchars($item['name']) . '</td>';
                echo '<td>';
                if (isset($item['avatar'])) {
                    echo '<img src="' . htmlspecialchars($item['avatar']) . '" width="100" height="100">';
                } else {
                    echo 'N/A';
                }
                echo '</td>';
                echo '<td>' . htmlspecialchars($item['createdAt']) . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } 
        else {
            echo '<p>No data available.</p>';
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
