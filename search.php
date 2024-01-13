<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>DisasterList</title>
</head>
    <body class="bg">
        <h1>Searched Disasters</h1>
        <button class="button" type = "goBack" name = "goBack" onclick="history.back()"><p>Go Back</p></button>
        
        <?php
        $connect = mysqli_connect('localhost:3306', 'root', 'root', 'natdis');
        
        if (!$connect) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $whereClause = [];
        
        if (isset($_GET['name']) && !empty($_GET['name'])) {
            $whereClause[] = "name LIKE '%" . mysqli_real_escape_string($connect, $_GET['name']) . "%'";
        }
        
        if (isset($_GET['type']) && !empty($_GET['type'])) {
            $whereClause[] = "type LIKE '%" . mysqli_real_escape_string($connect, $_GET['type']) . "%'";
        }
        
        if (isset($_GET['date']) && !empty($_GET['date'])) {
            $whereClause[] = "date = '" . mysqli_real_escape_string($connect, $_GET['date']) . "'";
        }
        
        if (isset($_GET['intensity']) && !empty($_GET['intensity'])) {
            $whereClause[] = "intensity = " . intval($_GET['intensity']);
        }
        
        $query = 'SELECT name, longitude, lat, date, intensity, type FROM mytable';
        if (!empty($whereClause)) {
            $query .= ' WHERE ' . implode(' AND ', $whereClause);
        }
        
        $result = mysqli_query($connect, $query);
        
        if (!$result) {
            die("No Results.");
        }
        
        $organizedResults = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $category = $row['type']; 
            $organizedResults[$category][] = $row;
        }

        echo '<table class="styled-table">';
        echo '<tr><th>Category</th><th>Name</th><th>Longitude</th><th>Latitude</th><th>Date</th><th>Intensity</th></tr>';

        foreach ($organizedResults as $category => $items) {
            foreach ($items as $item) {
                echo "<tr>";
                echo "<td>$category</td>";
                echo "<td>" . $item['name'] . "</td>";
                echo "<td>" . $item['longitude'] . "</td>";
                echo "<td>" . $item['lat'] . "</td>";
                echo "<td>" . $item['date'] . "</td>";
                echo "<td>" . $item['intensity'] . "</td>";
                echo "</tr>";
            }
        }

        echo '</table>';
        ?>
    </body>
</html>

