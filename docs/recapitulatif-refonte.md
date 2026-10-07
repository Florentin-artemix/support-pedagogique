# Récapitulatif de la Refonte : Système de Gestion Pédagogique Université Catholique de Bukavu (UCB)

## 1. Contexte et Objectif
L'ancien système (dossier `PROJETPRETFIN`) était un héritage d'un projet de microfinance bricolé en PHP procédural. Il souffrait de graves failles de sécurité (SQL injection, upload arbitraire/RCE, mots de passe en clair) et d'un modèle de données inadapté au milieu universitaire.
L'objectif atteint a été de concevoir et générer une véritable architecture moderne, sécurisée et dédiée à l'**Université Catholique de Bukavu (UCB)**.

## 2. Architecture Technique Déployée
Le projet a été restructuré en **Monorepo (pnpm workspaces)** :
- **Backend (API) :** NestJS (TypeScript strict), Prisma ORM, PostgreSQL. Base saine, modulaire et préparée pour l'authentification JWT/Argon2.
- **Frontend (Web) :** React, Vite, Tailwind CSS, React Router, Zustand. Interface moderne avec séparation claire des espaces (Public, Étudiant, Enseignant, Administrateur).
- **Packages Partagés :**
  - `@ucb-bukavu/api-contracts` : Modèles partagés.
  - `@ucb-bukavu/validation` : Schémas de validation (Zod).
  - `@ucb-bukavu/ui` : Composants graphiques réutilisables.
  - `@ucb-bukavu/config` : Configurations transversales.

## 3. Modèle de Données (Prisma)
Le fichier `apps/api/prisma/schema.prisma` a été réécrit pour le métier académique universitaire :
- **Structure :** Facultés ➔ Départements ➔ Programmes LMD ➔ Promotions.
- **Acteurs :** Utilisateurs (Admins, Étudiants, Enseignants) avec gestion stricte des rôles (RBAC).
- **Pédagogie :** Cours, Affectations Enseignants (TeacherCourseAssignment), et Supports liés dynamiquement aux promotions.
- **Fichiers :** Séparation entre le `Support` (métadonnées métier) et le `Document` (stockage physique sécurisé par hash SHA-256).

## 4. Sécurité Mise en Place
- **Authentification :** Remplacement des vérifications directes par mot de passe en clair par un système robuste avec hachage moderne.
- **Fichiers :** L'upload ne se fait plus dans un dossier public. Le téléchargement nécessite une vérification d'éligibilité via l'API (`/api/v1/downloads`).
- **Validation :** Centralisée avec Zod pour éviter toute injection ou donnée malveillante.

## 5. Prochaines Étapes Techniques (à charge du développeur)
- S'assurer que le service PostgreSQL local est actif et correspond à l'URL définie dans le fichier `.env` (`ucb_bukavu`).
- Pousser le schéma Prisma dans la base : `pnpm --filter @ucb-bukavu/api exec prisma db push`.
- Lancer le seeding des filières réelles de l'UCB : `pnpm --filter @ucb-bukavu/api run prisma:seed`.

---
*Ce document conclut l'analyse et la structuration générative pour l'Université Catholique de Bukavu (UCB).*
