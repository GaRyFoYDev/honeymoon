import sqlite3
import numpy as np
from recommendation import Recommendations as reco


# Connexion à la bdd
conn = sqlite3.connect('honeymoon.db')

# Création d'un curseur
cur = conn.cursor()

# Requête SQL pour récupérer toute la table survey
cur.execute("SELECT * FROM survey")

# Récupération des données
datas = cur.fetchall()

# Parcourir et afficher les données
matrix = []
for data in datas:
    # Récupérer uniquement les valeurs numériques
    matrix.append(list(data[1:]))


def get_reco(matrix):
    theitem = matrix[-1]
    others = matrix[:-1]

    print(theitem)

    for vector in others:
        vector.append(reco.cosine_similarity(
            np.array(theitem[:-1]), np.array(vector[:-1])))

    results = sorted(others, key=lambda x: -x[-1])

    recommendations = []
    for result in results:
        if result[-2] not in ['Je ne sais pas', theitem[-1]] and result[-2] not in recommendations:
            recommendations.append(result[-2])
        if len(recommendations) == 3:
            break

    print(recommendations)
    # Créez une table (modifiez les types de colonnes selon vos données)
    cur.execute('''CREATE TABLE IF NOT EXISTS user_recommendations 
                (id INTEGER PRIMARY KEY AUTOINCREMENT,
                    reco1 TEXT, 
                    reco2 TEXT, 
                    reco3 TEXT)''')

    try:
        cur.execute('''INSERT INTO user_recommendations 
                    (reco1, reco2, reco3)
                    VALUES (?, ?, ?)''', recommendations)
    except sqlite3.IntegrityError:
        pass


get_reco(matrix)
conn.commit()
conn.close()
