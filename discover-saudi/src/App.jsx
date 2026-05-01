import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import { DarkModeProvider } from './context/DarkModeContext';
import Navbar from './components/Navbar';
import Home from './pages/Home';
import Regions from './pages/Regions';
import Details from './pages/Details';
import AdminLogin from './pages/admin/AdminLogin';
import AdminDashboard from './pages/admin/AdminDashboard';
import AdminUpdate from './pages/admin/AdminUpdate';
import AdminAdd from './pages/admin/AdminAdd';

function Layout() {
  return (
    <Routes>
      {/* Public pages with Navbar */}
      <Route path="/" element={<><Navbar /><Home /></>} />
      <Route path="/regions" element={<><Navbar /><Regions /></>} />
      <Route path="/details/:id" element={<><Navbar /><Details /></>} />

      {/* Admin pages (self-contained layout) */}
      <Route path="/admin" element={<Navigate to="/admin/login" replace />} />
      <Route path="/admin/login" element={<AdminLogin />} />
      <Route path="/admin/dashboard" element={<AdminDashboard />} />
      <Route path="/admin/update/:id" element={<AdminUpdate />} />
      <Route path="/admin/add" element={<AdminAdd />} />
    </Routes>
  );
}

export default function App() {
  return (
    <DarkModeProvider>
      <BrowserRouter>
        <Layout />
      </BrowserRouter>
    </DarkModeProvider>
  );
}
