@extends('layouts.public-site')

@section('title', 'Enlistment - PESO Connect')

@section('body-bg', '#f8fafc')

@section('page-bg', '#f8fafc')

@section('content')
<section class="public-content" style="display: flex;flex-direction: column;align-items: center;width: 100%;padding: 40px clamp(20px, 5vw, 80px);">
  @include('partials.public.flash-status')

  <form action="{{ route('enlistment') }}" method="POST" class="public-enlistment-card" style="border-radius: 20px;background-color: #fff;overflow: hidden;display: flex;flex-direction: column;width: 100%;max-width: 560px;filter: drop-shadow(0px 20px 40px rgba(15,23,42,0.15));">
    @csrf
    @php
      $selectedJobPosition = old('job_position', $selectedJobListing['title'] ?? '');
    @endphp
    <input type="hidden" id="skills" name="skills" value="{{ old('skills', 'Customer Service, Data Entry, MS Office') }}">

    <div style="border-width: 1px;border-style: solid;border-color: #e2e8f0;display: flex;flex-direction: row;align-items: center;width: 100%;padding: 24px;">
      <div style="display: flex;flex-direction: column;row-gap: 4px;flex: 1;min-width: 0;">
        <span class="text" style="font-size: 18px;font-family: Inter, system-ui, sans-serif;font-weight: 700;color: #0f172a;">Enlist Now</span>
        <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #64748b;">Fill in your details to enlist as a job seeker on PESO</span>
      </div>
      <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('home') }}" aria-label="Close" style="border-radius: 16px;background-color: #f8fafc;display: flex;align-items: center;justify-content: center;width: 32px;height: 32px;flex-shrink: 0;text-decoration: none;">
        <svg width="18" height="18" viewBox="0 0 17 17" fill="none" aria-hidden="true"><path d="M9.7508 5.2504L5.2504 9.7508M5.2504 5.2504L9.7508 9.7508M15.0012 7.5006C15.0012 11.6431 11.6431 15.0012 7.5006 15.0012 3.3581 15.0012 0 11.6431 0 7.5006 0 3.3581 3.3581 0 7.5006 0 11.6431 0 15.0012 3.3581 15.0012 7.5006Z" transform="translate(1.13 1.13)" style="stroke: #0f172a;stroke-width: 2;stroke-linecap: round;"></path></svg>
      </a>
    </div>

    <div style="display: flex;flex-direction: column;row-gap: 20px;width: 100%;padding: 24px 24px 32px;">
      <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
        <label for="job_position" class="public-field-label" style="font-size: 13px;color: #0f172a;">Select Job Position <span class="public-field-required">*</span></label>
        <select id="job_position" name="job_position" class="public-select public-enlistment-input" required>
          <option value="" disabled @selected(! $selectedJobPosition)>Choose from posted jobs</option>
          @foreach ($jobs as $job)
            <option value="{{ $job['title'] }}" @selected($selectedJobPosition === $job['title'])>{{ $job['title'] }}</option>
          @endforeach
        </select>
        <x-field-error field="job_position" />
      </div>

      <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
        <label for="full_name" class="public-field-label" style="font-size: 13px;color: #0f172a;">Full Name <span class="public-field-required">*</span></label>
        <input type="text" id="full_name" name="full_name" class="public-input public-enlistment-input" placeholder="e.g. Juan Dela Cruz" required value="{{ old('full_name') }}">
        <x-field-error field="full_name" />
      </div>

      <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
        <label for="address" class="public-field-label" style="font-size: 13px;color: #0f172a;">Address <span class="public-field-required">*</span></label>
        <input type="text" id="address" name="address" class="public-input public-enlistment-input" placeholder="e.g. Barangay 76, Pasay City, Metro Manila" required value="{{ old('address') }}">
      </div>

      <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
        <label for="email" class="public-field-label" style="font-size: 13px;color: #0f172a;">Email Address <span class="public-field-required">*</span></label>
        <input type="email" id="email" name="email" class="public-input public-enlistment-input" placeholder="e.g. juan.delacruz@email.ph" required value="{{ old('email') }}">
        <x-field-error field="email" />
      </div>

      <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
        <label for="phone" class="public-field-label" style="font-size: 13px;color: #0f172a;">Phone Number <span class="public-field-required">*</span></label>
        <input type="tel" id="phone" name="phone" class="public-input public-enlistment-input" placeholder="e.g. +63 917 123 4567" required value="{{ old('phone') }}">
      </div>

      <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
        <label for="education" class="public-field-label" style="font-size: 13px;color: #0f172a;">Highest Attained Education <span class="public-field-required">*</span></label>
        <input type="text" id="education" name="education" class="public-input public-enlistment-input" placeholder="e.g. College (Bachelor's Degree)" required value="{{ old('education') }}">
      </div>

      <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
        <label for="skills_input" class="public-field-label" style="font-size: 13px;color: #0f172a;">Skills <span class="public-field-required">*</span></label>
        <div id="enlistment-skills-tags" style="display: flex;flex-wrap: wrap;row-gap: 8px;grid-column-gap: 8px;width: 100%;padding-bottom: 4px;"></div>
        <div style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 10px;background-color: #f8fafc;display: flex;align-items: center;width: 100%;height: 44px;padding: 10px 16px;">
          <input type="text" id="skills_input" class="public-enlistment-input" placeholder="Type and press enter to add skills..." style="border: none;background: transparent;width: 100%;padding: 0;font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #0f172a;outline: none;">
          <svg width="16" height="16" viewBox="0 0 10 10" fill="none" aria-hidden="true" style="flex-shrink: 0;"><path d="M0 4.0838H8.1676M4.0838 0V8.1676" transform="translate(1.24 1.24)" style="stroke: #64748b;stroke-width: 2;stroke-linecap: round;"></path></svg>
        </div>
      </div>
    </div>

    <div style="border-width: 1px;border-style: solid;border-color: #e2e8f0;background-color: #f8fafc;display: flex;flex-direction: row;grid-column-gap: 12px;align-items: center;justify-content: flex-end;width: 100%;padding: 24px;flex-wrap: wrap;">
      <a href="{{ route('home') }}" style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 10px;background-color: #fff;display: inline-flex;padding: 12px 20px;text-decoration: none;">
        <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #64748b;">Cancel</span>
      </a>
      <button type="submit" style="border-radius: 10px;background-color: #1b3a6b;display: inline-flex;padding: 12px 24px;border: none;cursor: pointer;">
        <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #fff;">Submit</span>
      </button>
    </div>
  </form>
