<?php
include("../../../env.php");

$con = new mysqli($DB_HOSTNAME,$DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

function buscarEmail($email, $con) {
  $query = "SELECT COUNT(*) as count FROM usuario WHERE email = ?";

  $stmt = $con->prepare($query);

  if ($stmt === false) {
      return false;
  }

  $stmt->bind_param("s", $email);

  if ($stmt->execute()) {
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();

      if ($row["count"] > 0) {
          return true; 
      }
  }

  return false; 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT) ;
  if(!buscarEmail($email,$con)){
    $stmt = $con->prepare("INSERT INTO usuario (email, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    header("Location: ../../../index.php?http=201");
  }else{

    header("Location: ../../../index.php?http=409");
  }
  

    


}



