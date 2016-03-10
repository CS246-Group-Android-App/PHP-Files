<?php
    $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
    $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
    $dbName = 'bathroom_rater';
    $name = $_POST["name"];
    $lat = $_POST["lat"];
    $lng = $_POST["lng"];

    try
    {
        $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die(); 
    }
    $stmt = $db->prepare('INSERT INTO rated_locations (name, lat, lng) VALUES (:name, :lat, :lng)');
    $stmt->execute(array(':name' => $name, ':lat' => $lat, ':lng' => $lng));
    echo "Location name: " . $name . " at latitude: " . $lat . ", and longitude: " . $lng . " added to Database";
?>