import { Outlet, Link, useNavigate } from 'react-router-dom';
import { LogOut, Home, BookOpen, Users, FileText } from 'lucide-react';

export default function DashboardLayout({ role = 'STUDENT' }: { role?: string }) {
  const navigate = useNavigate();

  const handleLogout = () => {
    // In real app, call API to clear session cookie, clear store, then navigate
    navigate('/login');
  };

  return (
    <div className="min-h-screen flex bg-slate-100">
      <aside className="w-64 bg-white border-r border-slate-200 flex flex-col">
        <div className="h-16 flex items-center px-6 border-b border-slate-200">
          <span className="text-xl font-bold text-brand-600">Espace {role}</span>
        </div>
        <nav className="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
          <Link to={`/${role.toLowerCase()}`} className="flex items-center space-x-3 px-3 py-2 rounded-md text-slate-700 hover:bg-brand-50 hover:text-brand-700">
            <Home className="w-5 h-5" />
            <span className="font-medium">Tableau de bord</span>
          </Link>
          <Link to={`/${role.toLowerCase()}/courses`} className="flex items-center space-x-3 px-3 py-2 rounded-md text-slate-700 hover:bg-brand-50 hover:text-brand-700">
            <BookOpen className="w-5 h-5" />
            <span className="font-medium">Mes Cours</span>
          </Link>
          <Link to={`/${role.toLowerCase()}/supports`} className="flex items-center space-x-3 px-3 py-2 rounded-md text-slate-700 hover:bg-brand-50 hover:text-brand-700">
            <FileText className="w-5 h-5" />
            <span className="font-medium">Supports</span>
          </Link>
          {role === 'ADMIN' && (
            <Link to="/admin/users" className="flex items-center space-x-3 px-3 py-2 rounded-md text-slate-700 hover:bg-brand-50 hover:text-brand-700">
              <Users className="w-5 h-5" />
              <span className="font-medium">Utilisateurs</span>
            </Link>
          )}
        </nav>
        <div className="p-4 border-t border-slate-200">
          <button onClick={handleLogout} className="flex items-center space-x-3 px-3 py-2 w-full rounded-md text-red-600 hover:bg-red-50 transition-colors">
            <LogOut className="w-5 h-5" />
            <span className="font-medium">Déconnexion</span>
          </button>
        </div>
      </aside>
      
      <main className="flex-1 flex flex-col h-screen overflow-hidden">
        <header className="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 shrink-0">
          <h2 className="text-lg font-semibold text-slate-800">UCB Bukavu Pédagogie</h2>
          <div className="flex items-center space-x-4">
            <div className="w-8 h-8 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center font-bold">
              U
            </div>
          </div>
        </header>
        <div className="flex-1 overflow-y-auto p-8 bg-slate-50">
          <Outlet />
        </div>
      </main>
    </div>
  );
}
