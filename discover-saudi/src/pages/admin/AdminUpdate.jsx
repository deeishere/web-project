import { useState } from 'react';
import { Link, useParams, useNavigate } from 'react-router-dom';
import { regionsData } from '../../data/regions';

export default function AdminUpdate() {
  const { id } = useParams();
  const regionId = parseInt(id) || 1;
  const data = regionsData[regionId] || regionsData[1];
  const navigate = useNavigate();

  const [title, setTitle] = useState(data.title);
  const [region, setRegion] = useState(data.type);
  const [description, setDescription] = useState(data.desc);
  const [success, setSuccess] = useState('');

  const handleSave = (e) => {
    e.preventDefault();
    setSuccess('تم حفظ التحديثات بنجاح!');
    setTimeout(() => navigate('/admin/dashboard'), 1500);
  };

  return (
    <div className="admin-dashboard-page">
      <header className="admin-topbar">
        <div className="admin-topbar-brand">لوحة تحكم المشرف</div>
        <div className="admin-topbar-actions">
          <Link className="admin-pill primary" to="/admin/add">إضافة محتوى</Link>
          <Link className="admin-pill primary" to="/admin/dashboard">لوحة التحكم</Link>
          <Link className="admin-pill danger" to="/">تسجيل الخروج</Link>
        </div>
      </header>

      <main className="admin-dashboard-wrap">
        <section className="admin-panel-card">
          <h1>تحديث مكان</h1>
          <p className="admin-panel-note">قم بتعديل بيانات السجل المختار ثم احفظ التحديثات.</p>
          {success && <p className="admin-success">{success}</p>}

          <div className="admin-editor-grid">
            <article className="admin-subcard">
              <h2>تعديل البيانات</h2>
              <div className="admin-form">
                <label>اسم المكان</label>
                <input type="text" value={title} onChange={e => setTitle(e.target.value)} required />

                <label>التصنيف</label>
                <select value={region} onChange={e => setRegion(e.target.value)} required>
                  <option value="وسطى">وسطى</option>
                  <option value="غربية">غربية</option>
                  <option value="شرقية">شرقية</option>
                  <option value="جنوبية">جنوبية</option>
                  <option value="شمالية">شمالية</option>
                </select>

                <label>الوصف</label>
                <textarea rows="5" value={description} onChange={e => setDescription(e.target.value)} />

                <label>الصورة الرئيسية للمكان</label>
                <input type="file" />

                <div className="admin-form-actions">
                  <button type="button" className="admin-submit" onClick={handleSave}>حفظ التحديثات</button>
                  <Link to="/admin/dashboard" className="admin-back-link">الرجوع</Link>
                </div>
              </div>
            </article>

            <aside className="admin-subcard admin-preview-card">
              <h2>معاينة</h2>
              <p className="admin-panel-note">الصورة الرئيسية الحالية</p>
              <img src={data.heroImg} alt={data.title} />
              <p className="admin-panel-note">صور العرض الجانبي</p>
              <div className="admin-preview-grid">
                {data.images.map((img, i) => <img key={i} src={img} alt={`preview-${i}`} />)}
              </div>
            </aside>
          </div>
        </section>
      </main>
    </div>
  );
}
