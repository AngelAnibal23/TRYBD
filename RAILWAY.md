# Entorno del Laboratorio 09

Este repositorio se despliega en Railway desde la rama master mediante el Dockerfile de la raíz. Es todavía una prueba de conexión; los formularios de la práctica están pendientes.

## Servicios

- TRYBD: PHP 8.4 y Apache. Escucha en PORT, con 8080 como valor por defecto. El script start.sh activa únicamente mpm_prefork y valida Apache antes de arrancar.
- MySQL: servicio separado, sin dominio público ni proxy TCP. Datos persistentes en el volumen montado en /var/lib/mysql.
- URL pública de la aplicación: https://trybd-production.up.railway.app/

## Configuración de despliegue

La configuración está guardada en el servicio TRYBD de Railway:

- Dockerfile: Dockerfile, detectado en la raíz.
- Comprobación HTTP antes de publicar el despliegue: /.
- Tiempo máximo de comprobación: 120 segundos.
- Reinicio: ON_FAILURE, hasta 3 reintentos.
- Dominio gestionado por Railway, destino 8080, con HTTPS.
- Variables requeridas: MYSQLHOST, MYSQLPORT, MYSQLDATABASE, MYSQLUSER, MYSQLPASSWORD.

MYSQLHOST y MYSQLPORT apuntan al servicio MySQL por la red privada. MYSQLDATABASE debe ser ventas, y MYSQLUSER debe ser lab09_app. La contraseña se guarda solo en Railway. No guardar credenciales en este repositorio.

La página actual responde HTTP 200 cuando PHP consigue ejecutar SELECT 1 en MySQL; devuelve 503 si falta configuración o falla la conexión. Por tanto, el control de salud del despliegue depende también de la disponibilidad de MySQL. No es un monitor continuo.

## Operación

Los cambios publicados en master generan un nuevo despliegue automático. Revisar el resultado en Deployments y la comprobación HTTP antes de considerar aplicado un cambio. La cuenta de aplicación usa SELECT, INSERT y UPDATE sobre ventas; no debe sustituirse por la cuenta administradora.

El acceso de administración está preparado mediante MCP, Railway CLI y una clave SSH identificada como Codex Lab09. La clave privada permanece fuera del repositorio. La ejecución remota permite consultar y probar usando las variables internas del servicio sin hacer pública la base.

## Disponibilidad

El entorno utiliza crédito de prueba. El funcionamiento depende de que el trial y su saldo sigan vigentes. El volumen conserva datos entre reinicios, pero no reemplaza una copia de respaldo. La configuración de alojamiento no constituye todavía la aplicación final del laboratorio.
