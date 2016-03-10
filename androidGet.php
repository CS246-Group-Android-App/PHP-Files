<?php
    $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
    $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
    $dbName = 'bathroom_rater';
    
    try
    {
        $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die(); 
    }
    
    $stmt = $db->prepare('SELECT name, lat, lng FROM rated_locations');
    $stmt->execute();
    $markers = $stmt->fetchAll();
    if ($markers != null)
    {
        foreach ($markers as $marker)
        {
            echo nl2br ($marker['name'] . "," . $marker['lat'] . "," . $marker['lng'] . ";\n");
        }
    }
    else {
        echo "No saved locations";
    }
?>