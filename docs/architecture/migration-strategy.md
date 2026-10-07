# Stratégie de Migration des Données

Ce document décrit la stratégie de migration des données de l'ancien système (hérité d'un projet de microfinance) vers la nouvelle architecture de la plateforme de gestion pédagogique de l'ISP-Bukavu.

## 1. Principes Fondamentaux

*   **Non-Destruction :** La base de données existante (`projet.sql`) ne sera pas modifiée. Un script ETL (Extract, Transform, Load) lira les données de l'ancienne base et les insérera dans la nouvelle.
*   **Nettoyage des Données (Data Cleansing) :** Les données héritées du système de microfinance (tables `client`, `compte`, `dette`, `epargne`, `emprunt`, `remboursement`, `retrait`, `approbation`, `agent`) seront ignorées et ne seront pas migrées.
*   **Correction Typographique :** Les erreurs de nommage (ex: `enseignat` au lieu de `enseignant`, `suport` au lieu de `support`) seront corrigées lors du mapping vers les nouveaux modèles.
*   **Sécurisation Rétroactive :** Les mots de passe existants (probablement stockés en clair ou avec un hachage faible) devront être traités. S'ils sont en clair, ils seront hachés avec bcrypt lors de la migration. Si le hachage est inconnu/faible, une procédure de réinitialisation de mot de passe obligatoire à la première connexion sera mise en place.

## 2. Cartographie de Migration (Mapping)

### 2.1. Entités Utilisateurs (Users & Roles)

L'ancien système séparait les types d'utilisateurs dans des tables distinctes sans table parent, compliquant l'authentification. Le nouveau système utilise une table unique `users` avec des relations `user_roles`.

| Ancienne Table | Ancien Champ | Nouvelle Table | Nouveau Champ | Transformation / Remarques |
| :--- | :--- | :--- | :--- | :--- |
| `administrateur` | `id_admin` | `users` | `id` | Génération UUIDv4. |
| `administrateur` | `nom`, `postnom`, `prenom` | `users` | `firstName`, `lastName` | Concaténation possible ou division selon format. |
| `administrateur` | `email` | `users` | `email` | Validation du format. |
| `administrateur` | `motdepasse` | `users` | `passwordHash` | Hachage avec bcrypt. |
| - | - | `user_roles` | - | Assigner le rôle `ADMIN`. |
| `enseignat` | `id_enseignant` | `users` | `id` | Génération UUIDv4. |
| `enseignat` | `nom`, `postnom`, `prenom` | `users` | `firstName`, `lastName` | Mapping direct. |
| `enseignat` | `email` | `users` | `email` | Mapping direct. |
| `enseignat` | `motdepasse` | `users` | `passwordHash` | Hachage avec bcrypt. |
| `enseignat` | `grade` | `users` (ou profil) | `academicTitle` | Mapping. |
| `enseignat` | `telephone` | `users` | `phoneNumber` | Mapping. |
| - | - | `user_roles` | - | Assigner le rôle `TEACHER`. |

*Note: La table `client` (utilisée potentiellement pour les étudiants dans le code PHP) sera migrée vers `users` avec le rôle `STUDENT`.*

### 2.2. Entités Académiques (Structure)

L'ancienne structure manquait de l'entité "Année Académique" et liait directement support à promotion.

| Ancienne Table | Ancien Champ | Nouvelle Table | Nouveau Champ | Transformation / Remarques |
| :--- | :--- | :--- | :--- | :--- |
| `section` | `id_section` | `sections` | `id` | Génération UUIDv4. |
| `section` | `designation` | `sections` | `name` | Mapping direct. |
| `departement` | `id_dep` | `departments` | `id` | Génération UUIDv4. |
| `departement` | `designation` | `departments` | `name` | Mapping direct. |
| `departement` | `id_section` | `departments` | `sectionId` | Résolution de la clé étrangère (UUID). |
| `promotion` | `id_promotion` | `promotions` | `id` | Génération UUIDv4. |
| `promotion` | `designation` | `promotions` | `name` | Mapping direct (ex: "G1", "L1"). |
| `promotion` | `id_dep` | `promotions` | `departmentId`| Résolution de la clé étrangère (UUID). |

### 2.3. Cursus et Pédagogie

Séparation claire entre le Cours (conceptuel) et le Support (matérialisation).

| Ancienne Table | Ancien Champ | Nouvelle Table | Nouveau Champ | Transformation / Remarques |
| :--- | :--- | :--- | :--- | :--- |
| `cours` | `id_cours` | `courses` | `id` | Génération UUIDv4. |
| `cours` | `designation` | `courses` | `name` | Mapping direct. |
| `cours` | `id_enseignant`| `courses` | `teacherId` | Résolution de la clé étrangère (UUID de l'enseignant). |
| `suport` | `id_suport` | `materials` | `id` | Génération UUIDv4. |
| `suport` | `designation` | `materials` | `title` | Titre du document. |
| `suport` | `fichier` | `materials` | `fileUrl` | Migration des fichiers physiques vers le nouveau stockage (S3/local). Mise à jour du chemin. |
| `suport` | `id_cours` | `materials` | `courseId` | Résolution de la clé étrangère (UUID du cours). |

**Table de liaison manquante (Génération dynamique) :**
Dans l'ancien système, `suport` contenait `id_promotion`. Lors de la migration, nous devrons créer des entrées dans la table de liaison `course_promotions` (ou `material_promotions`) pour préserver l'accès par promotion.
*Logique :* Si `suport_X` est lié à `cours_Y` et `promotion_Z`, lier `cours_Y` à `promotion_Z` dans le nouveau système.

## 3. Stratégie de Migration des Fichiers

Les supports pédagogiques actuels sont stockés dans un dossier public, ce qui pose de graves problèmes de sécurité.

1.  **Audit du Dossier Existant :** Analyser le répertoire de stockage actuel.
2.  **Copie Sécurisée :** Déplacer les fichiers vers un répertoire non public sécurisé du nouveau serveur.
3.  **Renommage :** Générer des noms de fichiers uniques (ex: UUID) pour éviter les collisions et les devinettes (Path Traversal).
4.  **Mise à jour de la BDD :** Le champ `fileUrl` pointera vers l'identifiant du fichier géré par l'API sécurisée.

## 4. Outils et Exécution

*   **Outil recommandé :** Script Node.js utilisant Prisma (ou TypeORM) se connectant simultanément à l'ancienne base MySQL et à la nouvelle base PostgreSQL.
*   **Phases d'exécution :**
    1.  **Dry Run (Simulation) :** Le script ETL tourne et logge les résultats sans commiter les transactions.
    2.  **Validation :** Vérification des logs pour s'assurer que les relations UUID sont correctes et qu'aucune donnée pertinente n'est perdue.
    3.  **Migration Réelle :** Exécution avec commit.
    4.  **Migration des Fichiers :** Script bash/Node.js pour déplacer et renommer les supports.

## 5. Résumé des Données à Abandonner (Microfinance)
Ces tables seront complètement ignorées lors du processus ETL :
`approbation`, `agent`, `client`, `compte`, `dette`, `epargne`, `emprunt`, `remboursement`, `retrait`.
