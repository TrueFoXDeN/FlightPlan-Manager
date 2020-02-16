<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/calculator.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
<?php

$Block_fuel_calc = '0 kg';
$Zfw = '41000 kg';
$Tow = '41000 kg';
$Fuelhours = '0 h';
$block_fuel = '';
$pax = '';
$cargo_input = '';
$Ergebnis = array();
if (isset($_POST['block_fuel_input']) && isset($_POST['pax_input']) && isset($_POST['cargo_input'])
    && $_POST['block_fuel_input'] != "" && $_POST['pax_input'] != "" && $_POST['cargo_input'] != "") {
    $block_fuel = $_POST['block_fuel_input'];
    $pax = $_POST['pax_input'];
    $cargo_input = $_POST['cargo_input'];
    $Ergebnis = calculation($block_fuel, $pax, $cargo_input);
    $Block_fuel_calc = $Ergebnis[0];
    $Zfw = $Ergebnis[1];
    $Tow = $Ergebnis[2];
    $Fuelhours = $Ergebnis[3];
} else {
//    echo 'Bitte alle Felder ausfüllen!';
}

?>
<div id="id_calculator_frame">
    <form id="id_calculator" method="post">
        <table style="width: 100%">
            <tr>
                <td>Inital Block Fuel:</td>
                <td><input type="text" name="block_fuel_input" placeholder="0 kg"></td>
            </tr>
            <tr>
                <td>PAX:</td>
                <td><input type="text" name="pax_input" placeholder="0"></td>
            </tr>
            <tr>
                <td>Cargo (Kg):</td>
                <td><input type="text" name="cargo_input" placeholder="0 kg"></td>
            </tr>
        </table>

        <input type="submit" id="id_calculator_submit" value="Submit">
        <hr>

    </form>
    <form action="index.php" id="id_calculator_res" method="post">
        <label>Block Fuel:</label>
        <label><?php echo htmlspecialchars($Block_fuel_calc); ?></label><br><br>
        <label>ZFW:</label>
        <label><?php echo htmlspecialchars($Zfw); ?></label><br><br>
        <label>TOW:</label>
        <label><?php echo htmlspecialchars($Tow); ?></label><br><br>
        <label>Fuelhours:</label>
        <label><?php echo htmlspecialchars($Fuelhours); ?></label><br><br>

    </form>
</div>

<?php
function calculation($block_input, $pax, $cargo)
{
    $ReturnErgebnis = array();
    $TotalPayload = ($pax * 104) + $cargo;
    $ZFW = $TotalPayload + 41000;
    $block_fuel = $block_input + ($block_input * ($TotalPayload * 0.00001230769));
    $Fuelhours = $block_fuel / 2000;
    $Tow = $ZFW + $block_fuel;
    $block_fuel = round($block_fuel, 2);
    $ZFW = round($ZFW, 2);
    $Tow = round($Tow, 3);
    $Fuelhours = round($Fuelhours, 2);
    array_push($ReturnErgebnis, $block_fuel . ' kg');
    array_push($ReturnErgebnis, $ZFW . ' kg');
    array_push($ReturnErgebnis, $Tow . ' kg');
    array_push($ReturnErgebnis, $Fuelhours . ' h');

    return $ReturnErgebnis;
}

?>

</body>
</html>

