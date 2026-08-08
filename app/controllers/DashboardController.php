<?php

class DashboardController
{
    private $dashboardModel;

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
            redirect('auth');
        }

        $this->dashboardModel = model('Dashboard');
    }

    public function apiKpis()
    {
        header('Content-Type: application/json');
        $kpis = $this->dashboardModel->getKpis();

        echo json_encode($kpis);
    }

    public function apiHistorialMensual()
    {
        header('Content-Type: application/json');
        $historial = $this->dashboardModel->getHistorialMensual();

        echo json_encode($historial);
    }

    public function apiTiposEquipos()
    {
        header('Content-Type: application/json');
        $tiposEquipos = $this->dashboardModel->getTiposEquipos();

        echo json_encode($tiposEquipos);
    }

    public function apiSolicitudesRecientes()
    {
        header('Content-Type: application/json');
        $solicitudes = $this->dashboardModel->getSolicitudesRecientes();

        echo json_encode($solicitudes);
    }

    public function apiLogs()
    {
        header('Content-Type: application/json');
        $logs = $this->dashboardModel->getLogs();

        echo json_encode($logs);
    }
}
