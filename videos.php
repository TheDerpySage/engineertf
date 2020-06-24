<!DOCTYPE html>
<html lang="en">
<?php
    function iAmError($n) {
        return "<center><h3>An Error Occured: $n</h3><video width='500' autoplay loop><source src='assets/jazz.webm' type='video/webm' autoplay='true'>Your shitty browser does not support Webms. Get a real browser you fucking nerd.</video></center>";
    }
        
    /* GET */
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $search = isset($_GET['search']) ? $_GET['search'] : '';

?>
<head>
    <title>Engineer.tf - Videos</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        table {
            width: 100%;
        }

        td {
            padding: 5px;
            text-align:center;
        }

        td:hover {
            background-color: #FFFFFF;
        }

        body {
            background-image: url("assets/engineer.jpg");
            background-repeat: no-repeat;
            background-color: #000000;
        }

        h2 {
            text-align: center;
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
</head>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" href="#"><img src="assets/nav-logo.png" style="width:40px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="./index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./blog.php">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./videos.php">Videos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./demos.php">Demos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://www.youtube.com/channel/UCpLek2j00mwJawRD7g6SBJQ">Youtube</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://www.twitch.tv/engineertf">Twitch</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://discord.gg/S5ekEUT">Discord</a>
            </li>
        </ul>
    </div>
</nav>
<body>
    <div class="container" style="margin-top:30px; margin-bottom:30px">
        <div class="row bg-primary text-light">
            <div class="col text-center">
                <br />
                <h1>Videos</h1>
                <br />
            </div>
        </div>
        <div class="row bg-light-seethru">
            <div class="col-sm-12">
            <br />
            <form action='./videos.php' method='get' name='searchform'>
                <?php 
                # This is here so we can see the search term used still
                echo "<input type='text' name='search' value='$search' placeholder='Search'>"; 
                ?>
                <input class='text' type='submit' value='Search'>
            </form>
            <br />
            <?php
            $FILE = './videos.txt';
            if(file_exists($FILE)){
                $HANDLER = fopen($FILE, "r");
                if(empty($id)){
                    #If no id passed, load the normal page
                    $i = 0;
                    echo "<table><tr>";
                    while (!feof($HANDLER)) {
                        $LINE = explode(",", fgets($HANDLER));
                        #Watch out for newline characters
                        if(trim($LINE[0]) !== ""){
                            # If no filter has been given, process as normal
                            if(empty($search)){
                                echo "<td><div class='border border-dark rounded-lg bg-dark'><a href='./videos.php?id=$LINE[0]'><img style='width: 100%' src='https://img.youtube.com/vi/$LINE[0]/hqdefault.jpg'><p>$LINE[1]</p></a></div></td>";
                                $i++;
                                # Items per row break
                                if (($i % 2) == 0)
                                    echo "</tr><tr>";
                            # Else process, but filter based on our search term
                            } else {
                                # No case sensitive search
                                if (strpos(strtolower($LINE[1]), strtolower($search)) !== false){
                                    echo "<td><div class='border border-dark rounded-lg bg-dark'><a href='./videos.php?id=$LINE[0]'><img style='width: 100%' src='https://img.youtube.com/vi/$LINE[0]/hqdefault.jpg'><p>$LINE[1]</p></a></div></td>";
                                    $i++;
                                    # Items per row break
                                    if (($i % 2) == 0)
                                        echo "</tr><tr>";
                                }
                            }
                        }
                    }
                    # If no results, say as much...
                    if ($i == 0){
                        echo "<p>No results</p>";
                    }
                    echo "</tr></table>";
                    fclose($HANDLER);
                } else {
                    #If an id is passed, start embed process
                    $title = "";
                    $HANDLER = fopen($FILE, "r");
                    #Validate the given id against whats in our file, and get our video title if we find it. 
                    while (!feof($HANDLER)) {
                        $LINE = explode(",", fgets($HANDLER));
                        if ($id == $LINE[0]){
                            $title = $LINE[1];
                            break;
                        }
                    }
                    fclose($HANDLER);
                    #If it's in our file, finish processing
                    if ($title !== ""){
                        echo "<h2>$title</h2>";
                        echo "<br /><div class='embed-responsive embed-responsive-16by9'>";
                        echo "<iframe class='embed-responsive-item' src='https://www.youtube.com/embed/$id?autoplay=1&rel=0' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                        echo "</div><br />";
                        echo "<a href='./videos.php' role='button' class='btn btn-primary btn-sm'><--Back--</a><br />";
                    #If it's not in our file, error out
                    } else { echo iAmError("Not a valid video"); }
                }
            #If there is no file, error out
            } else { echo iAmError("Videos File Not Found"); }

            #Why do this?
            #I dunno, I like input validation even tho it wouldn't be THAT hard for someone to client side deface the site if they REALLY wanted to.

            ?>
            <br />
            </div>
        </div>
    </div>
</body>
<footer class="footer card-footer text-center bg-dark">
    <a href="./exaflamer/"><img src="assets/exa_colorcorrected.png" style="height:60px"></a>
    <br />
    <small class="text-muted">Last updated February 2020</small>
</footer>

</html>