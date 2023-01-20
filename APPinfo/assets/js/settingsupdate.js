// Get a reference to the form element
const form = document.getElementById("settingschanges");

// Add an event listener for the submit event
form.addEventListener("submit", (event) => {
  // Prevent the default form submission behavior
  event.preventDefault();

  // Get the email from the form
  const nomLabo = document.getElementById("nomLabo").value;
  const adresseLabo = document.getElementById("adresseLabo").value;
  const emailLabo = document.getElementById("emailLabo").value;
  const nom = document.getElementById("nom").value;
  const prenom = document.getElementById("prenom").value;
  const email = document.getElementById("email").value;
  const adresse = document.getElementById("adresse").value;
  const motdepasse = document.getElementById("motdepasse").value;

  // Send an AJAX request to the PHP script
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../model/settingsupdate.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = () => {
    // Check the status of the request
    if (xhr.status === 200) {
      // Display the result of the PHP script
      document.getElementById("resultat").innerHTML = xhr.responseText + "Les valeurs ont bien été mises à jour.";
    } else {
      // Display an error message
      document.getElementById("resultat").innerHTML = "Une erreur est survenue.";
    }
    document.getElementById("motdepasse").value = "";
    window.scrollTo(0,0);
  };
  xhr.send(
    `nomLabo=${nomLabo}&adresseLabo=${adresseLabo}&emailLabo=${emailLabo}&nom=${nom}&prenom=${prenom}&email=${email}&adresse=${adresse}&motdepasse=${motdepasse}`
  );
});
