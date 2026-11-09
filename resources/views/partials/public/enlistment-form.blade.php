@php
  $formId = $formId ?? 'form-enlistment';
  $idPrefix = $idPrefix ?? 'enlistment';
  $variant = $variant ?? 'page';
  $jobs = $jobs ?? [];
  $selectedJobPosition = old('job_position', $selectedJobPosition ?? '');
  $isModal = $variant === 'modal';
@endphp

<form
  action="{{ route('enlistment') }}"
  method="POST"
  id="{{ $formId }}"
  class="public-enlistment-card"
  style="border-radius: 20px;background-color: #fff;overflow: hidden;display: flex;flex-direction: column;width: 100%;max-width: 560px;{{ $isModal ? 'max-height: none;box-shadow: 0 20px 40px rgba(15,23,42,0.2);' : 'filter: drop-shadow(0px 20px 40px rgba(15,23,42,0.15));' }}"
>
  @csrf
  @if ($isModal)
    <input type="hidden" name="enlist_context" value="modal">
  @endif
  <input type="hidden" id="{{ $idPrefix }}_skills" name="skills" value="{{ old('skills') }}">

  <div style="border-width: 1px;border-style: solid;border-color: #e2e8f0;display: flex;flex-direction: row;align-items: center;width: 100%;padding: 24px;">
    <div style="display: flex;flex-direction: column;row-gap: 4px;flex: 1;min-width: 0;">
      <span class="text" style="font-size: 18px;font-family: Inter, system-ui, sans-serif;font-weight: 700;color: #0f172a;">Enlist Now</span>
      <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #64748b;">Fill in your details to enlist as a job seeker with PESO Ozamiz</span>
    </div>
    @if ($isModal)
      <button type="button" class="public-enlist-modal__close" data-close-enlist-modal aria-label="Close enlistment form" style="border-radius: 16px;background-color: #f8fafc;display: flex;align-items: center;justify-content: center;width: 32px;height: 32px;flex-shrink: 0;border: none;cursor: pointer;padding: 0;">
        <svg width="18" height="18" viewBox="0 0 17 17" fill="none" aria-hidden="true"><path d="M9.7508 5.2504L5.2504 9.7508M5.2504 5.2504L9.7508 9.7508M15.0012 7.5006C15.0012 11.6431 11.6431 15.0012 7.5006 15.0012 3.3581 15.0012 0 11.6431 0 7.5006 0 3.3581 3.3581 0 7.5006 0 11.6431 0 15.0012 3.3581 15.0012 7.5006Z" transform="translate(1.13 1.13)" style="stroke: #0f172a;stroke-width: 2;stroke-linecap: round;"></path></svg>
      </button>
    @else
      <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('home') }}" aria-label="Close" style="border-radius: 16px;background-color: #f8fafc;display: flex;align-items: center;justify-content: center;width: 32px;height: 32px;flex-shrink: 0;text-decoration: none;">
        <svg width="18" height="18" viewBox="0 0 17 17" fill="none" aria-hidden="true"><path d="M9.7508 5.2504L5.2504 9.7508M5.2504 5.2504L9.7508 9.7508M15.0012 7.5006C15.0012 11.6431 11.6431 15.0012 7.5006 15.0012 3.3581 15.0012 0 11.6431 0 7.5006 0 3.3581 3.3581 0 7.5006 0 11.6431 0 15.0012 3.3581 15.0012 7.5006Z" transform="translate(1.13 1.13)" style="stroke: #0f172a;stroke-width: 2;stroke-linecap: round;"></path></svg>
      </a>
    @endif
  </div>

  <div class="public-enlist-modal__scroll" style="display: flex;flex-direction: column;row-gap: 20px;width: 100%;padding: 24px 24px 32px;">
    <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
      <label for="{{ $idPrefix }}_job_position" class="public-field-label" style="font-size: 13px;color: #0f172a;">Select Job Position <span class="public-field-required">*</span></label>
      <select id="{{ $idPrefix }}_job_position" name="job_position" class="public-select public-enlistment-input" required>
        <option value="" disabled @selected(! $selectedJobPosition)>Choose from posted jobs</option>
        @foreach ($jobs as $job)
          <option value="{{ $job['title'] }}" @selected($selectedJobPosition === $job['title'])>{{ $job['title'] }}</option>
        @endforeach
      </select>
      <x-field-error field="job_position" />
    </div>

    <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
      <label for="{{ $idPrefix }}_full_name" class="public-field-label" style="font-size: 13px;color: #0f172a;">Full Name <span class="public-field-required">*</span></label>
      <input type="text" id="{{ $idPrefix }}_full_name" name="full_name" class="public-input public-enlistment-input" placeholder="e.g. Juan Dela Cruz" required value="{{ old('full_name') }}">
      <x-field-error field="full_name" />
    </div>

    <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
      <label for="{{ $idPrefix }}_address" class="public-field-label" style="font-size: 13px;color: #0f172a;">Address <span class="public-field-required">*</span></label>
      <input type="text" id="{{ $idPrefix }}_address" name="address" class="public-input public-enlistment-input" placeholder="e.g. Barangay Aguada, Ozamiz City" required value="{{ old('address') }}">
      <x-field-error field="address" />
    </div>

    <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
      <label for="{{ $idPrefix }}_email" class="public-field-label" style="font-size: 13px;color: #0f172a;">Email Address <span class="public-field-required">*</span></label>
      <input type="email" id="{{ $idPrefix }}_email" name="email" class="public-input public-enlistment-input" placeholder="e.g. juan.delacruz@email.ph" required value="{{ old('email') }}">
      <x-field-error field="email" />
    </div>

    <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
      <label for="{{ $idPrefix }}_phone" class="public-field-label" style="font-size: 13px;color: #0f172a;">Phone Number <span class="public-field-required">*</span></label>
      <input type="tel" id="{{ $idPrefix }}_phone" name="phone" class="public-input public-enlistment-input" placeholder="e.g. +63 917 123 4567" required value="{{ old('phone') }}">
      <x-field-error field="phone" />
    </div>

    <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
      <label for="{{ $idPrefix }}_education" class="public-field-label" style="font-size: 13px;color: #0f172a;">Highest Attained Education <span class="public-field-required">*</span></label>
      <input type="text" id="{{ $idPrefix }}_education" name="education" class="public-input public-enlistment-input" placeholder="e.g. College (Bachelor's Degree)" required value="{{ old('education') }}">
      <x-field-error field="education" />
    </div>

    <div data-enlistment-skills-root data-enlistment-prefix="{{ $idPrefix }}" style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
      <label for="{{ $idPrefix }}_skills_input" class="public-field-label" style="font-size: 13px;color: #0f172a;">Skills <span class="public-field-required">*</span></label>
      <div data-enlistment-skills-tags style="display: flex;flex-wrap: wrap;row-gap: 8px;grid-column-gap: 8px;width: 100%;min-height: 0;padding-bottom: 4px;"></div>
      <div style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 10px;background-color: #f8fafc;display: flex;align-items: center;width: 100%;height: 44px;padding: 6px 8px 6px 16px;grid-column-gap: 8px;">
        <input type="text" id="{{ $idPrefix }}_skills_input" data-enlistment-skills-input class="public-enlistment-input" placeholder="Type a skill, then press Enter or + to add" autocomplete="off" style="border: none;background: transparent;flex: 1;min-width: 0;padding: 0;font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #0f172a;outline: none;">
        <button type="button" data-enlistment-skills-add aria-label="Add skill" style="border: none;background: #eef4f8;border-radius: 8px;display: flex;align-items: center;justify-content: center;width: 32px;height: 32px;flex-shrink: 0;cursor: pointer;padding: 0;">
          <svg width="16" height="16" viewBox="0 0 10 10" fill="none" aria-hidden="true"><path d="M0 4.0838H8.1676M4.0838 0V8.1676" transform="translate(1.24 1.24)" style="stroke: #1b3a6b;stroke-width: 2;stroke-linecap: round;"></path></svg>
        </button>
      </div>
      <x-field-error field="skills" />
    </div>
  </div>

  <div style="border-width: 1px;border-style: solid;border-color: #e2e8f0;background-color: #f8fafc;display: flex;flex-direction: row;grid-column-gap: 12px;align-items: center;justify-content: flex-end;width: 100%;padding: 24px;flex-wrap: wrap;">
    @if ($isModal)
      <button type="button" data-close-enlist-modal style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 10px;background-color: #fff;display: inline-flex;padding: 12px 20px;border: none;cursor: pointer;">
        <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #64748b;">Cancel</span>
      </button>
    @else
      <a href="{{ route('home') }}" style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 10px;background-color: #fff;display: inline-flex;padding: 12px 20px;text-decoration: none;">
        <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #64748b;">Cancel</span>
      </a>
    @endif
    <button type="submit" style="border-radius: 10px;background-color: #1b3a6b;display: inline-flex;padding: 12px 24px;border: none;cursor: pointer;">
      <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #fff;">Submit</span>
    </button>
  </div>
</form>
