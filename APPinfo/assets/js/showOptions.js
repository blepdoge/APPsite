function showOptions() {

    const element = document.querySelector(".options");
    if (element.classList.contains('show') == false) {
      element.classList.add("show");// affiche le menu
    } else {
      element.classList.remove("show");
    }
    // cache le menu
    //ce menu vous est apporté par louis-marie
  }