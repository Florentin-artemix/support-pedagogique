import { Link } from 'react-router-dom';
import { BookOpen, Users, Shield } from 'lucide-react';

export default function Home() {
  return (
    <div className="flex-1 flex flex-col">
      {/* Hero Section */}
      <section className="bg-brand-900 text-white py-24 px-4 relative overflow-hidden">
        <div className="max-w-7xl mx-auto relative z-10 text-center">
          <h1 className="text-5xl font-extrabold tracking-tight mb-6">
            L'Excellence Pédagogique au cœur de Bukavu
          </h1>
          <p className="text-xl text-brand-100 max-w-2xl mx-auto mb-10 leading-relaxed">
            Accédez à vos ressources académiques, suivez vos cours et interagissez avec le corps professoral de l'Institut Supérieur Pédagogique de Bukavu.
          </p>
          <div className="flex items-center justify-center space-x-4">
            <Link to="/login" className="bg-white text-brand-900 px-8 py-3 rounded-full font-bold shadow-lg hover:bg-brand-50 transition-all transform hover:-translate-y-1">
              Accéder à l'espace membre
            </Link>
            <Link to="/programs" className="border-2 border-brand-400 text-white px-8 py-3 rounded-full font-bold hover:bg-brand-800 transition-all">
              Découvrir les filières
            </Link>
          </div>
        </div>
        
        {/* Abstract Background Shapes */}
        <div className="absolute top-0 left-0 w-full h-full overflow-hidden z-0 opacity-20 pointer-events-none">
          <div className="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-brand-500 blur-3xl"></div>
          <div className="absolute top-48 right-12 w-64 h-64 rounded-full bg-brand-300 blur-3xl"></div>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-24 px-4 bg-white">
        <div className="max-w-7xl mx-auto">
          <div className="text-center mb-16">
            <h2 className="text-3xl font-bold text-slate-900">Une plateforme pensée pour la réussite</h2>
            <p className="mt-4 text-slate-600 text-lg">Centralisation sécurisée de tous les supports de cours.</p>
          </div>
          
          <div className="grid md:grid-cols-3 gap-12">
            <div className="p-8 rounded-2xl bg-slate-50 border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
              <div className="w-14 h-14 bg-brand-100 rounded-xl flex items-center justify-center mb-6 text-brand-600">
                <BookOpen size={28} />
              </div>
              <h3 className="text-xl font-bold text-slate-900 mb-3">Ressources Centralisées</h3>
              <p className="text-slate-600 leading-relaxed">Syllabus, travaux pratiques et notes de cours accessibles à tout moment pour les étudiants inscrits.</p>
            </div>
            
            <div className="p-8 rounded-2xl bg-slate-50 border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
              <div className="w-14 h-14 bg-brand-100 rounded-xl flex items-center justify-center mb-6 text-brand-600">
                <Users size={28} />
              </div>
              <h3 className="text-xl font-bold text-slate-900 mb-3">Interaction Étudiants-Enseignants</h3>
              <p className="text-slate-600 leading-relaxed">Les enseignants partagent directement avec leurs promotions assignées pour une diffusion efficace.</p>
            </div>
            
            <div className="p-8 rounded-2xl bg-slate-50 border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
              <div className="w-14 h-14 bg-brand-100 rounded-xl flex items-center justify-center mb-6 text-brand-600">
                <Shield size={28} />
              </div>
              <h3 className="text-xl font-bold text-slate-900 mb-3">Sécurité & Contrôle</h3>
              <p className="text-slate-600 leading-relaxed">Accès strictement limité aux personnes autorisées avec protection contre les téléchargements illicites.</p>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
