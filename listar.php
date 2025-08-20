<?php
include 'conexao.php';

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>

<h2>Usuários cadastrados</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
    </tr>

<?php
if ($result->num_rows > 0) {
    while ($linha = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $linha["id"] . "</td>
                <td>" . $linha["nome"] . "</td>
                <td>" . $linha["email"] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>Nenhum usuário cadastrado</td></tr>";
}
?>
</table>
<a href="index.php">Voltar ao cadastro</a>
