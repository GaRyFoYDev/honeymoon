import sqlite3

# Connexion à la base de données
conn = sqlite3.connect('../honeymoon.db')

# Création d'un curseur
cur = conn.cursor()

# Exécution d'une requête pour récupérer toutes les données d'une table
cur.execute("SELECT * FROM survey")

# Récupération des données
data = cur.fetchall()

# Parcourir et afficher les données
for ligne in data:
    print(type(ligne))

# Fermeture du curseur et de la connexion
cur.close()
conn.close()

