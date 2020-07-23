<!DOCTYPE html>
<html lang='en'>

<head>
    <title>Engineer.tf - Home</title>
    <meta charset='utf-8'>
    <link rel='icon' type='image/x-icon' href='assets/favicon.ico' />
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
    <style>
        body {
            background-image: url('assets/engineer.jpg');
            background-repeat: no-repeat;
            background-color: #000000;
        }

        h2 {
            text-align: center;
        }

        h3 {
            text-align: center;
            color: #FFFFFF;
        }

        a {
            color: #FFFFFF;
            text-align: center;
        }

        a:hover {
            color: #999999;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .seethru {
            opacity: .75;
        }

        .bg-light-seethru {
            background-color: rgba(248, 249, 250, 0.8)
        }

        .footer {
            bottom: 0;
            width: 100%;
        }
    </style>
    <?php 
        include "meta.php"; 
        metadata("Home");
    ?>
</head>
<?php include "nav.html"; ?>
<body>
    <div class='container' style='margin-top:30px; margin-bottom:30px'>
        <div class='row bg-primary text-light'>
            <div class='col text-center'>
                <img class='title-img' src='assets\transparent-logo-2.png' style='max-width: 50%'>
                <p>A resource for Engie Mains</p>
            </div>
        </div>
        <div class='row bg-light-seethru'>
            <div class='col-sm-10' style='margin-top:30px'>
                <h2>Welcome to Engineer.tf!</h2>
                <h5>Built by Engineers, for Engineers; Oct 2, 2019</h5>
                <p>Engineer.tf is a competitive engineering resource for the game Team Fortress 2.</p>
                <p>It was created in december 2016 by Mothership, waxx, and Exa_ to foster growth of engineer mains. 
                We provide map reviews, demo reviews, mentoring, and discussion from the standpoint of high level game-play 
                to ensure that the next generation of engineers will be ready to be the best they can be.</p>
                <br>
                <h2>Website Construction</h2>
                <h5>Part 1, Oct 2, 2019</h5>
                <p>Welcome to the new landing page for Engineer.tf! </p>
                <p>Our website is currently under construction and will hopefully be done soon! Until then, you can check 
                out the resources on the right side bar for our youtube, twitch, and discord information. Our discord is 
                full of other engineer mains and other highlander players who are highly experianced in playing the format 
                and are always willing to help out or answer questions. Feel free to drop in and say hello!</p>
            </div>
            <div class='col-sm-2 text-secondary' style='margin-top:5px'>
                <ul class='nav nav-pills flex-column bg-dark'>
                    <h3 style='width:100%; background-color:#00448a'>Social Media</h3>
                    <li class='nav-item'>
                        <a class='nav-link' href='https://www.youtube.com/channel/UCpLek2j00mwJawRD7g6SBJQ'><img src='assets/engi-youtube.png' style='width:50px;'>Youtube</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='https://www.twitch.tv/engineertf'><img src='assets/engi-twitch.png' style='width:50px;'>Twitch</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='https://discord.gg/S5ekEUT'><img src='assets/engi-discord.png' style='width:50px;'>Discord</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
<?php include "footer.html"; ?>
</html>