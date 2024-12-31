  <?php
  include("conexion.php");

  $sql = "SELECT * FROM usuarios";
  $stmt = $con->prepare($sql);
  $stmt->execute();
  $resultados =  $stmt->fetchAll();

  ?>
  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prueba php</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/estilos.css">
  </head>

  <body>
    <div class="container fondo">
      <h1 class="text-center">Prueba PHP</h1>
      <div class="row">
        <div class="col-2 offset-10">
          <div class="text-center ">
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalUsuario" id="botonCrear">
              <i class="bi bi-plus-circle-fill">
                crear
              </i>
            </button>
          </div>
        </div>
      </div>

      <br>
      <br>

      <div class="table-responsive">
        <table id="datosUsuarios" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Imagen</th>
              <th>Fecha Creacion</th>
              <th>Editar</th>
              <th>Borrar</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($resultados as $resultado){
                echo "<tr>";
                echo "<th scope='row'>{$resultado[0]}</th>"; 
                echo "<th>{$resultado['Nombre']}</th>";
                echo "<th>{$resultado['Apellido']}</th>"; 
                echo "<th>{$resultado['Telefono']}</th>"; 
                echo "<th>{$resultado['Email']}</th>"; 
                echo "<th>{$resultado['Imagen']}</th>"; 
                echo "<th>{$resultado['Fecha']}</th>";
              }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modalUsuario">Formulario</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="formulario" enctype="multipart/form-data">
              <div class="modal-content">
                <div class="modal-body">
                  <label for="Nombre">Ingrese el nombre</label>
                  <input type="text" name="Nombre" id="Nombre" class="form-control">
                  <br>
                  <label for="Apellido">Ingrese el Apellido</label>
                  <input type="text" name="Apellido" id="Apellido" class="form-control">
                  <br>
                  <label for="Telefono">Ingrese el Telefono</label>
                  <input type="text" name="Telefono" id="Telefono" class="form-control">
                  <br>
                  <label for="Email">Ingrese el Email</label>
                  <input type="text" name="Email" id="Email" class="form-control">
                  <br>
                  <label for="Imagen">Seleccione una Imagen</label>
                  <input type="file" name="Imagen_usuario" id="Imagen_usuario" class="form-control">
                  <span id="Imagen_subida"></span>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="Id_usuario" id="Id_usuario">
                  <input type="hidden" name="Operacion" id="Operacion">
                  <input type="submit" name="Action" id="Action" class="btn btn-success" value="Crear">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#botonCrear").click(function() {
          $("#formulario")[0].reset();
          $(".modal-title").text("Crear usuario");
          $("#action").val("Crear");
          $("#Operacion").val("Crear");
          $("#Imagen_subida").html("");
        })
        var dataTable = $('#datosUsuarios').DataTable({
          "processing": true,
          "serverSide": true,
          "order": [],
          "ajax": {
            url: "obtener_registros.php",
            type: "POST",
            dataSrc: function(json) {
              if (json.error) {
                alert(json.error); 
                return [];
              }
              return json.data; 
            }
          },
          "columnsDefs": [{
            "targets": [0, 3, 4],
            "orderable": false
          }]
        });
        $(document).on('submit', '#formulario', function(event) {
          event.preventDefault();
          var nombres = $("#Nombre").val();
          var apellidos = $("#Apellidos").val();
          var telefono = $("#Telefono").val();
          var email = $("#Email").val();
          var extension = $("#Imagen_usuario").val().split('.').pop().toLowerCase();

          // Validar imagen
          if (extension != '' && jQuery.inArray(extension, ['jpg', 'jpeg', 'png', 'gif']) == -1) {
            alert("Formato de imagen invalido");
            $("#Imagen_usuario").val('');
            return false;
          }

          // Validar campos
          if (nombres != '' && apellidos != '' && email != '') {
            $.ajax({
              url: "crear.php",
              method: "POST",
              data: new FormData(this),
              contentType: false,
              processData: false,
              success: function(data) {
                alert(data);
                $('#formulario')[0].reset();
                $('#modalUsuario').modal('hide');
                dataTable.ajax.reload();
              }
            });
          } else {
            alert("Algunos campos son obligatorios");
          }
        });
        $(document).on('click', '.editar', function(){
          var Id_usuario = $(this).attr("Id");
          $.ajax({
            url: "obtener_registro.php",
            method: "POST",
            data: {Id_usuario: Id_usuario},
            dataType:"json",
            success: function(data){
              $('#modalUsuario').modal('show');
              $('#Nombre').val(data.Nombre);
              $('#Apellido').val(data.Apellidos);
              $('#Telefono').val(data.Telefono);
              $('#Email').val(data.Email);
              $('.modal-title').text("Editar Usuario");
              $('#Id_usuario').val(Id_usuario);
              $('#Imagen_subida').html(data.imagen_usuario);
              $('#Action').val("Editar");
              $('#Operacion').val("Editar")
            },
            error: function(jqXRH, textStatus, errorThrown){
              console.log(textStatus, errorThrown);
            }
          })
        })
      });
    </script>
  </body>

  </html>