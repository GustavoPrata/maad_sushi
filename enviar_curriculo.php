<?php
// Configuração da conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maad_sushi";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $conn->real_escape_string($_POST['nome']);
    $area = $conn->real_escape_string($_POST['area']);
    $telefone = $conn->real_escape_string($_POST['telefone']);
    $email = $conn->real_escape_string($_POST['email']);
    
    // Verifica se o arquivo foi enviado
    if (isset($_FILES['curriculo']) && $_FILES['curriculo']['error'] == 0) {
        $curriculo_nome = $conn->real_escape_string($_FILES['curriculo']['name']);
        $curriculo_tmp = $_FILES['curriculo']['tmp_name'];
        $upload_dir = 'uploads/';
        
        // Move o arquivo para o diretório de upload
        if (move_uploaded_file($curriculo_tmp, $upload_dir . $curriculo_nome)) {
            // Prepara a query SQL para inserir os dados no banco de dados
            $sql = "INSERT INTO candidaturas (nome, email, area, telefone, curriculo) 
                    VALUES ('$nome', '$email', '$area', '$telefone', '$curriculo_nome')";
            
            // Executa a query e verifica se foi bem-sucedida
            if ($conn->query($sql) === TRUE) {
                echo "Candidatura enviada com sucesso!";
            } else {
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Erro ao fazer upload do currículo.";
        }
    } else {
        echo "Por favor, envie um currículo.";
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>