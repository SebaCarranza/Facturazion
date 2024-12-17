<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CBU</title>
        <meta name="description" content="The small framework with powerful features">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <!-- STYLES -->
    </head>
<body>
    <form  onsubmit="event.preventDefault();GuardarDatos(); return false;" action="/save_cbu" id="form" method="post">
        <div class="container-fluid"> 
            <div class="form-group mb-3">
                <label >Alias</label> 
                <input  name="alias" value="<?= @$cbu['alias']?>" required>
            </div>
            <div class="form-group mb-3">
                <label >CBU</label> 
                <input type="number" name="cbu"  value="<?= @$cbu['cbu']?>" required>
            </div>
            <input type="hidden" name="cbu_id" value="<?= @$cbu['id']?>">
            <input type="hidden" id="comercio_id" name="comercio_id" value="<?= $comercio['id']?>">
        </div>
        <div class="form-group">
            <div class="col-12 col-sm-3 form-group mb-4 p-0">
                <button class="btn btn-info btn-sm" type="submit">Guardar</button>
                <a class="btn btn-success btn-sm" href="/editar_comercio/<?= $comercio['id']?>">Volver al Listado</a>
            </div>
        </div>
   </form>
</body>
<script src="/jquery-3.1.1.min.js"></script>
<script src="/jquery-ui.js"></script>
<script src="/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function GuardarDatos() {

        let data = $("#form").serialize();
        var request = $.ajax({
            url: "/save_cbu",
            data: data, 
            method: "POST",
            type: "POST",
            async: true,

        });
        request.done(function(data) {
            Swal.fire({
                title: "Guardado",
                text: data.message,
                icon: "success"
            });
            let id_comercio = $('#comercio_id').val();
            setTimeout(function() {
                window.location.href = '/editar_comercio/' + id_comercio;
            }, 2000);
        });
        request.fail(function(jqXHR, textStatus) {
            Swal.fire({
                title: "Error",
                text: "No se pudo Guardar",
                icon: "error"
            });
        });
    }
</script>

</html>
