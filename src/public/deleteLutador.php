<?php

require_once __DIR__ . '../../PdoSetup.php';

$id = $_GET['idDelete'];
// $lutadorQueSeraDeletado = $CrudLutador->getById($id);
$deletar = $CrudLutador->deleteLutador($id);
// echo "<script>alert('DELETADO')</script>";
header('Location: index.php');

?>