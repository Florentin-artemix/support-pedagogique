# Feuille de Route d'Implémentation (Roadmap)

Ce document définit les étapes clés pour la refonte complète de la plateforme de gestion pédagogique de l'ISP-Bukavu. La nouvelle plateforme utilisera une architecture moderne (NestJS + React + PostgreSQL) organisée en monorepo, remplaçant ainsi l'ancien système monolithique et vulnérable en PHP.

## Phase 1 : Initialisation de l'Architecture (Semaine 1)

**Objectif :** Mettre en place l'environnement de développement et le squelette du projet.

1.  **Création du Monorepo :**
    *   Initialisation d'un espace de travail (Workspaces npm/yarn ou outil comme Nx/Turborepo) à la racine du projet.
    *   Création des dossiers `apps/api` (NestJS) et `apps/client` (React/Vite).
2.  **Configuration des Outils de Base :**
    *   Configuration de TypeScript pour le backend et le frontend.
    *   Mise en place de ESLint et Prettier pour assurer la consistance du code.
    *   Configuration des variables d'environnement (fichiers `.env`).
3.  **Mise en place de la Base de Données (PostgreSQL) :**
    *   Installation et configuration de l'ORM (Prisma recommandé pour sa sécurité et sa typage fort).
    *   Traduction du `domain-model.md` en schémas Prisma.
    *   Création des premières migrations.

## Phase 2 : Développement de l'API Backend - Cœur & Sécurité (Semaine 2)

**Objectif :** Créer les fondations sécurisées du backend NestJS.

1.  **Module d'Authentification (Auth) :**
    *   Mise en place de JWT (JSON Web Tokens).
    *   Implémentation du login et de la gestion des sessions.
    *   Création des Guards de rôle (RBAC) pour restreindre l'accès (`ADMIN`, `TEACHER`, `STUDENT`).
2.  **Gestion des Utilisateurs :**
    *   CRUD pour les administrateurs, enseignants et étudiants.
    *   Hachage sécurisé des mots de passe avec `bcrypt`.
3.  **Module Structure Académique :**
    *   API pour gérer les Sections, Départements et Promotions.

## Phase 3 : Développement de l'API Backend - Pédagogie (Semaine 3)

**Objectif :** Gérer les cours et les supports documentaires de manière sécurisée.

1.  **Gestion des Cours :**
    *   CRUD des cours, assignation aux enseignants.
    *   Liaison entre les cours et les promotions.
2.  **Gestion des Supports (Fichiers) :**
    *   Mise en place d'un service d'upload de fichiers sécurisé (validation du type MIME, renommage avec UUID).
    *   Stockage en dehors de l'arborescence publique (local storage ou S3).
    *   Création de l'endpoint de téléchargement avec vérification stricte des autorisations (seul un utilisateur inscrit dans la bonne promotion peut télécharger).

## Phase 4 : Script de Migration des Données (Semaine 3-4)

**Objectif :** Importer les anciennes données utiles sans corrompre le nouveau système.

1.  **Développement du Script ETL :**
    *   Connexion à l'ancienne base MySQL (`projet.sql`).
    *   Lecture et nettoyage des tables pertinentes (administrateur, enseignant, section, departement, promotion, cours, support).
    *   Ignorer les données de microfinance.
2.  **Tests de Migration (Dry Run) :**
    *   Exécution sur une base de données de test PostgreSQL pour valider le mapping.
    *   Vérification des relations entre cours, supports et promotions.

## Phase 5 : Développement du Frontend React (Semaine 4-5)

**Objectif :** Créer une interface utilisateur moderne, réactive et esthétique.

1.  **Fondations et Design System :**
    *   Mise en place de TailwindCSS (ou CSS Vanilla structuré) avec une palette de couleurs professionnelle pour l'ISP-Bukavu.
    *   Création des composants réutilisables (Boutons, Modales, Tableaux, Formulaires).
2.  **Implémentation des Vues (Pages) :**
    *   **Authentification :** Page de connexion.
    *   **Dashboard Admin :** Gestion des utilisateurs, gestion globale de la structure (Sections, Départements, Promotions).
    *   **Dashboard Enseignant :** Vue des cours assignés, interface d'upload sécurisé de nouveaux supports.
    *   **Espace Étudiant :** Liste des cours de sa promotion, consultation et téléchargement des supports.
3.  **Intégration API :**
    *   Connexion des vues React aux endpoints de l'API NestJS avec Axios ou Fetch.
    *   Gestion globale de l'état (Zustand ou Redux) et des erreurs (Toasters).

## Phase 6 : Tests, Optimisation et Déploiement (Semaine 6)

**Objectif :** Finaliser et livrer la plateforme.

1.  **Tests :**
    *   Tests unitaires des services critiques (Upload, Auth).
    *   Tests d'intégration des routes principales de l'API.
    *   Tests fonctionnels de l'interface (upload, téléchargement restreint).
2.  **Audit de Sécurité :**
    *   Vérification finale contre les injections SQL (géré par Prisma), XSS et failles d'upload (RCE).
3.  **Déploiement :**
    *   Configuration du serveur de production (VPS ou Cloud).
    *   Mise en place de PM2 ou Docker pour le backend.
    *   Build et déploiement du frontend (Nginx).
    *   Exécution de la migration finale des données et des anciens fichiers PDF/DOC.
