<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Iniciar Sesion</title>
        <meta name="description" content="The small framework with powerful features">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- STYLES -->

        
    </head>
<body>
    <form  onsubmit="event.preventDefault();ValidarUsuario(); return false;" action="/validar_usuario" id="form" method="get">
            <div class="container-fluid"> 
                <div class="form-group mb-3">
                    <label >Email</label> 
                    <input  name="email"   value="">
                </div>
                <div class="form-group mb-3">
                    <label >Contraseña</label> 
                    <input type="password" name="password"  value="">
                </div>
            </div>
            <div class="form-group">
            <div class="col-12 col-sm-3 form-group mb-4 p-0">
                <button class="btn btn-info btn-sm" type="submit">Logear</button>
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
    function ValidarUsuario() {

        let data = $("#form").serialize();
        var request = $.ajax({
            url: "/validar_usuario",
            data: data, 
            method: "GET",
            type: "GET",
            async: true,

        });
        request.done(function(data) {
            if (data.error == false){
                window.location.href = '/listado_comercio';
            }else{
                Swal.fire({
                        title: 'Error',
                        text: data.message,
                        icon: 'error'
                });
                return false;
            }
            
        });
        request.fail(function(jqXHR, textStatus) {
            
        });
        }
</script>

</html>
