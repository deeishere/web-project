import { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { regionsList } from '../../data/regions';

export default function AdminDashboard() {
  const [regions, setRegions] = useState(
    regionsList.map(r => ({ id: r.id, name: r.name, type: r.type, desc: r.desc }))
  );
  const [success, setSuccess] = useState('');
  const navigate = useNavigate();

  const handleDelete = (id) => {
    if (window.confirm('هل أنت متأكد؟')) {
      setRegions(prev => prev.filter(r => r.id !== id));
      setSuccess('تم حذف السجل بنجاح');
      setTimeout(() => setSuccess(''), 3000);
    }
  };

  return (
    <div className="admin-dashboard-page">
      <header className="admin-topbar">
        <div className="admin-topbar-brand">لوحة تحكم المشرف</div>
        <div className="admin-topbar-actions">
          <Link className="admin-pill danger" to="/">تسجيل الخروج</Link>
          <Link className="admin-pill primary" to="/admin/add">إضافة محتوى</Link>
        </div>
      </header>

      <main className="admin-dashboard-wrap">
        <section className="admin-panel-card">
          <h1>إدارة المحتوى</h1>
          <p className="admin-panel-note">
            تستخدم هذه الصفحة لإدارة محتوى المناطق من خلال إضافة السجلات، تعديلها أو حذف المحتوى.
          </p>
          {success && <p className="admin-success">{success}</p>}

          <div className="admin-table-wrap">
            <table className="admin-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>المنطقة</th>
                  <th>التصنيف</th>
                  <th>الوصف</th>
                  <th>الإجراءات</th>
                </tr>
              </thead>
              <tbody>
                {regions.map(r => (
                  <tr key={r.id}>
                    <td>{r.id}</td>
                    <td>{r.name}</td>
                    <td>{r.type}</td>
                    <td>{r.desc.slice(0, 60)}...</td>
                    <td className="admin-actions">
                      <Link className="admin-btn edit" to={`/admin/update/${r.id}`}>تعديل</Link>
                      <button
                        className="admin-btn delete"
                        style={{ border: 'none', cursor: 'pointer' }}
                        onClick={() => handleDelete(r.id)}
                      >
                        حذف
                      </button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </section>
      </main>
    </div>
  );
}
