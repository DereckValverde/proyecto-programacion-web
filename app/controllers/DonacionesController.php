<?php

class DonacionesController
{
    private $donacionesModel;

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
            redirect('auth');
        }

        $this->donacionesModel = model('Donaciones');
    }

    public function apiList()
    {
        header('Content-Type: application/json');
        $donaciones = $this->donacionesModel->getAll();

        echo json_encode($donaciones);
    }

    public function apiShow($id)
    {
        header('Content-Type: application/json');
        $donacion = $this->donacionesModel->getById($id);

        if ($donacion) {
            echo json_encode(['success' => true, 'data' => $donacion]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Donacion no encontrada.']);
        }
    }

    public function apiListEstado($estado)
    {
        header('Content-Type: application/json');
        $donaciones = $this->donacionesModel->getPorEstado($estado);

        echo json_encode($donaciones);
    }

    public function apiKpis()
    {
        header('Content-Type: application/json');
        $kpis = $this->donacionesModel->getKpis();
        echo json_encode($kpis);
    }

    public function apiBuscar()
    {
        header('Content-Type: application/json');
        $texto = trim($_GET['texto'] ?? '');

        if ($texto === '') {
            $donaciones = $this->donacionesModel->getAll();
        } else {
            $donaciones = $this->donacionesModel->buscar($texto);
        }

        echo json_encode($donaciones);
    }

    public function apiRechazar($id)
    {
        header('Content-Type: application/json');

        $datos = json_decode(file_get_contents('php://input'), true);
        $comentario = $datos['comentario'] ?? null;

        $donacionRechazada = $this->donacionesModel->rechazarById($id, $comentario);

        if ($donacionRechazada) {
            echo json_encode([
                'success' => true,
                'message' => 'Donación rechazada correctamente.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al rechazar la donación.'
            ]);
        }
    }

    public function apiAceptar($id)
    {
        header('Content-Type: application/json');

        $datos = json_decode(file_get_contents('php://input'), true);
        $comentario = $datos['comentario'] ?? null;

        $donacionAceptada = $this->donacionesModel->aceptarById($id, $comentario);

        if ($donacionAceptada) {
            echo json_encode([
                'success' => true,
                'message' => 'Donación aceptada correctamente.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al aceptar la donación.'
            ]);
        }
    }

    public function apiCompletar($id)
    {
        header('Content-Type: application/json');

        $datos = json_decode(file_get_contents('php://input'), true);
        $comentario = $datos['comentario'] ?? null;

        $donacionCompletada = $this->donacionesModel->completarById($id, $comentario);

        if ($donacionCompletada) {
            echo json_encode([
                'success' => true,
                'message' => 'Donación marcada como completada.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al completar la donación.'
            ]);
        }
    }

    public function apiEliminar($id)
    {
        header('Content-Type: application/json');

        $eliminada = $this->donacionesModel->deleteById($id);

        if ($eliminada) {
            echo json_encode([
                'success' => true,
                'message' => 'Donación eliminada correctamente.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al eliminar la donación.'
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

        $id = $this->donacionesModel->create([
            'nombreDonador'       => trim($datos['nombreDonador'] ?? ''),
            'correoDonador'       => trim($datos['correoDonador'] ?? ''),
            'telefonoDonador'     => trim($datos['telefonoDonador'] ?? ''),
            'tipoEquipo'          => trim($datos['tipoEquipo'] ?? ''),
            'marca'               => trim($datos['marca'] ?? ''),
            'modelo'              => trim($datos['modelo'] ?? ''),
            'estadoEquipo'        => trim($datos['estadoEquipo'] ?? ''),
            'cantidadEquipos'     => (int) ($datos['cantidadEquipos'] ?? 0),
            'descripcionAdicional'=> trim($datos['descripcionAdicional'] ?? ''),
        ]);

        if ($id) {
            echo json_encode([
                'success' => true,
                'message' => 'Donación creada correctamente.',
                'id' => $id
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error al crear la donación.']);
        }
    }

    public function apiActualizar($id)
    {
        header('Content-Type: application/json');

        $datos = json_decode(file_get_contents('php://input'), true);
        if (!is_array($datos)) {
            $datos = $_POST;
        }

        $actualizada = $this->donacionesModel->updateById($id, $datos);

        if ($actualizada) {
            echo json_encode([
                'success' => true,
                'message' => 'Donación actualizada correctamente.'
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la donación.']);
        }
    }
}
