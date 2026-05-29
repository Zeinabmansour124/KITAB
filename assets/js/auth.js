(function () {
  const fileInput = document.getElementById("avatar");
  const previewImg = document.getElementById("previewImg");
  const previewWrap = previewImg?.closest(".auth__preview");

  if (fileInput && previewImg) {
    const uploadBox = fileInput.closest(".auth__uploadBox");
    if (uploadBox) {
      uploadBox.addEventListener("click", () => fileInput.click());
    }

    fileInput.addEventListener("change", function () {
      const file = this.files[0];
      if (!file || !file.type.startsWith("image/")) return;

      const reader = new FileReader();
      reader.onload = (e) => {
        previewImg.src = e.target.result;
        previewImg.alt = file.name;
        previewWrap?.classList.add("has-image");

        const label = uploadBox?.querySelector(".auth__uploadLabel span");
        if (label) label.textContent = file.name;
      };
      reader.readAsDataURL(file);
    });
  }

  (function upgradeUploadBox() {
    const box = document.querySelector(".auth__uploadBox");
    if (!box) return;

    const inp = box.querySelector('input[type="file"]');
    const prev = box.querySelector(".auth__preview");
    if (!inp || !prev) return;

    if (!box.querySelector(".auth__uploadLabel")) {
      const labelBlock = document.createElement("label");
      labelBlock.className = "auth__uploadLabel";
      labelBlock.htmlFor = inp.id;
      labelBlock.innerHTML = `
        <span>Choisir une photo</span>
        <small>JPG, PNG, WEBP · max 5 Mo</small>
      `;
      box.appendChild(labelBlock);
    }
  })();

  const slides = Array.from(document.querySelectorAll(".auth__slide"));
  if (slides.length === 0) return;

  let current = 0;
  let timer;

  const aside = document.querySelector(".auth__right");
  if (aside) {
    if (!aside.querySelector(".auth__badge")) {
      const badge = document.createElement("span");
      badge.className = "auth__badge";
      badge.textContent = "KITAB";
      aside.appendChild(badge);
    }

    if (!aside.querySelector(".auth__dots")) {
      const dotsWrap = document.createElement("div");
      dotsWrap.className = "auth__dots";

      slides.forEach((_, i) => {
        const dot = document.createElement("button");
        dot.className = "auth__dot" + (i === 0 ? " is-active" : "");
        dot.setAttribute("aria-label", `Slide ${i + 1}`);
        dot.addEventListener("click", () => goTo(i));
        dotsWrap.appendChild(dot);
      });

      aside.appendChild(dotsWrap);
    }
  }

  function getDots() {
    return Array.from(document.querySelectorAll(".auth__dot"));
  }

  function goTo(idx) {
    slides[current].classList.remove("is-active");
    getDots()[current]?.classList.remove("is-active");

    current = (idx + slides.length) % slides.length;

    slides[current].classList.add("is-active");
    getDots()[current]?.classList.add("is-active");
  }

  function startAuto() {
    clearInterval(timer);
    timer = setInterval(() => goTo(current + 1), 4500);
  }

  aside?.addEventListener("mouseenter", () => clearInterval(timer));
  aside?.addEventListener("mouseleave", startAuto);

  startAuto();
})();
