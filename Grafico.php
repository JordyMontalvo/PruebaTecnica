<?php
// Inicializar un array para almacenar los datos
$pobreza_data = array();

for ($year = 1995; $year <= 2020; $year++) {
    // Construir la URL para la solicitud GET
    $url = "https://api.worldbank.org/pip/v1/pip?country=PER&year=" . $year;

    // Realizar la solicitud GET
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Verificar si hay datos y extraer el "headcount"
    if (isset($data[0]['headcount'])) {
        $pobreza_data[] = array(
            'year' => $year,
            'headcount' => $data[0]['headcount'] * 100 // Multiplicar por 100 para obtener el porcentaje
        );
    }
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($pobreza_data);

