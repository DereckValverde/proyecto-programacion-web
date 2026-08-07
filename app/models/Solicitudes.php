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
        $query = "
        SELECT
            s.*,
            t.nombre AS tipoEquipo,
            o.nombre AS tipoOrganizacion
        FROM solicitudes s
        INNER JOIN tipos_equipo t
        ON s.idTipoEquipo = t.idTipoEquipo
        INNER JOIN tipos_organizacion o
        ON s.idTipoOrganizacion = o.idTipoOrganizacion
        WHERE s.idSolicitud = ?
        ";
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
            s.cantidadEquipos,
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

    public function getKpis()
    {
        $query = "
        SELECT
            COUNT(*) AS total,
            SUM(CASE WHEN estado = 'Pendiente' THEN 1 ELSE 0 END) as pendientes,
            SUM(CASE WHEN estado = 'Aceptada' THEN 1 ELSE 0 END) as aceptadas,
            SUM(CASE WHEN estado = 'Rechazada' THEN 1 ELSE 0 END) as rechazadas
            FROM solicitudes
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function aceptarById($id, $comentario = null)
    {
        $query = "UPDATE solicitudes 
        SET estado = 'Aceptada',
            comentarioAdministrador = ?
        WHERE idSolicitud = ?
        ";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([$comentario, $id]);
    }

    public function rechazarById($id, $comentario = null)
    {
        $query = "UPDATE solicitudes 
        SET estado = 'Rechazada',
            comentarioAdministrador = ?
        WHERE idSolicitud = ?
        ";
        $stmt = $this->db->prepare($query);

        return $stmt->execute([$comentario, $id]);
    }
}
