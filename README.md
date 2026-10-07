# Système de Gestion Pédagogique ISP-Bukavu 🎓

Plateforme moderne de gestion académique et de distribution sécurisée des supports pédagogiques pour l'**Institut Supérieur Pédagogique (ISP) de Bukavu**.

Ce projet remplace l'ancien système monolithique procédural par une architecture moderne, modulaire, sécurisée et évolutive en **Monorepo (pnpm workspaces)**.

---

## 🎯 Objectifs de la Plateforme

- **Espace Étudiant** : Consultation de l'arborescence académique, accès ciblé aux cours et téléchargement sécurisé des syllabus, TP et exercices selon la promotion.
- **Espace Enseignant** : Publication et gestion des supports de cours, suivi des affectations académiques et historique des téléchargements.
- **Espace Administration** : Gestion de la structure pédagogique (Sections, Départements, Programmes, Promotions, Années académiques), attribution des cours et contrôle des accès (RBAC).

---

## 🏗️ Architecture & Technologies

Le projet est structuré sous forme de Monorepo géré avec `pnpm workspaces` :

### Backend (`apps/api`)
- **Framework** : [NestJS](https://nestjs.com/) (Architecture modulaire TypeScript strict)
- **ORM** : [Prisma ORM](https://www.prisma.io/)
- **Base de données** : PostgreSQL 14+
- **Authentification & Sécurité** : Sessions JWT, RBAC, Hachage Argon2/Bcrypt, CORS configuré
- **Endpoints de santé** : `/api/v1/health/live`, `/api/v1/health/ready`

### Frontend (`apps/web`)
- **Framework** : [React 18](https://react.dev/) + [TypeScript](https://www.typescriptlang.org/)
- **Build tool** : [Vite](https://vitejs.dev/)
- **Styling** : [Tailwind CSS](https://tailwindcss.com/)
- **Routage** : [React Router v6](https://reactrouter.com/)
- **Gestion d'état** : [Zustand](https://github.com/pmndrs/zustand)
- **Requêtes serveur** : [TanStack Query](https://tanstack.com/query/latest) (React Query)
- **Icônes** : [Lucide React](https://lucide.dev/)

### Packages Partagés (`packages/`)
- `@isp-bukavu/api-contracts` : Interfaces TypeScript et contrats d'échange partagés.
- `@isp-bukavu/validation` : Schémas de validation [Zod](https://zod.dev/).
- `@isp-bukavu/ui` : Composants d'interface réutilisables.
- `@isp-bukavu/config` : Configurations partagées (ESLint, TypeScript).

---

## 📁 Arborescence du Projet

```text
isp-bukavu-platform/
├── apps/
│   ├── api/                   # Backend NestJS (Port 3000)
│   │   ├── prisma/            # Schéma Prisma et script de seed
│   │   │   ├── schema.prisma  # Modèle relationnel complet
│   │   │   └── seed.ts        # Données de test ISP-Bukavu
│   │   └── src/               # Code source du backend
│   └── web/                   # Frontend React + Vite (Port 5173)
│       └── src/               # Pages, layouts, composants et routes
├── packages/
│   ├── api-contracts/         # Types partagés API / Frontend
│   ├── validation/            # Schémas Zod
│   ├── ui/                    # Bibliothèque UI
│   └── config/                # Configurations partagées
├── docs/                      # Documentation d'architecture et refonte
├── infra/                     # Déploiement et configurations
├── .env.example               # Modèle des variables d'environnement
├── package.json               # Scripts globaux du monorepo
├── pnpm-workspace.yaml        # Déclaration des espaces pnpm
└── README.md                  # Documentation du projet
```

---

## 📋 Prérequis

Avant de commencer, vérifiez que les outils suivants sont installés sur votre machine :

- **Node.js** : version 18 ou supérieure (recommandé : 20 LTS)  
  *Vérifier : `node -v`*
- **pnpm** : version 8 ou supérieure  
  *Installation si nécessaire : `npm install -g pnpm`*  
  *Vérifier : `pnpm -v`*
- **PostgreSQL** : version 14 ou supérieure (actif en local sur le port `5432`)  
  *Vérifier : service PostgreSQL démarré*
- **Git** : pour cloner et versionner le projet

---

## ⚙️ Installation Rapide

### 1. Cloner le dépôt

```bash
git clone https://github.com/Florentin-artemix/support-pedagogique.git
cd support-pedagogique
```

### 2. Installer les dépendances

Installez toutes les dépendances de l'ensemble du monorepo en une seule commande :

```bash
pnpm install
```

---

## 🔧 Configuration des Variables d'Environnement

Copiez le fichier `.env.example` en `.env` à la racine du projet :

```bash
# Sur Windows (PowerShell)
Copy-Item .env.example .env

# Sur Linux / macOS / Git Bash
cp .env.example .env
```

Vérifiez le contenu de votre fichier `.env` :

```env
# Environnement
NODE_ENV=development
PORT=3000

# URL de connexion PostgreSQL (à adapter avec votre mot de passe)
DATABASE_URL="postgresql://postgres:votre_mot_de_passe@localhost:5432/isp_bukavu?schema=public"

# URL du client Frontend
WEB_ORIGIN="http://localhost:5173"

# Sécurité & Session
SESSION_SECRET="super-secret-key-to-change-in-production"

# Stockage des fichiers
STORAGE_PATH="./uploads"
MAX_FILE_SIZE=52428800 # 50 Mo
```

---

## 🗄️ Base de Données, Synchronisation & Seeding

### 1. Créer la base de données PostgreSQL

Dans votre client PostgreSQL (pgAdmin, psql ou DBeaver), créez la base de données :

```sql
CREATE DATABASE isp_bukavu;
```

### 2. Générer le client Prisma

```bash
pnpm --filter @isp-bukavu/api exec prisma generate
```

### 3. Synchroniser le schéma Prisma dans PostgreSQL

Pour appliquer le schéma à la base sans créer de fichier de migration intermédiaire en développement :

```bash
pnpm db:push
```
*(ou `pnpm --filter @isp-bukavu/api exec prisma db push`)*

### 4. Peupler la base avec les données de test (Seed)

Exécutez le script d'initialisation pour injecter automatiquement la hiérarchie académique de l'ISP-Bukavu et les comptes de test :

```bash
pnpm seed
```
*(ou `pnpm --filter @isp-bukavu/api run prisma:seed`)*

---

## 👥 Exemples & Données de Test Disponibles en Base

Le script de seeding injecte des données réalistes conçues pour tester l'intégralité des rôles et des flux pédagogiques.

### 🔑 Comptes de Test (Authentification)

| Rôle | Nom & Prénom | Identifiant / Email | Mot de passe | Espace & Droits |
| :--- | :--- | :--- | :--- | :--- |
| **Super Administrateur** | Prince Abibu | `admin@isp-bukavu.ac.cd` | `Admin@2024!` | Accès complet `/admin` (gestion utilisateurs, structure, logs) |
| **Administrateur Académique** | Jean-Pierre Mukamba | `academic@isp-bukavu.ac.cd` | `Academic@2024!` | Direction des études, affectations, promotions |
| **Enseignant (Professeur)** | Kenda Kasongo | `kenda@isp-bukavu.ac.cd` | `Prof@2024!` | Espace Enseignant `/teacher` (dépôt et gestion de ses supports) |
| **Étudiant (BAC1)** | Yoshua Ayamba (Matricule: `ISP-2024-0012`) | `etudiant.bac1@isp-bukavu.ac.cd` | `Etudiant@2024!` | Espace Étudiant `/student` (accès aux cours et supports BAC1) |
| **Étudiant (BAC2)** | Sarah Nabintu (Matricule: `ISP-2024-0045`) | `etudiant.bac2@isp-bukavu.ac.cd` | `Etudiant@2024!` | Espace Étudiant `/student` (accès aux cours et supports BAC2) |

> 💡 **Mode Démonstration Rapide (Frontend)** :
> L'interface de connexion (`/login`) dispose également d'un mode de routage rapide :
> - Saisir n'importe quel email contenant `admin` redirige directement vers le tableau de bord Administrateur (`/admin`).
> - Saisir n'importe quel email contenant `prof` redirige vers l'espace Enseignant (`/teacher`).
> - Tout autre email redirige vers l'espace Étudiant (`/student`).

---

### 📚 Structure Académique & Données Pédagogiques Injectées

1. **Année Académique** :
   - `2023-2024` (Active)
2. **Sections Académiques** :
   - `Sciences Commerciales, Administratives et Informatique (SCAI)`
   - `Sciences Exactes`
3. **Département & Programme** :
   - Département : `Informatique de Gestion` (rattaché à SCAI)
   - Programme : `Licence en Informatique de Gestion (LMD)`
4. **Promotions** :
   - `BAC1 Informatique de Gestion (L1 LMD)`
   - `BAC2 Informatique de Gestion (L2 LMD)`
   - `BAC3 Informatique de Gestion (L3 LMD)`
5. **Cours Exemple** :
   - `Développement Web & Architecture Client-Serveur`
   - `Conception et Administration des Bases de Données`
6. **Affectation Enseignant (TeacherCourseAssignment)** :
   - Le Prof. Kenda Kasongo est affecté au cours de *Développement Web* pour la promotion *BAC1 Informatique de Gestion* (Semestre 1, 45h).
7. **Supports Pédagogiques Exemple** :
   - *Syllabus complet - Développement Web Moderne* (Type: `SYLLABUS`, statut: `PUBLISHED`, lié à BAC1).
   - *Travaux Pratiques N°1 - Modélisation & SQL* (Type: `TP`, statut: `PUBLISHED`, lié à BAC1 et BAC2).

---

## 🚀 Démarrage du Projet

### Option 1 : Démarrer l'ensemble du projet (Recommandé)

Lancez simultanément le serveur d'API NestJS et le serveur de développement React/Vite :

```bash
pnpm dev
```

- **Frontend Client** : [http://localhost:5173](http://localhost:5173)
- **API Backend** : [http://localhost:3000/api/v1](http://localhost:3000/api/v1)
- **Vérification de santé API** : [http://localhost:3000/api/v1/health/live](http://localhost:3000/api/v1/health/live)

---

### Option 2 : Démarrer les services séparément

Si vous souhaitez ouvrir deux terminaux séparés :

**Terminal 1 — Backend API :**
```bash
pnpm --filter @isp-bukavu/api run dev
```

**Terminal 2 — Frontend Web :**
```bash
pnpm --filter @isp-bukavu/web run dev
```

---

## 🧪 Tests & Qualité du Code

### Lancer tous les tests du Monorepo
```bash
pnpm test
```

### Tests spécifiques au Backend
```bash
pnpm --filter @isp-bukavu/api run test
pnpm --filter @isp-bukavu/api run test:e2e
```

### Linter et formater le code
```bash
pnpm lint
```

---

## 📦 Build de Production

Pour compiler l'ensemble des modules pour le déploiement :

```bash
pnpm build
```

Les bundles de production sont générés dans :
- `apps/api/dist/` (Artefact exécutable Node.js)
- `apps/web/dist/` (Fichiers statiques HTML/CSS/JS optimisés pour Nginx, Vercel ou Apache)

Pour démarrer l'API en mode production :
```bash
pnpm --filter @isp-bukavu/api run start:prod
```

---

## 🔒 Sécurité & Robustesse

- **Authentification & Mots de passe** : Élimination totale des mots de passe en clair du système hérité, gestion via hash moderne (Argon2 / sessions sécurisées).
- **Protection des Téléchargements** : Aucun fichier n'est exposé directement dans un dossier public. Tout téléchargement passe par le contrôleur de documents qui vérifie le rôle et l'éligibilité académique de l'étudiant.
- **Validation stricte** : Chaque requête est validée côté client et serveur via Zod et des DTOs typés pour bloquer toute injection.
- **Variables d'environnement** : Le fichier `.gitignore` protège strictement le fichier `.env` pour éviter toute fuite de clés ou d'accès à la base de données.

---

## 👥 Auteur & Contribution

- **Institution** : Institut Supérieur Pédagogique de Bukavu (ISP-Bukavu)
- **Dépôt GitHub** : [Florentin-artemix/support-pedagogique](https://github.com/Florentin-artemix/support-pedagogique.git)
