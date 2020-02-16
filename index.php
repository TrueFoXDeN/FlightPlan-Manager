<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="calculator.php"></script>
    <title>Flugplan</title>

</head>

<body>
<?php
$host_name = 'mysql01.manitu.net:3306';
$database = 'db42928';
$user_name = 'u42928';
$password = 'GaNJGNU9gBkT';
$connect = mysqli_connect($host_name, $user_name, $password, $database);


session_start();
if (mysqli_connect_errno()) {
    die('<p>Verbindung zum MySQL Server fehlgeschlagen: ' . mysqli_connect_error() . '</p>');
}

//$DEP = null;
$Route = null;
$NoGround_DEP = 'No frequency available';
$NoAtis_DEP = 'No frequency available';
$NoDelivery_DEP = 'No frequency available';
$NoTower_DEP = 'No frequency available';
$NoApproach_DEP = 'No frequency available';
$Del_DEP_value = '';
$Atis_DEP_value = '';
$Ground_DEP_value = '';
$Tower_DEP_value = '';
$Approach_DEP_value = '';
$NoAtis_ARR = 'No frequency available';
$NoApproach_ARR = 'No frequency available';
$NoTower_ARR = 'No frequency available';
$NoGround_ARR = 'No frequency available';
$Atis_ARR_value = '';
$Approach_ARR_value = '';
$Tower_ARR_value = '';
$Ground_ARR_value = '';
$NoRwy_DEP = 'Not available';
$NoRwy_ARR = 'Not available';
$Rwy_DEP_value = '';
$Rwy_ARR_value = '';
$NoSid = 'Not available';
$Sid_value = '';
$NoStar = 'Not available';
$Star_value = '';

$DepartureReturn = array();
$ArrivalReturn = array();
$SidReturn = array();
$StarReturn = array();
if (isset($_POST['name_departure_input'])) {
    $DEP_temp = $_POST['name_departure_input'];
    $DEP = strtoupper($DEP_temp);
    $DepartureReturn = sqlAbfrageDeparture($connect, $DEP);
    if (isset($DepartureReturn[0])) {
        $NoGround_DEP = $DepartureReturn[0];
    }
    if (isset($DepartureReturn[1])) {
        $Ground_DEP_value = $DepartureReturn[1];
    }
    if (isset ($DepartureReturn[2])) {
        $NoAtis_DEP = $DepartureReturn[2];
    }
    if (isset ($DepartureReturn[3])) {
        $Atis_DEP_value = $DepartureReturn[3];
    }
    if (isset ($DepartureReturn[4])) {
        $NoTower_DEP = $DepartureReturn[4];
    }
    if (isset ($DepartureReturn[5])) {
        $Tower_DEP_value = $DepartureReturn[5];
    }
    if (isset ($DepartureReturn[6])) {
        $NoDelivery_DEP = $DepartureReturn[6];
    }
    if (isset ($DepartureReturn[7])) {
        $Del_DEP_value = $DepartureReturn[7];
    }
    if (isset ($DepartureReturn[8])) {
        $NoApproach_DEP = $DepartureReturn[8];
    }
    if (isset ($DepartureReturn[9])) {
        $Approach_DEP_value = $DepartureReturn[9];
    }
    if (isset($DepartureReturn[10])) {
        $NoRwy_DEP = $DepartureReturn[10];
    }
    if (isset($DepartureReturn[11])) {
        $Rwy_DEP_value = $DepartureReturn[11];
    }

    if (isset($_POST['name_arrival_input'])) {
        $ARR_temp = $_POST['name_arrival_input'];
        $ARR = strtoupper($ARR_temp);
        $Route = routeLaden($DEP, $ARR, $connect);
        $Treibstoff = treibstoffLaden($DEP, $ARR, $connect);
        $Alternate = alternateLaden($DEP, $ARR, $connect);
        $SidReturn = sidLaden($Route, $DEP, $connect);
        $StarReturn = starLaden($Route, $ARR, $connect);
        if (isset($SidReturn[0])) {
            $NoSid = $SidReturn[0];
        }
        if (isset($SidReturn[1])) {
            $Sid_value = $SidReturn[1];
        }
        if (isset($StarReturn[0])) {
            $NoStar = $StarReturn[0];
        }
        if (isset($StarReturn[1])) {
            $Star_value = $StarReturn[1];
        }

    }
}
if (isset($_POST['name_arrival_input'])) {
    $ARR_temp = $_POST['name_arrival_input'];
    $ARR = strtoupper($ARR_temp);
    $ArrivalReturn = sqlAbfrageArrival($connect, $ARR);
    if (isset($ArrivalReturn[0])) {
        $NoAtis_ARR = $ArrivalReturn[0];
    }
    if (isset($ArrivalReturn[1])) {
        $Atis_ARR_value = $ArrivalReturn[1];
    }
    if (isset($ArrivalReturn[2])) {
        $NoApproach_ARR = $ArrivalReturn[2];
    }
    if (isset($ArrivalReturn[3])) {
        $Approach_ARR_value = $ArrivalReturn[3];
    }
    if (isset($ArrivalReturn[4])) {
        $NoTower_ARR = $ArrivalReturn[4];
    }
    if (isset($ArrivalReturn[5])) {
        $Tower_ARR_value = $ArrivalReturn[5];
    }
    if (isset($ArrivalReturn[6])) {
        $NoGround_ARR = $ArrivalReturn[6];
    }
    if (isset($ArrivalReturn[7])) {
        $Ground_ARR_value = $ArrivalReturn[7];
    }
    if (isset($ArrivalReturn[8])) {
        $NoRwy_ARR = $ArrivalReturn[8];
    }
    if (isset($ArrivalReturn[9])) {
        $Rwy_ARR_value = $ArrivalReturn[9];
    }
}


