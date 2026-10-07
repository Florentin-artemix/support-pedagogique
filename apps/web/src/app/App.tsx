import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';

import MainLayout from '../layouts/MainLayout';
import DashboardLayout from '../layouts/DashboardLayout';
import Home from '../pages/public/Home';
import Login from '../pages/public/Login';

const queryClient = new QueryClient();

export default function App() {
  return (
    <QueryClientProvider client={queryClient}>
      <BrowserRouter>
        <Routes>
          {/* Public Routes */}
          <Route element={<MainLayout />}>
            <Route path="/" element={<Home />} />
            <Route path="/login" element={<Login />} />
            <Route path="/about" element={<div className="p-8 text-center">À propos (en construction)</div>} />
            <Route path="/programs" element={<div className="p-8 text-center">Programmes (en construction)</div>} />
          </Route>

          {/* Student Routes */}
          <Route path="/student" element={<DashboardLayout role="STUDENT" />}>
            <Route index element={<div className="bg-white p-6 rounded-lg shadow-sm">Bienvenue dans l'espace Étudiant</div>} />
            <Route path="courses" element={<div className="bg-white p-6 rounded-lg shadow-sm">Mes Cours</div>} />
            <Route path="supports" element={<div className="bg-white p-6 rounded-lg shadow-sm">Supports</div>} />
          </Route>

          {/* Teacher Routes */}
          <Route path="/teacher" element={<DashboardLayout role="TEACHER" />}>
            <Route index element={<div className="bg-white p-6 rounded-lg shadow-sm">Bienvenue dans l'espace Enseignant</div>} />
            <Route path="courses" element={<div className="bg-white p-6 rounded-lg shadow-sm">Mes Cours (Enseignant)</div>} />
            <Route path="supports" element={<div className="bg-white p-6 rounded-lg shadow-sm">Gestion des Supports</div>} />
          </Route>

          {/* Admin Routes */}
          <Route path="/admin" element={<DashboardLayout role="ADMIN" />}>
            <Route index element={<div className="bg-white p-6 rounded-lg shadow-sm">Tableau de bord Administrateur</div>} />
            <Route path="users" element={<div className="bg-white p-6 rounded-lg shadow-sm">Gestion des Utilisateurs</div>} />
          </Route>
        </Routes>
      </BrowserRouter>
    </QueryClientProvider>
  );
}
