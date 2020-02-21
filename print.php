<?php
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link href="css/print.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:300&display=swap" rel="stylesheet">
    <title>Flugplan</title>

</head>

<body>
<?php
$date ='';
$etd ='';
$dep_apt = '';
$arr_apt = '';
$alt_apt = '';
$callsign = '';
$stand_dep = '';
$enroute_time = '';
$atis_info_dep = '';
$act_rwys_dep = '';
$ta = '';
$cruise_fl = '';
$qnh_dep = '';
$temp_dep = '';
$pax = '';
$cargo='';
$block_fuel ='';
$zfw = '';
$tow = '';
$fuel_hours = '';
$tripfuel='';
$atis_freq_dep = '';
$delivery_freq='';
$gnd_1_freq_dep='';
$gnd_2_freq_dep = '';
$twr_freq_dep = '';
$sid = '';
$rwy_dep = '';
$init_climb = '';
$squawk = '';
$notes_dep = '';
$route = '';
$taxi_route = '';
$takeoff_time = '';
$dep_freq = '';
$rdr_1_freq = '';
$rdr_2_freq = '';
$rdr_3_freq = '';
$rdr_4_freq = '';
$instructions='';
$landing_time = '';
$rwy_arr = '';
$approach = '';
$stand_arr = '';
$star = '';
$atis_freq_arr = '';
$app_freq_arr = '';
$twr_freq_arr = '';
$gnd_1_freq_arr = '';
$gnd_2_freq_arr='';
$tl = '';
$temp_arr ='';
$qnh_arr='';
$atis_info_arr='';
$act_rwys_arr='';
$notes_arr='';
if(isset($_POST['name_date'])){$date=$_POST['name_date'];}
if(isset($_POST['name_etd'])){$etd=$_POST['name_etd'];}
if(isset($_POST['name_dep_apt'])){$dep_apt=$_POST['name_dep_apt'];}
if(isset($_POST['name_arr_apt'])){$arr_apt=$_POST['name_arr_apt'];}
if(isset($_POST['name_alt_apt'])){$alt_apt=$_POST['name_alt_apt'];}
if(isset($_POST['name_callsign'])){$callsign=$_POST['name_callsign'];}
if(isset($_POST['name_stand_dep'])){$stand_dep=$_POST['name_stand_dep'];}
if(isset($_POST['name_act_runways'])){$act_rwys_dep=$_POST['name_act_runways'];}
if(isset($_POST['name_ta'])&&$_POST['name_ta']!==''){$ta=$_POST['name_ta'].' ft';}
if(isset($_POST['name_cruise_fl'])){$cruise_fl=$_POST['name_cruise_fl'];}
if(isset($_POST['name_atis_info_dep'])){$atis_info_dep=$_POST['name_atis_info_dep'];}
if(isset($_POST['name_qnh_dep'])){$qnh_dep=$_POST['name_qnh_dep'].' hPa';}
if(isset($_POST['name_temp_dep'])){$temp_dep=$_POST['name_temp_dep'];}
if(isset($_POST['name_enroute_time'])&&$_POST['name_enroute_time']!==''){$enroute_time=$_POST['name_enroute_time']. ' h';}
if(isset($_POST['name_pax'])){$pax=$_POST['name_pax'];}
if(isset($_POST['name_cargo'])&&$_POST['name_cargo']!==''){$cargo=$_POST['name_cargo']. ' kg';}
if(isset($_POST['name_blockfuel'])&&$_POST['name_blockfuel']!==''){$block_fuel=$_POST['name_blockfuel']. ' kg';}
if(isset($_POST['name_zfw'])&&$_POST['name_zfw']!==''){$zfw=$_POST['name_zfw']. ' kg';}
if(isset($_POST['name_tow'])&&$_POST['name_tow']!==''){$tow=$_POST['name_tow'].' kg';}
if(isset($_POST['name_tripfuel'])&&$_POST['name_tripfuel']!==''){$tripfuel=$_POST['name_tripfuel']. ' kg';}
if(isset($_POST['name_fuelhours'])&&$_POST['name_fuelhours']!==''){$fuel_hours=$_POST['name_fuelhours']. ' h';}
if(isset($_POST['name_atis_freq_dep'])){$atis_freq_dep=$_POST['name_atis_freq_dep'];}
if(isset($_POST['name_delivery_freq'])){$delivery_freq=$_POST['name_delivery_freq'];}
if(isset($_POST['name_gnd_1_freq_dep'])){$gnd_1_freq_dep=$_POST['name_gnd_1_freq_dep'];}
if(isset($_POST['name_gnd_2_freq_dep'])){$gnd_2_freq_dep=$_POST['name_gnd_2_freq_dep'];}
if(isset($_POST['name_twr_freq_dep'])){$twr_freq_dep=$_POST['name_twr_freq_dep'];}
if(isset($_POST['name_sid'])){$sid =$_POST['name_sid'];}
if(isset($_POST['name_rwy_takeoff'])){$rwy_dep=$_POST['name_rwy_takeoff'];}
if(isset($_POST['name_init_climb'])){$init_climb=$_POST['name_init_climb'];}
if(isset($_POST['name_squawk'])){$squawk=$_POST['name_squawk'];}
if(isset($_POST['name_further_information'])){$notes_dep=$_POST['name_further_information'];}
if(isset($_POST['name_route'])){$route=$_POST['name_route'];}
if(isset($_POST['name_taxi_route'])){$taxi_route=$_POST['name_taxi_route'];}
if(isset($_POST['name_takeoff_time'])){$takeoff_time=$_POST['name_takeoff_time'];}
if(isset($_POST['name_dep_freq'])){$dep_freq=$_POST['name_dep_freq'];}
if(isset($_POST['name_rdr_1_freq'])){$rdr_1_freq=$_POST['name_rdr_1_freq'];}
if(isset($_POST['name_rdr_2_freq'])){$rdr_2_freq=$_POST['name_rdr_2_freq'];}
if(isset($_POST['name_rdr_3_freq'])){$rdr_3_freq=$_POST['name_rdr_3_freq'];}
if(isset($_POST['name_rdr_4_freq'])){$rdr_4_freq=$_POST['name_rdr_4_freq'];}
if(isset($_POST['name_notes_dep'])){$instructions=$_POST['name_notes_dep'];}
if(isset($_POST['name_time_landing'])){$landing_time=$_POST['name_time_landing'];}
if(isset($_POST['name_rwy_landing'])){$rwy_arr=$_POST['name_rwy_landing'];}
if(isset($_POST['name_star'])){$star=$_POST['name_star'];}
if(isset($_POST['name_approach'])){$approach=$_POST['name_approach'];}
if(isset($_POST['name_stand_arr'])){$stand_arr=$_POST['name_stand_arr'];}
if(isset($_POST['name_atis_freq_arr'])){$atis_freq_arr=$_POST['name_atis_freq_arr'];}
if(isset($_POST['name_app_freq_arr'])){$app_freq_arr=$_POST['name_app_freq_arr'];}
if(isset($_POST['name_twr_freq_arr'])){$twr_freq_arr=$_POST['name_twr_freq_arr'];}
if(isset($_POST['name_gnd_1_freq_arr'])){$gnd_1_freq_arr=$_POST['name_gnd_1_freq_arr'];}
if(isset($_POST['name_gnd_2_freq_arr'])){$gnd_2_freq_arr=$_POST['name_gnd_2_freq_arr'];}
if(isset($_POST['name_qnh_arr'])){$qnh_arr=$_POST['name_qnh_arr']. ' hPa';}
if(isset($_POST['name_act_rwys_arr'])){$act_rwys_arr=$_POST['name_act_rwys_arr'];}
if(isset($_POST['name_temp_arr'])){$temp_arr=$_POST['name_temp_arr'];}
if(isset($_POST['name_tl'])){$tl=$_POST['name_tl'];}
if(isset($_POST['name_atis_info_arr'])){$atis_info_arr=$_POST['name_atis_info_arr'];}
if(isset($_POST['name_notes_arr'])){$notes_arr=$_POST['name_notes_arr'];}

