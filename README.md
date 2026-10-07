# Système de Gestion Pédagogique - Université Catholique de Bukavu (UCB) 🎓

Plateforme moderne de gestion académique et de distribution sécurisée des supports pédagogiques pour l'**Université Catholique de Bukavu (UCB)**.

Ce projet structure les cursus universitaires selon les standards LMD (Licence, Master, Doctorat) et fournit une architecture moderne, modulaire, sécurisée et évolutive en **Monorepo (pnpm workspaces)**.

---

## 🎯 Objectifs de la Plateforme UCB

- **Espace Étudiant** : Consultation de l'arborescence académique de sa faculté (FST, FASEG, Droit, Médecine, Agronomie...), accès direct aux cours magistraux et téléchargement sécurisé des syllabus, TP et exercices selon la promotion.
- **Espace Enseignant** : Dépôt, gestion et versionnage des supports de cours par les professeurs et chefs de travaux, suivi des affectations académiques et historique des téléchargements étudiants.
- **Espace Administration (Secrétariat Général Académique & Décanats)** : Gestion de la structure académique (Facultés, Départements, Filières, Promotions, Années académiques), affectation des cours et contrôle rigoureux des accès (RBAC).

---

## 🏛️ Facultés et Filières de l'UCB Bukavu

L'Université Catholique de Bukavu comprend les facultés et écoles d'excellence suivantes, intégrées dans la plateforme :

1. **Faculté des Sciences et Technologies (FST)**
   - *Département de Sciences Informatiques* : Génie Logiciel, Systèmes d'Information, Réseaux & Télécommunications, Intelligence Artificielle.
   - *Département Polytechnique* : Génie Chimique & Métallurgie, Génie Électrique & Énergies Renouvelables.
   - *Département des Sciences de l'Environnement* : Préservation des écosystèmes et gestion durable des ressources.
2. **Faculté des Sciences Économiques et de Gestion (FASEG)**
   - Économie de Gestion, Finance & Comptabilité, Audit, Économie du Développement, Entrepreneuriat.
3. **Faculté de Droit**
   - Droit Économique et des Affaires, Droit Privé et Judiciaire, Droit Public Interne et International.
4. **Faculté de Médecine**
   - Médecine Générale, Chirurgie & Accouchement, Spécialisations Médicales, Santé Publique & Sciences Biomédicales.
5. **Faculté des Sciences Agronomiques et Environnementales (FSA)**
   - Production Végétale (Phytotechnie), Économie Agricole & Agrobusiness, Gestion des Sols et des Eaux.
6. **Faculté des Sciences Sociales**
   - Sociologie Appliquée, Gouvernance et Développement, Communication des Organisations.
