<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Race Car Game</title>
</head>
<body onkeydown="mover(event)">
    <?php
        require_once "config.php";

        $mysqli = new mysqli($bd_host,$bd_user,$bd_password,$bd_database);

        if ($mysqli->connect_error) {
            die('Error: ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
        }

        $exists=false;


        if(isset($_POST["back"]) || (!(isset($_POST["play"])) && !(isset($_POST["pontuation"])) && !(isset($_POST["rules"])) && !(isset($_POST["player"])) && !(isset($_POST["players"])) && !(isset($_POST["time"])) && !(isset($_POST["points"])))) {
            include "menu.php";
        }
        else {
            if(isset($_POST["players"])) {
                include "game.php";
            }
            else {
                if(isset($_POST["time"]) || isset($_POST["points"])) {
                    include "pontuation.php";
                }
                else {
                    if(isset($_POST["play"])) {
                        include "game-menu.php";
                    }
                    else {
                        if(isset($_POST["pontuation"])) {
                            include "pontuations-menu.php";
                        }
                        else {
                            if(isset($_POST["rules"])) {
                                include "rules.php";
                            }
                        }
                    }
                }
            }
        }

        if(isset($_POST["winner"]) && isset($_POST["loser"]) && isset($_POST["time"]) && isset($_POST["winner_points"]) && isset($_POST["loser_points"])) {
            $winner = $_POST["winner"];
            $loser = $_POST["loser"];
            $time = $_POST["time"];
            $winner_points = $_POST["winner_points"];
            $loser_points = $_POST["loser_points"];
            $date = date("Y-m-d H:i:s");

            $query = "INSERT INTO table_name(winner, winner_points, loser, loser_points, game_time, game_date) VALUES(?,?,?,?,?,?)";
			$statement = $mysqli->prepare($query);
			$statement->bind_param('ssssss', $winner, $winner_points, $loser, $loser_points, $time, $date);
			$statement->execute();
			$statement->close();
        }

        $mysqli->close();
    ?>
</body>
</html>