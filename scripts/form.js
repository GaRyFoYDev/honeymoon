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


// Variable pour suivre la question actuelle
let currentQuestionIndex = 1;

// Fonction pour créer et retourner un élément de question
function createQuestionElement(questionNumber) {
    const questionContainer = document.createElement('div');
    questionContainer.classList.add('question-container');
    questionContainer.id = 'question-' + questionNumber;

    const questionLabel = document.createElement('label');
    questionLabel.textContent = questions[questionNumber];
    questionLabel.setAttribute('for', `question${questionNumber}`);
    questionContainer.appendChild(questionLabel);

    // Pour les questions 1 à 19, utiliser des boutons radio
    if (questionNumber < 20) {
        for (let i = 1; i <= 5; i++) {
            const radioButton = document.createElement('input');
            radioButton.setAttribute('type', 'radio');
            radioButton.setAttribute('name', `question${questionNumber}`);
            radioButton.setAttribute('value', i);
            questionContainer.appendChild(radioButton);
        }
    } else {
        // Pour la question 20, utiliser un champ de texte
        const textField = document.createElement('input');
        textField.setAttribute('type', 'text');
        textField.setAttribute('name', `question${questionNumber}`);
        questionContainer.appendChild(textField);
    }

    // Ajouter un bouton "Suivant" ou "Soumettre"
    const isLastQuestion = questionNumber === Object.keys(questions).length;
    const nextButton = document.createElement('button');
    nextButton.textContent = isLastQuestion ? 'Soumettre' : 'Suivant';
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
        // Vérifier le champ de texte pour la question 20
        const textField = document.querySelector(`input[name="question${questionNumber}"]`);
        return textField.value.trim() !== '';
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
            nextQuestionContainer.style.display = 'block';
        } else {
            // Créer la question suivante si elle n'existe pas déjà
            const newQuestionElement = createQuestionElement(currentQuestionIndex);
            document.getElementById('form').appendChild(newQuestionElement);
            newQuestionElement.style.display = 'block';
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
