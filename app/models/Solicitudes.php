<?php

class Solicitudes
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
        s.idSolicitud,
        s.nombreSolicitante,
        s.correoSolicitante,
        s.telefonoSolicitante,
        s.nombreOrganizacion,
        o.nombre as tipoOrganizacion,
        t.nombre AS tipoEquipo,
        s.cantidadEquipos,
        s.motivoSolicitud,
        s.estado,
        s.comentarioAdministrador,
        s.fechaRegistro
        FROM solicitudes s
        INNER JOIN tipos_equipo t
        ON s.idTipoEquipo = t.idTipoEquipo
        INNER JOIN tipos_organizacion o
        ON s.idTipoOrganizacion = o.idTipoOrganizacion
        ORDER BY s.idSolicitud ASC";

        $stmt = $this->db->query($query);

        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM solicitudes WHERE idSolicitud = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getPorEstado($estado)
    {
        $query = "
        SELECT
            s.idSolicitud,
            s.nombreSolicitante,
            s.correoSolicitante,
            s.telefonoSolicitante,
            s.nombreOrganizacion,
            t.nombre AS tipoEquipo,
            s.motivoSolicitud,
            s.estado,
            s.comentarioAdministrador,
            s.fechaRegistro
            FROM solicitudes s
            INNER JOIN tipos_equipo t
            ON s.idTipoEquipo = t.idTipoEquipo
            WHERE s.estado = :estado
            ORDER BY s.idSolicitud ASC";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':estado', $estado);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
