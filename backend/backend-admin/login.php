<?php
session_start();
require_once '../db/conexion.php';

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM administrador WHERE correo = ?");
    $stmt->execute([$correo]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && $user['password_hash'] === $password){
        $_SESSION['user_id'] = $user['id_admin'];
        $_SESSION['user_name'] = $user['nombre_completo'];
        echo json_encode(['success' => true, 'user' => $user['nombre_completo']]);
    } else{
        echo json_encode(['success' => false, 'message' => 'Credenciales incorretas']);
    }
} else{
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}