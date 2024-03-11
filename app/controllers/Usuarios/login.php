<?php
include("env.php");

$con = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

// Verificar a conexão
if ($con->connect_error) {
    die("Falha na conexão: " . $con->connect_error);
}



session_start();

if(isset($_SESSION['usuario_logado'])){
    header('Location:app/views/personagens/personagens.php');
}

function buscarCredenciais($email, $senha, $con)
{

    $query = "SELECT email,senha FROM usuario WHERE email = ? LIMIT 1";

    $stmt = $con->prepare($query);

    if ($stmt === false) {
        return false;
    }

    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            if (password_verify($senha, $row['senha'])) {
                return true;
            } else {
                false;
            }
        }
    }

    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    if (buscarCredenciais($email, $senha, $con)) {
        $_SESSION['usuario_logado'] = true;
        $_SESSION['last_activity'] = time();
        header("Location: app/views/personagens/personagens.php");

    } else {
        header("Location: index.php?http=404");
    }
}
