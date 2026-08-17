<?php

class FormulariosController
{
    private $donacionesModel;
    private $solicitudesModel;
    private $contactoModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->donacionesModel = model('Donaciones');
        $this->solicitudesModel = model('Solicitudes');
        $this->contactoModel = model('Contacto');
    }

    public function guardarDonacion()
    {
        header('Content-Type: application/json');

        $datos = json_decode(file_get_contents('php://input'), true);
        if (!is_array($datos)) {
            $datos = $_POST;
        }

        $errores = $this->validarDonacion($datos);
        if (!empty($errores)) {
            http_response_code(422);
            echo json_encode(['success' => false, 'errores' => $errores]);
            return;
        }

        $id = $this->donacionesModel->create([
            'nombreDonador'       => trim($datos['nombreDonador']),
            'correoDonador'       => trim($datos['correoDonador']),
            'telefonoDonador'     => trim($datos['telefonoDonador'] ?? ''),
            'tipoDonador'         => trim($datos['tipoDonador'] ?? 'Persona Fisica'),
            'detalleDonador'      => trim($datos['detalleDonador'] ?? ''),
            'tipoEquipo'          => trim($datos['tipoEquipo']),
            'marca'               => trim($datos['marca'] ?? ''),
            'modelo'              => trim($datos['modelo'] ?? ''),
            'estadoEquipo'        => trim($datos['estadoEquipo']),
            'cantidadEquipos'     => (int) $datos['cantidadEquipos'],
            'descripcionAdicional'=> trim($datos['descripcionAdicional'] ?? ''),
        ]);

        if ($id) {
            echo json_encode([
                'success' => true,
                'message' => 'Donación registrada con éxito. Nuestro equipo se pondrá en contacto para coordinar la recolección pronto.',
                'id' => $id
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'No se pudo registrar la donación. Intente nuevamente.']);
        }
    }

    public function guardarSolicitud()
    {
        header('Content-Type: application/json');

        $datos = json_decode(file_get_contents('php://input'), true);
        if (!is_array($datos)) {
            $datos = $_POST;
        }

        $errores = $this->validarSolicitud($datos);
        if (!empty($errores)) {
            http_response_code(422);
            echo json_encode(['success' => false, 'errores' => $errores]);
            return;
        }

        $id = $this->solicitudesModel->create([
            'nombreSolicitante'   => trim($datos['nombreSolicitante']),
            'correoSolicitante'   => trim($datos['correoSolicitante']),
            'telefonoSolicitante' => trim($datos['telefonoSolicitante'] ?? ''),
            'nombreOrganizacion'  => trim($datos['nombreOrganizacion']),
            'tipoOrganizacion'    => trim($datos['tipoOrganizacion']),
            'tipoEquipo'          => trim($datos['tipoEquipo']),
            'cantidadEquipos'     => (int) $datos['cantidadEquipos'],
            'motivoSolicitud'     => trim($datos['motivoSolicitud']),
        ]);

        if ($id) {
            echo json_encode([
                'success' => true,
                'message' => 'Su solicitud de equipos fue registrada con éxito. Nos pondremos en contacto.',
                'id' => $id
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'No se pudo registrar la solicitud. Intente nuevamente.']);
        }
    }

    public function guardarContacto()
    {
        header('Content-Type: application/json');

        $datos = json_decode(file_get_contents('php://input'), true);
        if (!is_array($datos)) {
            $datos = $_POST;
        }

        $errores = $this->validarContacto($datos);
        if (!empty($errores)) {
            http_response_code(422);
            echo json_encode(['success' => false, 'errores' => $errores]);
            return;
        }

        $id = $this->contactoModel->create([
            'nombre' => trim($datos['nombre']),
            'correo' => trim($datos['correo']),
            'asunto' => trim($datos['asunto']),
            'mensaje'=> trim($datos['mensaje']),
        ]);

        if ($id) {
            echo json_encode([
                'success' => true,
                'message' => 'Su mensaje fue enviado con éxito. Le responderemos pronto.',
                'id' => $id
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'No se pudo enviar el mensaje. Intente nuevamente.']);
        }
    }

    private function validarDonacion(array $d)
    {
        $errores = [];

        if (empty(trim($d['nombreDonador'] ?? ''))) {
            $errores[] = 'El nombre es requerido.';
        }
        if (empty(trim($d['correoDonador'] ?? '')) || !filter_var(trim($d['correoDonador']), FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'Correo electrónico inválido.';
        }
        if (empty(trim($d['telefonoDonador'] ?? ''))) {
            $errores[] = 'El teléfono es requerido.';
        }
        if (empty(trim($d['tipoEquipo'] ?? ''))) {
            $errores[] = 'Debe seleccionar un tipo de equipo.';
        }
        if (empty(trim($d['estadoEquipo'] ?? ''))) {
            $errores[] = 'Debe indicar el estado del equipo.';
        }
        if (empty($d['cantidadEquipos'] ?? null) || (int) $d['cantidadEquipos'] < 1) {
            $errores[] = 'La cantidad debe ser al menos 1.';
        }

        return $errores;
    }

    private function validarSolicitud(array $d)
    {
        $errores = [];

        if (empty(trim($d['nombreSolicitante'] ?? ''))) {
            $errores[] = 'El nombre del solicitante es requerido.';
        }
        if (empty(trim($d['correoSolicitante'] ?? '')) || !filter_var(trim($d['correoSolicitante']), FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'Correo electrónico inválido.';
        }
        if (empty(trim($d['telefonoSolicitante'] ?? ''))) {
            $errores[] = 'El teléfono es requerido.';
        }
        if (empty(trim($d['nombreOrganizacion'] ?? ''))) {
            $errores[] = 'El nombre de la organización es requerido.';
        }
        if (empty(trim($d['tipoOrganizacion'] ?? ''))) {
            $errores[] = 'Debe seleccionar un tipo de organización.';
        }
        if (empty(trim($d['tipoEquipo'] ?? ''))) {
            $errores[] = 'Debe seleccionar el equipo solicitado.';
        }
        if (empty($d['cantidadEquipos'] ?? null) || (int) $d['cantidadEquipos'] < 1) {
            $errores[] = 'La cantidad debe ser al menos 1.';
        }
        if (empty(trim($d['motivoSolicitud'] ?? ''))) {
            $errores[] = 'Debe explicar el motivo de la solicitud.';
        }

        return $errores;
    }

    private function validarContacto(array $d)
    {
        $errores = [];

        if (empty(trim($d['nombre'] ?? ''))) {
            $errores[] = 'El nombre es requerido.';
        }
        if (empty(trim($d['correo'] ?? '')) || !filter_var(trim($d['correo']), FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'Correo electrónico inválido.';
        }
        if (empty(trim($d['asunto'] ?? ''))) {
            $errores[] = 'El asunto es requerido.';
        }
        if (empty(trim($d['mensaje'] ?? ''))) {
            $errores[] = 'El mensaje es requerido.';
        }

        return $errores;
    }
}
