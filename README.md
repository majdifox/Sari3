# EasyMatch Transport - README

## **Description**
Sari3 Transport est une plateforme collaborative permettant de mettre en relation des conducteurs avec des expéditeurs pour optimiser le transport de marchandises. Ce projet vise à réduire les coûts et l’empreinte carbone tout en assurant un service efficace et fiable.

---

## **Fonctionnalités**

### **Utilisateurs**
- Inscription avec nom, prénom, email et mot de passe.
- Gestion du profil utilisateur (modification des informations personnelles).
- Notification par email pour les actions importantes (inscription, transaction, etc.).

### **Expéditeurs**
- Recherche de conducteurs par itinéraire.
- Envoi de demandes de transport (dimensions, poids, type de marchandise).
- Historique des demandes.
- Évaluation des conducteurs.

### **Conducteurs**
- Publication d’annonces avec itinéraires et capacité de chargement.
- Gestion des annonces publiées.
- Acceptation ou refus des demandes d'expéditeurs.
- Historique des trajets.

### **Administration**
- Validation des identités des utilisateurs.
- Gestion des utilisateurs (suspension, suppression, etc.).
- Suivi des annonces, demandes et évaluations.
- Dashboard avec statistiques (nombre d’annonces, transactions, etc.).

---

## **Technologies**

### **Backend**
- **Langage** : PHP (POO, MVC).
- **Framework** : Aucun (framework personnalisé construit avec PHP).
- **Base de données** : MySQL.
- **Routage** : Système de routage personnalisé.

### **Frontend**
- **HTML5**, **CSS3** (TailwindCSS).
- **JavaScript** (Fetch API, AJAX avec jQuery).
- **Responsive Design** : Compatible mobiles et tablettes.

### **Bonus**
- **API** : Utilisation d’un service cartographique (Google Maps, etc.).
- **Progressive Web App (PWA)**.

---

## **Installation et configuration**

### **Prérequis**
- PHP >= 8.0.
- Serveur Apache ou Nginx.
- MySQL >= 5.7.
- Composer.
- Node.js (optionnel pour TailwindCSS).

### **Étapes d'installation**
1. Clonez le dépôt Git :
   ```bash
   git clone https://github.com/nom-utilisateur/easymatch-transport.git
   ```
2. Accédez au répertoire du projet :
   ```bash
   cd easymatch-transport
   ```
3. Installez les dépendances backend avec Composer :
   ```bash
   composer install
   ```
4. Configurez le fichier `.env` :
   ```env
   DB_HOST=localhost
   DB_NAME=easymatch_transport
   DB_USER=root
   DB_PASSWORD=
   ```
5. Importez la base de données :
   - Rendez-vous dans le dossier `sql/`.
   - Importez le fichier `database.sql` dans MySQL.
6. Lancer le serveur local :
   ```bash
   php -S localhost:8000
   ```

### **Optionnel : Compilation TailwindCSS**
1. Installez les dépendances Node.js :
   ```bash
   npm install
   ```
2. Compilez les fichiers CSS :
   ```bash
   npm run build
   ```

---

## **Structure du projet**

### **Backend**
- `app/`
  - `Controllers/` : Contient les fichiers des contrôleurs.
  - `Models/` : Contient les classes de modèles liées à la base de données.
  - `Views/` : Contient les fichiers HTML gérés par le moteur de rendu.
- `routes/`
  - Fichier contenant les routes du projet.

### **Frontend**
- `public/`
  - `css/` : Feuilles de style compilées.
  - `js/` : Scripts JavaScript.

### **Configuration**
- `.env` : Fichier de configuration des variables d'environnement.

---

## **Contribution**
1. Créez une nouvelle branche :
   ```bash
   git checkout -b feature-nom-de-la-fonctionnalite
   ```
2. Faites vos modifications et committez :
   ```bash
   git commit -m "Description des modifications"
   ```
3. Poussez vos modifications :
   ```bash
   git push origin feature-nom-de-la-fonctionnalite
   ```
4. Ouvrez une Pull Request sur GitHub.

---

## **Contact**
Pour toute question ou suggestion, veuillez contacter l'équipe à : <support@easymatch-transport.com>

