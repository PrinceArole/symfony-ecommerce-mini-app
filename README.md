# 🛒 Mini site e-commerce Symfony

Ce projet est un mini site e-commerce développé avec le framework **Symfony 6**, dans le cadre d’un projet d’évaluation. Il permet de consulter des produits, les ajouter à un panier et simuler une commande. Un espace d'administration est également disponible pour gérer les produits.

---

## 🚀 Fonctionnalités principales

### 🧑‍💻 Côté public
- Page d’accueil
- Liste des produits (grille Bootstrap)
- Vue détail d’un produit
- Ajout au panier (stocké en session)
- Vue du panier (quantités, prix, total)
- Validation de commande fictive

### 🔐 Côté admin
- Authentification via formulaire
- Rôle `ROLE_ADMIN`
- CRUD complet des produits
- Upload d’images produit
- Sécurité d’accès aux pages admin

---

## ⚙️ Technologies utilisées

- Symfony 6
- PHP 8.1+
- MySQL
- Doctrine ORM
- Twig
- Bootstrap 5 (CDN)
- Sessions Symfony

---

## 🧱 Structure des entités

### `Product`
- `id`: identifiant
- `name`: nom du produit
- `description`: texte descriptif
- `price`: prix (float)
- `image`: nom de fichier (upload)
- `stock`: stock disponible

> (Bonus possible : entités `Order`, `OrderItem`)

---

## 🔧 Installation

1. Cloner le projet :
```bash
git clone <lien du repo>
cd mon-projet
