<?php ob_start(); ?>

<section class="d-flex justify-content-center min-vh-100 align-items-center bg-black text-light">
  <div class="card p-4 shadow-lg bg-black w-100" style="max-width: 500px;">
    <h2 class="card-title text-center mb-4 text-primary">Contactez-moi</h2> 

    <?php if (isset($successMessage)): ?>
      <div id="alert-message" class="alert alert-success"><?= $successMessage ?></div>
    <?php elseif (isset($errorMessage)): ?>
      <div id="alert-message" class="alert alert-danger"><?= $errorMessage ?></div>
    <?php endif; ?>

    <form action="?page=contact" method="POST">
      <div class="mb-3">
        <label for="name" class="form-label text-info">Nom</label>
        <input type="text" class="form-control bg-secondary text-white border-0" id="name" name="name" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label text-info">Email</label>
        <input type="email" class="form-control bg-secondary text-white border-0"  id="email" name="email" required>
      </div>

      <div class="mb-3">
        <label for="message" class="form-label text-info">Message</label>
        <textarea class="form-control bg-secondary text-white border-0"  id="message" name="message" rows="4" required></textarea>
      </div>

      <button type="submit" class="btn btn-outline-primary rounded-pill w-100">Envoyer</button>
    </form>
  </div>
    </section>

<?php
$content = ob_get_clean();
require('./base.php');
?>
