<?php require_once 'auth.header.php'; ?>

<main class="form-signin w-100 m-auto">
    <form action="<?= URL_BASE ?>?controller=auth/login&action=login" method="POST">
        <!-- <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
        <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>
        <div class="form-floating">
            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
            <label for="floatingInput">Correo</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Contraseña</label>
        </div>
        <?php if (isset($error)) : ?>
            <div class="text-danger my-3 px-1"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>
        <a href="<?= URL_BASE ?>?controller=auth/register&action=register" class="mt-2">Crear una cuenta</a>
        <br>
        <a href="<?= URL_BASE ?>?controller=site/home&action=home" class="mt-2">Volver al inicio</a>
        <p class="mt-5 mb-3 text-body-secondary">© ErickDeps - 2025 </p>
    </form>
</main>

<?php require_once 'auth.footer.php'; ?>