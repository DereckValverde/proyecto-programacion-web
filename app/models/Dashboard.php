<?php

class Dashboard
{
    private $db;

    public function __construct()
    {
        require_once APP_PATH . '/config/database.php';
        $this->db = Database::getInstance()->getConnection();
    }

    public function getKpis()
    {
        $query = "
        SELECT
            (SELECT COUNT(*) FROM solicitudes WHERE estado = 'Pendiente') AS solicitudesPendientes,
            (SELECT COUNT(*) FROM donaciones WHERE estado = 'Completada') AS donacionesCompletadas,
            (SELECT COALESCE(SUM(t.co2Estimado * d.cantidadEquipos), 0)
                FROM donaciones d
                INNER JOIN tipos_equipo t
                ON d.idTipoEquipo = t.idTipoEquipo
                WHERE d.estado IN ('Aceptada', 'Completada')) AS co2Evitado
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getHistorialMensual()
    {
        $query = "
        SELECT
            DATE_FORMAT(fechaRegistro, '%Y-%m') AS mes,
            SUM(cantidadEquipos) AS total
        FROM donaciones
        GROUP BY mes
        ORDER BY mes ASC
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $porMes = [];
        foreach ($registros as $registro) {
            $porMes[$registro['mes']] = (int) $registro['total'];
        }

        $historial = [];
        for ($i = 5; $i >= 0; $i--) {
            $mes = date('Y-m', strtotime("first day of -{$i} month"));
            $historial[] = [
                'mes' => $mes,
                'total' => $porMes[$mes] ?? 0
            ];
        }

        return $historial;
    }

    public function getTiposEquipos()
    {
        $query = "
        SELECT
            t.nombre AS tipoEquipo,
            SUM(d.cantidadEquipos) AS total
        FROM donaciones d
        INNER JOIN tipos_equipo t
        ON d.idTipoEquipo = t.idTipoEquipo
        GROUP BY t.idTipoEquipo, t.nombre
        ORDER BY total DESC
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSolicitudesRecientes()
    {
        $query = "
        SELECT
            s.idSolicitud,
            s.nombreSolicitante,
            s.nombreOrganizacion,
            t.nombre AS tipoEquipo,
            s.cantidadEquipos,
            s.estado,
            s.fechaRegistro
        FROM solicitudes s
        INNER JOIN tipos_equipo t
        ON s.idTipoEquipo = t.idTipoEquipo
        ORDER BY s.fechaRegistro DESC
        LIMIT 5
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLogs()
    {
        $query = "
        SELECT
            l.idLog,
            l.tipo,
            l.descripcion,
            l.fecha,
            a.nombre AS administrador
        FROM auditoria l
        LEFT JOIN administradores a
        ON l.idAdministrador = a.idAdministrador
        ORDER BY l.fecha DESC
        LIMIT 5
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
