import { Link } from 'react-router-dom';
import { BookOpen, Users, Shield, Cpu, Landmark, Scale, Stethoscope, Sprout, Building2 } from 'lucide-react';

const ucbFaculties = [
  {
    name: 'Sciences & Technologies (FST)',
    icon: Cpu,
    departments: ['Sciences Informatiques (Génie Logiciel & Réseaux)', 'Polytechnique (Génie Chimique/Métallurgie)', 'Sciences de l’Environnement'],
    color: 'border-blue-500 text-blue-600 bg-blue-50',
  },
  {
    name: 'Sciences Économiques & Gestion (FASEG)',
    icon: Landmark,
    departments: ['Économie de Gestion', 'Finance, Banque & Comptabilité', 'Économie du Développement'],
    color: 'border-emerald-500 text-emerald-600 bg-emerald-50',
  },
  {
    name: 'Faculté de Droit',
    icon: Scale,
    departments: ['Droit Économique et des Affaires', 'Droit Privé et Judiciaire', 'Droit Public'],
    color: 'border-amber-500 text-amber-600 bg-amber-50',
  },
  {
    name: 'Faculté de Médecine',
    icon: Stethoscope,
    departments: ['Médecine Générale, Chirurgie & Accouchement', 'Santé Publique', 'Sciences Biomédicales'],
    color: 'border-rose-500 text-rose-600 bg-rose-50',
  },
  {
    name: 'Sciences Agronomiques (FSA)',
    icon: Sprout,
    departments: ['Production Végétale (Phytotechnie)', 'Économie Agricole', 'Gestion des Écosystèmes'],
    color: 'border-green-500 text-green-600 bg-green-50',
  },
  {
    name: 'Architecture & Écoles Spécialisées',
    icon: Building2,
    departments: ['École d’Architecture & Urbanisme (EAU)', 'École Régionale de Santé Publique (ERSP)', 'École de Criminologie'],
    color: 'border-purple-500 text-purple-600 bg-purple-50',
  },
];

export default function Home() {
  return (
    <div className="flex-1 flex flex-col">
      {/* Hero Section */}
      <section className="bg-brand-900 text-white py-24 px-4 relative overflow-hidden">
        <div className="max-w-7xl mx-auto relative z-10 text-center">
          <div className="inline-block bg-brand-800/80 border border-brand-700 text-brand-200 px-4 py-1.5 rounded-full text-sm font-semibold mb-6">
            Portail Officiel • Université Catholique de Bukavu (UCB)
          </div>
          <h1 className="text-5xl font-extrabold tracking-tight mb-6">
            L'Excellence Universitaire au Cœur de Bukavu
          </h1>
          <p className="text-xl text-brand-100 max-w-3xl mx-auto mb-10 leading-relaxed">
            Plateforme centralisée de gestion pédagogique de l'Université Catholique de Bukavu (UCB). Accédez à vos syllabus, travaux pratiques, cours magistraux et interagissez en direct avec vos facultés.
          </p>
          <div className="flex items-center justify-center space-x-4">
            <Link to="/login" className="bg-white text-brand-900 px-8 py-3 rounded-full font-bold shadow-lg hover:bg-brand-50 transition-all transform hover:-translate-y-1">
              Accéder à l'espace membre
            </Link>
            <Link to="/programs" className="border-2 border-brand-400 text-white px-8 py-3 rounded-full font-bold hover:bg-brand-800 transition-all">
              Découvrir les facultés & filières
            </Link>
          </div>
        </div>
        
        {/* Abstract Background Shapes */}
        <div className="absolute top-0 left-0 w-full h-full overflow-hidden z-0 opacity-20 pointer-events-none">
          <div className="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-brand-500 blur-3xl"></div>
          <div className="absolute top-48 right-12 w-64 h-64 rounded-full bg-brand-300 blur-3xl"></div>
        </div>
      </section>

      {/* Faculties & Programs Showcase */}
      <section className="py-20 px-4 bg-slate-50 border-b border-slate-200">
        <div className="max-w-7xl mx-auto">
          <div className="text-center mb-14">
            <h2 className="text-3xl font-extrabold text-slate-900">Facultés & Domaines de Formation à l'UCB</h2>
            <p className="mt-3 text-slate-600 text-lg max-w-2xl mx-auto">
              L'Université Catholique de Bukavu propose des cursus LMD de premier plan, adossés à des départements d'excellence.
            </p>
          </div>

          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            {ucbFaculties.map((fac, idx) => {
              const Icon = fac.icon;
              return (
                <div key={idx} className="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all flex flex-col">
                  <div className={`w-12 h-12 rounded-xl flex items-center justify-center mb-4 ${fac.color}`}>
                    <Icon className="w-6 h-6" />
                  </div>
                  <h3 className="text-lg font-bold text-slate-900 mb-3">{fac.name}</h3>
                  <ul className="space-y-2 text-sm text-slate-600 flex-1">
                    {fac.departments.map((dept, dIdx) => (
                      <li key={dIdx} className="flex items-start">
                        <span className="inline-block w-1.5 h-1.5 rounded-full bg-brand-500 mt-1.5 mr-2 shrink-0"></span>
                        <span>{dept}</span>
                      </li>
                    ))}
                  </ul>
                  <div className="mt-6 pt-4 border-t border-slate-100 text-xs font-semibold text-brand-600 uppercase tracking-wide">
                    Système LMD • UCB Bukavu
                  </div>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-24 px-4 bg-white">
        <div className="max-w-7xl mx-auto">
          <div className="text-center mb-16">
            <h2 className="text-3xl font-bold text-slate-900">Une infrastructure pensée pour la réussite académique</h2>
            <p className="mt-4 text-slate-600 text-lg">Centralisation sécurisée, distribution contrôlée et traçabilité complète.</p>
          </div>
          
          <div className="grid md:grid-cols-3 gap-12">
            <div className="p-8 rounded-2xl bg-slate-50 border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
              <div className="w-14 h-14 bg-brand-100 rounded-xl flex items-center justify-center mb-6 text-brand-600">
                <BookOpen size={28} />
              </div>
              <h3 className="text-xl font-bold text-slate-900 mb-3">Ressources Centralisées</h3>
              <p className="text-slate-600 leading-relaxed">Syllabus officiels, travaux dirigés, énoncés de TP et examens archivés par promotion et année académique.</p>
            </div>
            
            <div className="p-8 rounded-2xl bg-slate-50 border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
              <div className="w-14 h-14 bg-brand-100 rounded-xl flex items-center justify-center mb-6 text-brand-600">
                <Users size={28} />
              </div>
              <h3 className="text-xl font-bold text-slate-900 mb-3">Coordination Pédagogique</h3>
              <p className="text-slate-600 leading-relaxed">Affectation des professeurs par cours et promotion, avec transmission directe des supports validés.</p>
            </div>
            
            <div className="p-8 rounded-2xl bg-slate-50 border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
              <div className="w-14 h-14 bg-brand-100 rounded-xl flex items-center justify-center mb-6 text-brand-600">
                <Shield size={28} />
              </div>
              <h3 className="text-xl font-bold text-slate-900 mb-3">Sécurité & Contrôle d'Accès</h3>
              <p className="text-slate-600 leading-relaxed">Authentification sécurisée, protection contre les fuites documentaires et téléchargements avec jeton cryptographique.</p>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
