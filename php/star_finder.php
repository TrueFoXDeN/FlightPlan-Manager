<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../css/star_finder.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<?php
$connect = '';
$Result_type = 'STAR: ';
$Input_icao = '';
$Input_rwy = '';
$Input_wp = '';
$Input_mode_selector = '';
$Input_result = '';
$placeholder_sid = '';
$placeholder_waypoint = '';
$placeholder_runway = '';
$isChecked = 'false';

connectToDB();

if (isset($_SESSION['ARR'])) {
    $Input_icao = $_SESSION['ARR'];
}

if (isset($_POST['input_icao'])) {
    $Input_icao = $_POST['input_icao'];
    $Input_rwy = $_POST['input_rwy'];
    $Input_wp = $_POST['input_waypoint'];
    getListall($Input_icao, $Input_rwy, $Input_wp);
}


?>


<datalist id="list_runway" name="list_runway"></datalist>
<datalist id="list_result" name="list_result"></datalist>
<datalist id="list_waypoint" name="list_waypoint"></datalist>


<form id="id_starfinder_form" method="post" autocomplete="off">
    <label style="display:block; text-align: center;"> STAR Finder</label>
    <br>
    <table id="id_starfinder_table">
        <tr>
            <td>ICAO:</td>
            <td><input type="text" name="input_icao" value="<?php echo @$Input_icao; ?>"></td>
        </tr>
        <tr>
            <td>Runway:</td>
            <td><input type="text" list="list_runway" value="<?php echo @$Input_rwy; ?>" name="input_rwy"
                       placeholder="<?php echo @$placeholder_runway; ?>"></td>
        </tr>
        <tr>
            <td>Waypoint:</td>
            <td><input type="text" name="input_waypoint" value="<?php echo @$Input_wp; ?>" list="list_waypoint"
                       placeholder="<?php echo @$placeholder_waypoint; ?>"></td>
        </tr>
    </table>

    <br>
    <div style="width: 100%; text-align: center">
        <input type="submit" id="id_starfinder_submit" value="Suchen">
    </div>

    <hr style="color: #ccc; border:none; border-bottom: 2px solid #ccc">
    <table id="id_starfinderRes_table">
        <tr>
            <td><label id="id_result"><?php echo htmlspecialchars($Result_type); ?></label></td>
            <td><input type="text" list="list_result" placeholder="<?php echo @$placeholder_sid; ?>"></td>
        </tr>
    </table>

</form>
</body>

