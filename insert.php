<?php
$connect = mysqli_connect('localhost:3306', 'root', 'root', 'natdis');

if(isset($_POST['submit']))
        {
            if(!empty($_POST['name']) && !empty($_POST['longitude']) && !empty($_POST['lat']) && !empty($_POST['date']) && !empty($_POST['intensity']) && !empty($_POST['type'])){
                $name = $_POST['name'];
                $longitude = $_POST['longitude'];
                $lat = $_POST['lat'];
                $date = $_POST['date'];
                $intensity = $_POST['intensity'];
                $type = $_POST['type']; 

                $query = "INSERT INTO `mytable`(`Name`, `longitude`, `lat`, `date`, `intensity`, `type`) VALUES ('$name','$longitude','$lat','$date','$intensity','$type')";

                $run = mysqli_query($connect, $query);

                if($run){
                    echo '<script>alert("Successfully added disaster")</script>';
                    echo '<script>window.history.go(-1)</script>';
                }
                else{
                    echo '<script>alert("Failed to add disaster")</script>';
                    echo '<script>window.history.go(-1)</script>';
                }
            }
            else{
                echo '<script>alert("All fields required")</script>';
                echo '<script>window.history.go(-1)</script>';
            }
        }
?>