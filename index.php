<!DOCTYPE html>
<html lang='en'>
<?php
    include "dependencies/Parsedown.php";
    $Parsedown = new Parsedown();
?>
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
                <?php
                    # CHANGE THIS TO CHANGE THE NUMBER OF POSTS SHOWN ON THE FRONT PAGE 
                    $MAX = 2;
                    # CHANGE THIS TO CHANGE THE NUMBER OF LINES RENDERED (THERE ARE 2 HEADER LINES)
                    $RENDER_LINES = 4;
                    $dir = 'blog';
                    $folders = scandir($dir);
                    sort($folders);
                    #To flip the order of the files so that our newest files are first
                    $folders = array_reverse($folders);
                    for( $x = 0; $x < $MAX; $x++ ) {
                        $folder = $folders[$x];
                        $files = scandir("$dir/$folder");
                        foreach($files as $file){
                            if (explode(".", $file)[1] == "md") {
                                # Limit Render Lines
                                $handler = fopen("$dir/$folder/$file", "r");
                                $md = "##[" . trim(substr(fgets($handler), 2)) . "](blog.php?post=$folder)\n";
                                for ( $y = 0; $y < $RENDER_LINES; $y++ ) {
                                    $md .= fgets($handler);
                                }
                                if(!feof($handler))
                                    $md .= "\n[Read more...](blog.php?post=$folder)";
                                fclose($handler);
                                # Just read entire file
                                // $handler = fopen("$dir/$folder/$file", "r");
                                // $md = "##[" . substr(fgets($handler), 2) . "](blog.php?post=$folder)";
                                // while(!feof($handler))
                                //     $md .= fgets($handler);
                                // fclose($handler);
                                echo $Parsedown->text($md);
                                echo "<br />";
                            }
                        }
                    }
                ?>
            </div>
            <div class='col-sm-2 text-secondary' style='margin-top:5px'>
                <ul class='nav nav-pills flex-column border border-dark rounded-lg bg-dark'>
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