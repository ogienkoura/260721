<?php


$firstNumber = (int)($_POST['firstNumber'] ?? null);
$secondNumber = (int)($_POST['secondNumber'] ?? null);
$mathAction = $_POST['mathAction'] ?? null;



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calculator</title>
</head>
<body>
<h1>Calculator</h1>

<?php switch ($mathAction) {
    case '+':
        echo "$firstNumber + $secondNumber", " = ", $firstNumber + $secondNumber;
        break;
    case '-';
        echo "$firstNumber - $secondNumber", " = ", $firstNumber - $secondNumber;
        break;
    case '*';
        echo "$firstNumber * $secondNumber", " = ", $firstNumber * $secondNumber;
        break;
    case '/';
        echo "$firstNumber / $secondNumber", " = ", $firstNumber / $secondNumber;
        break;
}
?>

<form method="post">
    <input type="number" name="firstNumber" id="firstNumber">
    <input type="text" name="mathAction" id="mathAction">
    <input type="number" name="secondNumber" id="secondNumber">
    <button type="submit">CALCULATE</button>
</form>

</body>
</html>


