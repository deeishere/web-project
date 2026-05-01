import { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';

export default function AdminAdd() {
  const navigate = useNavigate();
  const [form, setForm] = useState({
    title: '', description: '', region: '', season: '', activities: '', bestTime: ''
  });
  const [success, setSuccess] = useState('');

  const update = (field) => (e) => setForm(prev => ({ ...prev, [field]: e.target.value }));

  const handleSubmit = (e) => {
    e.preventDefault();
    setSuccess('تمت إضافة المكان بنجاح!');
    setTimeout(() => navigate('/admin/dashboard'), 1500);
  };

  return (
    <div className="admin-dashboard-page">
      <header className="admin-topbar">
        <div className="admin-topbar-brand">لوحة تحكم المشرف</div>
        <div className="admin-topbar-actions">
          <Link className="admin-pill primary" to="/admin/dashboard">لوحة التحكم</Link>
          <Link className="admin-pill danger" to="/">تسجيل الخروج</Link>
        </div>
      </header>

      <main className="admin-dashboard-wrap">
        <section className="admin-panel-card admin-form-card">
          <h1>إضافة مكان جديد</h1>
          <p className="admin-panel-note">أدخل بيانات المكان وأرفق الصور ثم اضغط زر الإضافة.</p>
          {success && <p className="admin-success">{success}</p>}

          <div className="admin-form">
            <label>اسم المكان</label>
            <input type="text" placeholder="مثل العلا" value={form.title} onChange={update('title')} required />

            <label>الصورة الرئيسية للمكان</label>
            <input type="file" />

            <label>الوصف</label>
            <textarea rows="4" placeholder="اكتب وصفاً مختصراً للمكان" value={form.description} onChange={update('description')} />

            <label>المنطقة</label>
            <select value={form.region} onChange={update('region')} required>
              <option value="">اختر المنطقة</option>
              <option value="الرياض">الرياض</option>
              <option value="مكة المكرمة">مكة المكرمة</option>
              <option value="المدينة المنورة">المدينة المنورة</option>
              <option value="عسير">عسير</option>
              <option value="تبوك">تبوك</option>
            </select>

            <label>الموسم</label>
            <input type="text" placeholder="شتوي، صيفي أو طوال العام" value={form.season} onChange={update('season')} />

            <label>الأنشطة</label>
            <input type="text" placeholder="مثل: تسلق، مخيمات، سياحة أثرية" value={form.activities} onChange={update('activities')} />

            <label>الوقت الأفضل للزيارة</label>
            <input type="text" placeholder="مثل: من أكتوبر إلى مارس" value={form.bestTime} onChange={update('bestTime')} />

            <label>صورة المعرض الأولى</label>
            <input type="file" />
            <label>صورة المعرض الثانية</label>
            <input type="file" />
            <label>صورة المعرض الثالثة</label>
            <input type="file" />

            <div className="admin-form-actions">
              <button type="button" className="admin-submit" onClick={handleSubmit}>إضافة الآن</button>
              <Link to="/admin/dashboard" className="admin-back-link">العودة للوحة التحكم</Link>
            </div>
          </div>
        </section>
      </main>
    </div>
  );
}
