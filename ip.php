<?php
    $DEV = false;
    if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1") {
        $DEV = true;
    }
    header('Content-type: aplication/octet-stream');
    $data = [
        "IP" => $_SERVER['REMOTE_ADDR'],
        "Devloper" => $DEV
    ];
    echo json_encode( $data );
    header('Content-Disposition: attachment; filename=ip.json');
?>