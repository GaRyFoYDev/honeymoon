const questions = {
    1: "Sur une échelle de 1 à 5, comment évaluez-vous l'importance du confort lors de voyages en avion ?",
    2: "Sur une échelle de 1 à 5, comment appréciez-vous les voyages en bateau ou en croisière ?",
    3: "Sur une échelle de 1 à 5, quelle est votre préférence pour les voyages en train ?",
    4: "Sur une échelle de 1 à 5, quelle importance accordez-vous à la durée du trajet pour atteindre votre destination ?",
    5: "Sur une échelle de 1 à 5, comment évaluez-vous l'importance de l'éco-responsabilité des moyens de transport ?",
    6: "Sur une échelle de 1 à 5, quelle importance accordez-vous à la richesse culturelle d'une destination ?",
    7: "Sur une échelle de 1 à 5, comment évaluez-vous l'importance des activités en plein air (randonnée, plongée, etc.) ?",
    8: "Sur une échelle de 1 à 5, quelle importance accordez-vous à la vie nocturne de la destination ?",
    9: "Sur une échelle de 1 à 5, comment évaluez-vous l'importance de la tranquillité et de l'isolement pour votre destination ?",
    10: "Sur une échelle de 1 à 5, quelle importance accordez-vous à la présence de sites historiques ?",
    11: "Sur une échelle de 1 à 5, comment évaluez-vous l'importance du luxe par rapport au budget pour votre hébergement ?",
    12: "Sur une échelle de 1 à 5, quelle importance accordez-vous au type d'hébergement (hôtel, Airbnb, camping, etc.) ?",
    13: "Sur une échelle de 1 à 5, comment évaluez-vous l'importance de l'emplacement de l'hébergement (central vs. retiré) ?",
    14: "Sur une échelle de 1 à 5, quelle importance accordez-vous aux services et commodités offerts par l'hébergement (spa, piscine, etc.) ?",
    15: "Sur une échelle de 0 à 5, quelle importance accordez-vous à un climat chaud pour votre lune de miel ?",
    16: "Sur une échelle de 1 à 5, comment évaluez-vous l'importance d'un climat tempéré ?",
    17: "Sur une échelle de 1 à 5, quelle importance accordez-vous à un climat froid ?",
    18: "Sur une échelle de 1 à 5, comment évaluez-vous l'importance de la variabilité climatique (par exemple, une destination qui offre à la fois des plages et des montagnes) ?",
    19: "Sur une échelle de 1 à 5, quelle importance accordez-vous à la découverte et à la dégustation de la cuisine locale ?"

};



// // Sélectionnez le formulaire
// const form = document.getElementById('form');

// // Fonction pour créer une question
// function createQuestion(index) {
//     const questionContainer = document.createElement('div');
//     questionContainer.classList.add('question-container');

//     const questionHeader = document.createElement('h2');
//     questionHeader.textContent = questions[index];

//     const questionDiv = document.createElement('div');
//     questionDiv.classList.add('question');

//     // Créez des boutons radio pour les réponses
//     for (let j = 1; j <= 5; j++) {
//         const label = document.createElement('label');
//         label.setAttribute('for', `q${index}-${j}`);
//         label.textContent = j;

//         const input = document.createElement('input');
//         input.setAttribute('type', 'radio');
//         input.setAttribute('id', `q${index}-${j}`);
//         input.setAttribute('name', `question${index}`);
//         input.setAttribute('value', j);

//         questionDiv.appendChild(label);
//         questionDiv.appendChild(input);
//     }

//     questionContainer.appendChild(questionHeader);
//     questionContainer.appendChild(questionDiv);

//     // Ajouter un bouton "Suivant" ou "Soumettre" selon la question
//     const isLastQuestion = index === Object.keys(questions).length;
//     const nextButton = document.createElement('button');
//     nextButton.textContent = isLastQuestion ? 'Soumettre' : 'Suivant';
//     nextButton.onclick = function () {
//         if (isLastQuestion) {
//             form.submit(); // Soumet le formulaire à la dernière question
//         } else {
//             //form.innerHTML = ''; // Efface le contenu actuel du formulaire
//             createQuestion(index + 1); // Crée la question suivante
//             document.getElementById('.question-container').style.display = 'none';
//         }
//     };
//     questionContainer.appendChild(nextButton);

//     form.appendChild(questionContainer);
// };

// // Générer la première question au chargement de la page
// document.addEventListener('DOMContentLoaded', (event) => {
//     createQuestion(1);
// });

// form.addEventListener('submit', function (event) {
//     // event.preventDefault(); // Empêche la soumission réelle du formulaire

//     // Parcourir les données du formulaire
//     const formData = new FormData(form);
//     for (let [key, value] of formData.entries()) {
//         console.log(key, value);
//     }

//     // Vous pouvez ensuite soumettre les données manuellement si nécessaire
// });


// Sélectionnez le formulaire
const form = document.getElementById('form');
let currentQuestionIndex = 1;

// Fonction pour créer une question
function createQuestion(index) {
    const questionContainer = document.createElement('div');
    questionContainer.classList.add('question-container');

    const questionHeader = document.createElement('h2');
    questionHeader.textContent = questions[index];

    const questionDiv = document.createElement('div');
    questionDiv.classList.add('question');

    // Créez des boutons radio pour les réponses
    for (let j = 1; j <= 5; j++) {
        const label = document.createElement('label');
        label.setAttribute('for', `q${index}-${j}`);
        label.textContent = j;

        const input = document.createElement('input');
        input.setAttribute('type', 'radio');
        input.setAttribute('id', `q${index}-${j}`);
        input.setAttribute('name', `question${index}`);
        input.setAttribute('value', j);

        questionDiv.appendChild(label);
        questionDiv.appendChild(input);
    }

    questionContainer.appendChild(questionHeader);
    questionContainer.appendChild(questionDiv);

    // Ajouter un bouton "Suivant" ou "Soumettre" selon la question
    const isLastQuestion = index === Object.keys(questions).length;
    const nextButton = document.createElement('button');
    nextButton.textContent = isLastQuestion ? 'Soumettre' : 'Suivant';
    nextButton.onclick = function (event) {
        event.preventDefault(); // Empêche le rechargement du formulaire
        questionContainer.style.display = 'none'; // Cache la question actuelle
        if (!isLastQuestion) {
            currentQuestionIndex++;
            let nextQuestionContainer = document.getElementById('question-' + currentQuestionIndex);
            if (!nextQuestionContainer) {
                createQuestion(currentQuestionIndex); // Crée et affiche la question suivante
                nextQuestionContainer = document.getElementById('question-' + currentQuestionIndex);
            }
            nextQuestionContainer.style.display = 'block';
        } else {
            form.submit(); // Soumet le formulaire à la dernière question
        }
    };
    questionContainer.appendChild(nextButton);

    questionContainer.id = 'question-' + index; // Identifiant unique pour le conteneur de question
    questionContainer.style.display = index === currentQuestionIndex ? 'block' : 'none'; // Affiche seulement la question actuelle
    form.appendChild(questionContainer);
}

// Générer la première question au chargement de la page
document.addEventListener('DOMContentLoaded', (event) => {
    createQuestion(currentQuestionIndex);
});
