<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap');

  *,
  *::before,
  *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {

    background-image: url(images/Images/gallerie.jpg);
  }

  .gallery-section {
    font-family: 'DM Sans', sans-serif;
    padding: 3rem 2rem;
    background: var(--color-background-tertiary);
    min-height: 100vh;
  }

  .gallery-header {
    text-align: center;
    margin-bottom: 2.5rem;
  }

  .gallery-header h2 {
    font-family: 'Playfair Display', serif;
    font-size: 4.2rem;
    font-weight: 400;
    color: #f1d124;
    letter-spacing: -0.02em;
    line-height: 1.1;
  }

  .gallery-header h2 em {
    font-style: italic;
    color: #B4B2A9;
  }

  .gallery-header p {
    margin-top: 0.6rem;
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--color-text-secondary);
  }

  .gallery-filters {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
  }

  .filter-btn {
    font-family: 'DM Sans', sans-serif;
    font-size: 0.78rem;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 0.45rem 1.1rem;
    border: 0.5px solid var(--color-border-secondary);
    border-radius: 999px;
    background: transparent;
    color: var(--color-text-secondary);
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .filter-btn:hover {
    background: var(--color-background-secondary);
    color: var(--color-text-primary);
  }

  .filter-btn.active {
    background: var(--color-text-primary);
    color: var(--color-background-primary);
    border-color: var(--color-text-primary);
  }

  .gallery-grid {
    columns: 3;
    column-gap: 1rem;
    max-width: 1100px;
    margin: 0 auto;
  }

  @media (max-width: 720px) {
    .gallery-grid {
      columns: 2;
    }
  }

  @media (max-width: 440px) {
    .gallery-grid {
      columns: 1;
    }
  }

  .gallery-item {
    break-inside: avoid;
    margin-bottom: 1rem;
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    background: var(--color-background-secondary);
  }

  .gallery-item img {
    width: 100%;
    display: block;
    transition: transform 0.55s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    will-change: transform;
  }

  .gallery-item-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.72) 0%, transparent 55%);
    opacity: 0;
    transition: opacity 0.35s ease;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 1.2rem;
  }

  .gallery-item:hover .gallery-item-overlay {
    opacity: 1;
  }

  .gallery-item:hover img {
    transform: scale(1.05);
  }

  .overlay-title {
    font-family: 'Playfair Display', serif;
    font-size: 1rem;
    font-weight: 600;
    color: #fff;
    margin-bottom: 0.2rem;
    transform: translateY(6px);
    transition: transform 0.35s ease;
  }

  .overlay-tag {
    font-size: 0.7rem;
    font-weight: 400;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.65);
    transform: translateY(6px);
    transition: transform 0.35s ease 0.04s;
  }

  .gallery-item:hover .overlay-title,
  .gallery-item:hover .overlay-tag {
    transform: translateY(0);
  }

  .zoom-icon {
    position: absolute;
    top: 0.8rem;
    right: 0.8rem;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(6px);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .gallery-item:hover .zoom-icon {
    opacity: 1;
  }

  .zoom-icon svg {
    width: 14px;
    height: 14px;
    stroke: #fff;
    fill: none;
  }

  /* ── Lightbox ── */
  .lightbox-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(10, 10, 10, 0.96);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
  }

  .lightbox-backdrop.open {
    opacity: 1;
    pointer-events: all;
  }

  .lightbox-inner {
    position: relative;
    max-width: 90vw;
    max-height: 90vh;
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .lightbox-card {
    background: #111;
    border-radius: 16px;
    overflow: hidden;
    max-width: 82vw;
    max-height: 88vh;
    display: flex;
    flex-direction: column;
    transform: scale(0.92);
    transition: transform 0.35s cubic-bezier(0.34, 1.26, 0.64, 1);
    box-shadow: 0 32px 80px rgba(0, 0, 0, 0.7);
  }

  .lightbox-backdrop.open .lightbox-card {
    transform: scale(1);
  }

  .lightbox-card img {
    max-width: 100%;
    max-height: 70vh;
    object-fit: contain;
    display: block;
  }

  .lightbox-info {
    padding: 1rem 1.4rem 1.2rem;
    border-top: 0.5px solid rgba(255, 255, 255, 0.08);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .lightbox-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.05rem;
    color: #f0ece4;
    font-weight: 400;
  }

  .lightbox-meta {
    font-size: 0.72rem;
    color: rgba(255, 255, 255, 0.35);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-top: 0.2rem;
  }

  .lightbox-counter {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.3);
    letter-spacing: 0.06em;
  }

  .lb-nav {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 0.5px solid rgba(255, 255, 255, 0.15);
    background: rgba(255, 255, 255, 0.06);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.15s ease;
    flex-shrink: 0;
    backdrop-filter: blur(8px);
  }

  .lb-nav:hover {
    background: rgba(255, 255, 255, 0.14);
    transform: scale(1.08);
  }

  .lb-nav svg {
    width: 18px;
    height: 18px;
    stroke: #fff;
    fill: none;
    stroke-width: 2;
  }

  .lb-close {
    position: fixed;
    top: 1.2rem;
    right: 1.2rem;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.08);
    border: 0.5px solid rgba(255, 255, 255, 0.12);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s ease;
    z-index: 10000;
  }

  .lb-close:hover {
    background: rgba(255, 255, 255, 0.18);
  }

  .lb-close svg {
    width: 16px;
    height: 16px;
    stroke: #fff;
    fill: none;
    stroke-width: 2;
  }

  .lb-strip {
    position: fixed;
    bottom: 1.2rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 6px;
    z-index: 10000;
  }

  .lb-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.25);
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
  }

  .lb-dot.active {
    background: #fff;
    transform: scale(1.4);
  }

  .gallery-item.hidden {
    display: none;
  }
