<?php
// Inicia código PHP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Cria a conexão com o banco de dados usando a classe mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Função para adicionar dados
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    // Prepara e executa a consulta para prevenir SQL Injection
    $stmt = $conn->prepare("INSERT INTO contacts (nome, email, mensagem) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $mensagem);

    if ($stmt->execute()) {
        echo "Novo registro criado com sucesso<br>";
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
}

// Função para ler dados
if (isset($_POST['action']) && $_POST['action'] == 'read') {
    $sql = "SELECT id_contacts, nome, email, mensagem FROM contacts";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output de dados em cada linha
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id_contacts"] . " - Nome: " . $row["nome"] . " - Email: " . $row["email"] . " - Mensagem: " . $row["mensagem"] . "<br>";
        }
    } else {
        echo "0 resultados";
    }
}

// Função para atualizar dados
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id_contacts = $_POST['id_contacts'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    // Prepara e executa a consulta para prevenir SQL Injection
    $stmt = $conn->prepare("UPDATE contacts SET nome = ?, email = ?, mensagem = ? WHERE id_contacts = ?");
    $stmt->bind_param("sssi", $nome, $email, $mensagem, $id_contacts);

    if ($stmt->execute()) {
        echo "Registro atualizado com sucesso<br>";
    } else {
        echo "Erro ao atualizar registro: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<h2>Formulário para Adicionar Usuário</h2>
<form method="post">
  <input type="hidden" name="action" value="create">
  Nome: <input type="text" name="nome"><br>
  Email: <input type="text" name="email"><br>
  Mensagem: <input type="text" name="mensagem"><br>
  <input type="submit" value="Adicionar">
</form>

<h2>Formulário para Ler Usuários</h2>
<form method="post">
  <input type="hidden" name="action" value="read">
  <input type="submit" value="Ler">
</form>

<h2>Formulário para Atualizar Usuário</h2>
<form method="post">
  <input type="hidden" name="action" value="update">
  ID: <input type="text" name="id_contacts"><br>
  Nome: <input type="text" name="nome"><br>
  Email: <input type="text" name="email"><br>
  Mensagem: <input type="text" name="mensagem"><br>
  <input type="submit" value="Atualizar">
</form>
