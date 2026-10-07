import { Cpu, Landmark, Scale, Stethoscope, Sprout, Building2, GraduationCap, CheckCircle } from 'lucide-react';

const ucbFaculties = [
  {
    code: 'FST',
    title: 'Faculté des Sciences et Technologies',
    icon: Cpu,
    color: 'from-blue-600 to-indigo-700',
    description: 'Pôle d’innovation technologique formant des ingénieurs et informaticiens de haut niveau.',
    departments: [
      {
        name: 'Département de Sciences Informatiques',
        degrees: ['Génie Logiciel & Systèmes d’Information', 'Réseaux, Télécommunications & Sécurité', 'Intelligence Artificielle & Data Science'],
      },
      {
        name: 'Département Polytechnique',
        degrees: ['Génie Chimique et Métallurgie', 'Génie Électrique & Énergies Renouvelables'],
      },
      {
        name: 'Département des Sciences de l’Environnement',
        degrees: ['Gestion et Préservation des Écosystèmes Lacustres et Forestiers'],
      },
    ],
  },
  {
    code: 'FASEG',
    title: 'Faculté des Sciences Économiques et de Gestion',
    icon: Landmark,
    color: 'from-emerald-600 to-teal-700',
    description: 'Formation de managers, experts financiers et économistes pour le développement régional et international.',
    departments: [
      {
        name: 'Département d’Économie de Gestion',
        degrees: ['Management des Entreprises & Stratégie', 'Marketing & Commerce International'],
      },
      {
        name: 'Département de Finance et Comptabilité',
        degrees: ['Banque, Finance & Assurance', 'Audit, Contrôle de Gestion & Comptabilité'],
      },
      {
        name: 'Département d’Économie du Développement',
        degrees: ['Économie Rurale & Microfinance', 'Analyse des Politiques Publiques'],
      },
    ],
  },
  {
    code: 'DROIT',
    title: 'Faculté de Droit',
    icon: Scale,
    color: 'from-amber-600 to-orange-700',
    description: 'Formation d’avocats, magistrats, juristes d’entreprises et spécialistes en droits humains.',
    departments: [
      {
        name: 'Département de Droit Économique et Social',
        degrees: ['Droit des Affaires & Fiscalité', 'Droit Social et du Travail'],
      },
      {
        name: 'Département de Droit Privé et Judiciaire',
        degrees: ['Procédure Judiciaire & Droit Civil', 'Contentieux Judiciaire'],
      },
      {
        name: 'Département de Droit Public Interne et International',
        degrees: ['Droit Constitutionnel & Administratif', 'Droit International Humanitaire'],
      },
    ],
  },
  {
    code: 'MEDECINE',
    title: 'Faculté de Médecine',
    icon: Stethoscope,
    color: 'from-rose-600 to-red-700',
    description: 'Formation de médecins généralistes et spécialistes rattachés aux hôpitaux universitaires de référence.',
    departments: [
      {
        name: 'Département des Sciences Cliniques',
        degrees: ['Médecine Générale, Chirurgie & Accouchement', 'Gynécologie-Obstétrique & Pédiatrie'],
      },
      {
        name: 'Département des Sciences Biomédicales',
        degrees: ['Biologie Médicale & Pharmacologie Clinique'],
      },
      {
        name: 'Santé Publique & Épidémiologie',
        degrees: ['Gestion des Systèmes Sanitaires & Santé Communautaire'],
      },
    ],
  },
  {
    code: 'FSA',
    title: 'Faculté des Sciences Agronomiques et Environnementales',
    icon: Sprout,
    color: 'from-green-600 to-emerald-800',
    description: 'Sciences appliquées à la sécurité alimentaire, l’agriculture durable et la gestion des ressources naturelles.',
    departments: [
      {
        name: 'Département de Phytotechnie & Production Végétale',
        degrees: ['Amélioration des Plantes & Biotechnologies Végétales'],
      },
      {
        name: 'Département d’Économie Agricole',
        degrees: ['Agrobusiness, Chaînes de Valeurs & Gestion des Exploitations'],
      },
      {
        name: 'Département des Sciences du Sol & Environnement',
        degrees: ['Gestion et Conservation des Eaux et des Sols'],
      },
    ],
  },
  {
    code: 'ECOLES',
    title: 'Écoles Professionnelles Spécialisées',
    icon: Building2,
    color: 'from-purple-600 to-violet-800',
    description: 'Écoles d’application pratique répondant aux défis urbains, sanitaires et criminologiques de la région des Grands Lacs.',
    departments: [
      {
        name: 'École d’Architecture et d’Urbanisme (EAU)',
        degrees: ['Conception Architecturale, Urbanisme & Aménagement du Territoire'],
      },
      {
        name: 'École Régionale de Santé Publique (ERSP)',
        degrees: ['Santé Internationale, Politiques de Santé & Recherche Sanitaire'],
      },
      {
        name: 'École de Criminologie',
        degrees: ['Sécurité Publique, Criminologie Appliquée & Analyse Pénale'],
      },
    ],
  },
];

