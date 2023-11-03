<?php

// Datos ingresados por el usuario en el formulario
$name = $_POST['name'];
$age = $_POST['age'];
$department = $_POST['department'];
$date = $_POST['date'];

// Realizar validaciones de datos
if (empty($name) || empty($age) || empty($department) || empty($date)) {
    echo 'Todos los campos son obligatorios. Por favor, complete todos los campos.';
} elseif (!is_numeric($age) || $age <= 0) {
    echo 'La edad debe ser un número válido mayor que cero.';
} elseif (!strtotime($date)) {
    echo 'La fecha no está en un formato válido.';
} else {
    // Los datos son válidos, proceder a enviar la solicitud a la API

    // URL de la API de FastAPI
    $apiUrl = 'http://localhost:8001/data';

    // Datos a enviar a la API en formato JSON
    $data = json_encode(array(
        'name' => $name,
        'age' => $age,
        'department' => $department,
        'date' => $date
    ));

    // Inicializar una sesión cURL para enviar la solicitud POST
    $ch = curl_init($apiUrl);

    // Establecer opciones para la solicitud cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // Realizar la solicitud cURL
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

        // Hacer algo con la respuesta de la API (por ejemplo, mostrar un mensaje de éxito)
        echo 'Datos ingresados con éxito en la API.';
    } else {
        echo 'No se recibió una respuesta válida de la API.';
    }
}
?>
