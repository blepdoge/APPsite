document.getElementById("sessionStartBtn").addEventListener("click", function() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "testdata.php", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Request successful, handle the response if needed
        console.log(xhr.responseText);
        location.reload();
      }
    };
    xhr.send();
    
  });

 