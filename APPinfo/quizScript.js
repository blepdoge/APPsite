
(function () {

  function buildQuiz() {
    //variable pour stocker ce qui sera renvoyé au HTML
    const output = [];

    myQuestions.forEach(
      (currentQuestion, questionNumber) => {

        //variable pour stocker la liste des réponses
        const answers = [];

        for (letter in currentQuestion.answers) {

          //génère les radio boutons avec leurs lettres à côté
          answers.push(
            `<label>
              <input type="radio" class="radioButtons" name="question${questionNumber}" value="${letter}">
              ${letter} :
              ${currentQuestion.answers[letter]}
            </label>`
          );
        }

        //ajoute les questions avec leurs réponses à l'output
        output.push(
          `<div class="slide">
            <div class="question"> ${currentQuestion.question} </div>
            <div class="answers"> ${answers.join("")} </div>
          </div>`
        );
      }
    );

    //la liste de l'output est rassemblée en un seul string et renvoyé sur la page html
    quizContainer.innerHTML = output.join('');
  }

  function showResults() {

    // gather answer containers from our quiz
    const answerContainers = quizContainer.querySelectorAll('.answers');

    //compteur de bonnes réponses
    let numCorrect = 0;

    myQuestions.forEach((currentQuestion, questionNumber) => {

      // find selected answer
      const answerContainer = answerContainers[questionNumber];
      const selector = `input[name=question${questionNumber}]:checked`;
      const userAnswer = (answerContainer.querySelector(selector) || {}).value;

      //vérifie si la réponse est correcte
      if (userAnswer === currentQuestion.correctAnswer) {
        numCorrect++;

        //affiche les réponses en vert
        answerContainers[questionNumber].style.color = '#2ea797';
      }
      //si la réponse est fausse ou si pas de réponse
      else {
        //affiche les réponses en rouge
        answerContainers[questionNumber].style.color = '#d91536';
      }
    });

    //pour print le nombre de bonnes réponses
    resultsContainer.innerHTML = `${numCorrect}/${myQuestions.length} réponse(s) correcte(s)!`;

    document.querySelectorAll('.radioButtons').forEach(function (element) {
      element.setAttribute('disabled', '');
    });
    document.getElementById('submit').setAttribute('disabled', '');

  }

  function showSlide(n) {
    slides[currentSlide].classList.remove('active-slide');
    slides[n].classList.add('active-slide');
    currentSlide = n;
    if (currentSlide === 0) {
      previousButton.style.display = 'none';
    }
    else {
      previousButton.style.display = 'inline-block';
    }
    if (currentSlide === slides.length - 1) {
      nextButton.style.display = 'none';
      submitButton.style.display = 'inline-block';
    }
    else {
      nextButton.style.display = 'inline-block';
      submitButton.style.display = 'none';
    }
  }

  function showNextSlide() {
    showSlide(currentSlide + 1);
  }

  function showPreviousSlide() {
    showSlide(currentSlide - 1);
  }

  var quizContainer = document.getElementById('quiz');
  var resultsContainer = document.getElementById('results');
  const submitButton = document.getElementById('submit');
  const myQuestions = [
    {
      question: "Quel est le rythme cardiaque normal d'un individu en bonne santé ?",
      answers: {
        a: "60 à 100 battements par minute",
        b: "100 à 140 battements par minute",
        c: "140 à 180 battements par minute",
        d: "180 à 220 battements par minute"
      },
      correctAnswer: "a"
    },
    {
      question: "Parmi ces températures, laquelle est la plus idéale pour travailler dans un laboratoire ?",
      answers: {
        a: "23°C",
        b: "17°C",
        c: "19°C",
        d: "25°C"
      },
      correctAnswer: "c"
    },
    {
      question: "Quel danger est représenté par le symbole de la tête de mort et les os en croix ?",
      answers: {
        a: "Matériau de haute toxicité",
        b: "Risque corrosifs et irritation de la peau",
        c: "Nociveté pour l'environnement",
        d: "Risque de mort ou d'empoisement"
      },
      correctAnswer: "d"
    },
    {
      question: "Où ne devez-vous jamais utiliser ou laisser des matériaux inflammables ?",
      answers: {
        a: "Une source de chaleur",
        b: "Une porte ouverte",
        c: "Un évier",
        d: "Dans une réserve"
      },
      correctAnswer: "a"
    },
    {
      question: "L'utilisation d'une hotte contribue à vous protéger contre lequel de ces facteurs ?",
      answers: {
        a: "Une explosion due à la chaleur",
        b: "Les substances volatiles toxiques",
        c: "Une infection bacterielle",
        d: "Une infection virale"
      },
      correctAnswer: "b"
    }
  ];


  buildQuiz();

  // Pagination
  const previousButton = document.getElementById("previous");
  const nextButton = document.getElementById("next");
  const slides = document.querySelectorAll(".slide");
  let currentSlide = 0;

  // Show the first slide
  showSlide(currentSlide);

  // Event listeners
  submitButton.addEventListener('click', showResults);
  previousButton.addEventListener("click", showPreviousSlide);
  nextButton.addEventListener("click", showNextSlide);
})();