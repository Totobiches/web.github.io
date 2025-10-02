<?php
if (isset($_POST['dni'])) {
    $dni = trim($_POST['dni']);

    if (!ctype_digit($dni)) {
        echo json_encode(["status" => "error", "mensaje" => "El DNI debe contener solo números"]);
        exit;
    }

    $archivo = __DIR__ . "/BaseDeDatos.csv";

    if (!file_exists($archivo)) {
        echo json_encode(["status" => "error", "mensaje" => "No se encontró la base de datos"]);
        exit;
    }

    if (($handle = fopen($archivo, "r")) === false) {
        echo json_encode(["status" => "error", "mensaje" => "No se pudo abrir el archivo"]);
        exit;
    }

    $header = fgetcsv($handle, 0, ";");
    $resultado = null;

    while (($datos = fgetcsv($handle, 0, ";")) !== false) {
        if (trim($datos[0]) === $dni) {
            $resultado = array_combine($header, $datos);
            break;
        }
    }
    fclose($handle);

    if ($resultado) {
        
        $escuelas = [
            "113" => "Escuela Técnica N°4",
            "534" => "Escuela Normal N°7"
            
        ];

        $resultado['ESCUELA'] = isset($escuelas[$resultado['DISTRITO']]) 
            ? $escuelas[$resultado['DISTRITO']] 
            : "Distrito " . $resultado['DISTRITO'];

        echo json_encode(["status" => "ok", "datos" => $resultado]);
    } else {
        echo json_encode(["status" => "error", "mensaje" => "DNI no encontrado en el padrón"]);
    }
}
?>
