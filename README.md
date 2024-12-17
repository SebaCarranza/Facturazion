### CONFIGURACION LOCAL - VIRTUAL HOST

C:\Windows\System32\drivers\etc\hosts

# PONER ESTO AL FINAL DEL ARCHIVO

127.0.0.1 web.ar

### CONFIGURACION APACHE AL FINALIZAR REINICIAR WAMP

C:\wamp64\bin\apache\apache2.4.48\conf\extra\httpd-vhosts.conf

<VirtualHost \*:80>
        ServerName web.ar
        DocumentRoot "C:/www/practica/public"
    <Directory "C:/www/practica/public">
        Options +Indexes +Includes +FollowSymLinks +MultiViews
        AllowOverride All
        Require local
    </Directory>
</VirtualHost>

## copiar el ENV

cp env .env

## Y CONFIGURAR LO BASICO EN EL .ENV

CI_ENVIRONMENT = development

app.baseURL = 'http://facturacion.ar/'

# configurar la base en el .env

database.default.hostname = localhost
database.default.database = facturacion
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3307

# ejecutar el sql de la bbdd

crear la base con el nombre facturacion e importar el archivo sql ubicado en app/Database("estructura_inicial.sql")
