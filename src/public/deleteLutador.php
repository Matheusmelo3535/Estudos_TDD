<?php

require_once __DIR__ . '../../PdoSetup.php';

$id = $_POST['idDelete'];
$deletar = $CrudLutador->deleteLutador($id);
if ($deletar) {
    echo json_encode(array('success' => 'Ok'));
}
else {
    echo json_encode(array('success' => 'Fail'));
}


?>