<?php 
  $mysql = new mysqli("localhost", "root", "12341234", "ajax_exam");

  if ($mysql -> connect_error) {
    die("Problemas con la conexion a la base de datos");
  }
?>