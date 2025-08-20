<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Usuário cadastrado com sucesso! <a href='listar.php'>Ver usuários</a>";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<h2>Cadastro de Usuário</h2>
<form method="post">
    Nome: <input type="text" name="nome" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    <input type="submit" value="Cadastrar">
</form>