?>

<header>
    <div class="logo">
        <img style="vertical-align:middle; background-color: #5f5f5f" width="60px" src="img/flugzeug.png">
        FlightPlan Manager
    </div>

</header>
<div id="div_links">
    <form id="id_suche" method="post">
        <input type="text" id="id_route_input_dep" name="name_departure_input" placeholder="Departure ICAO">
        <input type="text" id="id_route_input_arr" name="name_arrival_input" placeholder="Arrival ICAO">
        <button type="submit" id="id_create_flightplan">Suchen</button>
        <br>
        <iframe id="id_calculator_frame" src="calculator.php"></iframe>
    </form>


</div>


<!--Datalists Departure-Frequenzen-->
<datalist id="list_ground_dep" name="list_ground_dep"></datalist>
<datalist id="list_atis_dep" name="list_atis_dep"></datalist>
<datalist id="list_tower_dep" name="list_tower_dep"></datalist>
<datalist id="list_delivery_dep" name="list_delivery_dep"></datalist>
<datalist id="list_approach_DEP" name="list_approach_DEP"></datalist>
<!--Departure Runway-->
<datalist id="list_rwy_dep" name="list_rwy_dep"></datalist>


<!--Datalists Arrival-Frequenzen-->
<datalist id="list_ground_arr" name="list_ground_arr"></datalist>
<datalist id="list_atis_arr" name="list_atis_arr"></datalist>
<datalist id="list_tower_arr" name="list_tower_arr"></datalist>
<datalist id="list_approach_arr" name="list_approach_arr"></datalist>
<!--Arrival Runway-->
<datalist id="list_rwy_arr" name="list_rwy_arr"></datalist>
<!--SID & STAR-->
<datalist id="list_sid" name="list_sid"></datalist>
<datalist id="list_star" name="list_star"></datalist>

