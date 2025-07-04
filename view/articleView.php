<?php ob_start(); ?>

<main class="container py-5">
  <h1 class="display-5 fw-light text-primary text-center mb-3">
    <?= htmlspecialchars($project['title']) ?>
  </h1>

  <?php if (!empty($project['subtitle'])): ?>
    <p class="lead text-center text-white mb-4">
      <?= htmlspecialchars($project['subtitle']) ?>
    </p>
  <?php endif; ?>

  <?php if (!empty($project['image'])): ?>
    <div class="text-center mb-5">
      <img src="public/img/<?= htmlspecialchars($project['image']) ?>" alt="Image du projet" class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: cover;">
    </div>
  <?php endif; ?>

  <section class="mb-5">
    <p><?= nl2br(htmlspecialchars($project['content'])) ?></p>
  </section>


</main>

<?php $content = ob_get_clean(); ?>
<?php require 'base.php'; ?>