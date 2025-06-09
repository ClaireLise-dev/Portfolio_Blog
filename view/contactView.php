<?php ob_start(); ?>

<main class="d-flex justify-content-center min-vh-100 align-items-center bg-black text-light">
  <div class="card p-4 shadow-lg bord bg-black w-100 er-0" style="max-width: 500px;">
    <h2 class="card-title text-center mb-4 text-secondary">Contactez-moi</h2> 

    <?php if (isset($successMessage)): ?>
      <div class="alert alert-success"><?= $successMessage ?></div>
    <?php elseif (isset($errorMessage)): ?>
      <div class="alert alert-danger"><?= $errorMessage ?></div>
    <?php endif; ?>

    <form action="?page=contact" method="POST">
      <div class="mb-3">
        <label for="name" class="form-label text-white"></label>
        <input type="text" class="form-control bg-secondary text-black border-0" placeholder="Nom" id="name" name="name" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label text-white"></label>
        <input type="email" class="form-control bg-secondary text-white border-0" placeholder="Email" id="email" name="email" required>
      </div>

      <div class="mb-3">
        <label for="message" class="form-label text-white"></label>
        <textarea class="form-control bg-secondary text-white border-0" placeholder="Message" id="message" name="message" rows="4" required></textarea>
      </div>

      <button type="submit" class="btn btn-outline-secondary rounded-pill w-100">Envoyer</button>
    </form>
  </div>
</main>

<?php
$content = ob_get_clean();
require('./base.php');
?>
