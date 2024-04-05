# O'Note

## Depuis un serveur local linux (à l'IUT)

### A) Installation du projet

- Se déplacer dans le dossier : `cd $USER/public_html`.
- Cloner projet : `git clone REPOSITORY`.

### B) Configuration générale

- Donner les droits en lecture/écriture au dossier "data" : `chmod -R 777 src/back-end/data/`.

### C) Configuration des logins

- Créer le fichier ".env" : `O-Notes\src\metier\bd\.env`
- A partir du modèle ".env.example" compléter le nouveau fichier avec les bons identifiants.

### D) Utilisation

- Accéder à la page : [http://localhost/~USER/O-Notes/src/vue/authentifier/authentifier.php](http://localhost/~USER/O-Notes/src/vue/authentifier/authentifier.php)

---

## Depuis un serveur local windows (xampp)

### A) Installation du projet

- Se déplacer dans le serveur : `cd C:\xampp\htdocs\`.
- Cloner projet : `git clone REPOSITORY`.

### B) Configuration générale

- Dans le fichier `C:\xampp\php\php.ini`, décommenter la ligne ";extension=zip" afin d'obtenir "extension=zip".

### C) Configuration des logins

- Créer le fichier ".env" : `C:\xampp\htdocs\O-Notes\src\metier\bd\.env`
- A partir du modèle ".env.example" compléter le nouveau fichier avec les bons identifiants.

### D) Utilisation

#### 1. Ouvir un tunnel ssh

- Dans un teminal : `ssh -L 5432:woody.iut.univ-lehavre.fr:5432 -p 4660 IDENTIFIANT@c-corton.iut.univ-lehavre.fr`

#### 2. Démarrer le serveur

- Démarrer le serveur xampp (module 'apache' start).
- Accéder à la page : [http://localhost/O-Notes/src/vue/index.php](http://localhost/O-Notes/src/vue/index.php)
