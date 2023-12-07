<!DOCTYPE html>
<html lang="es-419">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Página principal de la app Web que se redirige una vez que se logra iniciar sesión con éxito.">
        <meta name="author" content="Diego Bravo Pérez y Javier Lachica y Sánchez">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <link href="../../css/login.css" rel="stylesheet">
        <link rel="icon" href="https://png.pngtree.com/png-clipart/20221222/original/pngtree-flag-of-mexico-png-image_8797173.png" type="image/x-icon">
        <?php require "../codigos/login.php"?>
        <title>Página de iniciar sesión</title>
    </head>
    <body data-bs-theme="dark">
        <div class="box">
            <span class="lineaBorde"></span>
            <form method="post">
                <h2>Iniciar sesión</h2>

                <?php if($es_invalido): ?>
                    <em>Error al iniciar sesión</em>
                <?php endif; ?>

                <div class="inputBox">
                    <input type="text" required="required" name="dato1" value="<?= htmlspecialchars($_POST["dato1"] ?? "") ?>"> <!-- Mantiene este campo cuando se le da refresh a la página -->
                    <span>Usuario o correo</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <input type="password" required="required" name="contrasenia">
                    <span>Contraseña</span>
                    <i></i>
                </div>

                <div class="links">
                    <a class="nav-link disabled" aria-disabled="true" href="#">Olvidé mi contraseña :&#40;</a>
                    <a href="../../html/Paginas/registrarse.html">Registrarse</a>
                </div>
                
                <input type="submit" value="Ingresar">
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>