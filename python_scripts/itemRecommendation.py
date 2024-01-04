import sqlite3
import numpy as np
from recommendation import Recommendations as reco


# Connexion à la base de données
conn = sqlite3.connect('honeymoon.db')

# Création d'un curseur
cur = conn.cursor()

# Exécution d'une requête pour récupérer toutes les données d'une table
cur.execute("SELECT * FROM survey ORDER BY id DESC LIMIT 1")


# Récupératon la destinatio choisi par user à la dernière question
userDestinationChoice = cur.fetchall()
userDestinationChoice = userDestinationChoice[0][-1]
# print(userDestinationChoice)

cur.execute("SELECT * FROM destinations")
destinations = cur.fetchall()

# Parcourir et afficher les données
matrix = []
for destination in destinations:
    matrix.append(list(destination[1:]))


def getItem(matrix: list):
    for vector in matrix:
        if vector[0].strip() == userDestinationChoice:
            return vector


def get_reco(matrix):
    theitem = theitem = getItem(matrix)
    matrix.remove(theitem)
    others = matrix

    for vector in others:
        vector.append(reco.cosine_similarity(
            np.array(theitem[1:]), np.array(vector[1:])))

    results = sorted(others, key=lambda x: -x[-1])

    recommendations = []
    for result in results:
        if result[0] not in recommendations:
            recommendations.append(result[0])
        if len(recommendations) == 3:
            break

    # Créez une table (modifiez les types de colonnes selon vos données)
    cur.execute('''CREATE TABLE IF NOT EXISTS item_recommendations
                (id INTEGER PRIMARY KEY AUTOINCREMENT,
                    reco1 TEXT,
                    reco2 TEXT,
                    reco3 TEXT)''')

    try:
        cur.execute('''INSERT INTO item_recommendations
                    (reco1, reco2, reco3)
                    VALUES (?, ?, ?)''', recommendations)
    except sqlite3.IntegrityError:
        pass


get_reco(matrix)
conn.commit()
conn.close()
