#Script de création de la table destination à partir du csv 
import sqlite3
import csv

# Connectez-vous à votre base de données SQLite
conn = sqlite3.connect('../honeymoon.db')
cur = conn.cursor()

# Créez une table (modifiez les types de colonnes selon vos données)
cur.execute('''CREATE TABLE IF NOT EXISTS destinations 
               (id INTEGER PRIMARY KEY AUTOINCREMENT,
                destination TEXT,
                feature1 INTEGER, 
                feature2 INTEGER, 
                feature3 INTEGER, 
                feature4 INTEGER, 
                feature5 INTEGER, 
                feature6 INTEGER, 
                feature7 INTEGER)''')

# Ouvrez votre fichier CSV et insérez les données
with open('../csv/destinations.csv', 'r', encoding='utf-8') as fichier_csv:
    reader = csv.reader(fichier_csv, delimiter=';')
    next(reader, None)  
    for ligne in reader:
        try:
            cur.execute('''INSERT INTO destinations
                        (destination,feature1,feature2,feature3,feature4,feature5,
                         feature6,feature7)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)''', ligne)
        except sqlite3.IntegrityError:
            pass

conn.commit()
conn.close()
