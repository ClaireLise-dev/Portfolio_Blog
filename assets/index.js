function loadProjects(type) {
  fetch("view/partials/projectsList.php?type=" + type)
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("projectsContent").innerHTML = html;
    })
    .catch((error) => console.error("Erreur chargement projets :", error));
}

// document.addEventListener("DOMContentLoaded", function () {
//   const navbar = document.querySelector(".navbar");
//   if (window.scrollY > 10) {
//     navbar.classList.add("transparent");
//   } else {
//     navbar.classList.remove("transparent");
//   }
// });

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
