# Prueba temporal de PHP y MySQL en Railway

Este proyecto solo verifica despliegue PHP, conexión y SELECT 1. No es la aplicación definitiva del laboratorio. No contiene credenciales, ni importa ventas, ni configura usuarios o permisos. No ha sido ejecutado localmente: la ejecución se comprobará en Railway.

Subir Dockerfile, index.php y start.sh a la raíz de un repositorio de GitHub. Desplegar ese repositorio como un servicio dentro del MISMO proyecto y entorno de Railway donde está el servicio MySQL.

En el servicio PHP, crear estas variables como referencias a las del servicio MySQL (si el servicio se llama exactamente MySQL):

```
MYSQLHOST=${{MySQL.MYSQLHOST}}
MYSQLPORT=${{MySQL.MYSQLPORT}}
MYSQLDATABASE=${{MySQL.MYSQLDATABASE}}
MYSQLUSER=${{MySQL.MYSQLUSER}}
MYSQLPASSWORD=${{MySQL.MYSQLPASSWORD}}
```

Usar las referencias privadas, no MYSQL_PUBLIC_URL. No publicar capturas con valores de variables ni copiar contraseñas a GitHub.

El servidor Apache escucha en PORT, o en 8080 si no se define. Generar un dominio público para el servicio PHP en Networking; si solicita el puerto, indicar el puerto de escucha (8080 cuando no hay otro PORT configurado).

Resultado esperado: HTTP 200, PHP funcionando, MySQL conexión y consulta correctas, consulta_select_1 igual a 1. Falta de variables o fallo de conexión devuelve HTTP 503 con información limitada, sin contraseñas.

La prueba usa la cuenta de conexión proporcionada por la plantilla de Railway únicamente para comprobar conectividad. Antes de construir la aplicación definitiva, crear y probar una cuenta limitada a SELECT, INSERT y UPDATE sobre ventas. No usar la cuenta administradora como cuenta definitiva de la aplicación.

Después de una respuesta correcta, probar también desde otro dispositivo y comprobar una consulta nueva después de reiniciar el servicio PHP. El éxito de esta prueba no verifica todavía importación, permisos, acceso de usuarios ni cambios de contraseña de la práctica.

Vigilar el crédito del trial y retirar este servicio de prueba cuando deje de ser necesario, o sustituirlo por la aplicación definitiva mediante un despliegue nuevo.
