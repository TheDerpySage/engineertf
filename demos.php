<!DOCTYPE html>
<html lang='en'>
<?php
    # A small helper to remove . and .. from scandir
    function scandir2($n){
        return array_slice(scandir($n), 2);
    }
?>
<head>
    <title>Engineer.tf - Demos</title>
    <meta charset='utf-8'>
    <link rel='icon' type='image/x-icon' href='assets/favicon.ico' />
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css" integrity='sha384-Vwj80kTHnbvFQKFx/DXnuzcgBarxFKFKVn0/CvmrVdyYhYHbg2e05M8TF4dskCwA' crossorigin='anonymous'>
    <link rel="stylesheet" href="./css/style.css">
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js' integrity='sha384-N+hjelBRegvuPAsq7MTLjYC2XIhcdnMqJtJqW2i8lSU0LYCr7SJP33GsoNGWk9Aj' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
    <style>
        table {
            width: 100%;
        }

        td, th {
            text-align:center;
        }

        body {
            background-image: url('assets/engineer.jpg');
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
        table.dataTable tbody tr {
            background-color: #343a40;
        }
    </style>
    <?php 
        include "meta.php"; 
        metadata("Demos");
    ?>
</head>
<?php include "nav.html"; ?>
<body>
    <div class='container container-custom' style='margin-top:30px; margin-bottom:30px'>
        <div class='row bg-primary text-light'>
            <div class='col text-center'>
                <br />
                <h1>Demos</h1>
                <br />
            </div>
        </div>
        <div class='row bg-light-seethru'>
            <div class='col-sm-12'>
            <br />
            <?php
                #Simple script to spit out the contents of a folder with download links
                $files = scandir2('demos');
                sort($files);
                #To flip the order of the files so that our newest files are first
                $files = array_reverse($files);
                $json = json_decode(file_get_contents("demos/seasons.json"), true);
                $logs_json = json_decode(file_get_contents("demos/logs.json"), true);
                echo "<table id='table1' class='table table-striped table-dark table-custom'>
                <thead>
                <tr>
                <th scope='col'>League</th>
                <th scope='col'>Division</th>
                <th scope='col'>Season/<br class='br'/>Event</th>
                <th scope='col'>Map</th>
                <th scope='col'>Matchup</th>
                <th scope='col'>Date</th>
                <th scope='col'>Logs</th>
                <th scope='col'>Downloads</th>
                </tr>
                </thead>
                <tbody class='tbody'>";
                for ($x = 0; $x < count($files); $x++) {
                    $file = $files[$x];
                    if(substr($file,-4) == '.dem') {
                        $data = explode('-', substr(strtoupper($file),0,-4));
                        $partsof = explode('_', $data[9]);
                        if($partsof[0] == '1') {
                            /* LEAGUE-FORMAT-DIV-SEASON-WEEK-MATCH_UP-YYYYMMDD-TIME-MAP-PART_OF-MISSING */
                            /* 0      1      2   3      4    5        6        7    8   9       10      */
                            /* Missing only used in dummy files to indicate missing parts of otherwise  */
                            /* complete sets.                                                           */
                            $format = strtolower($data[1]);
                            if($format == "hl"){
                                $season = (int)substr($data[3],1);
                                $week = (int)substr($data[4],1);
                                $matchup = explode('_', strtolower($data[5]));
                                $red = $json["seasons"][$format][($season-1)][$matchup[0]];
                                $blu = $json["seasons"][$format][($season-1)][$matchup[1]];
                                $date = substr($data[6], 0, 4) . '/' . substr($data[6], 4, 2) . '/' . substr($data[6], 6, 2);
                                $map = strtolower($data[8]);

                                if(!empty($logs_json["logs"][$format][($season-1)])) {
                                    #Determine if this demo has a log, found using identifier WEEK-MATCH_UP-MAP
                                    # TO-DO: WRITE INSTANCE FOR MULTIPLE LOGS. CURRENTLY, THIS ONLY GRABS THE FIRST
                                    $log_id = $logs_json["logs"][$format][($season-1)][strtolower($data[4] . "-" .  $data[5] . "-" . $data[8])][0];
                                    if(isset($log_id)) {
                                        $stats="<a target='_blank' href='https://logs.tf/$log_id'>Link</a>";
                                    } else { $stats="N/A"; }
                                } else { $stats="N/A"; }
                                echo '<tr>';
                                echo "<td>$data[0] $data[1]</td>
                                <td>$data[2]</td>
                                <td>Season $season <br class='br'/>(Week $week)</td>
                                <td>$map</td>
                                <td>$red <br class='br'/>vs. <br class='br'/>$blu</td>
                                <td>$date</td>
                                <td>$stats</td>
                                <td>";
                                for ($t = 0; $t < (int)$partsof[1]; $t++) {
                                    #Since we flipped the array, this has to walk backwards instead of forward
                                    $temp = $files[$x-$t];
                                    $part = $t + 1;
                                    $data = explode('-', substr($temp,0,-4));
                                    if ($data[10] != 'missing') {
                                        echo "<a href='demos/$temp'>Part $part</a><br />";
                                    } else {
                                        echo "Part $part Missing<br />";
                                    }
                                }
                                echo '</td></tr>';
                            }
                        }
                    }
                }
                echo '</tbody>
                </table>';
            ?>
            <br />
            </div>
        </div>
    </div>
</body>
<?php include "footer.html"; ?>
<script>
$(document).ready(function(){
  $("#table1").dataTable({
        "iDisplayLength": 25,
        "aLengthMenu": [[25, 50, 100,  -1], [25, 50, 100, "All"]],
        "order": [[ 5, "desc" ]]
    });
});
</script>
</html>
