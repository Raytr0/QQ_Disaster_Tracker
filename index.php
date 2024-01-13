<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>QQ</title>
</head>
<body class="bg">
        <h1>QQ Disaster Tracker</h1>
        
        <form action = "insert.php" method = "post">
        <div class="add-bar">
            <div class="input-info">
                <p>Name</p>
                <input class="input-box-large" type="text" name="name" placeholder="Name"></input>
            </div>
            <div class="input-info">
                <p>Longitude</p>
                <input class="input-box-large" type="text" name="longitude" placeholder="123.123123"></input>
            </div>
            <div class="input-info">
                <p>Latitude</p>
                <input class="input-box-large" type="text" name="lat" placeholder="123.123123"></input>
            </div>
            <div class="input-info">
                <p>Type</p>
                <input class="input-box-small" type="text" name="type" placeholder="tornado, earthquake ect"></input>
            </div>
            <div class="input-info">
                <p>Date</p>
                <input class="input-box-small" type="text" name="date" placeholder="DD/MM/YYYY"></input>
            </div>
            <div class="input-info">
                <p>Intesity</p>
                <input class="input-box-small" type="text" name="intensity" placeholder="1-10"></input>
            </div>
        </div>
        <button class="button" type = "submit" name = "submit"><p>Submit</p></button>
        </form>
        <form action = "search.php">
        <div class="add-bar">
            <div class="input-info">
                <p>Name</p>
                <input class="input-box-large" type="text" name="name" placeholder="Name"></input>
            </div>
            <div class="input-info">
                <p>Type</p>
                <input class="input-box-small" type="text" name="type" placeholder="tornado, earthquake ect"></input>
            </div>
            <div class="input-info">
                <p>Date</p>
                <input class="input-box-small" type="text" name="date" placeholder="DD/MM/YYYY"></input>
            </div>
            <div class="input-info">
                <p>Intesity</p>
                <input class="input-box-small" type="text" name="intensity" placeholder="1-10"></input>
            </div>
        </div>
        <button class="button"  type = "search" name = "search"><p>Search</p></button>
        </form>

        <?php
        $connect = mysqli_connect('localhost:3306', 'root', 'root', 'natdis');

        $query = 'SELECT name,longitude,lat,date,intensity,type FROM mytable';
        $result = mysqli_query( $connect, $query );

        
        if (!$result) {
            die("Query failed: " . mysqli_error($connect));
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