</style>

<section class="gallery-section">
  <div class="gallery-header">
    <h2>GROUPE VISION D'AIGLE SERVICES</h2>
    <p>Vivre une galerie speciale pour nos activitées</p>
  </div>

  <div class="gallery-grid" id="gallery"></div>
</section>

<div class="lightbox-backdrop" id="lightbox">
  <button class="lb-close" id="lb-close">
    <svg viewBox="0 0 24 24">
      <line x1="18" y1="6" x2="6" y2="18" />
      <line x1="6" y1="6" x2="18" y2="18" />
    </svg>
  </button>
  <div class="lightbox-inner">
    <button class="lb-nav" id="lb-prev">
      <svg viewBox="0 0 24 24">
        <polyline points="15 18 9 12 15 6" />
      </svg>
    </button>
    <div class="lightbox-card">
      <img id="lb-img" src="" alt="">
      <div class="lightbox-info">
        <div>
          <div class="lightbox-title" id="lb-title"></div>
          <div class="lightbox-meta" id="lb-tag"></div>
        </div>
        <div class="lightbox-counter" id="lb-counter"></div>
      </div>
    </div>
    <button class="lb-nav" id="lb-next">
      <svg viewBox="0 0 24 24">
        <polyline points="9 18 15 12 9 6" />
      </svg>
    </button>
  </div>
  <div class="lb-strip" id="lb-strip"></div>
</div>

<script>
  const photos = [];

  for (let i = 1; i <= 26; i++) {
    photos.push({
      src: `images/BG/${i}.jpg`,
      title: "GVAS",
      tag: "formation"
    });
  }

  const grid = document.getElementById('gallery');
  const lb = document.getElementById('lightbox');
  const lbImg = document.getElementById('lb-img');
  const lbTitle = document.getElementById('lb-title');
  const lbTag = document.getElementById('lb-tag');
  const lbCounter = document.getElementById('lb-counter');
  const lbStrip = document.getElementById('lb-strip');

  let currentIndex = 0;
  let visiblePhotos = [...photos];

  function buildGallery(filter) {
    grid.innerHTML = '';
    visiblePhotos = filter === 'all' ? [...photos] : photos.filter(p => p.tag === filter);
    visiblePhotos.forEach((p, i) => {
      const item = document.createElement('div');
      item.className = 'gallery-item';
      item.innerHTML = `
      <img src="${p.src}" alt="${p.title}" loading="lazy">
      <div class="gallery-item-overlay">
        <div class="overlay-title">${p.title}</div>
        <div class="overlay-tag">${p.tag}</div>
      </div>
      <div class="zoom-icon">
        <svg viewBox="0 0 24 24" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
      </div>`;
      item.addEventListener('click', () => openLightbox(i));
      grid.appendChild(item);
    });

    lbStrip.innerHTML = '';
    visiblePhotos.forEach((_, i) => {
      const dot = document.createElement('div');
      dot.className = 'lb-dot' + (i === currentIndex ? ' active' : '');
      dot.addEventListener('click', () => {
        currentIndex = i;
        updateLightbox();
      });
      lbStrip.appendChild(dot);
    });
  }

  function updateLightbox() {
    const p = visiblePhotos[currentIndex];
    lbImg.style.opacity = 0;
    lbImg.style.transform = 'scale(0.96)';
    setTimeout(() => {
      lbImg.src = p.src;
      lbImg.alt = p.title;
      lbTitle.textContent = p.title;
      lbTag.textContent = p.tag.toUpperCase();
      lbCounter.textContent = (currentIndex + 1) + ' / ' + visiblePhotos.length;
      lbImg.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
      lbImg.style.opacity = 1;
      lbImg.style.transform = 'scale(1)';
      document.querySelectorAll('.lb-dot').forEach((d, i) => d.classList.toggle('active', i === currentIndex));
    }, 120);
  }

  function openLightbox(i) {
    currentIndex = i;
    lb.classList.add('open');
    document.body.style.overflow = 'hidden';
    updateLightbox();
  }

  function closeLightbox() {
    lb.classList.remove('open');
    document.body.style.overflow = '';
  }

  document.getElementById('lb-close').addEventListener('click', closeLightbox);
  lb.addEventListener('click', e => {
    if (e.target === lb) closeLightbox();
  });

  document.getElementById('lb-prev').addEventListener('click', e => {
    e.stopPropagation();
    currentIndex = (currentIndex - 1 + visiblePhotos.length) % visiblePhotos.length;
    updateLightbox();
  });

  document.getElementById('lb-next').addEventListener('click', e => {
    e.stopPropagation();
    currentIndex = (currentIndex + 1) % visiblePhotos.length;
    updateLightbox();
  });

  document.addEventListener('keydown', e => {
    if (!lb.classList.contains('open')) return;
    if (e.key === 'ArrowLeft') {
      currentIndex = (currentIndex - 1 + visiblePhotos.length) % visiblePhotos.length;
      updateLightbox();
    }
    if (e.key === 'ArrowRight') {
      currentIndex = (currentIndex + 1) % visiblePhotos.length;
      updateLightbox();
    }
    if (e.key === 'Escape') closeLightbox();
  });

  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      buildGallery(btn.dataset.filter);
    });
  });

  buildGallery('all');
</script>