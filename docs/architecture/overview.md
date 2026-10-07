# Architecture Générale du Système (ISP-Bukavu)

## 1. Vue d'Ensemble du Système

Le **Système de Gestion Pédagogique de l'ISP-Bukavu** est conçu selon une architecture moderne **Full-Stack TypeScript Strict** orchestrée en **Monorepo (pnpm workspaces)**.

Il abandonne définitivement le modèle de scripts procéduraux PHP dispersés pour adopter un **Monolithe Modulaire** robuste côté backend et une **Single Page Application (SPA)** réactive, ergonomique et typée de bout en bout côté frontend.

```
                              ┌───────────────────────────────────┐
                              │          Navigateur Client        │
                              │     React + Vite SPA (apps/web)   │
                              └─────────────────┬─────────────────┘
                                                │ HTTPS / Cookies HttpOnly
                                                ▼
                              ┌───────────────────────────────────┐
                              │      Reverse Proxy Nginx / API    │
                              │   API REST Versionnée (/api/v1)   │
                              │       NestJS (apps/api)           │
                              └─────────────────┬─────────────────┘
                                                │
                     ┌──────────────────────────┼──────────────────────────┐
                     │                          │                          │
                     ▼                          ▼                          ▼
        ┌─────────────────────────┐ ┌─────────────────────────┐ ┌────────────────────────┐
        │  PostgreSQL (Prisma)    │ │   Stockage Privé        │ │ Logs Structurés        │
        │  Base relationnelle     │ │   Documents chiffrés /  │ │ Audit & Métriques      │
        │  Schéma normalisé       │ │   hachés SHA-256        │ │ Health & Readiness     │
        └─────────────────────────┘ └─────────────────────────┘ └────────────────────────┘
```

---

## 2. Structure Monorepo (`pnpm workspaces`)

L'arborescence normative du projet est organisée comme suit :

```
isp-bukavu/
├── apps/
│   ├── api/                     # Backend NestJS (Monolithe modulaire)
│   └── web/                     # Frontend React + Vite SPA
├── packages/
│   ├── api-contracts/           # Types DTO, interfaces et payloads partagés
│   ├── validation/              # Schémas Zod réutilisables (frontend & backend)
│   ├── config/                  # Configuration partagée (ESLint, Prettier, TSConfig)
│   └── ui/                      # Composants UI Design System réutilisables
├── docs/                        # Documentation architecturale complète
├── infra/                       # Infrastructure Docker, scripts SQL et backups
├── .env.example
├── pnpm-workspace.yaml
├── package.json
└── tsconfig.base.json
```

---

## 3. Architecture Backend (`apps/api`)

Le backend adopte le patron **Modulaire Monolithique** sous NestJS. Chaque domaine métier est encapsulé dans son propre module autonome avec ses contrôleurs, services, entités et DTOs.

```
apps/api/src/
├── auth/                        # Authentification (Argon2id, sessions serveur, guards)
├── users/                       # Gestion des comptes utilisateurs et rôles
├── students/                    # Gestion des profils étudiants et inscriptions
├── teachers/                    # Gestion des enseignants et grades académiques
│
├── academic/                    # Structure académique ISP-Bukavu
│   ├── sections/                # SCAI, FLA, Sciences Exactes, etc.
│   ├── departments/             # Informatique de Gestion, etc.
│   ├── programs/                # Cursus LMD (Licence, Master)
│   ├── promotions/              # Cohortes d'étudiants (L1, L2, L3)
│   ├── academic-years/          # Années académiques avec bascule d'activité
│   └── courses/                 # Unités d'enseignement et syllabus
│
├── pedagogical/                 # Diffusion pédagogique
│   ├── supports/                # Ressources (Syllabus, TD, TP, Examens)
│   ├── categories/              # Catégorisation thématique
│   ├── assignments/             # Affectations des enseignants aux cours
│   ├── access/                  # Règles d'éligibilité et contrôle d'accès
│   └── downloads/               # Métriques et journalisation des flux
│
├── dashboard/                   # Indicateurs de performance par rôle
├── documents/                   # Service de stockage privé sécurisé (hash, magic bytes)
├── audit/                       # Journalisation de conformité et gouvernance
├── health/                      # Health checks (/live, /ready avec sonde DB)
│
├── database/                    # Module Prisma et extensions de requêtes
├── common/                      # Filtres d'exceptions, intercepteurs, décorateurs
├── config/                      # Validation stricte des variables d'environnement
└── observability/               # Logs JSON structurés et correlation IDs (requestId)
```

### Principes de Conception Backend :
- **Validation déclarative centralisée :** Validation systématique des corps de requêtes via Zod et pipes NestJS.
- **Réponses API standardisées :** Enveloppe unifiée `{ success: true, data: T, meta?: Meta }` ou `{ success: false, error: ApiError, meta?: Meta }`.
- **Zéro SQL brut dispersé :** Accès aux données 100% typé via Prisma ORM avec migrations versionnées.
- **Isolation des couches :** Aucun contrôleur n'accède directement à la base de données ; la logique métier réside exclusivement dans les services de domaine.

