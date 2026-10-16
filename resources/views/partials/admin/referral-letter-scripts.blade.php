<script>
  (function () {
    var letterFieldMap = {
      date_display: 'date_display',
      recipient_name: 'recipient_name',
      recipient_title: 'recipient_title',
      company: 'company',
      city: 'city',
      position: 'position',
      candidate_display: 'candidate_display',
      pronoun_possessive: 'pronoun_possessive',
      born: 'born',
      address: 'address',
      phone: 'phone',
      email: 'email',
      education: 'education',
      skills: 'skills',
      signatory_name: 'signatory_name',
      signatory_title: 'signatory_title',
    };

    window.renderOfficialReferralLetter = function (root, data) {
      if (!root || !data) return;

      Object.keys(letterFieldMap).forEach(function (field) {
        var key = letterFieldMap[field];
        var el = root.querySelector('[data-letter-field="' + field + '"]');
        if (!el) return;
        var value = data[key];
        el.textContent = value === null || value === undefined || value === '' ? '—' : value;
      });

      var positionWrap = root.querySelector('[data-letter-field="position"]');
      if (positionWrap && data.position) {
        positionWrap.textContent = data.position;
      }
    };

    function honorificForGender(gender, name) {
      name = (name || '').trim();
      if (!name) return 'The registrant';
      var g = (gender || '').toLowerCase();
      if (g === 'female' || g === 'f') return 'Ms. ' + name;
      if (g === 'male' || g === 'm') return 'Mr. ' + name;
      return name;
    }

    function possessiveForGender(gender) {
      var g = (gender || '').toLowerCase();
      if (g === 'female' || g === 'f') return 'her';
      if (g === 'male' || g === 'm') return 'his';
      return 'their';
    }

    function syncCreateReferralLetterPreview() {
      var root = document.querySelector('#form-create-referral [data-letter-root]');
      if (!root) return;

      var nameInput = document.getElementById('referral_name');
      var genderInput = document.getElementById('referral_gender');
      var gender = genderInput ? genderInput.value : '';
      var name = nameInput ? nameInput.value.trim() : '';

      var displayEl = root.querySelector('[data-letter-field="candidate_display"]');
      if (displayEl) displayEl.textContent = honorificForGender(gender, name) || 'The registrant';

      var posEl = root.querySelector('[data-letter-field="position"]');
      var jobSelect = document.getElementById('referral_job');
      if (posEl && jobSelect && jobSelect.value) posEl.textContent = jobSelect.options[jobSelect.selectedIndex].text;

      var pronounEl = root.querySelector('[data-letter-field="pronoun_possessive"]');
      if (pronounEl) pronounEl.textContent = possessiveForGender(gender);
    }

    function bindCreateReferralForm() {
      var form = document.getElementById('form-create-referral');
      if (!form || form.dataset.bound === '1') return;
      form.dataset.bound = '1';

      var employerSelect = document.getElementById('referral_employer_id');
      var applicantSelect = document.getElementById('referral_applicant_id');
      var recipientInput = document.getElementById('referral_recipient_name');
      var cityInput = document.getElementById('referral_recipient_city');
      var companyMirror = document.getElementById('referral_company_mirror');
      var genderInput = document.getElementById('referral_gender');

      function applyEmployerOption() {
        if (!employerSelect) return;
        var option = employerSelect.options[employerSelect.selectedIndex];
        if (!option || !option.value) return;

        var companyName = option.getAttribute('data-name') || option.textContent.trim();
        var contactPerson = (option.getAttribute('data-contact') || '').trim();
        var address = option.getAttribute('data-address') || '';

        if (companyMirror) companyMirror.textContent = companyName || 'Company name';

        if (recipientInput) recipientInput.value = contactPerson;

        var recipientDisplay = document.getElementById('referral_recipient_name_display');
        if (recipientDisplay) {
          recipientDisplay.textContent = contactPerson ? contactPerson.toUpperCase() : '—';
        }

        if (cityInput) {
          if (/ozamiz\s*city/i.test(address)) {
            cityInput.value = 'Ozamiz City';
          } else if (address) {
            var parts = address.split(',').map(function (part) { return part.trim(); }).filter(Boolean);
            cityInput.value = parts.length ? parts[parts.length - 1] : cityInput.value;
          }
        }

        var root = document.querySelector('#form-create-referral [data-letter-root]');
        if (root) {
          var letterRecipient = root.querySelector('[data-letter-field="recipient_name"]');
          if (letterRecipient) {
            letterRecipient.textContent = contactPerson ? contactPerson.toUpperCase() : '—';
          }
          var letterCompany = root.querySelector('[data-letter-field="company"]');
          if (letterCompany && companyName) letterCompany.textContent = companyName;
        }
      }

      function applyApplicantOption() {
        if (!applicantSelect) return;
        var option = applicantSelect.options[applicantSelect.selectedIndex];
        if (!option || !option.value) return;

        var setValue = function (id, value) {
          var el = document.getElementById(id);
          if (el && value) el.value = value;
        };

        setValue('referral_name', option.getAttribute('data-name'));
        setValue('referral_birth_date', option.getAttribute('data-birth'));
        setValue('referral_address', option.getAttribute('data-address'));
        setValue('referral_phone', option.getAttribute('data-phone'));
        setValue('referral_email', option.getAttribute('data-email'));
        setValue('referral_education', option.getAttribute('data-education'));
        setValue('referral_skills', option.getAttribute('data-skills'));
        if (genderInput) genderInput.value = option.getAttribute('data-gender') || '';
        syncCreateReferralLetterPreview();
      }

      if (employerSelect) employerSelect.addEventListener('change', applyEmployerOption);
      if (applicantSelect) applicantSelect.addEventListener('change', applyApplicantOption);

      form.addEventListener('input', syncCreateReferralLetterPreview);
      form.addEventListener('change', syncCreateReferralLetterPreview);

      syncCreateReferralLetterPreview();
    }

    window.prepareReferralLetterPrintFit = function () {
      var letter = document.querySelector('body.peso-print-referral-letter [data-letter-root]');
      if (!letter) return function () {};

      letter.style.removeProperty('--peso-letter-print-scale');
      var pageHeightPx = 10 * 96 - 0.56 * 96;
      var contentHeight = letter.scrollHeight;
      if (contentHeight > pageHeightPx && contentHeight > 0) {
        var scale = pageHeightPx / contentHeight;
        letter.style.setProperty('--peso-letter-print-scale', String(Math.max(0.94, scale)));
      }

      return function resetReferralLetterPrintFit() {
        letter.style.removeProperty('--peso-letter-print-scale');
      };
    };

    window.populateCreateReferralModal = function (data) {
      data = data || {};

      var setValue = function (id, value) {
        var el = document.getElementById(id);
        if (!el || value === undefined || value === null || value === '' || value === '—') return;
        el.value = value;
      };

      setValue('referral_name', data.name || data.candidate_name);
      setValue('referral_birth_date', data.birth_date);
      setValue('referral_address', data.address);
      setValue('referral_phone', data.phone);
      setValue('referral_email', data.email);
      setValue('referral_education', data.education);
      setValue('referral_skills', data.skills);
      setValue('referral_recipient_city', data.city);
      setValue('referral_gender', data.gender);

      var employerSelect = document.getElementById('referral_employer_id');
      var jobSelect = document.getElementById('referral_job');
      var applicantSelect = document.getElementById('referral_applicant_id');

      if (employerSelect && data.employerId) {
        employerSelect.value = String(data.employerId);
      } else if (employerSelect && data.employer && data.employer !== 'Pending Assignment') {
        Array.prototype.forEach.call(employerSelect.options, function (option) {
          if (option.textContent.trim() === data.employer || option.getAttribute('data-name') === data.employer) {
            option.selected = true;
          }
        });
      }

      var jobTitle = data.job || data.position;
      if (jobSelect && jobTitle) {
        jobSelect.value = jobTitle;
        if (jobSelect.value !== jobTitle) {
          Array.prototype.forEach.call(jobSelect.options, function (option) {
            if (option.textContent.trim() === jobTitle) option.selected = true;
          });
        }
      }

      var applicantId = data.applicant_id || data.applicantId;
      if (applicantSelect && applicantId) {
        applicantSelect.value = String(applicantId);
      }

      if (employerSelect) employerSelect.dispatchEvent(new Event('change'));
      if (applicantSelect && applicantId) applicantSelect.dispatchEvent(new Event('change'));

      var createRoot = document.querySelector('#form-create-referral [data-letter-root]');
      if (createRoot && window.renderOfficialReferralLetter && data.candidate_display) {
        window.renderOfficialReferralLetter(createRoot, data);
      }

      syncCreateReferralLetterPreview();
    };

    window.fetchReferralLetter = function (referralId) {
      return fetch('/admin/referrals/' + referralId + '/letter', {
        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      }).then(function (response) {
        if (!response.ok) throw new Error('Unable to load referral letter.');
        return response.json();
      });
    };

    document.addEventListener('DOMContentLoaded', bindCreateReferralForm);
    document.addEventListener('turbo:load', bindCreateReferralForm);
  })();
</script>
