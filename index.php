<?php
declare(strict_types=1);

// Prueba temporal de alojamiento. Solo ejecuta SELECT; no crea ni modifica datos.
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
header('X-Content-Type-Options: nosniff');

function respond(int $status, array $body): never
{
    http_response_code($status);
    echo json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

$required = ['MYSQLHOST', 'MYSQLPORT', 'MYSQLDATABASE', 'MYSQLUSER', 'MYSQLPASSWORD'];
$missing = [];
foreach ($required as $name) {
    if (getenv($name) === false || getenv($name) === '') {
        $missing[] = $name;
    }
}

if ($missing !== []) {
    respond(503, [
        'prueba' => 'Lab09 - PHP y MySQL',
        'php' => 'funcionando',
        'mysql' => 'configuración pendiente',
        'variables_faltantes' => $missing,
    ]);
}

try {
    $connection = new PDO(
        'mysql:host=' . getenv('MYSQLHOST') . ';port=' . getenv('MYSQLPORT')
            . ';dbname=' . getenv('MYSQLDATABASE') . ';charset=utf8mb4',
        getenv('MYSQLUSER'),
        getenv('MYSQLPASSWORD'),
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 5,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
    $result = $connection->query('SELECT 1 AS comprobacion, VERSION() AS version_mysql')->fetch(PDO::FETCH_ASSOC);
    respond(200, [
        'prueba' => 'Lab09 - PHP y MySQL',
        'php' => 'funcionando',
        'mysql' => 'conexión y consulta correctas',
        'consulta_select_1' => (int) $result['comprobacion'],
        'version_mysql' => $result['version_mysql'],
        'fecha_utc' => gmdate('c'),
    ]);
} catch (PDOException $error) {
    // No se publican mensajes de excepción, credenciales ni detalles de red.
    respond(503, [
        'prueba' => 'Lab09 - PHP y MySQL',
        'php' => 'funcionando',
        'mysql' => 'no se pudo completar la conexión o consulta',
        'sqlstate' => (string) $error->getCode(),
        'codigo_controlador' => $error->errorInfo[1] ?? null,
    ]);
}
