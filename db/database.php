<?php

    class databaseHelper{
        public $db;

        public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if ($this->db->connect_error) {
                die("Connection failed: " . $this->db->connect_error);
            }
        }

        public function getUsers(){
            $stmt = $this->db->prepare("SELECT * FROM UTENTI");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getCategories(){
            $stmt = $this->db->prepare("SELECT idCategoria,nome FROM CATEGORIE");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getSubcategories(){
            $stmt = $this->db->prepare("SELECT idSottoCategoria, nome, idCategoria FROM SOTTOCATEGORIE");
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function insertSpot($titolo, $testo, $idCategoria, $idSottocategoria, $username){
            $stmt = $this->db->prepare("INSERT INTO SPOT (titolo, testo, idCategoria, idSottoCategoria, username) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('ssiis', $titolo, $testo, $idCategoria, $idSottocategoria, $username);
            return $stmt->execute();
        }

        public function getLastSpots($n){
            
            $stmt = $this->db->prepare("SELECT * FROM spot WHERE stato='approvato' ORDER BY dataInserimento LIMIT ?");
            $stmt->bind_param('i',$n);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }     
        
        public function getSpotsByString($str){
            
            $query = "SELECT * FROM SPOT WHERE (titolo LIKE ? OR testo LIKE ?) 
              AND stato = 'approvato' 
              ORDER BY dataInserimento DESC";
    
            $stmt = $this->db->prepare($query);
            $ricerca = "%".$str."%"; 
            $stmt->bind_param("ss", $ricerca, $ricerca);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }  

        public function getSpotsByCategories($idCategorie){
            $placeholders = implode(',', array_fill(0, count($idCategorie), '?'));
            $query = "SELECT * FROM SPOT 
                    WHERE idCategoria IN ($placeholders) 
                    AND stato = 'approvato'";
            
            $stmt = $this->db->prepare($query);
            $types = str_repeat('i', count($idCategorie));
            
            $stmt->bind_param($types, ...$idCategorie);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getSpotsByCategoriesAndString($testo, $idCategorie) {
            $placeholders = implode(',', array_fill(0, count($idCategorie), '?'));
            $query = "SELECT * FROM SPOT 
                    WHERE (titolo LIKE ? OR testo LIKE ?) 
                    AND idCategoria IN ($placeholders) 
                    AND stato = 'approvato'";
            
            $stmt = $this->db->prepare($query);
            
            $parola = "%$testo%";
            $types = "ss" . str_repeat('i', count($idCategorie));
            $params = array_merge([$parola, $parola], $idCategorie);
            
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
    }
?>