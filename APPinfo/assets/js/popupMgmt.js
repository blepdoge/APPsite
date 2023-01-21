var hidecalled = false;

// Function to show the popup
function showPopup(datapopup) {
  hidecalled=false;
  // Get the iframe element
  var frame = document.getElementById("graphframe");
  // Set the src attribute
  frame.src = datapopup;
  // Get the popup and overlay elements
  var popup = document.getElementById("popup");
  var overlay = document.getElementById("overlay");
  // Show the popup and overlay
  popup.style.display = "block";
  overlay.style.display = "block";
}

// Function to hide the popup
function hidePopup() {
  hidecalled = true;
  // Get the popup and overlay elements
  var popup = document.getElementById("popup");
  var overlay = document.getElementById("overlay");
  // Hide the popup and overlay
  popup.style.display = "none";
  overlay.style.display = "none";
  var frame = document.getElementById("graphframe");
  // Set the src attribute
  frame.src = "";
  
}

// Add an event listener to the overlay to hide the popup when clicked
document.getElementById("overlay").addEventListener("click", hidePopup);
