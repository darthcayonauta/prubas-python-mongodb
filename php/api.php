<?php

// URL de la API de FastAPI
$apiUrl = 'http://localhost:8001/data';

// Inicializar una sesión cURL
$ch = curl_init($apiUrl);

// Establecer opciones para la solicitud cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Realizar una solicitud GET
$response = curl_exec($ch);

// Verificar si hubo algún error en la solicitud
if (curl_errno($ch)) {
    echo 'Error en la solicitud cURL: ' . curl_error($ch);
}

// Cerrar la sesión cURL
curl_close($ch);

// Procesar la respuesta de la API (puede variar según la estructura de datos de la API)
if ($response) {
    // Decodificar la respuesta JSON (si la API devuelve JSON)
    $responseData = json_decode($response, true);

    // Hacer algo con los datos de la API
    var_dump($responseData);
} else {
    echo 'No se recibió una respuesta válida de la API.';
}

