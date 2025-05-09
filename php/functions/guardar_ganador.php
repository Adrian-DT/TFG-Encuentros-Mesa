<?php
require_once "../functions/db.php";

try {
    $db = conectar();
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Obtener datos del POST
$data = json_decode(file_get_contents('php://input'), true);
$opcion = $data['opcion'] ?? null;
$usuario = $data['usuario'] ?? null;
$partida = $data['partida'] ?? null;

// Validar datos
if (!$opcion || !$usuario || !$partida) {
    http_response_code(400);
    echo json_encode(['error' => 'Faltan datos']);
    exit;
}

// Insertar/Actualizar en la base de datos
$stmt = $db->prepare("UPDATE partidas SET ganador = ? WHERE id = ?");
$stmt->execute(array($usuario, $partida));

echo json_encode(['status' => 'success']);
