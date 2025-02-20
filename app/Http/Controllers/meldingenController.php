<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
if(empty($attractie)) {
    $errors[] = "Vul een attractienaam in.";
}

$type = $_POST['type'];
if(empty($type)) {
    $errors[] = "Vul een type in.";
}

$capaciteit = $_POST['capaciteit'];
if(!is_numeric($capaciteit)) {
    $errors[] = "Vul een geldige capaciteit in.";
}

if(isset($_POST['prioriteit']))
{
    $prioriteit = true;
}
else
{
    $prioriteit = false;
}
$melder = $_POST['melder'];
if(empty($melder)) {
    $errors[] = "Vul een melder in.";
}
$overig = $_POST['overig'];

if(!empty($errors)) {
    var_dump($errors);
    die();
}

//1. Verbinding
require_once 'C:\laragon\www\storingapp\config\conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info)
VALUES(:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
    ":attractie" => $attractie,
    ":type" => $type,
    ":capaciteit" => $capaciteit,
    ":prioriteit" => $prioriteit,
    ":melder" => $melder,
    ":overige_info" => $overig,
]);

header("Location: ../meldingen/index.php?msg=Melding opgeslagen");