<div id="id_flugplan">
    <form id="id_form_plan">
        <br>
        <fieldset id="id_fieldset_beforeflight">
            <legend id="id_fieldset_beforeflight_legend">Before flight</legend>
            Date: <input type="text" id="id_date">
            ETD: <input type="text" id="id_etd">
            DEP Apt: <input type="text" id="id_dep_apt" value="<?php echo @$DEP; ?>"/>
            ARR Apt: <input type="text" id="id_arr_apt" value="<?php echo @$ARR; ?>"/>
            ALTN Apt: <input type="text" id="id_altn_apt" value="<?php echo @$Alternate; ?>">
            Callsign: <input type="text" id="id_calllsign">
            Stand: <input type="text" id="id_stand"><br><br>
            ACT Runways: <input type="text" id="id_act_rwys">
            TA: <input type="text" id="id_ta">
            Cruise FL: <input type="text" id="id_cruise_fl">
            ATIS Info: <input type="text" id="id_atis_info_dep">
            QNH: <input type="text" id="id_qnh_dep">
            Temp: <input type="text" id="id_temp_dep">
            Enroute Time: <input type="text" id="id_enroute_time">
            Pax: <input type="text" id="id_pax">
            Cargo: <input type="text" id="id_cargo">
            <br><br>
            Block Fuel: <input type="text" id="id_block_fuel">
            ZFW: <input type="text" id="id_zfw">
            TOW: <input type="text" id="id_tow">
            Trip Fuel: <input type="text" id="id_tripfuel" value="<?php echo @$Treibstoff; ?>">
            Fuel hours: <input type="text" id="id_fuel_hours">
            <br><br>
            ATIS Freq: <input type="text" list="list_atis_dep" id="id_atis_freq_dep"
                              PLACEHOLDER="<?php echo @$NoAtis_DEP; ?>"
                              value="<?php echo @$Atis_DEP_value; ?>">
            Delivery Freq: <input type="text" list="list_delivery_dep" id="id_delivery_freq"
                                  PLACEHOLDER="<?php echo @$NoDelivery_DEP; ?>" value="<?php echo @$Del_DEP_value; ?>">
            Ground 1 Freq: <input list="list_ground_dep" type="text" id="id_gnd_1_freq_dep"
                                  PLACEHOLDER="<?php echo @$NoGround_DEP; ?>" value="<?php echo @$Ground_DEP_value; ?>">
            Ground 2 Freq: <input list="list_ground_dep" type="text" id="id_gnd_2_freq_dep"
                                  PLACEHOLDER="<?php echo @$NoGround_DEP; ?>" value="<?php echo @$Ground_DEP_value; ?>">
            Tower Freq: <input type="text" list="list_tower_dep" id="id_twr_freq_dep"
                               PLACEHOLDER="<?php echo @$NoTower_DEP; ?>"
                               value="<?php echo @$Tower_DEP_value; ?>">


        </fieldset>
        <br>
        <fieldset>
            <legend>ATC Clearance</legend>
            SID: <input type="text" id="id_sid" list="list_sid" placeholder="<?php echo @$NoSid; ?>"
                        value="<?php echo @$Sid_value; ?>">
            RWY: <input type="text" id="id_rwy_takeoff" list="list_rwy_dep" placeholder="<?php echo @$NoRwy_DEP; ?>"
                        value="<?php echo @$Rwy_DEP_value; ?>">
            Init CLB: <input type="text" id="id_init_clb">
            Squawk: <input type="text" id="id_squawk">
            <br><br>
            <textarea id="id_further_information" placeholder="Further Information:"></textarea>
            <textarea id="id_route" name="name_route"
                      placeholder="Route:"><?php echo htmlspecialchars($Route); ?></textarea>
        </fieldset>
        <br>
        <fieldset>
            <legend>Taxi</legend>
            Time: <input type="text" id="id_taxi_time">
            <br><br>
            <textarea id="id_taxi_route" placeholder="Taxiroute:"></textarea>
        </fieldset>
        <br>
        <fieldset>
            <legend>Takeoff</legend>
            Time: <input type="text" id="id_takeoff_time">
            Approach Freq: <input type="text" id="id_dep_freq" list="list_approach_DEP"
                                  placeholder="<?php echo @$NoApproach_DEP; ?>"
                                  value="<?php echo @$Approach_DEP_value; ?>">
            Radar 1: <input type="text" id="id_rdr_1_freq">
            Radar 2: <input type="text" id="id_rdr_2_freq">
            Radar 3: <input type="text" id="id_rdr_3_freq">
            Radar 4: <input type="text" id="id_rdr_4_freq">
            <br> <br>
            <textarea id="id_notes_dep" placeholder="Notizen:"></textarea>
        </fieldset>
        <br>
        <fieldset>
            <legend>Descending, landing, taxiing</legend>
            Time: <input type="text" id="id_time_landing">
            Runway: <input type="text" id="id_rwy_landing" list="list_rwy_arr" placeholder="<?php echo @$NoRwy_ARR; ?>"
                           value="<?php echo @$Rwy_ARR_value; ?>">
            STAR: <input type="text" id="id_star" list="list_star" placeholder="<?php echo @$NoStar; ?>"
                         value="<?php echo @$Star_value; ?>">
            Approach: <input type="text" id="id_approach">
            Stand: <input type="text" id="id_stand_arr">
            <br><br>
            ATIS Freq: <input type="text" id="id_atis_freq_arr" list="list_atis_arr"
                              placeholder="<?php echo @$NoAtis_ARR; ?>"
                              value="<?php echo @$Atis_ARR_value; ?>">
            Approach Freq: <input type="text" id="id_app_freq_arr" list="list_approach_arr"
                                  placeholder="<?php echo @$NoApproach_ARR; ?>"
                                  value="<?php echo @$Approach_ARR_value; ?>">
            Tower Freq: <input type="text" id="id_twr_freq_arr" list="list_tower_arr"
                               placeholder="<?php echo @$NoTower_ARR; ?>"
                               value="<?php echo @$Tower_ARR_value; ?>">
            Ground 1: <input type="text" id="id_gnd_1_freq_arr" list="list_ground_arr"
                             placeholder="<?php echo @$NoGround_ARR; ?>" value="<?php echo @$Ground_ARR_value; ?>">
            Ground 2: <input type="text" id="id_gnd_2_freq_arr" list="list_ground_arr"
                             placeholder="<?php echo @$NoGround_ARR; ?>" value="<?php echo @$Ground_ARR_value; ?>">
            <br><br>
            QNH: <input type="text" id="id_qnh_arr">
            Active Runways: <input type="text" id="id_act_rwys_arr">
            Temp: <input type="text" id="id_temp_arr">
            Transition Level: <input type="text" id="id_tl">
            ATIS Info: <input type="text" id="id_atis_info_arr">
            <br><br>
            <textarea id="id_notes_arr" placeholder="Notizen:"></textarea>

        </fieldset>
        <br>

    </form>
