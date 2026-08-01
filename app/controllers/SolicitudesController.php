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
}
