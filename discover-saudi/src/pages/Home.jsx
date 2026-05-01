import { Link } from 'react-router-dom';
import Footer from '../components/Footer';

export default function Home() {
  return (
    <>
      <section className="hero">
        <div className="hero-content">
          <div className="hero-text">
            <h1>موقع ثقافي تفاعلي للتعريف بالمملكة</h1>
            <p>
              استكشف مناطق المملكة العربية السعودية وتعرّف على أهم
              المعالم التاريخية والثقافية. اختر منطقة من المعرض للانتقال إلى
              صفحة التفاصيل.
            </p>
            <Link to="/regions" className="hero-cta">ابدأ الاستكشاف</Link>
          </div>
          <div className="hero-welcome">
            <span className="welcome-big">أهلاً بك</span>
            <span className="palm">🌴</span>
            <p>ابدأ رحلتك لاكتشاف مناطق المملكة</p>
          </div>
        </div>
      </section>

      <section className="cards-section">
        <div className="cards-grid">
          <div className="info-card">
            <div className="card-icon">⭐</div>
            <h3>الهدف</h3>
            <p>تقديم معلومات مرئية موثوقة عن مناطق المملكة وأبرز الوجهات.</p>
          </div>
          <div className="info-card">
            <div className="card-icon">🗺️</div>
            <h3>المناطق</h3>
            <p>معرض تفاعلي يتيح للمستخدم التنقل بين المناطق (صور + عناوين + روابط).</p>
          </div>
          <div className="info-card">
            <div className="card-icon">🏛️</div>
            <h3>التفاصيل</h3>
            <p>صفحة تعرض وصفاً وصوراً ومعلومات تاريخية وثقافية عن المكان.</p>
          </div>
        </div>
      </section>

      <section>
        <div className="about-section">
          <div className="about-text">
            <h2>عن المملكة العربية السعودية</h2>
            <p>
              المملكة العربية السعودية دولة عربية إسلامية تقع في قلب شبه الجزيرة العربية،
              تمتاز بتاريخ حضاري عريق وتنوع جغرافي فريد بين الصحاري والجبال والسواحل.
            </p>
            <p>
              تحتضن المملكة أقدس البقاع الإسلامية وتزخر بالمواقع التاريخية المسجّلة
              ضمن التراث العالمي لليونسكو، إلى جانب التطور العمراني المتسارع في إطار رؤية 2030.
            </p>
          </div>
          <div className="about-img">
            <img
              src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Riyadh_Financial_District_panorama.jpg/1280px-Riyadh_Financial_District_panorama.jpg"
              alt="الرياض"
            />
          </div>
        </div>
      </section>

      <section className="stats-section">
        <div className="stats-grid">
          <div className="stat-item">
            <div className="stat-num">13</div>
            <div className="stat-label">منطقة إدارية</div>
          </div>
          <div className="stat-item">
            <div className="stat-num">7</div>
            <div className="stat-label">مواقع تراث عالمي</div>
          </div>
          <div className="stat-item">
            <div className="stat-num">2030</div>
            <div className="stat-label">رؤية المستقبل</div>
          </div>
          <div className="stat-item">
            <div className="stat-num">2M+</div>
            <div className="stat-label">زائر سنوياً</div>
          </div>
        </div>
      </section>

      <Footer />
    </>
  );
}
