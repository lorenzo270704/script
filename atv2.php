<?php //Inicia codigo php 
$servername = "localhost";//nome do servidor aonde o banco está localizado
$username = "root";// nome do usuário que será usado para conectar no banco
$password = "";// senha para o usuário do banco
$dbname = "users";// nome do banco que acessaremos


$conn = new mysqli($servername, $username, $password, $dbname);// Cria a conexão com o banco de dados usando a classe mysqli


if ($conn->connect_error) {// Verifica se houve algum erro na conexão
    die("Conexão falhou: " . $conn->connect_error); // Se houver um erro na conexão, interrompe a execução do script e exibe a mensagem de erro
}

// Função para adicionar dados
if (isset($_POST['action']) && $_POST['action'] == 'create') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];
   

    

    $sql = "INSERT INTO contacts (nome, email, mensagem) VALUES ('$nome', '$email','$mensagem')";

    if ($conn->query($sql) === TRUE) {
        echo "Novo registro criado com sucesso<br>";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
<h2>Formulário para Adicionar Usuário</h2>
<form method="post">
  <input type="hidden" name="action" value="create">
  Nome: <input type="text" name="nome"><br>
  Email: <input type="text" name="email"><br>
  Mensagem: <input type="text" name="mensagem"><br>
  <input type="submit" value="Adicionar">
</form>