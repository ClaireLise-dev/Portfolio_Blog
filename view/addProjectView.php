<?php ob_start(); ?>

<main class="container py-5 text-light">
  <h1 class="mb-4 text-center text-info">Ajouter un projet</h1>

  <?php if (isset($errorMessage)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($errorMessage) ?></div>
  <?php elseif (isset($successMessage)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div>
  <?php endif; ?>

  <form action="?page=submit-project" method="POST" enctype="multipart/form-data" id="project-form">
    <div class="mb-3">
      <label for="type" class="form-label">Type de projet</label>
      <select class="form-select bg-secondary text-white" id="type" name="type" required>
        <option value="">-- Sélectionner --</option>
        <option value="projects">Projet Web</option>
        <option value="wordpress">Projet WordPress</option>
        <option value="articles">Article</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="title" class="form-label">Titre</label>
      <input type="text" class="form-control bg-secondary text-white border-0 " id="title" name="title" required>
    </div>

    <div class="mb-3">
      <label for="subtitle" class="form-label">Sous-titre</label>
      <input type="text" class="form-control bg-secondary text-white border-0" id="subtitle" name="subtitle">
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Image</label>
      <input type="file" class="form-control bg-secondary text-white border-0" id="image" name="image" accept="image/*">
    </div>

    <div id="common-description" class="mb-3 d-none">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control bg-secondary text-white border-0" id="description" name="description" rows="4"></textarea>
    </div>

    <div id="features-group" class="mb-3 d-none">
      <label for="features" class="form-label">Fonctionnalités (une par ligne)</label>
      <textarea class="form-control bg-secondary text-white border-0" id="features" name="features" rows="4"></textarea>
    </div>

    <div id="technologies-group" class="mb-3 d-none">
      <label for="technologies" class="form-label">Technologies (séparées par virgules)</label>
      <input type="text" class="form-control bg-secondary text-white border-0" id="technologies" name="technologies">
    </div>

    <div id="site-link-group" class="mb-3 d-none">
      <label for="site_link" class="form-label">Lien vers le site</label>
      <input type="url" class="form-control bg-secondary text-white border-0" id="site_link" name="site_link">
    </div>

    <div id="github-link-group" class="mb-3 d-none">
      <label for="github_link" class="form-label">Lien GitHub</label>
      <input type="url" class="form-control bg-secondary text-white border-0" id="github_link" name="github_link">
    </div>

    <div id="role-group" class="mb-3 d-none">
      <label for="role" class="form-label">Rôle</label>
      <textarea class="form-control bg-secondary text-white border-0" id="role" name="role" rows="3"></textarea>
    </div>

    <div id="content-group" class="mb-3 d-none">
      <label for="content" class="form-label">Contenu de l'article</label>
      <textarea class="form-control bg-secondary text-white border-0" id="content" name="content" rows="6"></textarea>
    </div>

    <button type="submit" class="btn btn-outline-secondary w-100">Ajouter</button>
  </form>
</main>
<?php $content = ob_get_clean(); require('base.php'); ?>