---

## 4. Architecture Frontend (`apps/web`)

L'application web est une SPA moderne construite avec React, TypeScript et Vite, privilégiant la rapidité de chargement, une ergonomie claire et un typage strict.

```
apps/web/src/
├── app/                         # Point d'entrée de l'application et fournisseurs de contexte
├── components/                  # Composants partagés (modales, tableaux paginés, loaders)
├── layouts/                     # Mises en page différenciées (AuthLayout, DashboardLayout)
├── pages/                       # Vues routées par espace métier
│   ├── public/                  # Accueil ISP-Bukavu, recherche publique, portails
│   ├── student/                 # Espace étudiant (mes cours, supports autorisés, profil)
│   ├── teacher/                 # Espace enseignant (mes charges, publication de supports)
│   └── admin/                   # Back-office académique, audit, structure et utilisateurs
│
├── features/                    # Modules verticaux par fonctionnalité
│   ├── auth/                    # Formulaires de connexion et gestion de session
│   ├── students/                # Gestion des étudiants et fiches d'inscription
│   ├── teachers/                # Gestion des enseignants
│   ├── academic/                # Arborescence sections, départements, promotions
│   ├── courses/                 # Catalogue des cours
│   ├── supports/                # Galerie de supports, visionneuse et téléchargement
│   ├── assignments/             # Grille d'affectations horaires
│   └── dashboard/               # Tableaux de bord analytiques
│
├── hooks/                       # Custom hooks réutilisables
├── lib/                         # Client API Axios/Fetch préconfiguré avec intercepteurs
├── router/                      # Définition des routes et protections d'accès (Guards)
└── stores/                      # État applicatif global (Zustand)
```

---

## 5. Gestion des Données et Stockage

### A. Base de Données (PostgreSQL)
- Base relationnelle ACID, support natif des UUID, des index B-tree et de la recherche textuelle (Full-Text Search).
- Gestion de schéma et migrations déterministes pilotées par Prisma.
- Contraintes d'intégrité référentielle strictes (`ON DELETE RESTRICT` pour préserver l'historique académique).

### B. Pipeline de Stockage Sécurisé (`StorageService`)
- Les fichiers ne sont jamais exposés dans un dossier web public.
- Stockage sur disque local protégé ou bucket S3-compatible avec identifiant opaque (`storageKey = UUIDv4`).
- Contrôle strict :
  1. Taille maximale configurée par variable d'environnement (ex: 25 Mo pour documents, 2 Mo pour avatars).
  2. Vérification de l'extension contre une liste blanche (`.pdf`, `.docx`, `.xlsx`, `.pptx`, `.txt`, `.jpg`, `.png`).
  3. Vérification du Content-Type déclaré.
  4. Inspection des octets magiques (*magic bytes*) pour neutraliser les fichiers malveillants déguisés.
  5. Calcul du hachage SHA-256 pour intégrité et déduplication.
  6. Téléchargement uniquement via flux de streaming API (`GET /api/v1/supports/:id/file`) après authentification et vérification RBAC.

---

## 6. Sécurité et Contrôle d'Accès (RBAC)

1. **Mots de passe :** Hachés exclusivement avec **Argon2id** (paramètres de mémoire et de parallélisme adaptés).
2. **Gestion de Session :** Sessions côté serveur stockées en base de données avec identifiant opaque transmis via cookie sécurisé :
   - `HttpOnly = true` (inaccessible au JavaScript client, immunité XSS).
   - `Secure = true` en production (transmission HTTPS uniquement).
   - `SameSite = Strict` ou `Lax` (protection anti-CSRF).
3. **Rôles Applicatifs (RBAC) :**
   - `SUPER_ADMIN` : Contrôle système, gestion des administrateurs, audit de sécurité.
   - `ACADEMIC_ADMIN` : Gestion des sections, départements, promotions, cours et inscriptions.
   - `PEDAGOGICAL_MANAGER` : Validation des affectations et des supports.
   - `TEACHER` : Gestion de ses affectations, publication et mise à jour de ses supports.
   - `STUDENT` : Consultation et téléchargement des supports autorisés pour sa promotion.
4. **En-têtes de Sécurité :** Protection via `helmet` (CSP, X-Content-Type-Options, HSTS, Referrer-Policy).
5. **CORS :** Restreint strictement aux origines autorisées (ex: URL du client web).

---

## 7. Observabilité et Résilience

1. **Logs Structurés :** Format JSON intégrant `timestamp`, `level`, `context`, `requestId`, `userId`, `ipAddress`.
2. **Correlation ID (`X-Request-ID`) :** Généré pour chaque requête entrante et propagé dans les logs et la réponse HTTP.
3. **Health Checks standardisés :**
   - `GET /health/live` : Vérifie que le processus API répond.
   - `GET /health/ready` : Vérifie la connectivité active à la base PostgreSQL et au disque de stockage.
