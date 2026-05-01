import { useState } from 'react';
import { Link } from 'react-router-dom';
import { regionsList } from '../data/regions';
import Footer from '../components/Footer';

const TYPES = ['all', 'وسطى', 'غربية', 'شرقية', 'جنوبية', 'شمالية'];
const TYPE_LABELS = { all: 'الكل', وسطى: 'وسطى', غربية: 'غربية', شرقية: 'شرقية', جنوبية: 'جنوبية', شمالية: 'شمالية' };

export default function Regions() {
  const [search, setSearch] = useState('');
  const [activeType, setActiveType] = useState('all');

  const filtered = regionsList.filter(r => {
    const typeMatch = activeType === 'all' || r.type === activeType;
    const searchMatch = !search || r.name.includes(search);
    return typeMatch && searchMatch;
  });

  return (
    <>
      <div className="page-header">
        <h1>معرض المناطق</h1>
        <p>ابحث أو صفِّ النتائج ثم اضغط على أي منطقة للانتقال إلى صفحة التفاصيل.</p>
      </div>

      <div className="filters-bar">
        <div style={{ display: 'flex', gap: '0.8rem', alignItems: 'center', flexWrap: 'wrap' }}>
          <div className="search-wrap">
            <input
              type="text"
              placeholder="ابحث عن منطقة أو مدينة..."
              value={search}
              onChange={e => setSearch(e.target.value)}
            />
          </div>
          <select
            className="filter-select"
            value={activeType}
            onChange={e => setActiveType(e.target.value)}
          >
            <option value="all">كل المناطق</option>
            {TYPES.slice(1).map(t => <option key={t} value={t}>{t}</option>)}
          </select>
        </div>
        <div className="filter-btns">
          {TYPES.map(t => (
            <button
              key={t}
              className={`filter-btn${activeType === t ? ' active' : ''}`}
              onClick={() => setActiveType(t)}
            >
              {TYPE_LABELS[t]}
            </button>
          ))}
        </div>
        <span className="results-count">عدد النتائج: {filtered.length}</span>
      </div>

      <div className="gallery-wrap">
        <div className="regions-grid" id="regionsGrid">
          {filtered.map(r => (
            <Link to={`/details/${r.id}`} className="region-card" key={r.id}>
              <div className="card-img-wrap">
                <img src={r.img} alt={r.name} />
                <span className="card-type-badge">{r.type}</span>
              </div>
              <div className="card-body">
                <h3>{r.name}</h3>
                <p>{r.desc}</p>
                <span className="card-arrow">← استكشف التفاصيل</span>
              </div>
            </Link>
          ))}
        </div>
        {filtered.length === 0 && (
          <div className="no-results" style={{ display: 'block' }}>
            <div className="icon">🔍</div>
            <p>لا توجد نتائج مطابقة لبحثك.</p>
          </div>
        )}
      </div>

      <Footer />
    </>
  );
}