<?php
function getListall($icao, $rwy, $wp)
{
    if ($rwy !== '' && $wp !== '') {
        $rwy_id = getRwyId($rwy);
        $sql = "SELECT distinct name from star where icao = '$icao' and runway = '$rwy_id' and wegpunkt = '$wp'";
        $result = $GLOBALS['connect']->query($sql);
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_assoc();
            echo "<datalist id ='list_result'>";
            echo "<option value=" . $row['name'] . ">";
            echo "</datalist>";
            $GLOBALS['placeholder_sid'] = 'Select STAR';
        } else if (mysqli_num_rows($result) > 1) {
            echo "<datalist id ='list_result'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['name'] . ">";
            }
            echo "</datalist>";
            $GLOBALS['placeholder_sid'] = 'Select STAR';
        } else {
            $GLOBALS['placeholder_sid'] = 'No STAR available';
        }
    } else if ($rwy !== '' && $wp === '') {
        $rwy_id = getRwyId($rwy);
        $sql = "SELECT distinct name from star where icao='$icao' and runway = '$rwy_id'";
        $result = $GLOBALS['connect']->query($sql);
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_assoc();
            echo "<datalist id ='list_result'>";
            echo "<option value=" . $row['name'] . ">";
            echo "</datalist>";
            $GLOBALS['placeholder_sid'] = 'Select STAR';
        } else if (mysqli_num_rows($result) > 1) {
            echo "<datalist id ='list_result'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['name'] . ">";
            }
            echo "</datalist>";
            $GLOBALS['placeholder_sid'] = 'Select STAR';
        } else {
            $GLOBALS['placeholder_sid'] = 'No STAR available';
        }

        $sql = "SELECT distinct  wegpunkt from star where icao='$icao' and runway = '$rwy_id'";
        $result = $GLOBALS['connect']->query($sql);
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_assoc();
            echo "<datalist id ='list_waypoint'>";
            echo "<option value=" . $row['wegpunkt'] . ">";
            echo "</datalist>";
            $GLOBALS['placeholder_waypoint'] = 'Select waypoint';
        } else if (mysqli_num_rows($result) > 1) {
            echo "<datalist id ='list_waypoint'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['wegpunkt'] . ">";
            }
            echo "</datalist>";
            $GLOBALS['placeholder_waypoint'] = 'Select waypoint';
        } else {
            $GLOBALS['placeholder_waypoint'] = 'No waypoint available';
        }
    } else if ($rwy === '' & $wp !== '') {
        $sql = "SELECT distinct name from star where icao='$icao' and wegpunkt = '$wp'";
        $result = $GLOBALS['connect']->query($sql);
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_assoc();
            echo "<datalist id ='list_result'>";
            echo "<option value=" . $row['name'] . ">";
            echo "</datalist>";
            $GLOBALS['placeholder_sid'] = 'Select STAR';
        } else if (mysqli_num_rows($result) > 1) {
            echo "<datalist id ='list_result'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['name'] . ">";
            }
            echo "</datalist>";
            $GLOBALS['placeholder_sid'] = 'Select STAR';
        } else {
            $GLOBALS['placeholder_sid'] = 'No STAR available';
        }

        $sql = "SELECT distinct  runway from star where icao='$icao' and wegpunkt='$wp'";
        $result = $GLOBALS['connect']->query($sql);
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_assoc();
            echo "<datalist id ='list_runway'>";
            $rwy_richtung = getRwyDir($row['runway']);
            echo "<option value=" . $rwy_richtung . ">";
            echo "</datalist>";
            $GLOBALS['placeholder_runway'] = 'Select runway';
        } else if (mysqli_num_rows($result) > 1) {
            echo "<datalist id ='list_runway'>";
            while ($row = $result->fetch_assoc()) {
                $rwy_richtung = getRwyDir($row['runway']);
                echo "<option value=" . $rwy_richtung . ">";
            }
            echo "</datalist>";
            $GLOBALS['placeholder_runway'] = 'Select runway';
        } else {
            $GLOBALS['placeholder_runway'] = 'No runway available';
        }

    } else if ($rwy === '' && $wp === '') {
        $sql = "SELECT distinct name from star where icao='$icao'";
        $result = $GLOBALS['connect']->query($sql);
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_assoc();
            echo "<datalist id ='list_result'>";
            echo "<option value=" . $row['name'] . ">";
            echo "</datalist>";
            $GLOBALS['placeholder_sid'] = 'Select STAR';
        } else if (mysqli_num_rows($result) > 1) {
            echo "<datalist id ='list_result'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['name'] . ">";
            }
            echo "</datalist>";
            $GLOBALS['placeholder_sid'] = 'Select STAR';
        } else {
            $GLOBALS['placeholder_sid'] = 'No STAR available';
        }

        $sql = "SELECT distinct  runway from star where icao='$icao'";
        $result = $GLOBALS['connect']->query($sql);
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_assoc();
            echo "<datalist id ='list_runway'>";
            $rwy_richtung = getRwyDir($row['runway']);
            echo "<option value=" . $rwy_richtung . ">";
            echo "</datalist>";
            $GLOBALS['placeholder_runway'] = 'Select runway';
        } else if (mysqli_num_rows($result) > 1) {
            echo "<datalist id ='list_runway'>";
            while ($row = $result->fetch_assoc()) {
                $rwy_richtung = getRwyDir($row['runway']);
                echo "<option value=" . $rwy_richtung . ">";
            }
            echo "</datalist>";
            $GLOBALS['placeholder_runway'] = 'Select runway';
        } else {
            $GLOBALS['placeholder_runway'] = 'No runway available';
        }

        $sql = "SELECT distinct  wegpunkt from star where icao='$icao'";
        $result = $GLOBALS['connect']->query($sql);
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_assoc();
            echo "<datalist id ='list_waypoint'>";
            echo "<option value=" . $row['wegpunkt'] . ">";
            echo "</datalist>";
            $GLOBALS['placeholder_waypoint'] = 'Select waypoint';
        } else if (mysqli_num_rows($result) > 1) {
            echo "<datalist id ='list_waypoint'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['wegpunkt'] . ">";
            }
            echo "</datalist>";
            $GLOBALS['placeholder_waypoint'] = 'Select waypoint';
        } else {
            $GLOBALS['placeholder_waypoint'] = 'No waypoint available';
        }


    }


}


function connectToDB()
{
    $host_name = 'mysql01.manitu.net:3306';
    $database = 'db42928';
    $user_name = 'u42928';
    $password = 'GaNJGNU9gBkT';
    $GLOBALS['connect'] = mysqli_connect($host_name, $user_name, $password, $database);
    if (mysqli_connect_errno()) {
        die('<p>Verbindung zum MySQL Server fehlgeschlagen: ' . mysqli_connect_error() . '</p>');
    }
}

function getRwyId($richtung)
{
    $sql = "SELECT id from runways where richtung ='$richtung'";
    $result = $GLOBALS['connect']->query($sql);
    $row = $result->fetch_assoc();
    return $row['id'];
}

function getRwyDir($id)
{
    $sql = "SELECT richtung from runways where id ='$id'";
    $result = $GLOBALS['connect']->query($sql);
    $row = $result->fetch_assoc();
    return $row['richtung'];
}


?>
</html>