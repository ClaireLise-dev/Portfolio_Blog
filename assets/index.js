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
