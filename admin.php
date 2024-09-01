<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
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

// Query para selecionar todos os currículos
$sql = "SELECT nome, email, telefone, area, curriculo, data_envio FROM candidaturas";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=============== FAVICON ===============-->
        <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

        <!--=============== REMIXICONS ===============-->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="assets/css/styles.css">

        <title>MAAD SUSHI</title>
    </head>
    <body>
        <!--==================== HEADER ====================-->
        <header class="header" id="header">
            <nav class="nav container">
                <a href="" class="nav__logo">
                    <img src="assets/img/logo12.png" alt="logo image">
                    
                </a>
                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="index.html" class="nav__link">Principal</a>
                        </li>

                        <li class="nav__item">
                            <a href="logout.php" class="nav__link">Sair</a>
                        </li>
                    </ul>

                    <!-- Close Button -->
                    <div class="nav__close" id="nav-close">
                        <i class="ri-close-line"></i>
                    </div>

                    <img src="assets/img/leaf-branch-4.png" alt="nav image" class="nav__img-1">
                    <img src="assets/img/leaf-branch-3.png" alt="nav image" class="nav__img-2">

                </div>

                <div class="nav__buttons">
                    <!-- Theme Change Button -->
                    <i class="ri-moon-line change-theme" id="theme-button"></i>

                    <!-- Toggle button -->
                    <div class="nav__toggle" id="nav-toggle">
                        <i class="ri-apps-2-line"></i>
                    </div>
                </div>
            </nav>
        </header>
<body>
    <div class="curriculos-container">
        <h1>Currículos Enviados</h1>
        <?php if ($result->num_rows > 0): ?>
            <table class="curriculos-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Área</th>
                        <th>Data</th>
                        <th>Currículo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nome']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['telefone']); ?></td>
                            <td><?php echo htmlspecialchars($row['area']); ?></td>
                            <td><?php echo htmlspecialchars($row['data_envio']); ?></td>
                            <td><a href="uploads/<?php echo htmlspecialchars($row['curriculo']); ?>" target="_blank">Ver Currículo</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum currículo encontrado.</p>
        <?php endif; ?>

        <?php
        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>
    </div>
</body>
<footer class="footer">
            <div class="footer__container container grid">
    

                    <div>

                        </ul>
                    </div>
                </div>

                <img src="assets/img/spring-onion.png" alt="footer image" class="footer__onion">
                <img src="assets/img/spring-onion.png" alt="footer image" class="footer__onion-1">
                <img src="assets/img/spinach-leaf.png" alt="footer image" class="footer__spinach">
                <img src="assets/img/spinach-leaf.png" alt="footer image" class="footer__spinach-1">
                <img src="assets/img/leaf-branch-4.png" alt="footer image" class="footer__leaf">

            </div>

            <div class="footer__info container">
                <div class="footer__card">
                    <!-- <img src="assets/img/footer-card-1.png" alt="footer image">
                    <img src="assets/img/footer-card-2.png" alt="footer image"> -->
                    <!-- <img src="assets/img/footer-card-3.png" alt="footer image">
                    <img src="assets/img/footer-card-4.png" alt="footer image"> -->
                </div>

                <span class="footer__copy">
                    &#169; Direitos Autorais de MAAD SUSHI. Todos os direitos reservados
                </span>
            </div>
        </footer>

        <!--========== SCROLL UP ==========-->
        <a href="#" class="scrollup" id="scroll-up">
           <i class="ri-arrow-up-line"></i>
        </a>

        <!--=============== SCROLLREVEAL ===============-->
        <script src="assets/js/scrollreveal.min.js"></script>

        <!--=============== MAIN JS ===============-->
        <script src="assets/js/main.js"></script>
</html>
