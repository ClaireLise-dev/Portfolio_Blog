# 🎨 Portfolio MVC – Développeuse Web & Musicienne

Bienvenue sur mon portfolio personnel ! Ce projet met en valeur mes compétences en **développement web** et en **musique**, en suivant une **architecture MVC** claire et maintenable. Il permet également une gestion complète et autonome des projets via une interface d’administration sécurisée.

---

## 🔍 Fonctionnalités principales

- ✅ Architecture **MVC personnalisée** (Modèle – Vue – Contrôleur)
- ✅ Affichage dynamique des **projets web**, **WordPress** et **articles**
- ✅ Accès à une **page dédiée pour chaque projet**
- ✅ Interface **admin sécurisée** avec système de connexion
- ✅ CRUD complet (Ajouter / Modifier / Supprimer des projets)
- ✅ **Filtrage dynamique** des projets en JavaScript (sans rechargement)
- ✅ **Formulaire de contact** avec stockage en base de données
- ✅ Design **responsive** avec **Sass** et **Bootstrap**
- ✅ **Messages de confirmation** et **animations**

---

## 🧱 Structure technique

### 🧠 Architecture MVC

Le projet est structuré selon le modèle MVC :

- **Modèle** : fichiers `Manager.php` + managers spécialisés
- **Vue** : fichiers `xxxView.php` pour les pages publiques et admin
- **Contrôleur** : `controller.php` centralise toutes les actions
- **Routeur** : `index.php` dirige vers les bonnes fonctions

### Backend – PHP / MySQL

- `Manager.php` : connexion PDO
- `ProjectManager.php` : gestion des projets selon leur type
- `AdminManager.php`, `HomeManager.php`, `ContactManager.php`

### Frontend – HTML / SCSS / JS / Bootstrap

- **Bootstrap 5** : grille, mise en page, composants UI
- **SCSS modulaire** : `_cardProjects.scss`, `_navbar.scss`, etc.
- **JavaScript centralisé** (`index.js`) pour :
  - Chargement dynamique des projets
  - Disparition automatique des messages
  - Formulaires adaptatifs selon le type

---

## 📂 Base de données

- `projects` – Projets web
- `wordpress` – Projets WordPress
- `articles` – Articles de blog
- `admin` – Utilisateurs autorisés
- `messages` – Messages de contact

---

## 🔐 Accès à l'administration

- Connexion sécurisée via session
- Gestion complète des projets (ajout, édition, suppression)
- Formulaires dynamiques selon le type sélectionné

---

## 📫 Me contacter

Un formulaire de contact est disponible sur la page dédiée.  
Les messages sont enregistrés en base et peuvent être traités ultérieurement.
