import sqlite3
import numpy as np


# Connexion à la base de données
conn = sqlite3.connect('honeymoon.db')

# Création d'un curseur
cur = conn.cursor()

# Exécution d'une requête pour récupérer toutes les données d'une table
cur.execute("SELECT * FROM survey ORDER BY id DESC LIMIT 1")


# Récupération des données
datas = cur.fetchall()
# Parcourir et afficher les données
matrix = []
for data in datas:
    # Récupérer uniquement les valeurs numériques
    matrix.append(list(data[1:]))


def dot_product(vector1, vector2):
    thedotproduct = np.sum([vector1[k] * vector2[k]
                           for k in range(0, len(vector1))])
    return thedotproduct


def vector_norm(vector):
    thenorm = np.sqrt(dot_product(vector, vector))
    return thenorm


def cosine_similarity(vector1, vector2):
    thedotproduct = dot_product(vector1, vector2)
    thecosine = thedotproduct / (vector_norm(vector1) * vector_norm(vector2))
    thecosine = np.round(thecosine, 4)
    return thecosine


def get_reco(matrix):
    theitem = matrix[-1]
    others = matrix[:-1]

    for vector in others:
        vector.append(cosine_similarity(theitem[:-1], vector[:-1]))

    results = sorted(others, key=lambda x: -x[-1])

    recommendations = []
    for result in results:
        if result[-2] not in ['Je ne sais pas', theitem[-1]] and result[-2] not in recommendations:
            recommendations.append(result[-2])
        if len(recommendations) == 3:
            break

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
