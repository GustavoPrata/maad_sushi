<?php
session_start();

// If the user is already logged in, redirect to the dashboard
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: admin.php');
    exit;
}

// Initialize the error message
$error = '';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    // Simple username and password verification
    if ($username === 'adriano' && ($password === '123' || $password === '1')) {
        $_SESSION['loggedin'] = true;

        // Set a cookie if "Remember Me" is checked
        if ($remember) {
            setcookie('username', $username, time() + (86400 * 30), "/"); // 86400 = 1 day
        } else {
            // Clear the cookie if "Remember Me" is not checked
            setcookie('username', '', time() - 3600, "/");
        }

        header('Location: admin.php');
        exit;
    } else {
        $error = 'Usuário ou senha incorretos.';
    }
}

// Retrieve the cookie value if it exists
$stored_username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
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

                        <!-- <li class="nav__item">
                            <a href="logout.php" class="nav__link">Sair</a>
                        </li> -->
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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />
</head>
<body>
    <br>
    <br>
    <br>
    <div class="login-container">
        <h2>Area | Login</h2><br>
        <?php if ($error): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="" method="post" class="login-form">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" placeholder="Digite seu usuario" value="<?php echo htmlspecialchars($stored_username); ?>" required>
            <label for="password">Senha:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
                <span class="toggle-password" onclick="togglePassword()">👁️‍🗨️</span>
            </div>
            <label>
                <input type="checkbox" name="remember" <?php if($stored_username) echo 'checked'; ?>> Lembrar-me
            </label>
            <button type="submit">Entrar</button>
        </form>
    </div>
    <br>


        <!--=============== SCROLLREVEAL ===============-->
        <script src="assets/js/scrollreveal.min.js"></script>

        <!--=============== MAIN JS ===============-->
        <script src="assets/js/main.js"></script>
    <script>
        const nav = document.querySelector('#header nav')
        const toggle = document.querySelectorAll('nav .toggle')

        for (const element of toggle) {
            element.addEventListener('click', function () {
                nav.classList.toggle('show')
            })
        }
        function togglePassword() {
        const passwordField = document.getElementById('password');
        const passwordToggle = document.querySelector('.toggle-password');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordToggle.textContent = '👁️';
        } else {
            passwordField.type = 'password';
            passwordToggle.textContent = '👁️‍🗨️';
        }
    }
    </script>
</body>
</html>