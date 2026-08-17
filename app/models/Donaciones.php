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

    public function buscar($texto)
    {
        $texto = '%' . $texto . '%';
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
        WHERE d.nombreDonador LIKE :texto
           OR d.correoDonador LIKE :texto
           OR d.marca LIKE :texto
           OR d.modelo LIKE :texto
           OR t.nombre LIKE :texto
        ORDER BY d.idDonacion ASC
    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':texto' => $texto]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rechazarById($id, $comentario = null)
    {
        $query = "UPDATE donaciones 
        SET estado = 'Rechazada',
            comentarioAdministrador = ?
        WHERE idDonacion = ?
        ";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([$comentario, $id]);

        if ($exito) {
            $this->registrarLog('Modificacion', "Se rechazó la donación #{$id}.", $_SESSION['admin_id'] ?? null);
        }

        return $exito;
    }

    public function aceptarById($id, $comentario = null)
    {
        $query = "UPDATE donaciones 
        SET estado = 'Aceptada',
            comentarioAdministrador = ?
        WHERE idDonacion = ?
        ";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([$comentario, $id]);

        if ($exito) {
            $this->registrarLog('Modificacion', "Se aprobó la donación #{$id}.", $_SESSION['admin_id'] ?? null);
        }

        return $exito;
    }

    public function completarById($id, $comentario = null)
    {
        $query = "UPDATE donaciones
        SET estado = 'Completada',
            comentarioAdministrador = ?,
            fechaRevision = NOW()
        WHERE idDonacion = ?
        ";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([$comentario, $id]);

        if ($exito) {
            $this->registrarLog('Modificacion', "Se completó la donación #{$id}.", $_SESSION['admin_id'] ?? null);
        }

        return $exito;
    }

    public function create(array $datos)
    {
        $idTipoEquipo = $this->getTipoEquipoId($datos['tipoEquipo'] ?? '');

        $query = "INSERT INTO donaciones
            (nombreDonador, correoDonador, telefonoDonador, idTipoEquipo, marca, modelo,
             estadoEquipo, cantidadEquipos, descripcionAdicional, estado)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pendiente')
        ";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([
            $datos['nombreDonador'],
            $datos['correoDonador'],
            $datos['telefonoDonador'] ?? null,
            $idTipoEquipo,
            $datos['marca'] ?? null,
            $datos['modelo'] ?? null,
            $datos['estadoEquipo'],
            $datos['cantidadEquipos'],
            $datos['descripcionAdicional'] ?? null,
        ]);

        if ($exito) {
            $id = (int) $this->db->lastInsertId();
            $this->registrarLog('Registro', "Se registró una nueva donación de {$datos['nombreDonador']}.", $_SESSION['admin_id'] ?? null);
            return $id;
        }

        return false;
    }

    public function updateById($id, array $datos)
    {
        $campos = [
            'nombreDonador',
            'correoDonador',
            'telefonoDonador',
            'marca',
            'modelo',
            'estadoEquipo',
            'cantidadEquipos',
            'descripcionAdicional'
        ];

        if (isset($datos['tipoEquipo']) && $datos['tipoEquipo'] !== '') {
            $datos['idTipoEquipo'] = $this->getTipoEquipoId($datos['tipoEquipo']);
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

        if (empty($sets)) {
            return false;
        }

        $valores[] = $id;
        $query = "UPDATE donaciones SET " . implode(', ', $sets) . " WHERE idDonacion = ?";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute($valores);

        if ($exito) {
            $this->registrarLog('Modificacion', "Se modificó la donación #{$id}.", $_SESSION['admin_id'] ?? null);
        }

        return $exito;
    }

    public function deleteById($id)
    {
        $query = "DELETE FROM donaciones WHERE idDonacion = ?";
        $stmt = $this->db->prepare($query);
        $exito = $stmt->execute([$id]);

        if ($exito) {
            $this->registrarLog('Eliminacion', "Se eliminó la donación #{$id}.", $_SESSION['admin_id'] ?? null);
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

    private function registrarLog($tipo, $descripcion, $idAdministrador = null)
    {
        $query = "INSERT INTO auditoria (idAdministrador, tipo, descripcion) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$idAdministrador, $tipo, $descripcion]);
    }
}
