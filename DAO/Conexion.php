<?php
function Conectar()
{
    $con = pg_connect("host=localhost port=5432 dbname=BDRIMAC user=postgres password=123456") or die("error");
    return $con;
}

