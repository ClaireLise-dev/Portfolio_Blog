<?php ob_start(); ?>

<section class="d-flex justify-content-center min-vh-100 align-items-center bg-black text-light">
  <div class="card p-4 shadow-lg bg-black w-100" style="max-width: 500px;">
    <h2 class="card-title text-center mb-4 text-primary">Connexion</h2>

    <?php if (isset($successMessage)): ?>
      <div class="alert alert-success"><?= $successMessage ?></div>
    <?php elseif (isset($errorMessage)): ?>
      <div class="alert alert-danger"><?= $errorMessage ?></div>
    <?php endif; ?>

    <form action="?page=login" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label text-white">Email</label>
        <input type="email" class="form-control bg-secondary text-white border-0" id="email" name="email" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label text-white">Mot de passe</label>
        <input type="password" class="form-control bg-secondary text-white border-0" id="password" name="password" required>
      </div>

      <button type="submit" class="btn btn-outline-primary rounded-pill w-100">Se connecter</button>
    </form>
  </div>
</section>

<?php
$content = ob_get_clean();
require('./base.php');
?>