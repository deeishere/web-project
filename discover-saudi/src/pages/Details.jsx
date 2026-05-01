import { useState } from 'react';
import { Link, useParams } from 'react-router-dom';
import { regionsData, regionNavLinks } from '../data/regions';
import Footer from '../components/Footer';

export default function Details() {
  const { id } = useParams();
  const regionId = parseInt(id) || 1;
  const data = regionsData[regionId] || regionsData[1];
  const [lightboxSrc, setLightboxSrc] = useState(null);

  return (
    <>
      <div className="breadcrumb">
        <Link to="/">الرئيسية</Link>
        <span>›</span>
        <Link to="/regions">معرض المناطق</Link>
        <span>›</span>
        <span>{data.title}</span>
      </div>

      <div className="detail-hero">
        <div className="hero-img-wrap">
          <img src={data.heroImg} alt={data.title} />
          <div className="hero-img-caption">
            <h1>{data.title}</h1>
            <p>{data.subtitle}</p>
          </div>
        </div>
      </div>

      <div className="detail-body">
        <div>
          <div className="section-block">
            <h2>نبذة تاريخية وثقافية</h2>
            <p>{data.desc}</p>
          </div>

          <div className="section-block">
            <h2>معلومات سريعة</h2>
            <ul className="info-list">
              {data.quickInfo.map((item, i) => <li key={i}>{item}</li>)}
            </ul>
          </div>

          <div className="section-block">
            <h2>أبرز المعالم</h2>
            <ul className="landmarks-list">
              {data.landmarks.map((l, i) => {
                const parts = l.split(' ');
                const emoji = parts[0];
                const text = parts.slice(1).join(' ');
                return (
                  <li key={i}>
                    <span className="landmark-icon">{emoji}</span>
                    {text}
                  </li>
                );
              })}
            </ul>
          </div>

          <div className="section-block">
            <h2>معرض الصور</h2>
            <div className="gallery-grid">
              {data.images.map((img, i) => (
                <img
                  key={i}
                  src={img}
                  alt={data.title}
                  onClick={() => setLightboxSrc(img)}
                />
              ))}
            </div>
          </div>

          <Link to="/regions" className="back-btn">← العودة إلى معرض المناطق</Link>
        </div>

        {/* Sidebar */}
        <div className="sidebar">
          <div className="meta-card">
            <h3>📍 معلومات المنطقة</h3>
            <div className="meta-row">
              <span className="meta-label">الموقع</span>
              <span className="meta-value">{data.location}</span>
            </div>
            <div className="meta-row">
              <span className="meta-label">التصنيف</span>
              <span className="meta-value">{data.type}</span>
            </div>
            <div className="meta-row">
              <span className="meta-label">أبرز المميزات</span>
              <span className="meta-value">{data.feature}</span>
            </div>
            <div className="meta-row">
              <span className="meta-label">أفضل وقت للزيارة</span>
              <span className="meta-value">{data.season}</span>
            </div>
          </div>

          <div className="meta-card" style={{ borderTopColor: 'var(--green-light)' }}>
            <h3>🗺️ تصفح مناطق أخرى</h3>
            <div className="nav-regions">
              {regionNavLinks.map(r => (
                <Link
                  key={r.id}
                  to={`/details/${r.id}`}
                  className={`region-link${regionId === r.id ? ' current' : ''}`}
                >
                  {r.emoji} {r.name}
                </Link>
              ))}
            </div>
          </div>
        </div>
      </div>

      {/* Lightbox */}
      {lightboxSrc && (
        <div className="lightbox open" onClick={() => setLightboxSrc(null)}>
          <button className="lightbox-close" onClick={() => setLightboxSrc(null)}>✕</button>
          <img src={lightboxSrc} alt="" onClick={e => e.stopPropagation()} />
        </div>
      )}

      <Footer />
    </>
  );
}
