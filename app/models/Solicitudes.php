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

    public function buscar($texto)
    {
        $texto = '%' . $texto . '%';
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
        WHERE s.nombreSolicitante LIKE :texto
           OR s.correoSolicitante LIKE :texto
           OR s.nombreOrganizacion LIKE :texto
           OR t.nombre LIKE :texto
           OR o.nombre LIKE :texto
        ORDER BY s.idSolicitud ASC
    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':texto' => $texto]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function aceptarById($id, $comentario = null)
    {
        $query = "UPDATE solicitudes 
        SET estado = 'Aceptada',
            comentarioAdministrador = ?
        WHERE idSolicitud = ?
        ";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([$comentario, $id]);

        if ($exito) {
            $this->registrarLog('Modificacion', "Se aprobó la solicitud #{$id}.", $_SESSION['admin_id'] ?? null);
        }

        return $exito;
    }

    public function rechazarById($id, $comentario = null)
    {
        $query = "UPDATE solicitudes 
        SET estado = 'Rechazada',
            comentarioAdministrador = ?
        WHERE idSolicitud = ?
        ";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([$comentario, $id]);

        if ($exito) {
            $this->registrarLog('Modificacion', "Se rechazó la solicitud #{$id}.", $_SESSION['admin_id'] ?? null);
        }

        return $exito;
    }

    public function create(array $datos)
    {
        $idTipoEquipo = $this->getTipoEquipoId($datos['tipoEquipo'] ?? '');
        $idTipoOrganizacion = $this->getTipoOrganizacionId($datos['tipoOrganizacion'] ?? '');

        $query = "INSERT INTO solicitudes
            (nombreSolicitante, correoSolicitante, telefonoSolicitante, nombreOrganizacion,
             idTipoOrganizacion, idTipoEquipo, cantidadEquipos, motivoSolicitud, estado)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Pendiente')
        ";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([
            $datos['nombreSolicitante'],
            $datos['correoSolicitante'],
            $datos['telefonoSolicitante'] ?? null,
            $datos['nombreOrganizacion'],
            $idTipoOrganizacion,
            $idTipoEquipo,
            $datos['cantidadEquipos'],
            $datos['motivoSolicitud'],
        ]);

        if ($exito) {
            $id = (int) $this->db->lastInsertId();
            $this->registrarLog('Registro', "Se registró una nueva solicitud de {$datos['nombreSolicitante']}.", $_SESSION['admin_id'] ?? null);
            return $id;
        }

        return false;
    }

    public function updateById($id, array $datos)
    {
        $campos = [
            'nombreSolicitante',
            'correoSolicitante',
            'telefonoSolicitante',
            'nombreOrganizacion',
            'cantidadEquipos',
            'motivoSolicitud'
        ];

        if (isset($datos['tipoEquipo']) && $datos['tipoEquipo'] !== '') {
            $datos['idTipoEquipo'] = $this->getTipoEquipoId($datos['tipoEquipo']);
        }
        if (isset($datos['tipoOrganizacion']) && $datos['tipoOrganizacion'] !== '') {
            $datos['idTipoOrganizacion'] = $this->getTipoOrganizacionId($datos['tipoOrganizacion']);
        }

        $sets = [];
        $valores = [];
        foreach ($campos as $campo) {
            if (array_key_exists($campo, $datos)) {
                $sets[] = "{$campo} = ?";
                $valores[] = $datos[$campo];
            }
        }
        if (isset($datos['idTipoEquipo'])) {
            $sets[] = "idTipoEquipo = ?";
            $valores[] = $datos['idTipoEquipo'];
        }
        if (isset($datos['idTipoOrganizacion'])) {
            $sets[] = "idTipoOrganizacion = ?";
            $valores[] = $datos['idTipoOrganizacion'];
        }

        if (empty($sets)) {
            return false;
        }

        $valores[] = $id;
        $query = "UPDATE solicitudes SET " . implode(', ', $sets) . " WHERE idSolicitud = ?";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute($valores);

        if ($exito) {
            $this->registrarLog('Modificacion', "Se modificó la solicitud #{$id}.", $_SESSION['admin_id'] ?? null);
        }

        return $exito;
    }

    public function deleteById($id)
    {
        $query = "DELETE FROM solicitudes WHERE idSolicitud = ?";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([$id]);

        if ($exito) {
            $this->registrarLog('Eliminacion', "Se eliminó la solicitud #{$id}.", $_SESSION['admin_id'] ?? null);
        }

        return $exito;
    }

    private function getTipoEquipoId(string $nombre): int
    {
        if ($nombre === '') {
            throw new \InvalidArgumentException('El tipo de equipo es requerido.');
        }

        $query = "SELECT idTipoEquipo FROM tipos_equipo WHERE nombre = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nombre]);
        $id = $stmt->fetchColumn();

        if ($id) {
            return (int) $id;
        }

        $insert = "INSERT INTO tipos_equipo (nombre, co2Estimado) VALUES (?, 0)";
        $stmt = $this->db->prepare($insert);
        $stmt->execute([$nombre]);

        return (int) $this->db->lastInsertId();
    }

    private function getTipoOrganizacionId(string $nombre): int
    {
        if ($nombre === '') {
            throw new \InvalidArgumentException('El tipo de organización es requerido.');
        }

        $query = "SELECT idTipoOrganizacion FROM tipos_organizacion WHERE nombre = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nombre]);
        $id = $stmt->fetchColumn();

        if ($id) {
            return (int) $id;
        }

        $insert = "INSERT INTO tipos_organizacion (nombre) VALUES (?)";
        $stmt = $this->db->prepare($insert);
        $stmt->execute([$nombre]);

        return (int) $this->db->lastInsertId();
    }

    private function registrarLog($tipo, $descripcion, $idAdministrador = null)
    {
        $query = "INSERT INTO auditoria (idAdministrador, tipo, descripcion) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$idAdministrador, $tipo, $descripcion]);
    }
}
