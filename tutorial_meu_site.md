# Tutorial: Criando o projeto `meu_site` no XAMPP

## 1. Instalar o XAMPP
1. Acesse [https://www.apachefriends.org/pt_br/index.html](https://www.apachefriends.org/pt_br/index.html)
2. Baixe a versão mais recente para o seu sistema operacional.
3. Instale deixando marcados **Apache**, **MySQL**, **PHP** e **phpMyAdmin**.
4. Ao final, abra o **XAMPP Control Panel**.

---

## 2. Iniciar o Servidor
1. No **XAMPP Control Panel**, clique em **Start** para:
   - Apache
   - MySQL
2. Quando ficarem verdes, significa que estão ativos.

---

## 3. Criar o Banco de Dados
1. No navegador, acesse: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Clique em **Novo** e crie um banco chamado `meubanco`.
3. Vá na aba **SQL** e execute:
   ```sql
   CREATE TABLE usuarios (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nome VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL
   );
   ```

---

## 4. Criar a Estrutura de Arquivos

No Windows, vá até `C:\xampp\htdocs` e crie a pasta `meu_site`:

```
C:\xampp\htdocs\meu_site
│
├── conexao.php
├── index.php
└── listar.php
```

---

## 5. Arquivo `conexao.php`
```php
<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "meubanco";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
```

---

## 6. Arquivo `index.php`
```php
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
```

---

## 7. Arquivo `listar.php`
```php
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
```

---

## 8. Testar no Navegador
1. Acesse [http://localhost/meu_site](http://localhost/meu_site)
2. Preencha o formulário e cadastre um usuário.
3. Clique em **Ver usuários** para listar todos cadastrados.

---


