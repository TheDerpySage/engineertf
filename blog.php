<!DOCTYPE html>
<html lang='en'>
<?php
    function iAmError($n) {
        return "<center><h3>An Error Occured: $n</h3><video width='500' autoplay loop><source src='assets/jazz.webm' type='video/webm' autoplay='true'>Your shitty browser does not support Webms. Get a real browser you fucking nerd.</video></center>";
    }

    # A small helper to remove . and .. from scandir
    function scandir2($n){
        return array_slice(scandir($n), 2);
    }

    include "dependencies/Parsedown.php";
    $Parsedown = new Parsedown();

    /* GET */
    $post = isset($_GET['post']) ? $_GET['post'] : '';
?>
<head>
    <title>Engineer.tf - Blog</title>
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
        if (empty($post)) {
            metadata("Blog");
        } else {
            $files = scandir2("blog/$post");
            $title = "";
            foreach($files as $file){
                $file = explode(".",$file);
                if ($file[1] == "md") {
                    $title = $file[0];
                    break;
                }
            }
            metadata_post("Blog post $post", $title);
        }
    ?>
</head>
<?php include "nav.html"; ?>
<body>
    <div class='container' style='margin-top:30px; margin-bottom:30px'>
        <div class='row bg-primary text-light'>
            <div class='col text-center'>
                <br />
                <h1>Blog</h1>
                <br />
            </div>
        </div>
        <div class='row bg-light-seethru'>
            <div class='col-sm-12'>
            <br />
                <?php
                    $dir = 'blog';
                    if(empty($post)) {
                        # CHANGE THIS TO CHANGE THE NUMBER OF LINES RENDERED (THERE ARE 2 HEADER LINES, BUT THE FIRST ONE HAS HARD CODED HANDLING)
                        $RENDER_LINES = 5;
                        # Include array_slice 2 to exclude . and .. folder paths
                        $folders = scandir2($dir);
                        sort($folders);
                        #To flip the order of the files so that our newest files are first
                        $folders = array_reverse($folders);
                        foreach($folders as $folder) {
                            $files = scandir2("$dir/$folder");
                            foreach($files as $file){
                                if (explode(".", $file)[1] == "md") {
                                    # Limits the number of lines that we render
                                    $handler = fopen("$dir/$folder/$file", "r");
                                    $md = "##[" . trim(substr(fgets($handler), 2)) . "](blog.php?post=$folder)\n";
                                    for ( $x = 0; $x < $RENDER_LINES; $x++ ) {
                                        $md .= fgets($handler);
                                    }
                                    if(!feof($handler))
                                        $md .= "\n[Read more...](blog.php?post=$folder)";
                                    fclose($handler);
                                    # Renders whole posts
                                    // $handler = fopen("$dir/$folder/$file", "r");
                                    // $md = "##[" . substr(fgets($handler), 2) . "](blog.php?post=$folder)";
                                    // while(!feof($handler))
                                    //     $md .= fgets($handler);
                                    // fclose($handler);
                                    echo $Parsedown->text($md);
                                    echo "<br />";
                                    break;
                                }
                            }
                        }
                    } else {
                        if(file_exists("$dir/$post")){
                            $files = scandir2("$dir/$post");
                            foreach($files as $file){
                                if (explode(".", $file)[1] == "md") {
                                    $handler = fopen("$dir/$post/$file", "r");
                                    $md = "##[" . trim(substr(fgets($handler), 2)) . "](blog.php?post=$post)\n";
                                    while(!feof($handler))
                                        $md .= fgets($handler);
                                    fclose($handler);
                                    echo $Parsedown->text($md);
                                    echo "<br />";
                                    break;
                                }
                            }
                        } else {
                            echo iAmError('Blog post not found.');
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<?php include "footer.html"; ?>
</html>