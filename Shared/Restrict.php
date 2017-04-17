<?php
if (!session_id()) {
  session_start();
}

$_SESSION['url'] = $_SERVER['REQUEST_URI'];

if (!$_SESSION['Logged']) {
    header("Location: Index?return_url=" . $_SERVER['REQUEST_URI']);
    die();
}

$stmt = $con->prepare("SELECT concat_ws(' ', nome, apelido) nome, email, nome AS primeiroNome, apelido, IdRole, Id as IdProf FROM professores WHERE Username = ?");
$stmt->bind_param("s", $_SESSION["usr"]);

$stmt->execute();

$result = $stmt->get_result();
$query = $result->fetch_assoc();

$LoggedID = $query["IdProf"];
$LoggedNome = $query["nome"];
$LoggedRole = $query["IdRole"];
$email = $query["email"];
$primeiroNome = $query["primeiroNome"];
$apelido = $query["apelido"];
