document.addEventListener('DOMContentLoaded', () => {
  const burgerButton = document.querySelector('.menu-burger');
  const mobileMenu = document.querySelector('.navlinks');
  const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');

  const setMobileMenu = isOpen => {
    mobileMenu?.classList.toggle('mobile-menu', isOpen);
    mobileMenuOverlay?.classList.toggle('is-visible', isOpen);
    burgerButton?.classList.toggle('is-open', isOpen);
    document.body.classList.toggle('menu-open', isOpen);
    burgerButton?.setAttribute('aria-expanded', String(isOpen));
    burgerButton?.setAttribute('aria-label', isOpen ? 'Fermer le menu' : 'Ouvrir le menu');
  };

  burgerButton?.addEventListener('click', event => {
    event.stopPropagation();
    const isOpen = !mobileMenu?.classList.contains('mobile-menu');
    setMobileMenu(isOpen);
  });

  mobileMenuOverlay?.addEventListener('click', () => setMobileMenu(false));

  const closeMobileMenu = () => setMobileMenu(false);

  mobileMenu?.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', closeMobileMenu);
  });

  document.addEventListener('click', event => {
    if (!mobileMenu?.classList.contains('mobile-menu')) return;
    if (mobileMenu.contains(event.target) || burgerButton?.contains(event.target)) return;
    closeMobileMenu();
  });

  document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && mobileMenu?.classList.contains('mobile-menu')) closeMobileMenu();
  });

  const spaceMenu = document.querySelector('.space-menu');
  const spaceMenuToggle = spaceMenu?.querySelector('.space-menu-toggle');
  const spaceMenuDropdown = spaceMenu?.querySelector('.space-menu-dropdown');

  const closeSpaceMenu = () => {
    if (!spaceMenuToggle || !spaceMenuDropdown) return;
    spaceMenuDropdown.hidden = true;
    spaceMenuToggle.setAttribute('aria-expanded', 'false');
  };

  spaceMenuToggle?.addEventListener('click', event => {
    event.stopPropagation();
    const willOpen = spaceMenuDropdown?.hidden ?? true;
    if (spaceMenuDropdown) spaceMenuDropdown.hidden = !willOpen;
    spaceMenuToggle.setAttribute('aria-expanded', String(willOpen));
  });

  document.addEventListener('click', event => {
    if (spaceMenu && !spaceMenu.contains(event.target)) closeSpaceMenu();
  });

  document.addEventListener('keydown', event => {
    if (event.key === 'Escape') {
      closeSpaceMenu();
      spaceMenuToggle?.focus();
    }
  });

  const showDashboardPanel = panelName => {
    if (!window.location.pathname.endsWith('/dashboard.php') && !window.location.pathname.endsWith('dashboard.php')) return;
    const panel = document.getElementById(panelName);
    if (!(panel instanceof HTMLDialogElement)) return;
    if (!panel.open) panel.showModal();
  };

  document.querySelectorAll('[data-dashboard-panel]').forEach(link => {
    link.addEventListener('click', event => {
      if (window.location.pathname.endsWith('/dashboard.php') || window.location.pathname.endsWith('dashboard.php')) {
        event.preventDefault();
        const panelName = link.dataset.dashboardPanel === 'danger' ? 'supprimer-compte' : 'paiement';
        closeSpaceMenu();
        showDashboardPanel(panelName);
      }
    });
  });

  document.querySelectorAll('[data-close-dashboard-modal]').forEach(button => {
    button.addEventListener('click', () => button.closest('dialog')?.close());
  });

  document.querySelectorAll('.dashboard-modal').forEach(dialog => {
    dialog.addEventListener('click', event => {
      if (event.target === dialog) dialog.close();
    });
  });

  if (window.location.hash === '#paiement') showDashboardPanel('paiement');
  if (window.location.hash === '#supprimer-compte') showDashboardPanel('supprimer-compte');

  document.querySelectorAll('input[type="search"]').forEach(input => {
    input.addEventListener('keydown', event => {
      if (event.key === 'Escape') input.value = '';
    });
  });

  const profileLayout = document.querySelector('.profile-editor-layout');
  const projectsSlide = document.querySelector('.portfolio-project-slide');
  const profileEditor = document.querySelector('.profile-editor-form');
  const livePreview = document.querySelector('.portfolio-live-preview');
  const profileForm = document.getElementById('portfolio-profile-form');
  const profileEditorToggle = document.querySelector('[data-profile-editor-toggle]');
  const profileEditorBody = document.getElementById('portfolio-profile-editor-body');

  profileEditorToggle?.addEventListener('click', () => {
    const willOpen = profileEditorBody?.hidden ?? false;
    if (!profileEditorBody) return;
    profileEditorBody.hidden = !willOpen;
    profileEditorToggle.setAttribute('aria-expanded', String(willOpen));
    profileEditorToggle.closest('.profile-editor-form')?.classList.toggle('is-open', willOpen);
    if (willOpen) profileLayout?.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });

  if (profileLayout && projectsSlide && livePreview) {
    profileLayout.insertBefore(projectsSlide, livePreview);
  }

  const showProfileStep = step => {
    if (!profileLayout || !projectsSlide || !profileForm) return;
    profileLayout.hidden = false;
    if (profileEditor) profileEditor.hidden = false;
    if (livePreview) livePreview.hidden = false;
    projectsSlide.hidden = true;
    if (profileEditorBody && profileEditorToggle) {
      profileEditorBody.hidden = false;
      profileEditorToggle.setAttribute('aria-expanded', 'true');
      profileEditorToggle.closest('.profile-editor-form')?.classList.add('is-open');
    }
    profileForm.querySelectorAll('[data-carousel-slide]').forEach((slide, index) => {
      slide.classList.toggle('is-active', index === step);
      slide.setAttribute('aria-hidden', index === step ? 'false' : 'true');
    });
    profileForm.querySelectorAll('[data-carousel-step]').forEach((button, index) => {
      button.classList.toggle('is-active', index === step);
      if (index === step) button.setAttribute('aria-current', 'step');
      else button.removeAttribute('aria-current');
    });
    const previousButton = profileForm.querySelector('[data-carousel-prev]');
    if (previousButton) previousButton.disabled = step === 0;
    const nextButton = profileForm.querySelector('[data-carousel-next]');
    if (nextButton) nextButton.textContent = step === 0 ? 'Suivant →' : 'Voir les projets →';
    profileLayout.scrollIntoView({ behavior: 'smooth', block: 'start' });
  };

  const showProjectsStep = () => {
    if (!profileLayout || !projectsSlide || !profileEditor || !livePreview) return;
    profileLayout.hidden = false;
    profileEditor.hidden = true;
    livePreview.hidden = false;
    projectsSlide.hidden = false;
    profileLayout.scrollIntoView({ behavior: 'smooth', block: 'start' });
  };

  const autosaveStatus = profileForm?.querySelector('[data-autosave-status]');
  let autosaveTimer;
  let autosaveController;

  const saveProfileAutomatically = () => {
    if (!profileForm) return;
    clearTimeout(autosaveTimer);
    autosaveTimer = setTimeout(async () => {
      if (autosaveController) autosaveController.abort();
      autosaveController = new AbortController();
      if (autosaveStatus) autosaveStatus.textContent = 'Enregistrement…';

      try {
        const response = await fetch(window.location.href, {
          method: 'POST',
          body: new FormData(profileForm),
          headers: { 'X-Autosave': '1' },
          signal: autosaveController.signal
        });
        const result = await response.json();
        if (autosaveStatus) {
          autosaveStatus.textContent = result.success ? '✓ Modifications enregistrées' : result.message;
          autosaveStatus.classList.toggle('is-error', !result.success);
        }
      } catch (error) {
        if (error.name !== 'AbortError' && autosaveStatus) {
          autosaveStatus.textContent = 'L’enregistrement automatique a échoué.';
          autosaveStatus.classList.add('is-error');
        }
      }
    }, 700);
  };

  profileForm?.querySelectorAll('input:not([type="hidden"]), textarea, select').forEach(field => {
    field.addEventListener(field.type === 'checkbox' || field.type === 'file' ? 'change' : 'input', saveProfileAutomatically);
  });

  profileForm?.querySelectorAll('[data-carousel-step]').forEach(button => {
    button.addEventListener('click', () => showProfileStep(Number(button.dataset.carouselStep)));
  });
  profileForm?.querySelector('[data-carousel-prev]')?.addEventListener('click', () => {
    const currentSlide = Number(profileForm.querySelector('[data-carousel-slide].is-active')?.dataset.carouselSlide || 0);
    showProfileStep(Math.max(0, currentSlide - 1));
  });
  profileForm?.querySelector('[data-carousel-next]')?.addEventListener('click', () => {
    const currentSlide = profileForm.querySelector('[data-carousel-slide].is-active');
    const requiredFields = [...(currentSlide?.querySelectorAll('[required]') || [])];
    if (requiredFields.some(field => !field.checkValidity())) {
      requiredFields.find(field => !field.checkValidity())?.reportValidity();
      return;
    }
    const slideNumber = Number(currentSlide?.dataset.carouselSlide || 0);
    if (slideNumber === 0) showProfileStep(1);
    else showProjectsStep();
  });
  profileForm?.querySelector('[data-show-project-step]')?.addEventListener('click', showProjectsStep);
  document.querySelectorAll('[data-show-profile-step]').forEach(button => {
    button.addEventListener('click', () => showProfileStep(Number(button.dataset.showProfileStep)));
  });
  document.querySelector('[data-show-identity-step]')?.addEventListener('click', () => showProfileStep(0));

  const deleteDialog = document.getElementById('delete-account-dialog');
  if (deleteDialog) {
    document.querySelector('[data-open-delete-account]')?.addEventListener('click', () => {
      document.getElementById('supprimer-compte')?.close();
      deleteDialog.showModal();
      deleteDialog.querySelector('[name="confirm_password"]')?.focus();
    });

    document.querySelector('[data-close-delete-account]')?.addEventListener('click', () => {
      deleteDialog.close();
    });

    deleteDialog.addEventListener('click', event => {
      if (event.target === deleteDialog) deleteDialog.close();
    });

    deleteDialog.addEventListener('close', () => {
      deleteDialog.querySelector('[name="confirm_password"]')?.select();
    });
  }
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


