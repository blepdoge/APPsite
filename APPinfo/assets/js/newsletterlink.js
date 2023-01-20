// Get a reference to the form element
const formnsl = document.getElementById("newsletterForm");

// Add an event listener for the submit event
formnsl.addEventListener("submit", (event) => {
  // Prevent the default form submission behavior
  event.preventDefault();

  // Get the email from the form
  const email = document.getElementById("email").value;

  // Send an AJAX request to the PHP script
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../model/newslettergrab.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = () => {
    // Check the status of the request
    if (xhr.status === 200) {
      // Display the result of the PHP script
      alert(xhr.responseText);
    } else {
      // Display an error message
      alert("une erreur est survenue ! " + xhr.status)
    }
    document.getElementById("email").value = "";
  };
  xhr.send(`email=${email}`);
});

