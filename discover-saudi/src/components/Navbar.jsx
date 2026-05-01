import { Link, useLocation } from 'react-router-dom';
import { useDarkMode } from '../context/DarkModeContext';

export default function Navbar() {
  const { dark, toggle } = useDarkMode();
  const { pathname } = useLocation();

  return (
    <nav>
      <span className="nav-brand">اكتشف السعودية</span>
      <div className="nav-links">
        <Link to="/" className={pathname === '/' ? 'active' : ''}>الرئيسية</Link>
        <Link to="/regions" className={pathname.startsWith('/regions') ? 'active' : ''}>معرض المناطق</Link>
        <Link to="/admin/login" className={pathname.startsWith('/admin') ? 'active' : ''}>دخول المشرف</Link>
        <button id="darkToggle" onClick={toggle}>
          <span id="darkIcon">{dark ? '☀️' : '🌙'}</span>
          <span id="darkLabel">{dark ? 'الوضع النهاري' : 'الوضع الليلي'}</span>
        </button>
      </div>
    </nav>
  );
}
