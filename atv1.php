<?php //Inicia codigo php 
$servername = "localhost";//nome do servidor aonde o banco está localizado
$username = "root";// nome do usuário que será usado para conectar no banco
$password = "";// senha para o usuário do banco
$dbname = "users";// nome do banco que acessaremos


$conn = new mysqli($servername, $username, $password, $dbname);// Cria a conexão com o banco de dados usando a classe mysqli


if ($conn->connect_error) {// Verifica se houve algum erro na conexão
    die("Conexão falhou: " . $conn->connect_error); // Se houver um erro na conexão, interrompe a execução do script e exibe a mensagem de erro
}

// Função para ler dados
if (isset($_POST['action']) && $_POST['action'] == 'read') {
    $sql = "SELECT nome, endereco FROM userss";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output de dados em cada linha
        while($row = $result->fetch_assoc()) {
            echo "Nome: " . $row["nome"]. " - Endereço: " . $row["endereco"]. "<br>";
        }
    } else {
        echo "0 resultados";
    }
}

$conn->close();

?>

<h2>Formulário para Ler Usuários</h2>
<form method="post">
  <input type="hidden" name="action" value="read">
  <input type="submit" value="Ler">
</form>






