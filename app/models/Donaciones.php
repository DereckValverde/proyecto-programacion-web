<?php

class Donaciones
{
    private $db;

    public function __construct()
    {
        require_once APP_PATH . '/config/database.php';
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $query = "
        SELECT
            d.idDonacion,
            d.nombreDonador,
            d.correoDonador,
            d.telefonoDonador,
            t.nombre AS tipoEquipo,
            d.marca,
            d.modelo,
            d.estadoEquipo,
            d.cantidadEquipos,
            d.estado,
            d.fechaRegistro
        FROM donaciones d
        INNER JOIN tipos_equipo t
            ON d.idTipoEquipo = t.idTipoEquipo
        ORDER BY d.idDonacion ASC
    ";

        $stmt = $this->db->query($query);

        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM donaciones WHERE idDonacion = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getPorEstado($estado)
    {
        $query = "
        SELECT
            d.idDonacion,
            d.nombreDonador,
            d.correoDonador,
            d.telefonoDonador,
            t.nombre AS tipoEquipo,
            d.marca,
            d.modelo,
            d.estadoEquipo,
            d.cantidadEquipos,
            d.estado,
            d.fechaRegistro
        FROM donaciones d
        INNER JOIN tipos_equipo t
            ON d.idTipoEquipo = t.idTipoEquipo
        WHERE d.estado = :estado
        ORDER BY d.idDonacion ASC
    ";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':estado', $estado);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKpis()
    {
        $query = "
        SELECT
            COUNT(*) AS total,
            SUM(CASE WHEN estado = 'Pendiente' THEN 1 ELSE 0 END) as pendientes,
            SUM(CASE WHEN estado = 'Aceptada' THEN 1 ELSE 0 END) as aceptadas,
            SUM(CASE WHEN estado = 'Rechazada' THEN 1 ELSE 0 END) as rechazadas
            FROM donaciones
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rechazarById($id)
    {
        $query = "UPDATE donaciones 
        SET estado = 'Rechazada'
        WHERE idDonacion = ?
        ";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([$id]);
    }
}
