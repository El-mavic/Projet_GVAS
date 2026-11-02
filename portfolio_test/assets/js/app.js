document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('input[type="search"]').forEach(input => {
    input.addEventListener('keydown', event => {
      if (event.key === 'Escape') input.value = '';
    });
  });
});

// Aperçu du portfolio actualisé pendant que le membre remplit son profil.
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('.profile-editor-form form');
  if (!form) return;
  const value = name => (form.querySelector(`[name="${name}"]`)?.value || '').trim();
  const setText = (id, text, fallback) => {
    const el = document.getElementById(id);
    if (el) el.textContent = text || fallback;
  };
  const updateSkills = () => {
    const container = document.getElementById('preview-skills');
    if (!container) return;
    container.replaceChildren();
    value('competences').split(',').map(s => s.trim()).filter(Boolean).slice(0, 14).forEach(skill => {
      const tag = document.createElement('span');
      tag.textContent = skill;
      container.appendChild(tag);
    });
  };
  const updateExtra = () => {
    const langs = value('langues');
    const interests = value('centre_interet');
    setText('preview-extra', [langs, interests].filter(Boolean).join(' · '), 'Vos langues et centres d’intérêt apparaîtront ici.');
  };
  const updateCv = file => {
    const container = document.getElementById('preview-cv');
    if (!container) return;
    container.replaceChildren();
    const label = document.createElement('span');
    label.textContent = file ? `📄 CV sélectionné : ${file.name}` : '📄 Votre CV apparaîtra ici après ajout.';
    container.appendChild(label);
    if (!file) {
      const existingLink = document.querySelector('.current-file a');
      if (existingLink) {
        const link = document.createElement('a'); link.href = existingLink.href; link.target = '_blank'; link.rel = 'noopener'; link.textContent = 'Consulter le CV ↗'; container.appendChild(link);
      }
    }
  };
  const updateImage = (inputName, targetId, isCover = false) => {
    const input = form.querySelector(`[name="${inputName}"]`);
    const target = document.getElementById(targetId);
    if (!input || !target || !input.files || !input.files[0]) return;
    const file = input.files[0];
    if (!file.type.startsWith('image/')) return;
    const url = URL.createObjectURL(file);
    if (isCover) target.style.backgroundImage = `url("${url}")`;
    else {
      target.src = url;
      target.hidden = false;
      const initial = document.getElementById('preview-initial');
      if (initial) initial.hidden = true;
    }
  };
  const update = () => {
    const name = value('nom');
    setText('preview-name', name, 'Votre nom complet');
    setText('preview-job', value('metier'), 'Votre métier ou spécialité');
    setText('preview-location', value('localisation'), 'Votre ville / pays');
    setText('preview-bio', value('bio'), 'Votre présentation personnelle apparaîtra ici.');
    setText('preview-formation', value('formation'), 'Vos formations apparaîtront ici.');
    setText('preview-experience', value('experience'), 'Vos expériences apparaîtront ici.');
    setText('preview-certifications', value('certifications'), 'Vos certifications apparaîtront ici.');
    const initial = document.getElementById('preview-initial');
    if (initial && document.getElementById('preview-photo')?.hidden) {
      initial.textContent = (name || 'P').charAt(0).toLocaleUpperCase();
    }
    updateSkills(); updateExtra();
  };
  form.querySelectorAll('input:not([type=file]), textarea').forEach(el => el.addEventListener('input', update));
  form.querySelector('[name="photo"]')?.addEventListener('change', () => updateImage('photo', 'preview-photo'));
  form.querySelector('[name="cover_photo"]')?.addEventListener('change', () => updateImage('cover_photo', 'preview-cover', true));
  form.querySelector('[name="cv"]')?.addEventListener('change', event => updateCv(event.target.files?.[0] || null));
  update();
});


// Rotation du téléphone avec transition pour ne pas casser l'effet./.


   window.addEventListener('scroll', function() {
    const maxScroll = 300;
    const scrollY = window.scrollY;
    const tel = document.querySelector('.phone');
    if (!tel) return;
    const rotation = Math.max(0, 0 - (scrollY / maxScroll) * -0);
    const translateY = (scrollY / 300) * 20;
    // if (tel) {
    tel.style.transform = `rotate(${rotation}deg)`;
    tel.style.transition = 'transform 18s ease';
    // }
  });



  

  
//Animation du header lors du scroll.

document.addEventListener("DOMContentLoaded", function () {

  const header = document.querySelector(".topbar");

  if (!header) return;

  let lastScroll = window.scrollY;

  window.addEventListener("scroll", function () {

    const currentScroll = window.scrollY;

    if (currentScroll > lastScroll && currentScroll > 100) {
      // On descend : cacher le header
      header.classList.add("header-hidden");
    } else {
      // On remonte : afficher le header
      header.classList.remove("header-hidden");
    }

    lastScroll = currentScroll;
  });

});

