
<?php 

include "../../navbar.html";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
        top: 5rem;
        left: 20%;
        width: 20rem;
        height: 37rem;
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
        bottom: -12rem;

        z-index: 999;

        width: 17.5rem;
        height: 30rem;
        
    }

    .sport-p {
        position: absolute;
        display: inline-block;
        top: 2rem;
        width: 10rem;

        left: 10px;

        font-family: 'Sacramento', cursive;
    }

    .round-p {
        position: absolute;
        display: inline-block;
        width: 10rem;
        top: 7rem;

        left: 10px;

        font-family: 'Sacramento', cursive;
    }

    .after-p {
        position: absolute;
        display: inline-block;
        width: 10rem;
        top: 12.2rem;

        left: 10px;

        font-family: 'Sacramento', cursive;
    }

    .venue-p {
        position: absolute;
        display: inline-block;
        width: 10rem;
        top: 17.1rem;

        left: 10px;

        font-family: 'Sacramento', cursive;
    }

    .submitBtn {
        position: absolute;
        height: 1rem;
        top: 32rem;
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


    /* Style by Id */
    #sport {
        position: absolute;
        height: 1.7rem;
        top: 5rem;
        left: 2rem;

        padding-left: 1rem;

        background-color: rgba(0,0,0,0.15);
        width: 15rem;
        border-width: 0;
        border-bottom-left-radius: 20px;  
        border-top-left-radius: 20px;  
        border-bottom-right-radius: 20px;  
        border-top-right-radius: 20px;  
    }

    #title {
        position: absolute;
        height: 1.7rem;
        top: 10rem;
        left: 2rem;

        padding-left: 1rem;

        background-color: rgba(0,0,0,0.15);
        width: 15rem;

        border-width: 0;
        border-bottom-left-radius: 20px;  
        border-top-left-radius: 20px;  
        border-bottom-right-radius: 20px;  
        border-top-right-radius: 20px;  
    }


    #date {
        position: absolute;
        height: 1.7rem;
        top: 14.7rem;
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

    #held_in {
        position: absolute;
        height: 1.7rem;
        top: 19.7rem;
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


    @media screen and (max-width: 1100px) {

        .Container {
            position: absolute;
            top: 5rem;
            left: 35%;
            width: 20rem;
            height: 37rem;
            justify-content: center;
            background: #FAF7F0;
        
        
            border-top-right-radius: 10%;
        }

        .olympic-img {
            position: absolute;
            width: 5rem;
            top: 6rem;
            left: 60%;
            z-index: 10;
        }

        .olympics-header {
            display: none;
        }
}
    </style>



</head>
<body>
<img src="../../imgs/images-removebg-preview.png" alt="Olympics" class="olympic-img">
    <h1 class="olympics-header">
        Olympics
    </h1>
    <div class='Container'>
        <div class='MainContainer'>
        <form action="competitionSelection.php" method="POST">  
            <p class='sport-p'>
            Sport:
            </p>
            <p class='round-p'>
            Round/Title:
            </p>
            <p class='after-p'>
            After:
            </p>
            <p class='venue-p'>
            Venue:
            </p>

            <input type="text" id="sport" name="sport">
            
            <input type="text" id="title" name="title">

            <input type="datetime-local" id="date" name="date">

            <input type="text" id="held_in" name="held_in">
            
            <input type="submit" value="Submit" class='submitBtn'> 

        </form>
        </div>
    </div>
</body>
</html>