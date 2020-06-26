<!DOCTYPE html>
<html lang="en">

<head>
    <title>Engineer.tf - Demos</title>
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

        td, th {
            text-align:center;
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
            color: #999999;
            text-align: center;
        }

        a:hover {
            color: #FFFFFF;
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
                <h1>Demos</h1>
                <br />
            </div>
        </div>
        <div class="row bg-light-seethru">
            <div class="col-sm-12">
            <br />
            <?php
                #Simple script to spit out the contents of a folder with download links
                $dir = "demos";
                $files = scandir($dir);
                sort($files);
                $json = json_decode(file_get_contents("$dir/seasons.json"), true);
                echo "<table class='table table-striped table-dark'>
                <tr>
                <th scope='col'>League</th>
                <th scope='col'>Division</th>
                <th scope='col'>Season/Event</th>
                <th scope='col'>Map</th>
                <th scope='col'>Matchup</th>
                <th scope='col'>Date</th>
                <th scope='col'>Downloads</th>
                </tr>
                </thead>
                <tbody>";
                for ($x = 0; $x < count($files); $x++) {
                    $file = $files[$x];
                    if(substr($file,-4) == ".dem") {
                        $data = explode('-', substr(strtoupper($file),0,-4));
                        $partsof = explode('_', $data[9]);
                        if($partsof[0] == "1") {
                            echo "<tr>";
                            /* LEAGUE-FORMAT-DIV-SEASON-WEEK-MATCH_UP-YYYYMMDD-TIME-MAP-PART_OF-MISSING */
                            /* 0      1      2   3      4    5        6        7    8   9       10      */
                            /* Missing only used in dummy files to indicate missing parts of otherwise  */
                            /* complete sets.                                                           */
                            $season = (int)substr($data[3],1);
                            $week = (int)substr($data[4],1);
                            $matchup = explode('_', strtolower($data[5]));
                            $red = $json['seasons'][($season-1)][$matchup[0]];
                            $blu = $json['seasons'][($season-1)][$matchup[1]];
                            $date = substr($data[6], 0, 4) . "/" . substr($data[6], 4, 2) . "/" . substr($data[6], 6, 2);
                            $map = strtolower($data[8]);

                            echo "<td>$data[0] $data[1]</td>
                            <td>$data[2]</td>
                            <td>Season $season (Week $week)</td>
                            <td>$map</td>
                            <td>$red vs. $blu</td>
                            <td>$date</td>
                            <td>";
                            for ($t = 0; $t < (int)$partsof[1]; $t++) {
                                $temp = $files[$x+$t];
                                $part = $t + 1;
                                $data = explode('-', substr($temp,0,-4));
                                if ($data[10] != 'missing') {
                                    echo "<a href='$dir/$temp'>Part $part</a><br />";
                                } else {
                                    echo "Part $part Missing<br />";
                                }
                            }
                            echo "</td></tr>";
                        }
                    }
                }
                echo "</tbody>
                </table>";
            ?>
            <br />
            </div>
        </div>
    </div>
</body>
<footer class="footer card-footer text-center bg-dark">
    <a href="./exaflamer/"><img src="assets/exa_colorcorrected.png" style="height:60px"></a>
    <br />
    <small class="text-muted">Last updated June 2020</small>
</footer>

</html>