"use strict";

const url = new URL(window.location.href);
const wasGoodCheckbox = document.getElementById("was-good");
const fNameInput = document.getElementById("first-name");
const lNameInput = document.getElementById("last-name");
const wishTextArea = document.getElementById("wish-text");

// Ovo samo ako nema dodataka urla, tj. ako nije bilo redirecta zbog greške
if (url.search !== "") {
  const fNameLabel = document.getElementById("first-name-label");
  const lNameLabel = document.getElementById("last-name-label");
  const citySelect = document.getElementById("city");
  const wishTextLabel = document.getElementById("wish-text-label");

  let query = {};
  let errors = [];
  let counter = 0;

  // Izvlačenje parametara iz urla
  for (let param of url.searchParams) {
    if (!counter) {
      query = JSON.parse(param[1]);
    } else {
      errors = JSON.parse(param[1]);
      break;
    }
    counter++;
  }

  // Popuni ponovo polja forme starim vrijednostima
  fNameInput.value = query["first-name"];
  lNameInput.value = query["last-name"];
  citySelect.value = query["city"];
  wasGoodCheckbox.checked = query["was-good"] ? true : false;
  wishTextArea.value = query["wish-text"];

  // Prikaži greške korisniku
  for (let error of errors) {
    switch (error) {
      case "fname":
        fNameInput.classList.add("warning");
        fNameLabel.textContent =
          "Ovo polje ne smije biti prazno i smije imati samo slova!";
        break;
      case "lname":
        lNameInput.classList.add("warning");
        lNameLabel.textContent =
          "Ovo polje ne smije biti prazno i smije imati samo slova!";
        break;
      case "isnt-good":
        wasGoodCheckbox;
        break;
      case "wish":
        wishTextArea.classList.add("warning");
        wishTextLabel.textContent = "Ovo polje ne smije biti prazno!";
        break;
    }
  }
}

// Event listener da bismo mogli preko Spejsa da manipulišemo checkboxom
wasGoodCheckbox.addEventListener("keyup", (e) => {
  if (document.activeElement === e.target && e.code === "Space") {
    e.target.checked = !e.target.checked;
  }
});

// Event listeneri da uklonimo klasu warning kad krenu da pišu
[fNameInput, lNameInput, wasGoodCheckbox, wishTextArea].forEach((el) => {
  el.addEventListener("change", (e) => {
    e.target.classList.remove("warning");
  });
});
