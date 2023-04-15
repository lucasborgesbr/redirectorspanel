<?php

ob_flush();
ob_start();

    var_dump($_POST);

file_put_contents("ebanx-resultado.txt", ob_get_flush(), FILE_APPEND);



?>