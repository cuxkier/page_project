<?php

//$lekarz = $_POST["lekarz"];
//$message = $_POST["message"];
$lekarz = filter_input(INPUT_POST, "lekarz", FILTER_VALIDATE_INT);
$cel_wizyty = filter_input(INPUT_POST, "cel_wizyty", FILTER_VALIDATE_INT);
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOLEAN);
//$date = filter_input(INPUT_POST, "date", FILTER_VALIDATE_)

if (!$terms) {
    die("Musisz być osobą pełnoletnią, żeby umówić się na wizytę!");
}

$host = "localhost";
$dbname = "rejestracja_db";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}
$sql = "INSERT INTO rejestracja (lekarz, cel_wizyty, data_wizyty)
        VALUES (?,?,?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssi",
    $lekarz,
    $cel_wizyty,
    $data_wizyty);

mysqli_stmt_execute($stmt);

echo "Record saved";