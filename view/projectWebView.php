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
      <img src="<?= htmlspecialchars($project['image']) ?>" alt="Image du projet" class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: cover;">
    </div>
  <?php endif; ?>

  <section class="mb-5">
    <h2 class="h5 text-primary">📄 Description</h2>
    <p><?= nl2br(htmlspecialchars($project['description'])) ?></p>
  </section>

  <?php if (!empty($project['features'])): ?>
    <section class="mb-5">
      <h2 class="h5 text-primary">✨ Fonctionnalités</h2>
      <ul>
        <?php foreach (explode("\n", $project['features']) as $feature): ?>
          <li><?= htmlspecialchars(trim($feature)) ?></li>
        <?php endforeach; ?>
      </ul>
    </section>
  <?php endif; ?>

  <?php if (!empty($project['technologies'])): ?>
    <section class="mb-5">
      <h2 class="h5 text-primary">🛠️ Technologies</h2>
      <?php foreach (preg_split('/\s*,\s*/', $project['technologies']) as $tech): ?>
        <span class="badge bg-secondary text-dark me-2 mb-2">
          <?= htmlspecialchars(trim($tech)) ?>
        </span>
      <?php endforeach; ?>
    </section>
  <?php endif; ?>

  <div class="d-flex flex-wrap gap-3 mt-4">
    <?php if (!empty($project['site_link'])): ?>
      <a href="<?= htmlspecialchars($project['site_link']) ?>" target="_blank" class="btn btn-outline-secondary">
        <i class="bi bi-box-arrow-up-right me-2"></i> Voir le site
      </a>
    <?php endif; ?>

    <?php if (!empty($project['github_link'])): ?>
      <a href="<?= htmlspecialchars($project['github_link']) ?>" target="_blank" class="btn btn-outline-secondary">
        <i class="bi bi-github me-2"></i> Voir le code
      </a>
    <?php endif; ?>
  </div>
</main>

<?php $content = ob_get_clean(); ?>
<?php require 'base.php'; ?>


