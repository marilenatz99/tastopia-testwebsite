<?php

$db = mysqli_connect('localhost', 'root', '', 'id21881012_database');

if ($db) {
    $output = 'Connection successful';
} else {
    $output = mysqli_connect_error();
}
// echo $output;
