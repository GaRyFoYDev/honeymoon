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
    19: "Sur une échelle de 1 à 5, quelle importance accordez-vous à la découverte et à la dégustation de la cuisine locale ?",
    20: "Quelle serait votre destination de lune de miel idéale ?"
};

const destinations = ['Maldives',
    'Antilles française',
    'Polynésie Française',
    'Grèce',
    'Hawaï',
    'France',
    'Indonésie',
    'Japon',
    'Seychelles',
    'Italie',
    'Îles Fidji',
    'Afrique du Sud',
    'Thaïlande',
    'Espagne',
    'Nouvelle-Zélande',
    'Émirats Arabes Unis',
    'Maroc',
    'États-Unis',
    'Turquie',
    'Île Maurice',
    'Tanzanie',
    'Islande',
    'Croatie',
    'Portugal',
    'Îles Cook',
    'Îles Grenadines',
    'Mexique',
    'Îles Caïmans',
    'Suède',
    'Belize',
    'Antigua',
    'Inde',
    'Australie',
    'Kenya',
    'Cuba',
    'La Réunion',
    'Malaisie',
    'Puerto Rico',
    'Bahamas',
    'Cap Vert',
    'Haiti']

// Variable pour suivre la question actuelle
let currentQuestionIndex = 1;

// Fonction pour créer et retourner un élément de question
function createQuestionElement(questionNumber) {
    const questionContainer = document.createElement('div');
    questionContainer.classList.add('question-container');
    questionContainer.id = 'question-' + questionNumber;

    const number = document.createElement('h3');
    number.textContent = 'Question ' + questionNumber + '/20'
    questionContainer.appendChild(number)
    
    const questionLabel = document.createElement('label');
    questionLabel.textContent = questions[questionNumber];
    questionLabel.setAttribute('for', `question${questionNumber}`);
    questionContainer.appendChild(questionLabel);

    const question = document.createElement('div');
    question.classList.add('question');

    // Pour les questions 1 à 19, utiliser des boutons radio
    if (questionNumber < 20) {
        for (let i = 1; i <= 5; i++) {
            
            const radioContainer = document.createElement('div'); // Créer un conteneur pour le bouton radio et le label
            const radioButton = document.createElement('input');
            
            radioButton.setAttribute('type', 'radio');
            radioButton.setAttribute('name', `question${questionNumber}`);
            radioButton.setAttribute('value', i);

            const label = document.createElement('label'); 
            label.textContent = i;
            label.setAttribute('for', `question${questionNumber}`);


            radioContainer.appendChild(radioButton);
            radioContainer.appendChild(label);
            question.appendChild(radioContainer);
            
        }
        questionContainer.appendChild(question);
    } else {
        // Pour la question 20, liste déroulante (select)
        const selectField = document.createElement('select');
        selectField.setAttribute('name', `question${questionNumber}`);

        // Ajouter des options basées sur la constante 'destinations'
        destinations.forEach(destination => {
            const option = document.createElement('option');
            option.value = destination;
            option.textContent = destination;
            selectField.appendChild(option);
        });

        questionContainer.appendChild(selectField);
    }

    // Ajouter un bouton "Suivant" ou "Soumettre"
    const isLastQuestion = questionNumber === Object.keys(questions).length;
    const nextButton = document.createElement('button');
    nextButton.textContent = isLastQuestion ? 'Soumettre' : 'Suivant';
    nextButton.classList.add('nextButton');
    nextButton.onclick = function (event) {
        event.preventDefault();
        handleQuestionNavigation(questionNumber, isLastQuestion);
    };
    questionContainer.appendChild(nextButton);

    return questionContainer;
}

// Fonction pour vérifier si la question actuelle a été répondie
function isCurrentQuestionAnswered(questionNumber) {
    if (questionNumber < 20) {
        // Vérifier les boutons radio pour les questions 1-19
        const radioButtons = document.querySelectorAll(`input[name="question${questionNumber}"]`);
        return Array.from(radioButtons).some(radio => radio.checked);
    } else {
        const selectField = document.querySelector(`select[name="question${questionNumber}"]`);
        return selectField.value !== '';

    }
}

// Fonction pour gérer la navigation entre les questions
function handleQuestionNavigation(questionNumber, isLastQuestion) {
    if (!isCurrentQuestionAnswered(questionNumber)) {
        alert("Veuillez répondre à la question avant de continuer.");
        return;
    }

    const currentQuestionContainer = document.getElementById('question-' + questionNumber);
    currentQuestionContainer.style.display = 'none';

    if (!isLastQuestion) {
        currentQuestionIndex++;
        const nextQuestionContainer = document.getElementById('question-' + currentQuestionIndex);
        if (nextQuestionContainer) {
            nextQuestionContainer.style.display = 'flex';
        } else {
            // Créer la question suivante si elle n'existe pas déjà
            const newQuestionElement = createQuestionElement(currentQuestionIndex);
            document.getElementById('form').appendChild(newQuestionElement);
            newQuestionElement.style.display = 'flex';
        }
    } else {
        // Soumettre le formulaire
        document.getElementById('form').submit();
    }
}

// Fonction pour ajouter toutes les questions au formulaire
function addQuestionsToForm() {
    const formElement = document.getElementById('form');

    // Ajouter la première question au chargement de la page
    const firstQuestionElement = createQuestionElement(currentQuestionIndex);
    formElement.appendChild(firstQuestionElement);
}

// Appeler cette fonction au chargement de la page
document.addEventListener('DOMContentLoaded', addQuestionsToForm);
