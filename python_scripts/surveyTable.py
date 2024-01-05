#Script de création de la table survey à partir du csv de sondage
import sqlite3
import csv

# Connexion à la bdd
conn = sqlite3.connect('../honeymoon.db')
cur = conn.cursor()

# Créez une table (modifiez les types de colonnes selon vos données)
cur.execute('''CREATE TABLE IF NOT EXISTS survey 
               (id INTEGER PRIMARY KEY AUTOINCREMENT,
                question1 INTEGER, 
                question2 INTEGER, 
                question3 INTEGER, 
                question4 INTEGER, 
                question5 INTEGER, 
                question6 INTEGER, 
                question7 INTEGER, 
                question8 INTEGER, 
                question9 INTEGER, 
                question10 INTEGER, 
                question11 INTEGER, 
                question12 INTEGER, 
                question13 INTEGER, 
                question14 INTEGER, 
                question15 INTEGER, 
                question16 INTEGER, 
                question17 INTEGER, 
                question18 INTEGER, 
                question19 INTEGER, 
                question20 TEXT)''')

# Ouvrez votre fichier CSV et insérez les données
with open('../csv/survey.csv', 'r', encoding='utf-8') as fichier_csv:
    reader = csv.reader(fichier_csv, delimiter=';')
    next(reader, None)  # Ignorez l'en-tête si votre CSV en a un
    for ligne in reader:
        try:
            cur.execute('''INSERT INTO survey
                        (question1, question2, question3, question4, question5,
                         question6, question7, question8, question9, question10,
                         question11, question12, question13, question14, question15,
                         question16, question17, question18, question19, question20)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)''', ligne)
        except sqlite3.IntegrityError:
            pass

conn.commit()
conn.close()
