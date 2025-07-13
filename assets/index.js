function loadProjects(type) {
  fetch("view/partials/projectsList.php?type=" + type)
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("projectsContent").innerHTML = html;
    })
    .catch((error) => console.error("Erreur chargement projets :", error));
}

document.querySelectorAll(".filterBtn").forEach((button) => {
  button.addEventListener("click", () => {
    document
      .querySelectorAll(".filterBtn")
      .forEach((b) => b.classList.remove("active"));

    button.classList.add("active");

    const type = button.dataset.type;
    loadProjects(type);
  });
});

const alertBox = document.getElementById("alert-message");
if (alertBox) {
  setTimeout(() => {
    alertBox.style.transition = "opacity 0.5s ease-in-out";
    alertBox.style.opacity = "0";

    setTimeout(() => {
      if (alertBox.parentNode) {
        alertBox.parentNode.removeChild(alertBox);
      }
    }, 500);
  }, 5000);
}

const typeSelect = document.getElementById("type");
if (typeSelect) {
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

  typeSelect.addEventListener("change", () => {
    document
      .querySelectorAll(".mb-3")
      .forEach((div) => div.classList.add("d-none"));
    document.getElementById("title").parentElement.classList.remove("d-none");
    document
      .getElementById("subtitle")
      .parentElement.classList.remove("d-none");
    document.getElementById("type").parentElement.classList.remove("d-none");
    document.getElementById("image").parentElement.classList.remove("d-none");

    const selected = typeSelect.value;
    if (groups[selected]) {
      groups[selected].forEach((id) =>
        document.getElementById(id).classList.remove("d-none")
      );
    }
  });
}
