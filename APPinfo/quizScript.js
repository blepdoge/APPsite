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
              <input type="radio" name="question${questionNumber}" value="${letter}">
              ${letter} :
              ${currentQuestion.answers[letter]}
            </label>`
          );
        }

        // add this question and its answers to the output
        output.push(
          `<div class="slide">
            <div class="question"> ${currentQuestion.question} </div>
            <div class="answers"> ${answers.join("")} </div>
          </div>`
        );
      }
    );

    // finally combine our output list into one string of HTML and put it on the page
    quizContainer.innerHTML = output.join('');
  }

  function showResults() {

    // gather answer containers from our quiz
    const answerContainers = quizContainer.querySelectorAll('.answers');

    // keep track of user's answers
    let numCorrect = 0;

    // for each question...
    myQuestions.forEach((currentQuestion, questionNumber) => {

      // find selected answer
      const answerContainer = answerContainers[questionNumber];
      const selector = `input[name=question${questionNumber}]:checked`;
      const userAnswer = (answerContainer.querySelector(selector) || {}).value;

      // if answer is correct
      if (userAnswer === currentQuestion.correctAnswer) {
        // add to the number of correct answers
        numCorrect++;

        //affiche les réponses en vert
        answerContainers[questionNumber].style.color = '#00cc88';
      }
      //si la réponse est fausse ou si pas de réponse
      else {
        //affiche les réponses en rouge
        answerContainers[questionNumber].style.color = '#f30034';
      }
    });

    // show number of correct answers out of total
    resultsContainer.innerHTML = `${numCorrect}/${myQuestions.length} réponse(s) correcte(s)!`;
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

  // Variables
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
        c: "19°C"
      },
      correctAnswer: "c"
    },
    {
      question: "Which tool can you use to ensure code quality?",
      answers: {
        a: "Angular",
        b: "jQuery",
        c: "RequireJS",
        d: "ESLint"
      },
      correctAnswer: "d"
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