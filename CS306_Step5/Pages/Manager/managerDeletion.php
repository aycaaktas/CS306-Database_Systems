<?php 

include "../../config.php";


include "../../navbar.html";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
        background-color: #BCCEF8;
        width: 100%;
        height: 40rem;
        justify-content: center;
        }


    /* Style by Class */

        .Container {
            position: absolute;
            top: 15rem;
            left: 20%;
            width: 20rem;
            height: 15rem;
            justify-content: center;
            background: #FAF7F0;


            border-top-right-radius: 10%;
        }

        .MainContainer {
            position: absolute;
            width: 17.5rem;
            height: 17rem;
            padding-top: 18rem;
            justify-content: center;
            align-items: center;
        }

        .main-form {
            position: absolute;
            bottom: 22.5rem;

            z-index: 999;

            width: 17.5rem;
            height: 30rem;
    
            }

        .delete-button {
            position: absolute;
            height: 1rem;
            top: 28rem;
            left: 2rem;
            border-color: white;
            background-color: #98A8F8;
            width: 15rem;
            height: 3rem;
            border-bottom-left-radius: 20px;  
            border-top-left-radius: 20px;  
            border-bottom-right-radius: 20px;  
            border-top-right-radius: 20px;  

            border-width: 0;

            font-family: 'Sacramento', cursive;
        }    

        .ids {
            position: absolute;
            height: 1.7rem;
            top: 23rem;
            left: 2rem;
            border-top-right-radius: 10rem;
            background-color: rgba(0,0,0,0.15);
            width: 15rem;

            padding-left: 1rem;
            
            border-width: 0;
            border-bottom-left-radius: 20px;  
            border-top-left-radius: 20px;  
            border-bottom-right-radius: 20px;  
            border-top-right-radius: 20px; 
        }
        
        .olympic-img {
            position: absolute;
            top: 13rem;
            right: 10%;
            width: 30rem;
            z-index: 0;

        }

        .olympics-header {
            position: absolute;
            top: 8rem;
            right:-1rem;
            width: 30rem;
            z-index: 0;
            font-family: 'Sacramento', cursive;
            text-decoration: underline;
        }

        @media screen and (max-width: 1100px) {

            .Container {
                position: relative;
                top: 10rem;
                left: 0%;
                width: 20rem;
                height: 15rem;
                justify-content: center;
                background: #FAF7F0;


                border-top-right-radius: 10%;
            }

            .olympic-img {
                position: absolute;
                width: 5rem;
                top: 14rem;
                left: 59%;
                z-index: 10;
            }

            .olympics-header {
                display: none;
            }
        }
    </style>

    <title>Document</title>
</head>


<body>
    <img src="../../imgs/images-removebg-preview.png" alt="Olympics" class="olympic-img">
    <h1 class="olympics-header">
        Olympics
    </h1>
    <div class ='Container'>
        <div class='MainContainer'>
        <form action="delete.php" method="POST" class= "main-form">
            <select name="ids" class='ids'>

            <?php

            $sql_command = "SELECT man_id, name FROM manager_manages";
            $myresult = mysqli_query($db, $sql_command);

                while($id_rows = mysqli_fetch_assoc($myresult))
                {
                    $man_id = $id_rows['man_id'];
                    $name = $id_rows['name'];
                    echo "<option value=$man_id>". $man_id . " " . $name  . "</option>";
                }

            ?>

            </select>
            <button class='delete-button'>DELETE</button>
        </form>
        </div>
    </div>
</body>
</html>