export default function Programs() {
  return (
    <div className="flex-1 bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
      <div className="max-w-7xl mx-auto">
        <div className="text-center mb-16">
          <span className="inline-block bg-brand-100 text-brand-700 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider mb-3">
            Offre de Formation LMD
          </span>
          <h1 className="text-4xl font-extrabold text-slate-900 tracking-tight sm:text-5xl">
            Facultés & Filières de l'Université Catholique de Bukavu
          </h1>
          <p className="mt-4 max-w-3xl mx-auto text-lg text-slate-600">
            L'UCB Bukavu organise des programmes accrédités selon le système LMD (Licence, Master, Doctorat), assurant une formation d'excellence ouverte sur le monde.
          </p>
        </div>

        <div className="grid lg:grid-cols-2 gap-10">
          {ucbFaculties.map((fac) => {
            const Icon = fac.icon;
            return (
              <div key={fac.code} className="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
                <div className={`p-6 bg-gradient-to-r ${fac.color} text-white`}>
                  <div className="flex items-center space-x-3 mb-2">
                    <div className="p-2 bg-white/20 rounded-lg">
                      <Icon className="w-6 h-6 text-white" />
                    </div>
                    <span className="text-xs font-bold uppercase tracking-wider bg-white/20 px-2.5 py-0.5 rounded-full">
                      {fac.code}
                    </span>
                  </div>
                  <h2 className="text-2xl font-bold">{fac.title}</h2>
                  <p className="text-white/90 text-sm mt-2">{fac.description}</p>
                </div>

                <div className="p-6 space-y-6 flex-1 flex flex-col justify-between">
                  <div className="space-y-5">
                    {fac.departments.map((dept, dIdx) => (
                      <div key={dIdx} className="border-l-2 border-brand-500 pl-4 py-1">
                        <h3 className="font-semibold text-slate-900 text-base">{dept.name}</h3>
                        <ul className="mt-2 space-y-1">
                          {dept.degrees.map((deg, degIdx) => (
                            <li key={degIdx} className="text-sm text-slate-600 flex items-center">
                              <CheckCircle className="w-4 h-4 text-emerald-500 mr-2 shrink-0" />
                              <span>{deg}</span>
                            </li>
                          ))}
                        </ul>
                      </div>
                    ))}
                  </div>

                  <div className="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-medium">
                    <span className="flex items-center">
                      <GraduationCap className="w-4 h-4 mr-1.5 text-brand-600" />
                      Diplômes homologués Ministère ESU
                    </span>
                    <span className="bg-slate-100 px-2 py-1 rounded text-slate-700">Campus UCB</span>
                  </div>
                </div>
              </div>
            );
          })}
        </div>
      </div>
    </div>
  );
}
