<?php

class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getSpotInfo($idSpot)
    {
        $query = "SELECT S.*, C.nome AS nomeCategoria, SC.nome AS nomeSottoCategoria, 
                        U.nome AS nomeAutore, U.cognome AS cognomeAutore
                        FROM SPOT S
                        JOIN CATEGORIE C ON S.idCategoria = C.idCategoria
                        LEFT JOIN SOTTOCATEGORIE SC ON S.idSottoCategoria = SC.idSottoCategoria
                        LEFT JOIN UTENTI U ON S.usernameUtente = U.username
                        WHERE S.stato = 'approvato' AND S.idSpot = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idSpot);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getComments($idSpot)
    {
        $query = "SELECT C1.*, C2.testo AS testoPadre, C2.usernameUtente AS autorePadre
            FROM COMMENTI C1
            LEFT JOIN COMMENTI C2 ON C1.idCommentoRisposto = C2.idCommento
            WHERE C1.idSpot = ?
            ORDER BY C1.dataPubblicazione ASC";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idSpot);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUsers()
    {
        $stmt = $this->db->prepare("SELECT * FROM UTENTI");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories()
    {
        $stmt = $this->db->prepare("SELECT idCategoria,nome FROM CATEGORIE");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubcategories()
    {
        $stmt = $this->db->prepare("SELECT idSottoCategoria, nome, idCategoria FROM SOTTOCATEGORIE");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function insertSpot($titolo, $testo, $idCat, $idSubCat, $username)
    {
        $stmt = $this->db->prepare("INSERT INTO SPOT (titolo, testo, idCategoria, idSottoCategoria, usernameUtente, stato) VALUES (?, ?, ?, ?, ?, 'in_attesa')");
        $stmt->bind_param('ssiis', $titolo, $testo, $idCat, $idSubCat, $username);
        return $stmt->execute();
    }

    public function getLastSpots($n)
    {

        $stmt = $this->db->prepare("SELECT * FROM SPOT WHERE stato='approvato' ORDER BY dataInserimento LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSpotsByString($str)
    {

        $query = "SELECT * FROM SPOT WHERE (titolo LIKE ? OR testo LIKE ?) 
            AND stato = 'approvato' 
            ORDER BY dataInserimento DESC";

        $stmt = $this->db->prepare($query);
        $ricerca = "%" . $str . "%";
        $stmt->bind_param("ss", $ricerca, $ricerca);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSpotsByCategories($idCategorie)
    {
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

    public function getSpotsByCategoriesAndString($testo, $idCategorie)
    {
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


    public function getAllSubcategories()
    {
        $stmt = $this->db->prepare("SELECT idSottoCategoria, nome, idCategoria FROM SOTTOCATEGORIE ORDER BY nome ASC");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getSpotById($idSpot)
    {
        $stmt = $this->db->prepare("SELECT * FROM SPOT WHERE idSpot = ?");
        $stmt->bind_param('i', $idSpot);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }


    public function updateSpot($idSpot, $titolo, $testo, $idCat, $idSubCat)
    {
        // Quando uno spot viene modificato, torna in stato in_attesa e deve essere riaprovato
        $stmt = $this->db->prepare("UPDATE SPOT SET titolo = ?, testo = ?, idCategoria = ?, idSottoCategoria = ?, stato = 'in_attesa' WHERE idSpot = ?");
        $stmt->bind_param('ssiii', $titolo, $testo, $idCat, $idSubCat, $idSpot);
        return $stmt->execute();
    }

    public function deleteSpot($idSpot)
    {
        $stmt = $this->db->prepare("DELETE FROM SPOT WHERE idSpot = ?");
        $stmt->bind_param('i', $idSpot);
        return $stmt->execute();
    }

    public function getUsersExceptAdmins()
    {
        $query = "SELECT * FROM UTENTI u JOIN TIPI_UTENTI t ON u.idTipo = t.idTipo WHERE t.nomeTipo != 'admin' ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUserStatus($username, $nuovoStato)
    {
        $stmt = $this->db->prepare("UPDATE UTENTI SET stato = ? WHERE username = ?");
        $stmt->bind_param('ss', $nuovoStato, $username);
        return $stmt->execute();
    }

    public function checkLogin($username, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM UTENTI WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if ($password === $user['password']) {
                if ($user['stato'] === 'attivo') {
                    return $user;
                } else {
                    return -1;
                }
            }
            return false;
        }
    }

    public function insertUser($nome, $cognome, $username, $password)
    {
        $query = "INSERT INTO UTENTI (nome, cognome, username, password, stato, idTipo) VALUES (?, ?, ?, ?,'attivo',2)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $nome, $cognome, $username, $password);
        return $stmt->execute();
    }

    public function getGeneralStats() {
        $stats = [];
        
        $res = $this->db->query("SELECT stato, COUNT(*) as total FROM SPOT GROUP BY stato");
        $results = $res->fetch_all(MYSQLI_ASSOC);
        
        $stats['approvati'] = 0;
        $stats['in_attesa'] = 0;
        
        foreach($results as $row) {
            if($row['stato'] == 'approvato') $stats['approvati'] = $row['total'];
            if($row['stato'] == 'in_attesa') $stats['in_attesa'] = $row['total'];
        }
        
        $res = $this->db->query("SELECT COUNT(*) as total FROM UTENTI WHERE stato = 'attivo'");
        $stats['utenti_attivi'] = $res->fetch_assoc()['total'];
        
        return $stats;
    }

    public function getTopUser() {
        $query = "SELECT usernameUtente, COUNT(*) as total 
                FROM SPOT 
                WHERE stato = 'approvato' 
                GROUP BY usernameUtente 
                ORDER BY total DESC LIMIT 1";
        $res = $this->db->query($query);
        return $res->fetch_assoc();
    }

    public function getTopCategory() {
        $query = "SELECT C.nome, COUNT(S.idSpot) as total 
                FROM CATEGORIE C 
                LEFT JOIN SPOT S ON C.idCategoria = S.idCategoria 
                GROUP BY C.idCategoria 
                ORDER BY total DESC LIMIT 1";
        $res = $this->db->query($query);
        return $res->fetch_assoc();
    }

    public function isSpotPreferito($usr,$idSpot)
    {
        $query = "SELECT * FROM PREFERITI 
                    WHERE usernameUtente = ? AND idSpot = ?;";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $usr, $idSpot);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->num_rows > 0;
    }

    public function aggiungiPreferito($usr,$idSpot){
        $query = "INSERT INTO PREFERITI(usernameUtente,idSpot) values(?,?)";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $usr, $idSpot);
        
        return $stmt->execute();
    }

    public function rimuoviPreferito($usr,$idSpot){
        $query = "DELETE FROM PREFERITI WHERE usernameUtente=? AND idSpot=? ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $usr, $idSpot);
        
        return $stmt->execute();
    }

    public function getUserFavorites($username, $orderBy) {
    
        $query = "SELECT S.*, C.nome AS nomeCategoria, U.nome, U.cognome 
                FROM SPOT S
                JOIN PREFERITI P ON S.idSpot = P.idSpot
                JOIN CATEGORIE C ON S.idCategoria = C.idCategoria
                JOIN UTENTI U ON S.usernameUtente = U.username
                WHERE P.usernameUtente = ? AND S.stato = 'approvato'
                ORDER BY $orderBy";
                
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertComment($usr,$idSpot,$commento,$idPadre){
        $query = "INSERT INTO COMMENTI(testo,dataPubblicazione,idSpot,usernameUtente,idCommentoRisposto)
                    values (?,NOW(),?,?,?)";
              
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sisi", $commento,$idSpot,$usr,$idPadre);
        

        return $stmt->execute();
    }

    public function getCommentById($idCommento) {
        $query = "SELECT usernameUtente, testo FROM COMMENTI WHERE idCommento = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idCommento);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
    }


    public function getPendingSpots() {
        $query = "SELECT S.*, C.nome AS nomeCategoria, U.nome AS nomeAutore, U.cognome AS cognomeAutore 
                FROM SPOT S
                JOIN CATEGORIE C ON S.idCategoria = C.idCategoria
                JOIN UTENTI U ON S.usernameUtente = U.username
                WHERE S.stato = 'in_attesa'
                ORDER BY S.dataInserimento ASC";
        $res = $this->db->query($query);
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function updateSpotStatus($idSpot, $nuovoStato, $adminUsername) {
        $query = "UPDATE SPOT SET stato = ?, usernameAdminApprovato = ?, dataApprovazione = NOW() WHERE idSpot = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssi', $nuovoStato, $adminUsername, $idSpot);
        return $stmt->execute();
    }

    public function getUserInfo($username) {
        $stmt = $this->db->prepare("SELECT nome, cognome, username, idTipo FROM UTENTI WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function getSpotsByUsername($username) {
        $query = "SELECT S.*, C.nome AS nomeCategoria 
                  FROM SPOT S 
                  JOIN CATEGORIE C ON S.idCategoria = C.idCategoria 
                  WHERE S.usernameUtente = ? 
                  ORDER BY S.dataInserimento DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function isSpotActive($idSpot){
        $query = "SELECT idSpot FROM SPOT WHERE idSpot = ? AND stato = 'approvato'";
    
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idSpot);
        $stmt->execute();
        
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function checkCommentBelongsToSpot($idCommento, $idSpot) {
    
        $query = "SELECT idCommento FROM COMMENTI WHERE idCommento = ? AND idSpot = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $idCommento, $idSpot); 
        $stmt->execute();
        
        $stmt->store_result(); 
        
        return $stmt->num_rows > 0;
    }

    public function getSubcategoriesByCategory($idCategoria) {
        $stmt = $this->db->prepare("SELECT idSottoCategoria, nome FROM SOTTOCATEGORIE WHERE idCategoria = ? ORDER BY nome ASC");
        $stmt->bind_param('i', $idCategoria);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }


    public function insertNotification($username, $testo, $link) {
        $stmt = $this->db->prepare("INSERT INTO NOTIFICHE (usernameDestinatario, testo, link) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $username, $testo, $link);
        return $stmt->execute();
    }
    
    public function getUnreadNotificationsCount($username) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as totale FROM NOTIFICHE WHERE usernameDestinatario = ? AND letta = FALSE");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['totale'];
    }
    
    public function getUserNotifications($username) {
        $stmt = $this->db->prepare("SELECT * FROM NOTIFICHE WHERE usernameDestinatario = ? ORDER BY dataNotifica DESC LIMIT 20");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function markNotificationsAsRead($username) {
        $stmt = $this->db->prepare("UPDATE NOTIFICHE SET letta = TRUE WHERE usernameDestinatario = ?");
        $stmt->bind_param('s', $username);
        return $stmt->execute();
    }
}

?>