<?php
function isActive($pagename)
{
    if (basename($_SERVER['PHP_SELF']) == $pagename) {
        echo " class='active' ";
    }
}

function isUserLoggedIn()
{
    return isset($_SESSION["username"]) && isset($_SESSION["logged"]) && isset($_SESSION["admin"]) && $_SESSION["logged"] && !$_SESSION["admin"];
}

function isAdminLoggedIn()
{
    return isset($_SESSION["username"]) && isset($_SESSION["logged"]) && isset($_SESSION["admin"]) && $_SESSION["logged"] && $_SESSION["admin"];
}

function registerLoggedUser($user)
{
    $_SESSION["username"] = $user["username"];
    $_SESSION["admin"] = ($user["idTipo"] == 1); // 1 = Admin, 0 = Utente
    $_SESSION["logged"] = 1;
}   

function setMsg($messaggio, $tipo = "success") {
    $_SESSION["feedback_msg"] = [
        "messaggio" => $messaggio,
        "tipo" => $tipo
    ];
}

function getMsg() {
    if (isset($_SESSION["feedback_msg"])) {
        $msg = $_SESSION["feedback_msg"];
        unset($_SESSION["feedback_msg"]); 
        return $msg;
    }
    return null;
}

?>