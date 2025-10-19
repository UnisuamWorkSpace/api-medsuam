<?php
// src/controllers/PacienteController.php

namespace src\controllers;

use src\models\PacienteModel;

class PacienteController {
    private $model;

    public function __construct($db) {
        $this->model = new PacienteModel($db);
    }

    public function listar() {
        try {
            $pacientes = $this->model->listarTodos();
            echo json_encode($pacientes);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function buscarPorId($id) {
        try {
            $paciente = $this->model->buscarPorId($id);
            if ($paciente) {
                echo json_encode($paciente);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Paciente não encontrado']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function criar() {
        try {
            $dados = json_decode(file_get_contents('php://input'), true);
            $resultado = $this->model->criar($dados);
            http_response_code(201);
            echo json_encode($resultado);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}