<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../css/calculator.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
<?php

$Block_fuel_calc = '0';
$Zfw = '41000';
$Tow = '41000';
$Fuelhours = '0';
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
        <table style="width: 100%" id="id_calculator_table">
            <tr>
                <td style="width: 50%">Inital Block Fuel:</td>
                <td style="width: 50%"><input type="text" style="width: 188px" name="block_fuel_input"
                                              placeholder="0 kg"
                                              value="<?php echo @$_SESSION['block_fuel']; ?>"></td>
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

        <input type="submit" id="id_calculator_submit" value="Berechnen">
        <hr style="color: #ccc;border:none; border-bottom: 2px solid #ccc">

    </form>
    <form action="../index.php" id="id_calculator_res" method="post">
        <table style="width: 100%">
            <tr>
                <td width="50%"><label class="noselect">Block Fuel:</label></td>
                <td width="50%"><?php echo htmlspecialchars($Block_fuel_calc); ?><label class="noselect"> kg</label>
                </td>
            </tr>
            <tr>
                <td><label class="noselect">FW:</label></td>
                <td><?php echo htmlspecialchars($Zfw); ?><label class="noselect"> kg</label></td>
            </tr>
            <tr>
                <td><label class="noselect">TOW:</label></td>
                <td><?php echo htmlspecialchars($Tow); ?><label class="noselect"> kg</label></td>
            </tr>
            <tr>
                <td><label class="noselect">Fuel Hours:</label></td>
                <td><?php echo htmlspecialchars($Fuelhours); ?><label class="noselect"> h</label></td>
            </tr>
        </table>

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
    $block_fuel = round($block_fuel, 0);
    $ZFW = round($ZFW, 0);
    $Tow = round($Tow, 0);
    $Fuelhours = round($Fuelhours, 2);
    array_push($ReturnErgebnis, $block_fuel);
    array_push($ReturnErgebnis, $ZFW);
    array_push($ReturnErgebnis, $Tow);
    array_push($ReturnErgebnis, $Fuelhours);

    return $ReturnErgebnis;
}

?>

</body>
</html>

