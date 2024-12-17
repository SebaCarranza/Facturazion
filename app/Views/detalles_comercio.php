<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="description" content="The small framework with powerful features">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- STYLES -->
    </head>
<body>
<div class="container my-4">
    <form  onsubmit="event.preventDefault();EditarComercio(); return false;" action="/save_comercio" id="form" method="post">
            <div class="container-fluid"> 
                <div class="form-group mb-3">
                    <label>CUIT</label> 
                    <input required name="cuit" value="<?= @$comercio['cuit']?>">
                </div>
                <div class="form-group mb-3">
                    <label>Razon Social</label> 
                    <input required name="razon_social" value="<?= @$comercio['razon_social']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-12 col-sm-3 form-group mb-4 p-0">
                    <button class="btn btn-info btn-sm" type="submit">Guardar</button>
                    <a class="btn btn-success btn-sm" href="/listado_comercio">Volver al Listado de comercios</a>
                </div>
                <input type="hidden" id="id_comercio" name="id_comercio"  value="<?= @$comercio['id']?>">
            </div>
    </form>        
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 style="color: red;" class="h3">Listado</h1>
        <?php if (!empty($comercio)) { ?>
            <a href="/editar_cbu/<?= @$comercio['id'] ?>" class="btn btn-primary">Nuevo CBU</a>        
        <?php } ?>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table bordered"> 
            <thead style="color: red; ">
                <tr style="color: darkgreen;"> 
                    <th scope="col">ALIAS</th>
                    <th scope="col">CBU</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Borrar</th>
                </tr>
            </thead>
            <tbody id="tablaBody">
                <?php if (count($cbus) > 0){
                    foreach ($cbus as $key => $cbu)  { ?>
                        <tr>
                            <td><?= $cbu['alias'] ?> </td>
                            <td><?= $cbu['cbu'] ?> </td>
                            <td><a class= " btn btn-warning btn-sm" href="/editar_cbu/<?= $comercio['id'] ?>/<?= $cbu['id']?>">Editar</a></td>
                            <td><button class="btn btn-danger btn-sm"  onclick="BorrarDatosCbu(<?= $cbu['id']?>)">Borrar</button></td>
                        </tr>
                <?php }}else{ ?>
                    <td colspan="4"><div class="alert alert-danger text-center">No hay Registros.</div></td>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
<script src="/jquery-3.1.1.min.js"></script>
<script src="/jquery-ui.js"></script>
<script src="/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function EditarComercio(){
        let data = $("#form").serialize();
        var request = $.ajax({
            url: "/save_comercio",
            data: data,
            method: "POST",
            type: "POST",
            async: true,
        });
        request.done(function(data){
            Swal.fire({
                title: "Guardado",
                text: data.message,
                icon: "success"
            });
            setTimeout(function() {
                window.location.href = '/listado_comercio';
            }, 2000);
        });
        request.fail(function(jqXHR, textStatus) {
            console.log(data.message);
        });
    }
    function BorrarDatosCbu(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, borrar',
            cancelButtonText: 'Cancelar'
                }).then((consult) => {
                    if (consult.isConfirmed) {
                            var request = $.ajax({
                            url: "/borrar_cbu/" + id,
                            method: "POST",
                            type: "POST",
                            async: true,
                        });
                request.done(function(data) {
                    Swal.fire({
                                title: 'Eliminado',
                                text: data.message,
                                icon: 'success'
                            });
                    let id_comercio = $('#id_comercio').val();
                    var request= $.ajax({
                        url: "/actualizar_listado_cbu/" + id_comercio,
                        method: "GET",
                        type: "GET",
                        async: true,
                    });   
                    request.done(function(data) {
                        $("#tablaBody").empty();
                        var miArray = data.cbus;
                        var html = "";
                        if (Object.entries(miArray).length != 0) {
                            miArray.forEach(function(objeto, indice, array) {
                                html += '<tr>';
                                html += '<td> '+objeto.alias+ '</td>';
                                html += '<td> '+objeto.cbu+ '</td>';
                                html += '<td><a class= " btn btn-warning btn-sm" href="/editar_cbu/'+objeto.id+'">Editar</a></td>';
                                html += '<td><button class="btn btn-danger btn-sm"  onclick="BorrarDatosCbu('+objeto.id+')">Borrar</button></td>';
                                html += '</tr>';
                            });
                        } else {
                            html += '<tr>';
                            html += '<td colspan="4"><div class="alert alert-danger ">No hay Registros.</div></td>';
                            html += '</tr>';
                        }
                    $("#tablaBody").append(html);
                });
            });
            request.fail(function(jqXHR, textStatus) {
                Swal.fire({
                        title: 'Error',
                        text: 'No se pudo eliminar. Intenta nuevamente.',
                        icon: 'error'
                });
            });
        }
        });
    }
</script>

</html>
