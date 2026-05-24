document.addEventListener("DOMContentLoaded", function () {
  // Écouter le clic sur tous les boutons favoris
  document.body.addEventListener("click", function (e) {
    // On cherche si on a cliqué sur le bouton favori (coeur)
    const btn = e.target.closest(".favorite-toggle-btn");

    if (btn) {
      e.preventDefault();
      const bookId = btn.getAttribute("data-book-id");
      const isPageFavoris = btn.getAttribute("data-page-favoris") === "true";

      // Création de la requête AJAX (Fetch)
      const formData = new FormData();
      formData.append("book_id", bookId);

      // Ajuste le chemin vers ton fichier PHP si nécessaire
      fetch("ajax/toggle_favorite.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "added") {
            // On remplit le coeur visuellement
            btn.classList.add("active");
            const icon = btn.querySelector("i");
            if (icon) {
              icon.className = "bi bi-heart-fill";
            }
          } else if (data.status === "removed") {
            // On vide le coeur visuellement
            btn.classList.remove("active");
            const icon = btn.querySelector("i");
            if (icon) {
              icon.className = "bi bi-heart";
            }

            // Si on est STRICTEMENT sur la page favoris, on fait disparaître la carte du livre instantanément !
            if (isPageFavoris) {
              const card =
                btn.closest(".favorite-card") || btn.closest(".book-card");
              if (card) {
                card.style.transition = "all 0.4s ease";
                card.style.opacity = "0";
                card.style.transform = "scale(0.8)";
                setTimeout(() => {
                  card.remove();
                  // Optionnel : Recharger les stats ou rafraîchir si la liste est vide
                  location.reload();
                }, 400);
              }
            }
          }
        })
        .catch((error) => console.error("Erreur favoris:", error));
    }
  });
});