?>

<div id="id_print_head">
    Flight Plan
</div>
<div id="id_print_border">
    <table id="id_print_title1">
        <tr>
            <td>Before Flight</td>
        </tr>
    </table>
    <table id="id_print_col1">
        <tr>
            <td>Date: <label><?php echo htmlspecialchars($date); ?></label></td>
            <td>ETD: <label><?php echo htmlspecialchars($etd); ?></label></td>
            <td>DEP Apt: <label><?php echo htmlspecialchars($dep_apt); ?></label></td>
            <td>ARR Apr: <label><?php echo htmlspecialchars($arr_apt); ?></label></td>
            <td>ALTN Apt: <label><?php echo htmlspecialchars($alt_apt); ?></label></td>
        </tr>
    </table>
    <table id="id_print_col2">
        <tr>
            <td>Callsign: <label><?php echo htmlspecialchars($callsign); ?></label></td>
            <td>Stand: <label><?php echo htmlspecialchars($stand_dep); ?></label></td>
            <td>Enroute Time: <label><?php echo htmlspecialchars($enroute_time); ?></label></td>
            <td>ATIS Info: <label><?php echo htmlspecialchars($atis_info_dep); ?></label></td>
            <td>ACT Runways: <label><?php echo htmlspecialchars($act_rwys_dep); ?></label></td>
        </tr>
    </table>
    <table  id="id_print_col3">
        <tr>

            <td>TA: <label><?php echo htmlspecialchars($ta); ?></label></td>
            <td>Cruise FL: <label><?php echo htmlspecialchars($cruise_fl); ?></label></td>
            <td>QNH: <label><?php echo htmlspecialchars($qnh_dep); ?></label></td>
            <td>Temp: <label><?php echo htmlspecialchars($temp_dep); ?></label></td>
            <td>Pax: <label><?php echo htmlspecialchars($pax); ?></label></td>
            <td>Cargo: <label><?php echo htmlspecialchars($cargo); ?></label></td>
        </tr>
    </table>
    <table id="id_print_col4">
        <tr>
            <td>Block Fuel: <label><?php echo htmlspecialchars($block_fuel); ?></label></td>
            <td>ZFW: <label><?php echo htmlspecialchars($zfw); ?></label></td>
            <td>TOW: <label><?php echo htmlspecialchars($tow); ?></label></td>
            <td>Trip Fuel: <label><?php echo htmlspecialchars($tripfuel); ?></label></td>
            <td>Fuel Hours: <label><?php echo htmlspecialchars($fuel_hours); ?></label></td>
        </tr>
    </table>
    <table id="id_print_col5">
        <tr>
            <td>ATIS Freq: <label><?php echo htmlspecialchars($atis_freq_dep); ?></label></td>
            <td>Delivery Freq: <label><?php echo htmlspecialchars($delivery_freq); ?></label></td>
            <td>Ground 1 Freq: <label><?php echo htmlspecialchars($gnd_1_freq_dep); ?></label></td>
            <td>Ground 2 Freq: <label><?php echo htmlspecialchars($gnd_2_freq_dep); ?></label></td>
            <td>Tower Freq: <label><?php echo htmlspecialchars($twr_freq_dep); ?></label></td>
        </tr>
    </table>
    <table id="id_print_title2">
        <tr>
            <td>ATC Clearance</td>
        </tr>
    </table>
    <table id="id_print_col6">
        <tr>
            <td>SID: <label><?php echo htmlspecialchars($sid); ?></label></td>
            <td>RWY: <label><?php echo htmlspecialchars($rwy_dep); ?></label></td>
            <td>Init CLB: <label><?php echo htmlspecialchars($init_climb); ?></label></td>
            <td>Squawk: <label><?php echo htmlspecialchars($squawk); ?></label></td>
        </tr>
    </table>
    <table id="id_print_col7">
        <tr>
            <td>Information: <label><?php echo htmlspecialchars($notes_dep); ?></label></td>
            <td>Route: <label><?php echo htmlspecialchars($route); ?></label></td>
        </tr>
    </table>
    <table id="id_print_title3">
        <tr>
            <td>Taxi</td>
        </tr>
    </table>
    <table id="id_print_col8">
        <tr>
            <td>Taxiroute: <label><?php echo htmlspecialchars($taxi_route); ?></label></td>
        </tr>
    </table>
    <table id="id_print_title4">
        <tr>
            <td>Takeoff</td>
        </tr>
    </table>
    <table id="id_print_col9">
        <tr>
            <td>Time: <label><?php echo htmlspecialchars($takeoff_time); ?></label></td>
            <td>Approach Freq: <label><?php echo htmlspecialchars($dep_freq); ?></label></td>
            <td>Radar 1: <label><?php echo htmlspecialchars($rdr_1_freq); ?></label></td>
            <td>Radar 2: <label><?php echo htmlspecialchars($rdr_2_freq); ?></label></td>
            <td>Radar 3: <label><?php echo htmlspecialchars($rdr_3_freq); ?></label></td>
            <td>Radar 4: <label><?php echo htmlspecialchars($rdr_4_freq); ?></label></td>
        </tr>
    </table>
    <table id="id_print_col10">
        <tr>
            <td>Instructions: <label><?php echo htmlspecialchars($instructions); ?></label></td>
        </tr>
    </table>
    <table id="id_print_title5">
        <tr>
            <td>Descend, Landing, Taxiing</td>
        </tr>
    </table>
    <table id="id_print_col11">
        <tr>
            <td>Time: <label><?php echo htmlspecialchars($landing_time); ?></label></td>
            <td>Runway: <label><?php echo htmlspecialchars($rwy_arr); ?></label></td>
            <td>STAR: <label><?php echo htmlspecialchars($star); ?></label></td>
            <td>Approach: <label><?php echo htmlspecialchars($approach); ?></label></td>
            <td>Stand: <label><?php echo htmlspecialchars($stand_arr); ?></label></td>
        </tr>
    </table>
    <table id="id_print_col12">
        <tr>
            <td>ATIS Freq: <label><?php echo htmlspecialchars($atis_freq_arr); ?></label></td>
            <td>Approach Freq: <label><?php echo htmlspecialchars($app_freq_arr); ?></label></td>
            <td>Tower Freq: <label><?php echo htmlspecialchars($twr_freq_arr); ?></label></td>
            <td>Ground 1 Freq: <label><?php echo htmlspecialchars($gnd_1_freq_arr); ?></label></td>
            <td>Ground 2 Freq: <label><?php echo htmlspecialchars($gnd_2_freq_arr); ?></label></td>
        </tr>
    </table>
    <table id="id_print_col13">
        <tr>
            <td>QNH: <label><?php echo htmlspecialchars($qnh_arr); ?></label></td>
            <td>Active Runways: <label><?php echo htmlspecialchars($act_rwys_arr); ?></label></td>
            <td>Temp: <label><?php echo htmlspecialchars($temp_arr); ?></label></td>
            <td>Transition Level: <label><?php echo htmlspecialchars($tl); ?></label></td>
            <td>Atis Info: <label><?php echo htmlspecialchars($atis_info_arr); ?></label></td>
        </tr>
    </table>
    <table id="id_print_col14">
        <tr>
            <td>Information: <label><?php echo htmlspecialchars($notes_arr); ?></label></td>
        </tr>
    </table>
</div>

</body>