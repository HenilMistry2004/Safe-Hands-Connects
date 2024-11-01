<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    include "Connection.php";

    // Check if POST data is set
    if (isset($_POST['serviceName'])) {
        $serviceName = $_POST['serviceName'];
    }

    if (isset($_POST['servicesDescription'])) {
        $servicesDescription = $_POST['servicesDescription'];
    }

    if (isset($_POST['servicePrice'])) {
        $servicePrice = $_POST['servicePrice'];
    }

    if (isset($_POST['servicesImagesPath'])) {
        $servicesImagesPath = $_POST['servicesImagesPath'];
    }

    // Insert data into 'service' table
    $sql = "INSERT INTO service (service_name, description, services_image, status) VALUES ('$serviceName', '$servicesDescription', '$servicesImagesPath', 'active')";

    if ($conn->query($sql) === TRUE) {
        // Get the ID of the newly inserted service
        $serviceId = $conn->insert_id;

        // Retrieve sub-service data from POST request
        $sub_Service_Names = $_POST['subServiceName'];
        $sub_Service_Descriptions = $_POST['subServiceDescription'];
        $sub_Service_Prices = $_POST['subServicePrice'];

        // Insert each sub-service
        foreach ($sub_Service_Names as $key => $subServiceName) {
            $subServiceDescription = $sub_Service_Descriptions[$key];
            $subServicePrice = $sub_Service_Prices[$key];

            $sub_Service_Insertion = "INSERT INTO sub_service (service_id, sub_service_name, sub_service_price, description) VALUES ('$serviceId', '$subServiceName', '$subServicePrice', '$subServiceDescription')";

            if (!$conn->query($sub_Service_Insertion)) {
                echo "Error: " . $sub_Service_Insertion . "<br>" . $conn->error;
            }
        }

        // Redirect after successful insertion
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    ?>
</body>

</html>