</section>
@endsection

@push('scripts')
<script>
  (function () {
    var hiddenInput = document.getElementById('skills');
    var tagsContainer = document.getElementById('enlistment-skills-tags');
    var skillsInput = document.getElementById('skills_input');
    if (!hiddenInput || !tagsContainer || !skillsInput) return;

    var skills = (hiddenInput.value || '')
      .split(',')
      .map(function (s) { return s.trim(); })
      .filter(Boolean);

    function syncHidden() {
      hiddenInput.value = skills.join(', ');
    }

    function renderTags() {
      tagsContainer.innerHTML = '';
      skills.forEach(function (skill, index) {
        var tag = document.createElement('div');
        tag.style.cssText = 'border-radius:6px;background-color:#eef4f8;display:flex;align-items:center;grid-column-gap:6px;padding:6px 12px;';
        tag.innerHTML =
          '<span class="text" style="font-size:12px;font-family:Inter,system-ui,sans-serif;font-weight:700;text-transform:uppercase;color:#1b3a6b;">' +
          skill +
          '</span>' +
          '<button type="button" aria-label="Remove ' + skill + '" style="border:none;background:transparent;padding:0;cursor:pointer;display:flex;align-items:center;">' +
          '<svg width="12" height="12" viewBox="0 0 10 10" fill="none" aria-hidden="true"><path d="M5.2 2.8L2.8 5.2M2.8 2.8L5.2 5.2M8 4C8 6.21 6.21 8 4 8 1.79 8 0 6.21 0 4 0 1.79 1.79 0 4 0 6.21 0 8 1.79 8 4Z" transform="translate(0.89 0.89)" style="stroke:#1b3a6b;stroke-width:1.5;stroke-linecap:round;"></path></svg>' +
          '</button>';
        tag.querySelector('button').addEventListener('click', function () {
          skills.splice(index, 1);
          syncHidden();
          renderTags();
        });
        tagsContainer.appendChild(tag);
      });
    }

    function addSkill(value) {
      var skill = value.trim();
      if (!skill || skills.indexOf(skill) !== -1) return;
      skills.push(skill);
      syncHidden();
      renderTags();
    }

    skillsInput.addEventListener('keydown', function (event) {
      if (event.key !== 'Enter') return;
      event.preventDefault();
      addSkill(skillsInput.value);
      skillsInput.value = '';
    });

    syncHidden();
    renderTags();
  })();
</script>
@endpush