</div>


<?php
function sqlAbfrageDeparture($connect, $DEP)
{
    $ReturnFrequencies = array();
    $sql = "SELECT concat(frequenz, ' ',bezeichnung) as ergebnis FROM airports join ground on airports.icao = ground.icao where airports.icao ='$DEP'";
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        echo "<datalist id ='list_ground_dep'>";
        echo "<option value=" . $row['ergebnis'] . ">";
        echo $row['ergebnis'];
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        $text = explode(" ", $row['ergebnis']);
        array_push($ReturnFrequencies, $text[0]);
    } else if (mysqli_num_rows($result) > 1) {
        echo "<datalist id ='list_ground_dep'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['ergebnis'] . ">";
            echo $row['ergebnis'];
        }
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        array_push($ReturnFrequencies, '');
    } else {
        array_push($ReturnFrequencies, 'Not available');
        array_push($ReturnFrequencies, '');
    }

    $sql = "SELECT concat(frequenz, ' ', bezeichnung) as ergebnis FROM airports join atis a on airports.icao = a.icao where a.icao ='$DEP'";
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        echo "<datalist id ='list_atis_dep'>";
        echo "<option value=" . $row['ergebnis'] . ">";
        echo $row['ergebnis'];
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        $text = explode(" ", $row['ergebnis']);
        array_push($ReturnFrequencies, $text[0]);
    } else if (mysqli_num_rows($result) > 1) {
        echo "<datalist id ='list_atis_dep'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['ergebnis'] . ">";
            echo $row['ergebnis'];
        }
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        array_push($ReturnFrequencies, '');
    } else {
        array_push($ReturnFrequencies, 'Not available');
        array_push($ReturnFrequencies, '');
    }

    $sql = "SELECT concat(frequenz,' ',bezeichnung) as ergebnis FROM airports join tower a on airports.icao = a.icao where a.icao ='$DEP'";
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        echo "<datalist id ='list_tower_dep'>";
        echo "<option value=" . $row['ergebnis'] . ">";
        echo $row['ergebnis'];
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        $text = explode(" ", $row['ergebnis']);
        array_push($ReturnFrequencies, $text[0]);
    } else if (mysqli_num_rows($result) > 1) {
        echo "<datalist id ='list_tower_dep'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['ergebnis'] . ">";
            echo $row['ergebnis'];
        }
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        array_push($ReturnFrequencies, '');

    } else {
        array_push($ReturnFrequencies, 'Not available');
        array_push($ReturnFrequencies, '');
    }

    $sql = "SELECT concat(frequenz,' ',bezeichnung) as ergebnis FROM airports join delivery a on airports.icao = a.icao where a.icao ='$DEP'";
    $result = $connect->query($sql);

    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        echo "<datalist id ='list_delivery_dep'>";
        echo "<option value=" . $row['ergebnis'] . ">";
        echo $row['ergebnis'];
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        $text = explode(" ", $row['ergebnis']);
        array_push($ReturnFrequencies, $text[0]);
    } else if (mysqli_num_rows($result) > 1) {
        echo "<datalist id ='list_delivery_dep'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['ergebnis'] . ">";
            echo $row['ergebnis'];
        }
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        array_push($ReturnFrequencies, '');
    } else {
        array_push($ReturnFrequencies, 'Not available');
        array_push($ReturnFrequencies, '');
    }

    $sql = "SELECT concat (frequenz, ' ', bezeichnung) as ergebnis FROM airports join approach a on airports.icao = a.icao where a.icao = '$DEP'";
    $result = $connect->query($sql);

    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        echo "<datalist id ='list_approach_DEP'>";
        echo "<option value=" . $row['ergebnis'] . ">";
        echo $row['ergebnis'];
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        $text = explode(" ", $row['ergebnis']);
        array_push($ReturnFrequencies, $text[0]);
    } else if (mysqli_num_rows($result) > 1) {
        echo "<datalist id ='list_approach_DEP'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['ergebnis'] . ">";
            echo $row['ergebnis'];
        }
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        array_push($ReturnFrequencies, '');
    } else {
        array_push($ReturnFrequencies, 'Not available');
        array_push($ReturnFrequencies, '');
    }
    $sql = "SELECT distinct runways.richtung FROM runways join airport_runway on runways.id  = airport_runway.runway_id join airports on airport_runway.icao = '$DEP'";
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        echo "<datalist id ='list_rwy_dep'>";
        echo "<option value=" . $row['ergebnis'] . ">";
        echo $row['ergebnis'];
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select runway...');
        $text = explode(" ", $row['ergebnis']);
        array_push($ReturnFrequencies, $text[0]);
    } else if (mysqli_num_rows($result) > 1) {
        echo "<datalist id ='list_rwy_dep'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['richtung'] . ">";
            echo $row['richtung'];
        }
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select runway...');
        array_push($ReturnFrequencies, '');
    } else {
        array_push($ReturnFrequencies, 'Not available');
        array_push($ReturnFrequencies, '');
    }


    return $ReturnFrequencies;
}


