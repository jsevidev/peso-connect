<div
  id="modal-enlist-now"
  class="public-enlist-modal-backdrop"
  role="dialog"
  aria-modal="true"
  aria-labelledby="public-enlist-modal-title"
  hidden
>
  <div class="public-enlist-modal__panel">
    @include('partials.public.enlistment-form', [
      'formId' => 'form-enlist-modal',
      'idPrefix' => 'enlist_modal',
      'variant' => 'modal',
      'jobs' => $enlistmentJobs ?? [],
      'selectedJobPosition' => old('job_position', ''),
    ])
  </div>
</div>
