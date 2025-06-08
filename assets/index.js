function loadProjects(type) {
  fetch("view/partials/projectsList.php?type=" + type)
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("projectsContent").innerHTML = html;
    })
    .catch((error) => console.error("Erreur chargement projets :", error));
}

document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 10) {
    navbar.classList.add("transparent");
  } else {
    navbar.classList.remove("transparent");
  }
});

document.addEventListener("DOMContentLoaded", () => {
  document
    .querySelector("#btnWeb")
    .addEventListener("click", () => loadProjects("projects"));
  document
    .querySelector("#btnWp")
    .addEventListener("click", () => loadProjects("wordpress"));
  document
    .querySelector("#btnArticles")
    .addEventListener("click", () => loadProjects("articles"));
});
