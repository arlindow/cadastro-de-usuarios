# cadastro-de-usuarios
PHP 8+_ MySQL_ phpMyAdmin_HTML5_XAMPP

# 📘 Documentação do Mini Projeto – Cadastro de Usuários (PHP + MySQL + XAMPP)

## 📌 Objetivo

Criar uma aplicação simples em **PHP** com **MySQL**, utilizando o **XAMPP**, para realizar o cadastro de usuários e listar os registros em uma tabela.

---

## 🛠️ Tecnologias utilizadas

* **PHP 8+** (fornecido pelo XAMPP)
* **MySQL** (banco de dados relacional)
* **phpMyAdmin** (interface web para o MySQL)
* **HTML5** (estrutura do formulário)
* **XAMPP** (servidor local com Apache + MySQL + PHP)

---

## 📂 Estrutura de Pastas

Dentro da pasta `htdocs` do XAMPP (`C:\xampp\htdocs`), foi criada a pasta `meu_site` com os seguintes arquivos:

```
meu_site/
│
├── conexao.php   # Arquivo de conexão com o banco de dados
├── index.php     # Formulário de cadastro
└── listar.php    # Listagem dos usuários cadastrados
```

---

## ⚙️ Configuração do Banco de Dados

1. Abra o navegador e vá para:

   ```
   http://localhost/phpmyadmin
   ```
2. Crie o banco de dados chamado:

   ```
   meubanco
   ```
3. Execute o seguinte script SQL para criar a tabela `usuarios`:

   ```sql
   CREATE TABLE usuarios (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nome VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL
   );
   ```

---

## 📑 Arquivos do Projeto

### 🔹 `conexao.php`

Responsável por criar a conexão com o banco de dados.

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

### 🔹 `index.php`

Formulário para cadastrar usuários e inserir os dados no banco.

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

### 🔹 `listar.php`

Página que mostra todos os usuários cadastrados em forma de tabela.

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

## ▶️ Como Executar o Projeto

1. Abra o **XAMPP Control Panel** e inicie:

   * **Apache**
   * **MySQL**
2. Copie a pasta `meu_site` para dentro de:

   ```
   C:\xampp\htdocs\
   ```
3. No navegador, acesse:

   ```
   http://localhost/meu_site
   ```
4. Preencha o formulário para cadastrar um usuário.
5. Clique em **Ver usuários** para listar todos cadastrados.

---

## 📌 Melhorias Futuras

* Adicionar **validação de dados** no formulário.
* Implementar **edição e exclusão de usuários**.
* Usar **Bootstrap** para melhorar o design.
* Utilizar **PDO ou MySQLi com Prepared Statements** para maior segurança (evitar SQL Injection).

---



