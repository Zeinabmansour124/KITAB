//c pour filtration
const selectCondition = document.getElementById("constionselect");
const allBooks = document.querySelectorAll(".book-card");
const genreselect = document.getElementById("genreselect");

function filtrerbooks() {
  const selected1 = selectCondition.value.toLowerCase();
  const selected2 = genreselect.value.toLowerCase();
  allBooks.forEach((book) => {
    let condition = book
      .querySelector(".conditionbook")
      .textContent.toLowerCase();
    condition = condition.replace("-", " ");
    let typeb = book.querySelector(".booktype").textContent.toLowerCase();
    if (
      (selected1 == "all condition" || condition == selected1) &&
      (selected2 == "all genres" || selected2 == typeb)
    ) {
      book.style.display = "";
    } else {
      book.style.display = "none";
    }
  });
}

selectCondition.addEventListener("change", filtrerbooks);
genreselect.addEventListener("change", filtrerbooks);

// c pour recherche

const searchnav = document.querySelector(".nav-search");
searchnav.addEventListener("keydown", (e) => {
  if (e.key == "Enter") {
    const userinput = searchnav.value.toLowerCase();
    console.log("ach kteb :", userinput);
    allBooks.forEach((book) => {
      let nombook = book.querySelector(".nombook").textContent.toLowerCase();
      if (nombook == userinput || userinput == "") {
        book.style.display = "";
      } else {
        book.style.display = "none";
      }
    });
  }
});

//pour filtre A-Z / price

const bookscontainer = document.querySelector(".cards-container");
let tabbooks = Array.from(allBooks);
const priceAZselct = document.getElementById("priceAZselct");
function updatebooksorder() {
  for (const element of tabbooks) {
    bookscontainer.appendChild(element);
  }
}

priceAZselct.addEventListener("click", () => {
  const optionn = priceAZselct.value;

  switch (optionn) {
    case "low to height":
      tabbooks.sort((a, b) => {
        const price1 = parseFloat(a.querySelector(".price").textContent);
        const price2 = parseFloat(b.querySelector(".price").textContent);
        return price1 - price2;
      });
      break;
    case "height to low":
      tabbooks.sort((a, b) => {
        const price1 = parseFloat(a.querySelector(".price").textContent);
        const price2 = parseFloat(b.querySelector(".price").textContent);
        return price2 - price1;
      });
      break;
    case "title : A-Z":
      tabbooks.sort((a, b) => {
        const nom1 = a
          .querySelector(".nombook")
          .textContent.toLocaleLowerCase();
        const nom2 = b
          .querySelector(".nombook")
          .textContent.toLocaleLowerCase();
        return nom1.localeCompare(nom2);
      });
      break;
    default:
  }
  updatebooksorder();
});

let current = 0;
const total = 3;
let timer;

function goTo(n, fromUser = true) {
  const slides = document.querySelectorAll(".slide");
  const dots = document.querySelectorAll(".dot-btn");
  slides[current].classList.remove("active");
  slides[current].classList.add("prev");
  setTimeout(() => slides[current].classList.remove("prev"), 5000);
  current = (n + total) % total;
  slides[current].classList.add("active");
  dots.forEach((d) => d.classList.remove("active"));
  dots[current].classList.add("active");
  document.getElementById("slideCounter").textContent =
    String(current + 1).padStart(2, "0") +
    " / " +
    String(total).padStart(2, "0");
  if (fromUser) {
    clearInterval(timer);
    startAuto();
  }
}

function next() {
  goTo(current + 1);
}
function prev() {
  goTo(current - 1);
}

function startAuto() {
  timer = setInterval(() => goTo(current + 1, false), 5000);
}
startAuto();

// Keyboard nav
document.addEventListener("keydown", (e) => {
  if (e.key === "ArrowRight") next();
  if (e.key === "ArrowLeft") prev();
});

// Nav scroll effect
window.addEventListener("scroll", () => {
  document
    .getElementById("mainNav")
    .classList.toggle("scrolled", window.scrollY > 50);
});

// Heart toggle
document.querySelectorAll(".heart-btn").forEach((btn) => {
  btn.addEventListener("click", function () {
    this.textContent = this.textContent === "♡" ? "♥" : "♡";
    this.style.background = this.textContent === "♥" ? "#c8860a" : "";
    this.style.color = this.textContent === "♥" ? "#fff" : "";
  });
});

const band = document.querySelector(".promo-items");

// Pause quand la souris entre
band.addEventListener("mouseenter", () => {
  band.style.animationPlayState = "paused";
});

// Reprend quand la souris sort
band.addEventListener("mouseleave", () => {
  band.style.animationPlayState = "running";
});
