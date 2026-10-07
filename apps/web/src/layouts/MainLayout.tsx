import { Outlet, Link } from 'react-router-dom';

export default function MainLayout() {
  return (
    <div className="min-h-screen flex flex-col bg-slate-50">
      <header className="bg-white shadow-sm border-b border-slate-200">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
          <div className="flex items-center">
            <Link to="/" className="text-2xl font-bold text-brand-600">UCB Bukavu</Link>
          </div>
          <div className="flex items-center space-x-4">
            <Link to="/about" className="text-slate-600 hover:text-brand-600 transition-colors">À propos</Link>
            <Link to="/programs" className="text-slate-600 hover:text-brand-600 transition-colors">Filières & Facultés</Link>
            <Link to="/login" className="bg-brand-600 text-white px-4 py-2 rounded-md font-medium hover:bg-brand-700 transition-colors">Connexion</Link>
          </div>
        </div>
      </header>

      <main className="flex-grow flex flex-col">
        <Outlet />
      </main>

      <footer className="bg-slate-900 text-white py-8">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-slate-400">
          © {new Date().getFullYear()} Université Catholique de Bukavu (UCB). Tous droits réservés.
        </div>
      </footer>
    </div>
  );
}
