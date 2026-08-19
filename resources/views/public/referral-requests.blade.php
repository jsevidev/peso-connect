@extends('layouts.public-site')

@section('title', 'Referral Requests - PESO Connect')

@section('body-bg', '#f8fafc')

@section('page-bg', '#f8fafc')

@section('content')
<div class="public-content public-layout-row" style="display: flex;flex-direction: column;row-gap: 32px;width: 100%;padding: 40px clamp(20px, 5vw, 80px);">
  <div style="display: flex;flex-direction: column;row-gap: 6px;">
    <span class="text" style="font-size: 40px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;color: #1e293b;">Referral Requests</span>
    <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #475569;">Request formal referral letters from Public Employment Service Office to potential employers</span>
  </div>

  <div class="public-layout-row" style="display: flex;flex-direction: row;grid-column-gap: 32px;align-items: start;width: 100%;">
    <div class="public-main" style="display: flex;flex-direction: column;row-gap: 32px;width: 100%;flex-grow: 1;">
      @include('partials.public.flash-status')

      <form action="{{ route('referral-requests') }}" method="POST" class="public-form-card" style="border-radius: 20px;background-color: #fff;display: flex;flex-direction: column;row-gap: 24px;width: 100%;filter: drop-shadow(0px 4px 12px rgba(15,23,42,0.05));padding: 32px;">
        @csrf
        <div style="display: flex;flex-direction: row;align-items: center;width: 100%;flex-wrap: wrap;gap: 8px;">
          <span class="text" style="font-size: 28px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;color: #1b3a6b;margin-right: auto;">Submit New Referral Request</span>
          <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #f57c00;">* Required fields</span>
        </div>

        <div style="display: flex;flex-direction: column;row-gap: 20px;width: 100%;">
          <div style="display: flex;flex-direction: row;grid-column-gap: 20px;width: 100%;flex-wrap: wrap;">
            <div style="display: flex;flex-direction: column;row-gap: 8px;flex: 1 1 240px;">
              <label for="full_name" class="public-field-label">Full Name <span class="public-field-required">*</span></label>
              <input type="text" id="full_name" name="full_name" class="public-input" placeholder="e.g. Juan Dela Cruz" required value="{{ old('full_name') }}">
            </div>
            <div style="display: flex;flex-direction: column;row-gap: 8px;flex: 1 1 240px;">
              <label for="birth_date" class="public-field-label">Birth Date <span class="public-field-required">*</span></label>
              <input type="date" id="birth_date" name="birth_date" class="public-input" required value="{{ old('birth_date') }}">
            </div>
          </div>

          <div style="display: flex;flex-direction: row;grid-column-gap: 20px;width: 100%;flex-wrap: wrap;">
            <div style="display: flex;flex-direction: column;row-gap: 8px;flex: 1 1 240px;">
              <label for="phone" class="public-field-label">Phone Number <span class="public-field-required">*</span></label>
              <input type="tel" id="phone" name="phone" class="public-input" placeholder="e.g. +63 9 1234 5678" required value="{{ old('phone') }}">
            </div>
            <div style="display: flex;flex-direction: column;row-gap: 8px;flex: 1 1 240px;">
              <label for="email" class="public-field-label">Email Address <span class="public-field-required">*</span></label>
              <input type="email" id="email" name="email" class="public-input" placeholder="name@example.com" required value="{{ old('email') }}">
            </div>
          </div>

          <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
            <label for="address" class="public-field-label">Address <span class="public-field-required">*</span></label>
            <input type="text" id="address" name="address" class="public-input" placeholder="House/Unit, Street, Barangay, City, Province" required value="{{ old('address') }}">
          </div>

          <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
            <label for="job_position" class="public-field-label">Select Job Position <span class="public-field-required">*</span></label>
            <select id="job_position" name="job_position" class="public-select" required>
              <option value="" disabled @selected(! old('job_position'))>Choose from posted jobs</option>
              @foreach ($jobOptions as $option)
                <option value="{{ $option }}" @selected(old('job_position') === $option)>{{ $option }}</option>
              @endforeach
            </select>
          </div>

          <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
            <label for="education" class="public-field-label">Highest Education <span class="public-field-required">*</span></label>
            <input type="text" id="education" name="education" class="public-input" placeholder="e.g. Bachelor's Degree, High School Diploma" required value="{{ old('education') }}">
          </div>

          <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
            <label for="skills" class="public-field-label">Special Skills <span class="public-field-required">*</span></label>
            <textarea id="skills" name="skills" class="public-textarea" placeholder="List relevant skills, certifications, or tools (e.g., MS Office, Adobe Creative Cloud, data analysis)..." required>{{ old('skills') }}</textarea>
          </div>
        </div>

        <div style="display: flex;flex-direction: row;grid-column-gap: 16px;justify-content: flex-end;width: 100%;flex-wrap: wrap;">
          <button type="reset" style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 8px;padding: 12px 24px;background:#fff;cursor:pointer;">
            <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #475569;">Reset</span>
          </button>
          <button type="submit" style="border-radius: 8px;background-color: #f57c00;padding: 12px 32px;border:none;cursor:pointer;">
            <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #fff;">Submit Request</span>
          </button>
        </div>
      </form>
    </div>

    <aside class="public-sidebar" style="display: flex;flex-direction: column;row-gap: 24px;width: 320px;flex-shrink: 0;">
      <div style="border-radius: 20px;background-color: #fff;display: flex;flex-direction: column;row-gap: 16px;width: 100%;filter: drop-shadow(0px 4px 12px rgba(15,23,42,0.05));padding: 24px;">
        <span class="text" style="font-size: 20px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;color: #1b3a6b;">How Referrals Work</span>
        <ul style="list-style: none;display: flex;flex-direction: column;row-gap: 12px;padding: 0;margin: 0;">
          <li class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;line-height: 1.4;color: #475569;"><strong style="color:#1e293b;">Validate First:</strong> Ensure the target company is currently hiring or open to applications.</li>
          <li class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;line-height: 1.4;color: #475569;"><strong style="color:#1e293b;">Processing Time:</strong> Standard referral processing takes 1 to 2 working days.</li>
          <li class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;line-height: 1.4;color: #475569;"><strong style="color:#1e293b;">FTJS Act Benefit:</strong> Registered seekers are exempt from certain validation fees under RA 11261.</li>
        </ul>
        <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #e2e8f0;width: 100%;height: 1px;"></div>
        <a href="{{ route('first-time-job-seeker') }}" style="display: inline-flex;flex-direction: row;grid-column-gap: 6px;align-items: center;text-decoration:none;">
          <span class="text" style="font-size: 13px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #1b3a6b;">Read Detailed Guidelines</span>
          <svg width="14" height="14" viewBox="0 0 8 8" fill="none" aria-hidden="true"><path d="M0 0H5.8324V5.8324M5.8324 0L0 5.8324" transform="translate(1.34 1.34)" style="stroke: #1b3a6b;stroke-width: 2;stroke-linecap: round;"></path></svg>
        </a>
      </div>
    </aside>
  </div>
</div>
@endsection
