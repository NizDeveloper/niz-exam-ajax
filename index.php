<?php 
  require '/Users/niz_pena/Sites/personal/projects/exam-ajax/php/conexion.php';

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
  order by id_per limit 0, 5;");
?>

<html>
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam</title>
    <link rel="stylesheet" href="/styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body class="p-5">
    <select class="form-select w-25" aria-label="Default select example" id="filtro">
      <option value="10" selected>Todos</option>
      <option value="1">1 Familiar</option>
      <option value="2">2 Familiares</option>
      <option value="3">3 Familiares</option>
      <option value="4">4 Familiares</option>
      <option value="5">5 Familiares</option>
      <option value="6">6 Familiares</option>
    </select>

    <table class="table table-hover mt-5">
      <thead>
        <tr>
          <th scope="col">ID:</th>
          <th scope="col">Nombres:</th>
          <th scope="col">Apellidos:</th>
          <th scope="col">Padre 1:</th>
          <th scope="col">Padre 2:</th>
          <th scope="col">Abuelo 1:</th>
          <th scope="col">Abuelo 2:</th>
          <th scope="col">Abuelo 3:</th>
          <th scope="col">Abuelo 4:</th>
          <th scope="col">Familiares:</th>
          <th scope="col">Borrar</th>
        </tr>
      </thead>
      <tbody id="tabla">
        <?php 
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
      </tbody>
    </table>

    <div class="mt-5 d-flex justify-content-evenly w-100" id="buttons_Pag">
      <button class="btn btn-primary d-flex align-items-center justify-content-center" id="back" style="--bs-link-hover-color-rgb: 25, 135, 84;">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="#FFF"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
  
        <div class="ms-1">
          Back 
        </div>
      </button>

      <button class="btn btn-primary d-flex align-items-center justify-content-center" id="next" style="--bs-link-hover-color-rgb: 25, 135, 84;">
        <div class="me-1">
          Next 
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="#FFF"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg>
      </button>
    </div>

    <!-- Notificación -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="/img/totem.png" class="rounded me-2" alt="logo">
          <strong class="me-auto">Sistema</strong>
          <small>11 mins ago</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="notification">
          
        </div>
      </div>
    </div>
    <!-- Notificación -->

    <!-- Confirmar Borrar -->
    <div class="modal fade" id="alert" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Alerta!!!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ¿Desea eliminar?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="delete" data-bs-dismiss="modal">Borrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Confirmar Borrar -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
  </body>
</html>