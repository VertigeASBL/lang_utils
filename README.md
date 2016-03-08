# Utilitaires pour fichiers de langue

des utilitaires pour travailler avec des fichiers de langue SPIP.

## lang2csv

Ce script permet de convertir des fichiers de langue SPIP en fichier csv, pour pouvoir les faire traduire par des gens qui ne veulent pas entendre parler de fichiers php.
Le fichier de langue /doit/ être spécifié avec l'option `--file` ou `-f`.
Le résultat sera écrit dans un fichier que l'on /doit/ spécifier via l'option `--output` ou `-o`.

## csv2lang

Ce script permet de convertir des fichiers csv en fichiers de langue.
On /doit/ choisir des fichiers d'entrée et de sortie, ce qu'on fait en utilisant les mêmes options que pour lang2csv.
On peut lui demander d'ignorer la première ligne via l'option `-i` ou `--ignore-first-line`.

Le script part du principe que la deuxième colonne du tableau contient les chaînes de langue.
Mais on peut passer l'index d'une autre colonne à l'option `-c` pour changer ce comportement.
Les textes à proprement parler sont pris dans le 3ème colonne, mais on peut passer un autre index à l'option `-t`.