function sqlAbfrageArrival($connect, $ARR)
{
    $ReturnFrequencies = array();
    $sql = "SELECT concat (frequenz, ' ', bezeichnung) as ergebnis FROM airports join atis a on airports.icao = a.icao where a.icao = '$ARR'";
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        echo "<datalist id ='list_atis_arr'>";
        echo "<option value=" . $row['ergebnis'] . ">";
        echo $row['ergebnis'];
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        $text = explode(" ", $row['ergebnis']);
        array_push($ReturnFrequencies, $text[0]);
    } else if (mysqli_num_rows($result) > 0) {
        echo "<datalist id ='list_atis_arr'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['ergebnis'] . ">";
            echo $row['ergebnis'];

        }
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        array_push($ReturnFrequencies, '');
    } else {
        array_push($ReturnFrequencies, 'Not available');
        array_push($ReturnFrequencies, '');
    }

    $sql = "SELECT concat (frequenz, ' ', bezeichnung) as ergebnis FROM airports join approach a on airports.icao = a.icao where a.icao = '$ARR'";
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        echo "<datalist id ='list_approach_arr'>";
        echo "<option value=" . $row['ergebnis'] . ">";
        echo $row['ergebnis'];
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        $text = explode(" ", $row['ergebnis']);
        array_push($ReturnFrequencies, $text[0]);
    } else if (mysqli_num_rows($result) > 0) {
        echo "<datalist id ='list_approach_arr'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['ergebnis'] . ">";
            echo $row['ergebnis'];
        }
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        array_push($ReturnFrequencies, '');
    } else {
        array_push($ReturnFrequencies, 'Not available');
        array_push($ReturnFrequencies, '');
    }

    $sql = "SELECT concat (frequenz, ' ', bezeichnung) as ergebnis FROM airports join tower a on airports.icao = a.icao where a.icao = '$ARR'";
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        echo "<datalist id ='list_tower_arr'>";
        echo "<option value=" . $row['ergebnis'] . ">";
        echo $row['ergebnis'];
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        $text = explode(" ", $row['ergebnis']);
        array_push($ReturnFrequencies, $text[0]);
    } else if (mysqli_num_rows($result) > 0) {
        echo "<datalist id ='list_tower_arr'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['ergebnis'] . ">";
            echo $row['ergebnis'];
        }
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        array_push($ReturnFrequencies, '');
    } else {
        array_push($ReturnFrequencies, 'Not available');
        array_push($ReturnFrequencies, '');
    }

    $sql = "SELECT concat (frequenz, ' ', bezeichnung) as ergebnis FROM airports join ground a on airports.icao = a.icao where a.icao = '$ARR'";
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        echo "<datalist id ='list_ground_arr'>";
        echo "<option value=" . $row['ergebnis'] . ">";
        echo $row['ergebnis'];
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        $text = explode(" ", $row['ergebnis']);
        array_push($ReturnFrequencies, $text[0]);
    } else if (mysqli_num_rows($result) > 0) {
        echo "<datalist id ='list_ground_arr'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['ergebnis'] . ">";
            echo $row['ergebnis'];
        }
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select frequency...');
        array_push($ReturnFrequencies, '');
    } else {
        array_push($ReturnFrequencies, 'Not available');
        array_push($ReturnFrequencies, '');
    }
    $sql = "SELECT distinct runways.richtung FROM runways join airport_runway on runways.id  = airport_runway.runway_id join airports on airport_runway.icao = '$ARR'";
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        echo "<datalist id ='list_rwy_arr'>";
        echo "<option value=" . $row['ergebnis'] . ">";
        echo $row['ergebnis'];
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select runway...');
        $text = explode(" ", $row['ergebnis']);
        array_push($ReturnFrequencies, $text[0]);
    } else if (mysqli_num_rows($result) > 1) {
        echo "<datalist id ='list_rwy_arr'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['richtung'] . ">";
            echo $row['richtung'];
        }
        echo "</datalist>";
        array_push($ReturnFrequencies, 'Select runway...');
        array_push($ReturnFrequencies, '');
    } else {
        array_push($ReturnFrequencies, 'Not available');
        array_push($ReturnFrequencies, '');
    }


    return $ReturnFrequencies;

}

