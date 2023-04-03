
<?php 

include "../../navbar.html";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/insertAthlete.css">    

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
            bottom: 5rem;

            z-index: 999;

            width: 17.5rem;
            height: 30rem;
            
        }

        .athlete-p {
            position: absolute;
            display: inline-block;
            top: 2rem;
            width: 10rem;

            left: 10px;

            font-family: 'Sacramento', cursive;
        }

        .prof-p {
            position: absolute;
            display: inline-block;
            width: 10rem;
            top: 7rem;

            left: 10px;

            font-family: 'Sacramento', cursive;
        }

        .age-p {
            position: absolute;
            display: inline-block;
            width: 10rem;
            top: 12.2rem;

            left: 10px;

            font-family: 'Sacramento', cursive;
        }

        .contact-p {
            position: absolute;
            display: inline-block;
            width: 10rem;
            top: 17.1rem;

            left: 10px;

            font-family: 'Sacramento', cursive;
        }

        .countary-p {
            position: absolute;
            display: inline-block;
            width: 10rem;
            top: 21.7rem;

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
        #name {
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

        #profession {
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

        #age {
            position: absolute;
            height: 1.7rem;
            top: 15rem;
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

        #gender {
            position: absolute;
            height: 2rem;
            
            padding-left: 1rem;
            top: 28rem;
            left: 2rem;
            border-top-right-radius: 10rem;
            background-color: rgba(255,255,0,0.2);
            width: 15rem;  

            border-bottom-left-radius: 20px;  
            border-top-left-radius: 20px;  
            border-bottom-right-radius: 20px;  
            border-top-right-radius: 20px; 
        }

        #contact_info {
            position: absolute;
            height: 1.7rem;
            top: 20rem;
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

        #country {
            position: absolute;
            height: 1.7rem;
            top: 24.7rem;
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

        #male {
            font-family: 'Sacramento', cursive;
        }

        #female {
            font-family: 'Sacramento', cursive;
        }

        #select {
            font-family: 'Sacramento', cursive;
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
                left: 53%;
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
    <div class="Container">

        <div class="MainContainer">
            <p class = 'athlete-p'>Athlete Name:</p>
            <p class ='prof-p'> Profession:</p>
            <p class = 'age-p'>Age:</p>
            <p class = 'contact-p'>Contact Info:</p>
            <p class = 'countary-p'>Country:</p>


            <form action="insertAthlete.php" method="POST" class="main-form">
                <input type="text" id="name" name="name" class="athlete-p">
                <input type="text" id="profession" name="profession" class="prof-p">
                <input type="number" id="age" name="age">
                <input type="text" id="contact_info" name="contact_info">
                <input type="text" id="country" name="country">
                <select id="gender" name="gender">
                    <option value="" id = 'select'> Select Gender </option>
                    <option value="M" id = 'male'>Male</option>
                    <option value="F" id = 'female'>Female</option>
                  </select>
                  <input type="submit" value="Submit" class = 'submitBtn'>
            
            </form>
        </div>
    </div>
</body>
</html>