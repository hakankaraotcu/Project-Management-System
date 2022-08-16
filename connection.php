<?php

$conn = new PDO( "sqlsrv:Server=(local);Database=db_project", NULL, NULL);   
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

?>