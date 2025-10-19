<?php
// src/models/PacienteModel.php

namespace src\models;

class PacienteModel {
    private $conn;
    private $table = 'pacientes';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listarTodos() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados) {
        $query = "INSERT INTO " . $this->table . " (nome, email, telefone) VALUES (:nome, :email, :telefone)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':email', $dados['email']);
        $stmt->bindParam(':telefone', $dados['telefone']);
        
        if ($stmt->execute()) {
            return ['id' => $this->conn->lastInsertId(), 'message' => 'Paciente criado com sucesso'];
        }
        throw new Exception('Erro ao criar paciente');
    }
}