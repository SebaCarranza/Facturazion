<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Comercios</title>
        <meta name="description" content="The small framework with powerful features">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- STYLES -->

    </head>
<body>
<div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 style="color: red;" class="h3">Lista de Comercios</h1>
            <a href="/editar_comercio" class="btn btn-primary">Nuevo Comercio</a>
        </div>
<div class="table-responsive">
    <table class="table table-striped table bordered"> 
        <thead style="color: red; ">

            <tr style="color: darkgreen;"> 
                <th scope="col">CUIT</th>
                <th scope="col">RAZON SOCIAL</th>
                <th scope="col">Editar</th>
                <th scope="col">Borrar</th>
            </tr>

        </thead>
    <tbody id="tablaBody">
        <?php if (count($comercios) > 0){
            foreach ($comercios as $key => $comercio)  { ?>
                <tr>
                    <td><?= $comercio['cuit'] ?> </td>
                    <td><?= $comercio['razon_social'] ?> </td>
                    <td><a class= " btn btn-warning btn-sm" href="/editar_comercio/<?= $comercio['id']?>">Editar</a></td>
                    <td><button class="btn btn-danger btn-sm"  onclick="BorrarDatos(<?= $comercio['id']?>)">Borrar</button></td>
                </tr>
        <?php }}else{ ?>
            <td colspan="4"><div class="alert alert-danger text-center">No hay Registros.</div></td>
        <?php  } ?>
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
    function BorrarDatos(id) {
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
                            url: "/borrar_comercio/" + id,
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
                    var request= $.ajax({
                        url: "/actualizar_listado_comercio",
                        method: "GET",
                        type: "GET",
                        async: true,
                    });   
                    request.done(function(data) {
                        $("#tablaBody").empty();
                        var miArray = data.comercios;
                        var html = "";
                        if (Object.entries(miArray).length != 0) {
                            miArray.forEach(function(objeto, indice, array) {
                                html += '<tr>';
                                html += '<td> '+objeto.cuit+ '</td>';
                                html += '<td> '+objeto.razon_social+ '</td>';
                                html += '<td><a class= " btn btn-warning btn-sm" href="/editar_comercio/'+objeto.id+'">Editar</a></td>';
                                html += '<td><button class="btn btn-danger btn-sm"  onclick="BorrarDatos('+objeto.id+')">Borrar</button></td>';
                                html += '</tr>';
                            });
                        } else {
                            html += '<tr>';
                            html += '<td colspan="5"><div class="alert alert-danger">No hay Registros.</div></td>';
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