function routeLaden($DEP, $ARR, $connect)
{
    $sql = "SELECT route from routen where routen.start_flughafen = '$DEP' AND routen.ziel_flughafen ='$ARR'";
    $ergebnis = '';
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $ergebnis = $row['route'];

        }
        return $ergebnis;
    } else {
    }
}

function treibstoffLaden($DEP, $ARR, $connect)
{
    $sql = "SELECT treibstoff from routen where routen.start_flughafen = '$DEP' AND routen.ziel_flughafen ='$ARR'";
    $ergebnis = '';
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) > 0) {

        while ($row = $result->fetch_assoc()) {
            $ergebnis = $row['treibstoff'];
        }
        return $ergebnis;
    } else {
    }


}

function alternateLaden($DEP, $ARR, $connect)
{
    $sql = "SELECT alternativer_flughafen from routen where routen.start_flughafen = '$DEP' AND routen.ziel_flughafen ='$ARR'";
    $ergebnis = '';
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $ergebnis = $row['alternativer_flughafen'];
        }
        return $ergebnis;
    } else {
    }


}

function sidLaden($Route, $DEP, $connect)
{
    $waypoints = explode(" ", $Route);
    $firstWp = $waypoints[0];
    $lastWp = $waypoints[count($waypoints) - 1];
    $sql = "SELECT name from sid where sid.wegpunkt ='$firstWp' and sid.icao = '$DEP'";

    $ReturnSid = array();
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        echo "<datalist id ='list_sid'>";
        echo "<option value=" . $row['name'] . ">";
        echo "</datalist>";
        array_push($ReturnSid, 'Select SID...');
        array_push($ReturnSid, $row['name']);
    } else if (mysqli_num_rows($result) > 1) {
        echo "<datalist id ='list_sid'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['name'] . ">";
        }
        echo "</datalist>";
        array_push($ReturnSid, 'Select SID...');
        array_push($ReturnSid, '');
    } else {
        array_push($ReturnSid, 'Not available');
        array_push($ReturnSid, '');
    }
    return $ReturnSid;

}

function starLaden($Route, $ARR, $connect)
{
    $Route = trim($Route);
    $lastWp = '';
    $waypoints = explode(" ", $Route);
//    echo $waypoints[7];
//    $lastWp = end($waypoints);

    $lastElement = count($waypoints);
    $lastElement = $lastElement - 1;
    $lastWp = $waypoints[$lastElement];
    $sql = "SELECT distinct name from star where star.wegpunkt ='$lastWp' and star.icao = '$ARR'";
    echo $lastWp;
    $ReturnStar = array();
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        echo "<datalist id ='list_star'>";
        echo "<option value=" . $row['name'] . ">";
        echo "</datalist>";
        array_push($ReturnStar, 'Select STAR...');
        array_push($ReturnStar, $row['name']);
    } else if (mysqli_num_rows($result) > 1) {
        echo "<datalist id ='list_star'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row['name'] . ">";
        }
        echo "</datalist>";
        array_push($ReturnStar, 'Select STAR...');
        array_push($ReturnStar, '');
    } else {
        array_push($ReturnStar, 'Not available');
        array_push($ReturnStar, '');
    }
    return $ReturnStar;

}


$connect->close();
?>

</body>
</html>