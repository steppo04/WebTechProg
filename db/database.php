<?php

class DatabaseHelper {
    public $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getUsers() {
        $stmt = $this->db->prepare("SELECT * FROM UTENTI");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories() {
        $stmt = $this->db->prepare("SELECT idCategoria, nome FROM CATEGORIE ORDER BY nome ASC");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllSubcategories() {
        $stmt = $this->db->prepare("SELECT idSottoCategoria, nome, idCategoria FROM SOTTOCATEGORIE ORDER BY nome ASC");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getSpotById($idSpot) {
        $stmt = $this->db->prepare("SELECT * FROM SPOT WHERE idSpot = ?");
        $stmt->bind_param('i', $idSpot);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insertSpot($titolo, $testo, $idCat, $idSubCat, $username) {
        $stmt = $this->db->prepare("INSERT INTO SPOT (titolo, testo, idCategoria, idSottoCategoria, usernameUtente, stato) VALUES (?, ?, ?, ?, ?, 'in_attesa')");
        $stmt->bind_param('ssiis', $titolo, $testo, $idCat, $idSubCat, $username);
        return $stmt->execute();
    }

    public function updateSpot($idSpot, $titolo, $testo, $idCat, $idSubCat) {
        // Quando uno spot viene modificato, torna in stato in_attesa e deve essere riaprovato
        $stmt = $this->db->prepare("UPDATE SPOT SET titolo = ?, testo = ?, idCategoria = ?, idSottoCategoria = ?, stato = 'in_attesa' WHERE idSpot = ?");
        $stmt->bind_param('ssiii', $titolo, $testo, $idCat, $idSubCat, $idSpot);
        return $stmt->execute();
    }

    public function deleteSpot($idSpot) {
        $stmt = $this->db->prepare("DELETE FROM SPOT WHERE idSpot = ?");
        $stmt->bind_param('i', $idSpot);
        return $stmt->execute();
    }

    public function getLastSpots($n) {
        $stmt = $this->db->prepare("SELECT * FROM SPOT WHERE stato='approvato' ORDER BY dataInserimento DESC LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }     
}
?>