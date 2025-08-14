<?php require_once './views/Dashboard/dashboard.header.php'; ?>
<h2 class="wecolme__title">Bienvenido <?= htmlspecialchars($user_name) ?>!</h2>
<a href="<?= URL_BASE; ?>?controller=dashboard/dashboard&action=logout" class="btn btn-primary logout__link mt-3">
    Cerrar sesión
</a>

<?php require_once './views/Dashboard/dashboard.footer.php'; ?>