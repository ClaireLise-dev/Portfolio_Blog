// Fonction de chargement dynamique des projets selon leur type
function loadProjects(type) {
  // Appelle le fichier PHP partiel en Ajax avec le type choisi (projects, wordpress, articles)
  fetch("view/partials/projectsList.php?type=" + type)
    .then((res) => res.text()) // Récupère la réponse en HTML
    .then((html) => {
      // Injecte le contenu dans le conteneur de projets
      document.getElementById("projectsContent").innerHTML = html;
    })
    .catch((error) => console.error("Erreur chargement projets :", error));
}

// Gestion des boutons de filtre (web, WordPress, articles)
document.querySelectorAll(".filterBtn").forEach((button) => {
  button.addEventListener("click", () => {
    // Supprime la classe active sur tous les boutons
    document
      .querySelectorAll(".filterBtn")
      .forEach((b) => b.classList.remove("active"));

    // Ajoute la classe active au bouton cliqué
    button.classList.add("active");

    // Charge les projets du type associé au bouton
    const type = button.dataset.type;
    loadProjects(type);
  });
});

// Disparition automatique de l’alerte (message succès / erreur)
const alertBox = document.getElementById("alert-message");
if (alertBox) {
  setTimeout(() => {
    alertBox.style.transition = "opacity 0.5s ease-in-out";
    alertBox.style.opacity = "0";

    setTimeout(() => {
      if (alertBox.parentNode) {
        alertBox.parentNode.removeChild(alertBox);
      }
    }, 500); // Supprime l’élément du DOM après disparition
  }, 5000); // L’alerte disparaît après 5 secondes
}

// Affichage conditionnel des champs du formulaire d’ajout/modification de projet
const typeSelect = document.getElementById("type");
if (typeSelect) {
  // Regroupe les champs à afficher selon le type sélectionné
  const groups = {
    projects: [
      "common-description",
      "features-group",
      "technologies-group",
      "site-link-group",
      "github-link-group",
    ],
    wordpress: [
      "common-description",
      "features-group",
      "role-group",
      "site-link-group",
    ],
    articles: ["content-group"],
  };

  // Au changement de type, masque tous les champs
  typeSelect.addEventListener("change", () => {
    document
      .querySelectorAll(".mb-3")
      .forEach((div) => div.classList.add("d-none"));

    // puis réaffiche les champs communs
    document.getElementById("title").parentElement.classList.remove("d-none");
    document
      .getElementById("subtitle")
      .parentElement.classList.remove("d-none");
    document.getElementById("type").parentElement.classList.remove("d-none");
    document.getElementById("image").parentElement.classList.remove("d-none");

    // Affiche les champs spécifiques au type sélectionné
    const selected = typeSelect.value;
    if (groups[selected]) {
      groups[selected].forEach((id) =>
        document.getElementById(id).classList.remove("d-none")
      );
    }
  });
}
