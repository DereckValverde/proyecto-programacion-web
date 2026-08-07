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

    public function apiRechazar($id)
    {
        header('Content-Type: application/json');

        $donacionRechazada = $this->donacionesModel->rechazarById($id);

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
}
