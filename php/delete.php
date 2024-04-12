<?php
  require '/Users/niz_pena/Sites/personal/projects/exam/php/conexion.php';

  if (isset($_REQUEST['name'])){
    $name = $_REQUEST['name'];
  } 

  if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
  } else {
    $page = 0;
  }

  $delete = mysqli_query($mysql, "delete from personas where nombres='$name';");

  $personas = mysqli_query($mysql , 
    "select 
    per1.id_per as id_per,
    per1.nombres as nombres,
    per1.apellidos as apellidos,
    per2.nombres as padre1,
    per3.nombres as padre2,
    per4.nombres as abuelo1,
    per5.nombres as abuelo2,
    per6.nombres as abuelo3,
    per7.nombres as abuelo4
      from personas as per1 
    left join personas as per2 on per1.id_padre1 = per2.id_per
    left join personas as per3 on per1.id_padre2 = per3.id_per
    left join personas as per4 on per1.id_abuelo1 = per4.id_per
    left join personas as per5 on per1.id_abuelo2 = per5.id_per
    left join personas as per6 on per1.id_abuelo3 = per6.id_per
    left join personas as per7 on per1.id_abuelo4 = per7.id_per
    order by id_per limit $page, 5;");

  $nivelHuerfanismo = 0;
        
  while ($reg = $personas -> fetch_array()) {
    if ($reg['padre1'] != null) $nivelHuerfanismo++;
    if ($reg['padre2'] != null) $nivelHuerfanismo++;
    if ($reg['abuelo1'] != null) $nivelHuerfanismo++;
    if ($reg['abuelo2'] != null) $nivelHuerfanismo++;
    if ($reg['abuelo3'] != null) $nivelHuerfanismo++;
    if ($reg['abuelo4'] != null) $nivelHuerfanismo++;

    echo "<tr>";
      echo "<th scope=\"row\"> $reg[id_per] </th>";
      echo "<td> $reg[nombres] </td>";
      echo "<td> $reg[apellidos] </td>";
      echo "<td>" . ($reg['padre1'] != null ? $reg['padre1'] : ':(') . "</td>";
      echo "<td>" . ($reg['padre2'] != null ? $reg['padre2'] : ':(') . "</td>";
      echo "<td>" . ($reg['abuelo1'] != null ? $reg['abuelo1'] : ':(') . "</td>";
      echo "<td>" . ($reg['abuelo2'] != null ? $reg['abuelo2'] : ':(') . "</td>";
      echo "<td>" . ($reg['abuelo3'] != null ? $reg['abuelo3'] : ':(') . "</td>";
      echo "<td>" . ($reg['abuelo4'] != null ? $reg['abuelo4'] : ':(') . "</td>";
      echo "<td class=\"$nivelHuerfanismo\">" . $nivelHuerfanismo . "</td>";
      echo "<td> <a href=\"#\" id=\"$reg[nombres]\" class=\"borrar\" data-bs-target=\"#alert\" data-bs-toggle=\"modal\">Borrar</a> </td>";
    echo "</tr>";

    $nivelHuerfanismo = 0;
  }
?>