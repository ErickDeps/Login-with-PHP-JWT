<?php require_once './views/Site/site.header.php'; ?>
<h2 class="wecolme__title">Bienvenido a mi sitio web</h2>
<a href="<?= URL_BASE; ?>?controller=auth/login&action=login" class="btn btn-primary logout__link mt-3">
    Iniciar Sesión
</a>

<?php require_once './views/Site/site.footer.php'; ?>