let titres = new Array(
    "titre-question1",
    "titre-question2",
    "titre-question3",
    "titre-question4",
    "titre-question5"
  );
  let reponses = new Array(
    "dropdown-content1",
    "dropdown-content2",
    "dropdown-content3",
    "dropdown-content4",
    "dropdown-content5"
  );
  for (var i = 0; i < titres.length; i++) {
    const targetDiv = document.getElementById(reponses[i]);
    const btn = document.getElementById(titres[i]);
    
    btn.onclick = function () {
      if (targetDiv.style.display !== "none") {
        targetDiv.style.display = "none";
      } else {
        targetDiv.style.display = "block";
      }
    };
  }