window.addEventListener('scroll', function () {
  const maxScroll = 300;
  const scrollY = window.scrollY;
  const tel = document.querySelector('.phone');
  if (!tel) return;
  const rotation = Math.max(0, 0 - (scrollY / maxScroll) * -0);
  const translateY = (scrollY / 300) * 20;
  tel.style.transform = `rotate(${rotation}deg)`;
  tel.style.transition = 'transform 18s ease';
});

document.addEventListener('DOMContentLoaded', function () {
  const header = document.querySelector('.topbar');
  if (!header) return;

  const onScrollHeader = () => {
    const currentScroll = window.scrollY;
    if (currentScroll <= 8) {
      header.classList.remove('header-hidden');
      return;
    }
    header.classList.add('header-hidden');
  };

  onScrollHeader();
  window.addEventListener('scroll', onScrollHeader, { passive: true });
});

const revealObserver = new IntersectionObserver(
  entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        revealObserver.unobserve(entry.target);
      }
    });
  },
  { threshold: 0.12 }
);

const revealTargets = document.querySelectorAll('.hero, .results-head, .join-banner, .profolio-about, .profolio-how-it-works');

revealTargets.forEach((element, index) => {
  element.classList.add('reveal');
  element.style.transitionDelay = `${index * 120}ms`;
  revealObserver.observe(element);
});

<<<<<<< HEAD
// menu burgeer


const menuburger = document.querySelector(".menu-burger")
const navlinks = document.querySelector(".navlinks")
menuburger.addEventListener('click', () => {
  navlinks.classList.toggle('mobile-menu')
  document.body.classList.toggle("menu-open");

})

=======
 
>>>>>>> 60cbdef2f1fb4c056bead0162e1fc90c1b9ab033
