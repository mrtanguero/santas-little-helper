"use strict";

const url = new URL(window.location.href);
const wasGoodCheckbox = document.querySelector(".checkmark");
const realCheckbox = document.getElementById("was-good");
const fNameInput = document.getElementById("first-name");
const lNameInput = document.getElementById("last-name");
const wishTextArea = document.getElementById("wish-text");

// Ovo samo ako nema dodataka urla, tj. ako nije bilo redirecta zbog greške
if (url.search !== "") {
  const wasGoodCheckboxLabel = document.querySelector(".checkbox");
  const fNameLabel = document.getElementById("first-name-label");
  const lNameLabel = document.getElementById("last-name-label");
  const citySelect = document.getElementById("city");
  const cityLabel = document.getElementById("city-label");
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
  realCheckbox.checked = query["was-good"] ? true : false;
  wishTextArea.value = query["wish-text"];

  // Prikaži greške korisniku
  for (let error of errors) {
    switch (error) {
      case 0:
        fNameInput.classList.add("warning");
        fNameLabel.textContent = "Ovo polje ne smije biti prazno!";
        break;
      case 1:
        fNameInput.classList.add("warning");
        fNameLabel.textContent =
          "Ime ne smije sadržati brojeve i specijalne simbole!";
        break;
      case 2:
        lNameInput.classList.add("warning");
        lNameLabel.textContent = "Ovo polje ne smije biti prazno!";
        break;
      case 3:
        lNameInput.classList.add("warning");
        lNameLabel.textContent =
          "Prezime ne smije sadržati brojeve i specijalne simbole";
        break;
      case 4:
        wasGoodCheckbox.classList.add("warning");
        wasGoodCheckboxLabel.childNodes[0].nodeValue =
          "Moraš potvrditi da si bio/la dobar/dobra!";
        break;
      case 5:
        citySelect.classList.add("warning");
        cityLabel.textContent = "Moraš odabrati grad!";
        break;
      case 6:
        wishTextArea.classList.add("warning");
        // wasGoodCheckboxLabel.classList.add("mt-10");
        wishTextLabel.textContent = "Polje za želju prazno? Stvarno?!";
        break;
    }
  }
}

// Event listener da bismo mogli preko Spejsa da manipulišemo checkboxom
realCheckbox.addEventListener("keyup", (e) => {
  if (document.activeElement === e.target && e.code === "Space") {
    e.target.checked = !e.target.checked;
    if (e.target.checked) {
      wasGoodCheckbox.classList.remove("warning");
    }
  }
});

// Event listeneri da uklonimo klasu warning kad promijene polje koje je bilo
// pogrešno
realCheckbox.addEventListener("change", (e) => {
  if (e.target.checked) {
    wasGoodCheckbox.classList.remove("warning");
  }
});

[fNameInput, lNameInput, city, wishTextArea].forEach((el) => {
  el.addEventListener("change", (e) => {
    e.target.classList.remove("warning");
  });
});
