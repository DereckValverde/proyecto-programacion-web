<?php

class SolicitudesController
{
    private $solicitudesModel;

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
            redirect('auth');
        }

        $this->solicitudesModel = model('Solicitudes');
    }

    public function apiList()
    {
        header('Content-Type: application/json');

        $solicitudes = $this->solicitudesModel->getAll();

        echo json_encode($solicitudes);
    }

    public function apiShow($id)
    {
        header('Content-Type: application/json');
        $solicitud = $this->solicitudesModel->getById($id);

        if ($solicitud) {
            echo json_encode(['success' => true, 'data' => $solicitud]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Solicitud no encontrada.']);
        }
    }

    public function apiListEstado($estado)
    {
        header('Content-Type: application/json');
        $solicitudes = $this->solicitudesModel->getPorEstado($estado);

        echo json_encode($solicitudes);
    }

    public function apiKpis()
    {
        header('Content-Type: application/json');
        $kpis = $this->solicitudesModel->getKpis();

        echo json_encode($kpis);
    }

    public function apiBuscar()
    {
        header('Content-Type: application/json');
        $texto = trim($_GET['texto'] ?? '');

        if ($texto === '') {
            $solicitudes = $this->solicitudesModel->getAll();
        } else {
            $solicitudes = $this->solicitudesModel->buscar($texto);
        }

        echo json_encode($solicitudes);
    }

    public function apiAceptar($id)
    {
        header('Content-Type: application/json');

        $datos = json_decode(file_get_contents('php://input'), true);
        $comentario = $datos['comentario'] ?? null;

        $solicitudAceptada = $this->solicitudesModel->aceptarById($id, $comentario);

        if ($solicitudAceptada) {
            echo json_encode([
                'success' => true,
                'message' => 'Solicitud aceptada correctamente.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al aceptar la solicitud.'
            ]);
        }
    }

    public function apiRechazar($id)
    {
        header('Content-Type: application/json');

        $datos = json_decode(file_get_contents('php://input'), true);
        $comentario = $datos['comentario'] ?? null;

        $solicitudRechazada = $this->solicitudesModel->rechazarById($id, $comentario);

        if ($solicitudRechazada) {
            echo json_encode([
                'success' => true,
                'message' => 'Solicitud rechazada correctamente.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al rechazar la solicitud.'
            ]);
        }
    }

    public function apiEliminar($id)
    {
        header('Content-Type: application/json');

        $eliminada = $this->solicitudesModel->deleteById($id);

        if ($eliminada) {
            echo json_encode([
                'success' => true,
                'message' => 'Solicitud eliminada correctamente.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al eliminar la solicitud.'
            ]);
        }
    }

    public function apiCrear()
    {
        header('Content-Type: application/json');

        $datos = json_decode(file_get_contents('php://input'), true);
        if (!is_array($datos)) {
            $datos = $_POST;
        }

        $id = $this->solicitudesModel->create([
            'nombreSolicitante'   => trim($datos['nombreSolicitante'] ?? ''),
            'correoSolicitante'   => trim($datos['correoSolicitante'] ?? ''),
            'telefonoSolicitante' => trim($datos['telefonoSolicitante'] ?? ''),
            'nombreOrganizacion'  => trim($datos['nombreOrganizacion'] ?? ''),
            'tipoOrganizacion'    => trim($datos['tipoOrganizacion'] ?? ''),
            'tipoEquipo'          => trim($datos['tipoEquipo'] ?? ''),
            'cantidadEquipos'     => (int) ($datos['cantidadEquipos'] ?? 0),
            'motivoSolicitud'     => trim($datos['motivoSolicitud'] ?? ''),
        ]);

        if ($id) {
            echo json_encode([
                'success' => true,
                'message' => 'Solicitud creada correctamente.',
                'id' => $id
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error al crear la solicitud.']);
        }
    }

    public function apiActualizar($id)
    {
        header('Content-Type: application/json');

        $datos = json_decode(file_get_contents('php://input'), true);
        if (!is_array($datos)) {
            $datos = $_POST;
        }

        $actualizada = $this->solicitudesModel->updateById($id, $datos);

        if ($actualizada) {
            echo json_encode([
                'success' => true,
                'message' => 'Solicitud actualizada correctamente.'
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la solicitud.']);
        }
    }
}