7. **Écoles Professionnelles Spécialisées**
   - *École d'Architecture et d'Urbanisme (EAU)*
   - *École Régionale de Santé Publique (ERSP)*
   - *École de Criminologie*

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
- **Requêtes serveur** : [TanStack Query](https://tanstack.com/query/latest)
- **Icônes** : [Lucide React](https://lucide.dev/)

### Packages Partagés (`packages/`)
- `@ucb-bukavu/api-contracts` : Interfaces TypeScript et contrats d'échange partagés.
- `@ucb-bukavu/validation` : Schémas de validation [Zod](https://zod.dev/).
- `@ucb-bukavu/ui` : Composants graphiques réutilisables.
- `@ucb-bukavu/config` : Configurations partagées.

---

## 📁 Arborescence du Projet

```text
ucb-bukavu-platform/
├── apps/
│   ├── api/                   # Backend NestJS (Port 3000)
│   │   ├── prisma/            # Schéma Prisma et script de seed
│   │   │   ├── schema.prisma  # Modèle relationnel complet
│   │   │   └── seed.ts        # Données de test UCB Bukavu
│   │   └── src/               # Modules NestJS
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

# URL de connexion PostgreSQL (base de données ucb_bukavu)
DATABASE_URL="postgresql://postgres:votre_mot_de_passe@localhost:5432/ucb_bukavu?schema=public"

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

Dans votre client PostgreSQL (pgAdmin, psql ou DBeaver) :

```sql
CREATE DATABASE ucb_bukavu;
```

### 2. Générer le client Prisma

```bash
pnpm --filter @ucb-bukavu/api exec prisma generate
```

### 3. Synchroniser le schéma Prisma dans PostgreSQL

Pour appliquer le schéma à la base sans créer de fichier de migration intermédiaire en développement :

```bash
pnpm db:push
```
*(ou `pnpm --filter @ucb-bukavu/api exec prisma db push`)*

### 4. Peupler la base avec les données réelles de l'UCB (Seed)

Exécutez le script d'initialisation pour injecter automatiquement la hiérarchie académique de l'Université Catholique de Bukavu (UCB) et les comptes de test :

```bash
pnpm seed
```
*(ou `pnpm --filter @ucb-bukavu/api run prisma:seed`)*

---

## 👥 Exemples & Données de Test Disponibles en Base

Le script de seeding injecte des données représentatives des filières et départements de l'UCB.

### 🔑 Comptes de Test (Authentification)

| Rôle | Nom & Prénom | Identifiant / Email | Mot de passe | Espace & Droits |
| :--- | :--- | :--- | :--- | :--- |
| **Super Administrateur** | Prince Abibu | `admin@ucbukavu.ac.cd` | `Admin@2024!` | Accès complet `/admin` (gestion utilisateurs, structure, logs) |
| **Secrétaire Général Académique** | Jean-Pierre Mukamba | `academic@ucbukavu.ac.cd` | `Academic@2024!` | Direction des études UCB, affectations facultaires |
| **Enseignant (Professeur UCB)** | Kenda Kasongo | `prof.kenda@ucbukavu.ac.cd` | `Prof@2024!` | Espace Enseignant `/teacher` (dépôt et gestion de ses supports) |
| **Étudiant BAC1 Informatique** | Yoshua Ayamba (Matricule: `UCB-2024-0012`) | `etudiant.bac1@ucbukavu.ac.cd` | `Etudiant@2024!` | Espace Étudiant `/student` (accès aux cours et supports BAC1 FST) |
| **Étudiante BAC2 Informatique** | Sarah Nabintu (Matricule: `UCB-2024-0045`) | `etudiant.bac2@ucbukavu.ac.cd` | `Etudiant@2024!` | Espace Étudiant `/student` (accès aux cours et supports BAC2 FST) |

> 💡 **Mode Démonstration Rapide (Frontend)** :
> L'interface de connexion (`/login`) dispose d'un simulateur de routage automatique :
> - Saisir un email contenant `admin` redirige directement vers le tableau de bord Administrateur (`/admin`).
> - Saisir un email contenant `prof` redirige vers l'espace Enseignant (`/teacher`).
> - Tout autre email redirige vers l'espace Étudiant (`/student`).

---

### 📚 Structure Académique UCB Injectée en Base

1. **Année Académique** :
   - `2023-2024` (Active)
2. **Facultés & Écoles UCB** :
   - `Faculté des Sciences et Technologies (FST)`
   - `Faculté des Sciences Économiques et de Gestion (FASEG)`
   - `Faculté de Droit`
   - `Faculté de Médecine`
   - `Faculté des Sciences Agronomiques et Environnementales (FSA)`
   - `École d’Architecture et d’Urbanisme (EAU)`
3. **Départements & Programmes** :
   - Département : `Sciences Informatiques` (rattaché à la FST)
   - Département : `Polytechnique` (Génie Chimique et Métallurgie)
   - Filière : `Licence en Sciences Informatiques (LMD - Génie Logiciel)`
4. **Promotions** :
   - `BAC1 Sciences Informatiques (L1 LMD)`
   - `BAC2 Sciences Informatiques (L2 LMD)`
   - `BAC3 Sciences Informatiques (L3 LMD)`
5. **Cours Exemple** :
   - `Développement Web Moderne & Systèmes Distribués`
   - `Conception et Administration des Bases de Données Relationnelles`
6. **Affectation Enseignant (TeacherCourseAssignment)** :
   - Le Professeur Kenda Kasongo est affecté au cours de *Développement Web Moderne* pour la promotion *BAC1 Sciences Informatiques* (Semestre 1, 45h).
7. **Supports Pédagogiques Exemple** :
   - *Syllabus complet - Développement Web Moderne (UCB-FST)* (Type: `SYLLABUS`, statut: `PUBLISHED`, lié à BAC1).
   - *Travaux Pratiques N°1 - Modélisation & SQL PostgreSQL* (Type: `TP`, statut: `PUBLISHED`, lié à BAC1 et BAC2).

---

## 🚀 Démarrage du Projet

### Option 1 : Démarrer l'ensemble du monorepo (Recommandé)

Lancez simultanément le serveur d'API NestJS et le serveur de développement React/Vite :

```bash
pnpm dev
```

- **Frontend Client UCB** : [http://localhost:5173](http://localhost:5173)
- **Catalogue des Filières & Facultés** : [http://localhost:5173/programs](http://localhost:5173/programs)
- **API Backend UCB** : [http://localhost:3000/api/v1](http://localhost:3000/api/v1)
- **Vérification de santé API** : [http://localhost:3000/api/v1/health/live](http://localhost:3000/api/v1/health/live)

---

### Option 2 : Démarrer les services séparément

Si vous souhaitez ouvrir deux terminaux séparés :

**Terminal 1 — Backend API :**
```bash
pnpm --filter @ucb-bukavu/api run dev
```

**Terminal 2 — Frontend Web :**
```bash
pnpm --filter @ucb-bukavu/web run dev
```

---

## 🧪 Tests & Qualité du Code

### Lancer tous les tests du Monorepo
```bash
pnpm test
```

### Tests spécifiques au Backend
```bash
pnpm --filter @ucb-bukavu/api run test
pnpm --filter @ucb-bukavu/api run test:e2e
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
- `apps/web/dist/` (Fichiers statiques HTML/CSS/JS optimisés pour le déploiement Web)

Pour démarrer l'API en mode production :
```bash
pnpm --filter @ucb-bukavu/api run start:prod
```

---

## 🔒 Sécurité & Robustesse

- **Authentification & Mots de passe** : Hachage sécurisé (Argon2 / sessions avec tokens) sans stockage de mots de passe en clair.
- **Protection des Téléchargements** : Aucun fichier n'est exposé directement dans un dossier public. Tout téléchargement passe par l'API qui vérifie le rôle et l'éligibilité académique de l'étudiant.
- **Validation stricte** : Chaque requête est validée côté client et serveur via Zod et des DTOs typés pour bloquer toute injection.
- **Protection des clés** : Le fichier `.gitignore` protège strictement le fichier `.env` pour éviter toute fuite d'informations sensibles.

---

## 👥 Institution & Référence

- **Institution** : Université Catholique de Bukavu (UCB)
- **Site Officiel** : [ucbukavu.ac.cd](https://ucbukavu.ac.cd)
- **Dépôt GitHub** : [Florentin-artemix/support-pedagogique](https://github.com/Florentin-artemix/support-pedagogique.git)
