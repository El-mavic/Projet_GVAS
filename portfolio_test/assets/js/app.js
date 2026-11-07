document.addEventListener('DOMContentLoaded', () => {
  const feedbackForm = document.getElementById('public-feedback-form');
  const feedbackMessage = feedbackForm?.querySelector('[name="feedback_message"]');
  const feedbackCounter = document.getElementById('feedback-character-current');
  const feedbackStatus = document.getElementById('public-feedback-status');

  feedbackMessage?.addEventListener('input', () => {
    if (feedbackCounter) feedbackCounter.textContent = feedbackMessage.value.length;
  });

  feedbackForm?.addEventListener('submit', event => {
    event.preventDefault();
    if (!feedbackForm.checkValidity()) {
      feedbackForm.reportValidity();
      return;
    }
    if (feedbackStatus) {
      feedbackStatus.textContent = 'Merci pour votre message. Votre retour a bien été préparé pour l’équipe Profolio.';
      feedbackStatus.classList.add('is-success');
    }
    feedbackForm.reset();
    if (feedbackCounter) feedbackCounter.textContent = '0';
  });

  const setupProfileRepeaters = () => {
    document.querySelectorAll('[data-profile-repeater]').forEach(repeater => {
      const itemsContainer = repeater.querySelector('.profile-repeat-items');
      const hiddenValue = repeater.querySelector('input[type="hidden"]');
      const placeholder = repeater.dataset.placeholder || '';
      const suggestions = itemsContainer.dataset.repeatSuggestions?.split(',').map(value => value.trim()).filter(Boolean) || [];
      if (!itemsContainer || !hiddenValue) return;

      const syncRepeater = () => {
        const values = Array.from(itemsContainer.querySelectorAll('[data-profile-repeat-field]'))
          .map(input => input.value.trim())
          .filter(Boolean);
        hiddenValue.value = values.join('\n');
      };

      const addRepeaterRow = (value = '') => {
        const row = document.createElement('div');
        row.className = 'profile-repeat-row';
        const input = document.createElement('input');
        input.type = repeater.dataset.inputType === 'url' ? 'url' : 'text';
        input.dataset.profileRepeatField = '';
        input.placeholder = placeholder;
        input.value = value;
        input.autocomplete = 'off';
        if (suggestions.length) {
          const suggestionsId = `${repeater.dataset.profileRepeater}-suggestions-${Math.random().toString(36).slice(2)}`;
          input.setAttribute('list', suggestionsId);
          const datalist = document.createElement('datalist');
          datalist.id = suggestionsId;
          suggestions.forEach(suggestion => {
            const option = document.createElement('option');
            option.value = suggestion;
            datalist.appendChild(option);
          });
          row.appendChild(datalist);
        }
        const remove = document.createElement('button');
        remove.type = 'button';
        remove.className = 'profile-repeat-remove';
        remove.setAttribute('aria-label', 'Supprimer cet élément');
        remove.innerHTML = '<i class="fa-solid fa-trash-can"></i>';
        input.addEventListener('input', () => {
          syncRepeater();
          input.dispatchEvent(new Event('change', { bubbles: true }));
        });
        remove.addEventListener('click', () => {
          row.remove();
          syncRepeater();
          if (!itemsContainer.children.length) addRepeaterRow();
          itemsContainer.querySelector('[data-profile-repeat-field]')?.dispatchEvent(new Event('change', { bubbles: true }));
        });
        if (repeater.dataset.profileRepeater === 'certifications') {
          row.classList.add('profile-repeat-row-with-media');
          const media = document.createElement('div');
          media.className = 'profile-repeat-media';
          const fileLabel = document.createElement('label');
          fileLabel.className = 'profile-repeat-file';
          fileLabel.innerHTML = '<i class="fa-solid fa-image"></i><span>Ajouter une image</span>';
          const fileInput = document.createElement('input');
          fileInput.type = 'file';
          fileInput.name = 'certification_images[]';
          fileInput.accept = 'image/jpeg,image/png,image/webp';
          const preview = document.createElement('img');
          preview.className = 'profile-repeat-media-preview';
          preview.alt = 'Aperçu du diplôme ou certificat';
          preview.hidden = true;
          fileInput.addEventListener('change', () => {
            const file = fileInput.files?.[0];
            if (!file) {
              preview.hidden = true;
              preview.removeAttribute('src');
              return;
            }
            const reader = new FileReader();
            reader.onload = () => {
              preview.src = String(reader.result);
              preview.hidden = false;
            };
            reader.readAsDataURL(file);
          });
          fileLabel.appendChild(fileInput);
          media.append(fileLabel, preview);
          row.append(input, media, remove);
        } else {
          row.append(input, remove);
        }
        itemsContainer.appendChild(row);
      };

      const existingSeparator = ['langues', 'centre_interet', 'competences'].includes(repeater.dataset.profileRepeater) ? /[\n,]+/ : /\n+/;
      const existingValues = hiddenValue.value.split(existingSeparator).map(value => value.trim()).filter(Boolean);
      existingValues.forEach(value => addRepeaterRow(value));
      if (!itemsContainer.children.length) addRepeaterRow();

      repeater.querySelector('[data-add-profile-item]')?.addEventListener('click', () => {
        addRepeaterRow();
        itemsContainer.lastElementChild?.querySelector('input')?.focus();
      });
    });
  };
  setupProfileRepeaters();

  const profilePhoneForm = document.getElementById('portfolio-profile-form');
  const phoneCode = profilePhoneForm?.querySelector('[name="indicatif_telephone"]');
  const phoneLocal = profilePhoneForm?.querySelector('[name="telephone_local"]');
  const phoneCustomCode = profilePhoneForm?.querySelector('[name="indicatif_personnalise"]');
  const phoneValue = profilePhoneForm?.querySelector('[name="telephone"]');

  const syncProfilePhone = () => {
    if (!phoneCode || !phoneLocal || !phoneValue) return;
    const localNumber = phoneLocal.value.replace(/[^0-9]/g, '').replace(/^0/, '');
    const useCustomCode = phoneCode.value === 'other';
    let prefix = phoneCode.value;
    if (useCustomCode && phoneCustomCode) {
      prefix = phoneCustomCode.value.trim().replace(/[^+0-9]/g, '');
      if (prefix && !prefix.startsWith('+')) prefix = `+${prefix}`;
    }
    phoneCustomCode?.toggleAttribute('hidden', !useCustomCode);
    phoneCustomCode?.closest('.phone-input-group')?.toggleAttribute('data-custom-code', useCustomCode);
    phoneValue.value = localNumber ? `${prefix}${localNumber}` : phoneValue.value;
  };

  if (phoneCode && phoneLocal && phoneValue) {
    const savedPhone = phoneValue.value.trim();
    if (/^\+/.test(savedPhone)) {
      const matchingCode = Array.from(phoneCode.options)
        .filter(option => option.value !== 'other')
        .find(option => savedPhone.startsWith(option.value));
      if (matchingCode) {
        phoneCode.value = matchingCode.value;
        phoneLocal.value = savedPhone.slice(matchingCode.value.length);
      } else {
        phoneCode.value = 'other';
        const codeMatch = savedPhone.match(/^\+\d{1,4}/);
        if (phoneCustomCode) phoneCustomCode.value = codeMatch?.[0] || '';
        phoneLocal.value = codeMatch ? savedPhone.slice(codeMatch[0].length) : savedPhone;
      }
    } else {
      phoneLocal.value = savedPhone;
    }
    phoneCode.addEventListener('change', syncProfilePhone);
    phoneLocal.addEventListener('input', syncProfilePhone);
    phoneCustomCode?.addEventListener('input', syncProfilePhone);
    syncProfilePhone();
  }

  profilePhoneForm?.addEventListener('submit', syncProfilePhone);

  const dashboardGreeting = document.querySelector('.dashboard-greeting');
  const updateDashboardGreeting = () => {
    if (!dashboardGreeting) return;
    const hour = new Date().getHours();
    dashboardGreeting.textContent = hour >= 6 && hour < 18 ? 'Bonjour' : 'Bonsoir';
  };
  updateDashboardGreeting();
  window.setInterval(updateDashboardGreeting, 60000);

  const burgerButton = document.querySelector('.menu-burger');
  const mobileMenu = document.querySelector('.navlinks');
  const setMobileMenu = isOpen => {
    mobileMenu?.classList.toggle('mobile-menu', isOpen);
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
    profileForm.querySelectorAll('[data-carousel-step]').forEach((step, index) => {
      step.classList.toggle('is-active', index === 2);
      if (index === 2) step.setAttribute('aria-current', 'step');
      else step.removeAttribute('aria-current');
    });
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
    value('competences').split(/[\n,]+/).map(s => s.trim()).filter(Boolean).slice(0, 14).forEach(skill => {
      const tag = document.createElement('span');
      tag.textContent = skill;
      container.appendChild(tag);
    });
  };
  const updateExtra = () => {
    const langs = value('langues');
    const interests = value('centre_interet');
    const formatList = text => text.split(/[\n,]+/).map(item => item.trim()).filter(Boolean).join(' · ');
    const extraParts = [];
    if (langs) extraParts.push(`Langues : ${formatList(langs)}`);
    if (interests) extraParts.push(`Loisirs : ${formatList(interests)}`);
    setText('preview-extra', extraParts.join('\n'), 'Vos langues et centres d’intérêt apparaîtront ici.');
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
  form.querySelectorAll('input:not([type=file]), textarea').forEach(el => {
    el.addEventListener('input', update);
    el.addEventListener('change', update);
  });
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
>>>>>>> 1da3a5ae72a0207ca9cf74fdbf6e42a15e82e66e
