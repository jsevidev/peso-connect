@extends('layouts.public-site')

@section('title', 'First-Time Job Seeker - PESO Connect')

@section('body-bg', '#f8fafc')

@section('page-bg', '#f8fafc')

@section('content')
<div class="public-content" style="display: flex;flex-direction: column;row-gap: 32px;width: 100%;padding: 48px clamp(20px, 5vw, 120px) 96px;">
  <div style="display: flex;flex-direction: column;row-gap: 8px;width: 100%;">
    <span class="text" style="font-size: 48px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;color: #1b3a6b;">First-Time Job Seeker Certification Request</span>
    <span class="text" style="line-height: 24px;font-size: 16px;font-family: Inter, system-ui, sans-serif;color: #4b5563;">Complete the form below to register with the Public Employment Service Office (PESO) and avail of the free pre-employment document assistance benefits under Republic Act No. 11261.</span>
  </div>

  <div style="border-width: 0px 0px 0px 4px;border-style: solid;border-color: #1b3a6b;border-radius: 12px;background-color: #eef4fc;display: flex;flex-direction: row;grid-column-gap: 16px;align-items: center;width: 100%;padding: 16px;">
    <div style="flex-shrink: 0;width: 24px;height: 24px;color: #1b3a6b;font-weight: 700;font-size: 18px;line-height: 24px;text-align: center;" aria-hidden="true">i</div>
    <div style="display: flex;flex-direction: column;row-gap: 4px;flex: 1;">
      <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 700;color: #1b3a6b;">Republic Act No. 11261 (First-Time Job Seeker Assistance Act)</span>
      <span class="text" style="line-height: 18.2px;font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #4b5563;">Under this law, you are qualified for one-time waiver of government fees for clearances (NBI, Police, Barangay, etc.) required for employment. Complete this process to receive your official PESO certification.</span>
    </div>
  </div>

  @include('partials.public.flash-status')

  <form action="{{ route('first-time-job-seeker') }}" method="POST" class="public-form-card" style="border-width: 1px;border-style: solid;border-color: #d1d5db;border-radius: 20px;background-color: #fff;display: flex;flex-direction: column;row-gap: 32px;width: 100%;filter: drop-shadow(0px 12px 24px rgba(27,58,107,0.04));padding: 40px;">
    @csrf

    <section style="display: flex;flex-direction: column;row-gap: 16px;width: 100%;">
      <div style="display: flex;flex-direction: column;row-gap: 6px;">
        <span class="text" style="font-size: 24px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;color: #1b3a6b;">Step 1: Personal Information</span>
        <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #4b5563;">Provide your legal name and demographic details exactly as they appear on your government identification.</span>
      </div>
      <div style="display: flex;flex-direction: column;row-gap: 16px;width: 100%;">
        <div style="display: flex;flex-direction: row;grid-column-gap: 24px;flex-wrap: wrap;">
          <div style="display: flex;flex-direction: column;row-gap: 6px;flex: 1 1 240px;">
            <label for="full_name" class="public-field-label public-field-label--dark">Full Name <span class="public-field-required">*</span></label>
            <input type="text" id="full_name" name="full_name" class="public-input public-input--gray" placeholder="e.g. Juan Dela Cruz" required value="{{ old('full_name') }}">
          </div>
          <div style="display: flex;flex-direction: column;row-gap: 6px;flex: 1 1 240px;">
            <label for="birth_date" class="public-field-label public-field-label--dark">Date of Birth <span class="public-field-required">*</span></label>
            <input type="date" id="birth_date" name="birth_date" class="public-input public-input--gray" required value="{{ old('birth_date') }}">
          </div>
        </div>
        <div style="display: flex;flex-direction: row;grid-column-gap: 24px;flex-wrap: wrap;">
          <div style="display: flex;flex-direction: column;row-gap: 6px;flex: 1 1 240px;">
            <label for="sex" class="public-field-label public-field-label--dark">Sex <span class="public-field-required">*</span></label>
            <select id="sex" name="sex" class="public-select public-input--gray" required>
              <option value="" disabled @selected(! old('sex'))>Select Sex</option>
              <option value="male" @selected(old('sex') === 'male')>Male</option>
              <option value="female" @selected(old('sex') === 'female')>Female</option>
            </select>
          </div>
          <div style="display: flex;flex-direction: column;row-gap: 6px;flex: 1 1 240px;">
            <label for="civil_status" class="public-field-label public-field-label--dark">Civil Status <span class="public-field-required">*</span></label>
            <select id="civil_status" name="civil_status" class="public-select public-input--gray" required>
              <option value="" disabled @selected(! old('civil_status'))>Select Civil Status</option>
              <option value="single" @selected(old('civil_status') === 'single')>Single</option>
              <option value="married" @selected(old('civil_status') === 'married')>Married</option>
              <option value="widowed" @selected(old('civil_status') === 'widowed')>Widowed</option>
              <option value="separated" @selected(old('civil_status') === 'separated')>Separated</option>
            </select>
          </div>
        </div>
        <div style="display: flex;flex-direction: row;grid-column-gap: 24px;flex-wrap: wrap;">
          <div style="display: flex;flex-direction: column;row-gap: 6px;flex: 1 1 240px;">
            <label for="mobile" class="public-field-label public-field-label--dark">Mobile Number <span class="public-field-required">*</span></label>
            <input type="tel" id="mobile" name="mobile" class="public-input public-input--gray" placeholder="e.g. +63 917 123 4567" required value="{{ old('mobile') }}">
          </div>
          <div style="display: flex;flex-direction: column;row-gap: 6px;flex: 1 1 240px;">
            <label for="email" class="public-field-label public-field-label--dark">Email Address <span class="public-field-required">*</span></label>
            <input type="email" id="email" name="email" class="public-input public-input--gray" placeholder="e.g. juan.delacruz@email.com" required value="{{ old('email') }}">
          </div>
        </div>
      </div>
    </section>

    <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #d1d5db;width: 100%;height: 1px;opacity: 0.6;"></div>

    <section style="display: flex;flex-direction: column;row-gap: 16px;width: 100%;">
      <div style="display: flex;flex-direction: column;row-gap: 6px;">
        <span class="text" style="font-size: 24px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;color: #1b3a6b;">Step 2: Address</span>
        <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #4b5563;">Provide your current residence details.</span>
      </div>
      <div style="display: flex;flex-direction: column;row-gap: 16px;width: 100%;">
        <div style="display: flex;flex-direction: column;row-gap: 6px;">
          <label for="address" class="public-field-label public-field-label--dark">Complete Address <span class="public-field-required">*</span></label>
          <input type="text" id="address" name="address" class="public-input public-input--gray" placeholder="House No., Street Name, Phase/Subdivision" required value="{{ old('address') }}">
        </div>
        <div style="display: flex;flex-direction: row;grid-column-gap: 24px;flex-wrap: wrap;">
          <div style="display: flex;flex-direction: column;row-gap: 6px;flex: 1 1 240px;">
            <label for="barangay" class="public-field-label public-field-label--dark">Barangay <span class="public-field-required">*</span></label>
            <input type="text" id="barangay" name="barangay" class="public-input public-input--gray" placeholder="e.g. Barangay 1" required value="{{ old('barangay') }}">
          </div>
          <div style="display: flex;flex-direction: column;row-gap: 6px;flex: 1 1 240px;">
            <label for="city" class="public-field-label public-field-label--dark">Municipality/City <span class="public-field-required">*</span></label>
            <input type="text" id="city" name="city" class="public-input public-input--gray" placeholder="e.g. Manila" required value="{{ old('city') }}">
          </div>
        </div>
      </div>
    </section>

    <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #d1d5db;width: 100%;height: 1px;opacity: 0.6;"></div>

    <section style="display: flex;flex-direction: column;row-gap: 16px;width: 100%;">
      <div style="display: flex;flex-direction: column;row-gap: 6px;">
        <span class="text" style="font-size: 24px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;color: #1b3a6b;">Step 3: Eligibility</span>
        <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #4b5563;">Please confirm the following:</span>
      </div>
      <fieldset style="border: none;display: flex;flex-direction: column;row-gap: 12px;padding: 0;margin: 0;">
        <legend class="sr-only">Eligibility confirmations</legend>
        @foreach ([
          'filipino_citizen' => 'I am a Filipino citizen.',
          'first_time_seeker' => 'I am a first-time jobseeker.',
          'actively_looking' => 'I am actively looking for employment.',
          'not_previously_availed' => 'I have not previously availed of First-Time Jobseeker benefits.',
        ] as $name => $label)
          <label class="public-checkbox-row public-checkbox-row--large">
            <input type="checkbox" name="{{ $name }}" value="1" required @checked(old($name, true))>
            <span>{{ $label }}</span>
          </label>
        @endforeach
      </fieldset>
    </section>

    <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #d1d5db;width: 100%;height: 1px;opacity: 0.6;"></div>

    <section style="display: flex;flex-direction: column;row-gap: 16px;width: 100%;">
      <div style="display: flex;flex-direction: column;row-gap: 6px;">
        <span class="text" style="font-size: 24px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;color: #1b3a6b;">Step 4: Identification</span>
        <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #4b5563;">Select the type of valid ID you will present at the PESO office.</span>
      </div>
      <div style="display: flex;flex-direction: column;row-gap: 6px;max-width: 548px;width: 100%;">
        <label for="id_type" class="public-field-label public-field-label--dark">Valid ID Type <span class="public-field-required">*</span></label>
        <select id="id_type" name="id_type" class="public-select public-input--gray" required>
          <option value="" disabled @selected(! old('id_type'))>Select ID type</option>
          <option value="national-id" @selected(old('id_type') === 'national-id')>Philippine National ID</option>
          <option value="passport" @selected(old('id_type') === 'passport')>Passport</option>
          <option value="drivers-license" @selected(old('id_type') === 'drivers-license')>Driver's License</option>
          <option value="sss-umid" @selected(old('id_type') === 'sss-umid')>SSS / UMID</option>
          <option value="voters-id" @selected(old('id_type') === 'voters-id')>Voter's ID</option>
        </select>
      </div>
      <div style="border-width: 0px 0px 0px 4px;border-style: solid;border-color: #1b3a6b;border-radius: 12px;background-color: #eef4fc;padding: 16px;">
        <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 700;color: #1b3a6b;">Verification at PESO office</span>
        <p class="text" style="line-height: 18.2px;font-size: 13px;font-family: Inter, system-ui, sans-serif;color: #4b5563;margin-top: 4px;">Please bring your valid ID when you visit the PESO office for verification. No need to upload any documents online.</p>
      </div>
    </section>

    <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #d1d5db;width: 100%;height: 1px;opacity: 0.6;"></div>

    <section style="display: flex;flex-direction: column;row-gap: 16px;width: 100%;">
      <div style="display: flex;flex-direction: column;row-gap: 6px;">
        <span class="text" style="font-size: 24px;font-family: &quot;Instrument Serif&quot;, system-ui, sans-serif;color: #1b3a6b;">Step 5: Declaration</span>
        <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #4b5563;">Confirm your declaration to proceed.</span>
      </div>
      <fieldset style="border: none;display: flex;flex-direction: column;row-gap: 12px;padding: 0;margin: 0;">
        <legend class="sr-only">Declaration confirmations</legend>
        <label class="public-checkbox-row public-checkbox-row--large">
          <input type="checkbox" name="certify_truth" value="1" required @checked(old('certify_truth', true))>
          <span>I certify that the information I provided is true and correct.</span>
        </label>
        <label class="public-checkbox-row public-checkbox-row--large">
          <input type="checkbox" name="agree_oath" value="1" required @checked(old('agree_oath', true))>
          <span>I agree to execute the required Oath of Undertaking.</span>
        </label>
      </fieldset>
    </section>

    <div style="border-width: 1px 0px 0px;border-style: solid;border-color: #d1d5db;width: 100%;height: 1px;opacity: 0.6;"></div>

    <div style="display: flex;justify-content: flex-end;width: 100%;">
      <button type="submit" style="border-radius: 10px;background-color: #1b3a6b;display: inline-flex;padding: 14px 32px;border:none;cursor:pointer;">
        <span class="text" style="font-size: 15px;font-family: Inter, system-ui, sans-serif;font-weight: 700;color: #fff;">Submit Request</span>
      </button>
    </div>
  </form>
</div>
@endsection
