// Get a reference to the form element
const form = document.getElementById("newsletterForm");

// Add an event listener for the submit event
form.addEventListener("submit", (event) => {
  // Prevent the default form submission behavior
  event.preventDefault();

  // Get the email from the form
  const email = document.getElementById("email").value;

  // Send an AJAX request to the PHP script
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "newslettergrab.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = () => {
    // Check the status of the request
    if (xhr.status === 200) {
      // Display the result of the PHP script
      document.getElementById("result").innerHTML = xhr.responseText;
    } else {
      // Display an error message
      document.getElementById("result").innerHTML = "Une erreur est survenue.";
    }
    document.getElementById("email").value = "";
  };
  xhr.send(`email=${email}`);
});
