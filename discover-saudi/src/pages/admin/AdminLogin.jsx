import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';

export default function AdminLogin() {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();

  const handleSubmit = (e) => {
    e.preventDefault();
    if (username === 'admin' && password === 'admin') {
      navigate('/admin/dashboard');
    } else {
      setError('اسم المستخدم أو كلمة المرور غير صحيحة');
    }
  };

  return (
    <div className="admin-login-page">
      <header className="admin-topbar">
        <div className="admin-topbar-brand">لوحة تحكم المشرف</div>
        <div className="admin-topbar-actions">
          <Link className="admin-pill primary" to="/">العودة للموقع</Link>
        </div>
      </header>

      <main className="admin-login-wrap">
        <section className="admin-login-card">
          <h1>تسجيل دخول المشرف</h1>
          {error && <div className="admin-error">{error}</div>}
          <form className="admin-form" onSubmit={handleSubmit} style={{ display: 'grid', gap: '0.65rem', padding: '0.8rem 1.2rem 1.3rem' }}>
            <label htmlFor="username">اسم المستخدم</label>
            <input
              id="username"
              type="text"
              placeholder="admin"
              value={username}
              onChange={e => setUsername(e.target.value)}
              required
            />
            <label htmlFor="password">كلمة المرور</label>
            <input
              id="password"
              type="password"
              placeholder="******"
              value={password}
              onChange={e => setPassword(e.target.value)}
              required
            />
            <button
              type="submit"
              className="admin-submit"
            >
              دخول
            </button>
          </form>
        </section>
      </main>
    </div>
  );
}
