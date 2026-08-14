<?php

class Contacto
{
    private $db;

    public function __construct()
    {
        require_once APP_PATH . '/config/database.php';
        $this->db = Database::getInstance()->getConnection();
    }

    public function create(array $datos)
    {
        $query = "INSERT INTO contacto (nombre, correo, asunto, mensaje)
            VALUES (?, ?, ?, ?)
        ";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([
            $datos['nombre'],
            $datos['correo'],
            $datos['asunto'],
            $datos['mensaje'],
        ]);

        return $exito ? (int) $this->db->lastInsertId() : false;
    }

    public function getAll()
    {
        $query = "
        SELECT
            c.idContacto,
            c.nombre,
            c.correo,
            c.asunto,
            c.mensaje,
            c.fechaEnvio,
            c.leido
        FROM contacto c
        ORDER BY c.idContacto DESC
        ";

        $stmt = $this->db->query($query);

        return $stmt->fetchAll();
    }
}
