@php
  $size = $size ?? 14;
@endphp
@switch($name)
  @case('edit')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M10 1l3 3L4 13H1v-3L10 1z" stroke="currentColor" stroke-width="1.5"/></svg>
    @break
  @case('view')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M1 7s2.5-4 6-4 6 4 6 4-2.5 4-6 4-6-4-6-4z" stroke="currentColor" stroke-width="1.5"/><circle cx="7" cy="7" r="2" stroke="currentColor" stroke-width="1.5"/></svg>
    @break
  @case('delete')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M2 4h10M5 4V2h4v2M5.5 6v5M8.5 6v5M3 4l.5 8h7L11 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
    @break
  @case('delete-bin')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M2 4h10M5 4V2h4v2M3 4l1 9h6l1-9" stroke="currentColor" stroke-width="1.5"/></svg>
    @break
  @case('archive')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M1 4h12M4 4V2h6v2M5 7v3M9 7v3M2 4l1 8h8l1-8" stroke="currentColor" stroke-width="1.5"/></svg>
    @break
  @case('approve')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 13 10" fill="none" aria-hidden="true"><path d="M10.666 0L3.333 7.333 0 4" transform="translate(1.19 1.27)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    @break
  @case('deny')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 15 15" fill="none" aria-hidden="true"><path d="M8.667 4.667L4.667 8.667M4.667 4.667L8.667 8.667M13.334 6.667C13.334 10.349 10.349 13.334 6.667 13.334 2.985 13.334 0 10.349 0 6.667 0 2.985 2.985 0 6.667 0 10.349 0 13.334 2.985 13.334 6.667Z" transform="translate(1.15 1.15)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    @break
  @case('print')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 15 15" fill="none" aria-hidden="true"><path d="M2.667 10.668H1.333C0.98 10.668 0.641 10.527 0.391 10.277 0.141 10.027 0 9.688 0 9.334V6.001C0 5.647 0.141 5.308 0.391 5.058 0.641 4.808 0.98 4.668 1.333 4.668H12.001C12.355 4.668 12.694 4.808 12.944 5.058 13.194 5.308 13.334 5.647 13.334 6.001V9.334C13.334 9.688 13.194 10.027 12.944 10.277 12.694 10.527 12.355 10.668 12.001 10.668H10.668M2.667 4.668V0.667C2.667 0.49 2.737 0.32 2.862 0.195 2.987 0.07 3.157 0 3.334 0H10.001C10.178 0 10.347 0.07 10.472 0.195 10.597 0.32 10.668 0.49 10.668 0.667V4.668M3.334 8.001H10.001C10.369 8.001 10.668 8.299 10.668 8.667V12.668C10.668 13.036 10.369 13.334 10.001 13.334H3.334C2.965 13.334 2.667 13.036 2.667 12.668V8.667C2.667 8.299 2.965 8.001 3.334 8.001Z" transform="translate(1.15 1.15)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    @break
  @case('print-sm')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 12 12" fill="none" aria-hidden="true"><path d="M2 8H1C0.735 8 0.48 7.895 0.293 7.707 0.105 7.52 0 7.266 0 7V4.5C0 4.235 0.105 3.981 0.293 3.793 0.48 3.606 0.735 3.5 1 3.5H9C9.266 3.5 9.52 3.606 9.707 3.793 9.895 3.981 10 4.235 10 4.5V7C10 7.266 9.895 7.52 9.707 7.707 9.52 7.895 9.266 8 9 8H8M2 3.5V0.5C2 0.367 2.053 0.24 2.147 0.146 2.24 0.053 2.368 0 2.5 0H7.5C7.633 0 7.76 0.053 7.854 0.146 7.948 0.24 8 0.367 8 0.5V3.5M2.5 6H7.5C7.777 6 8 6.224 8 6.5V9.5C8 9.777 7.777 10 7.5 10H2.5C2.224 10 2 9.777 2 9.5V6.5C2 6.224 2.224 6 2.5 6Z" transform="translate(1.2 1.2)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    @break
  @case('preview')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 15 11" fill="none" aria-hidden="true"><path d="M0.042 4.898C-0.014 4.748-0.014 4.584 0.042 4.434 0.583 3.122 1.501 2 2.681 1.211 3.86 0.421 5.248 0 6.667 0 8.086 0 9.474 0.421 10.653 1.211 11.833 2 12.751 3.122 13.292 4.434 13.348 4.584 13.348 4.748 13.292 4.898 12.751 6.21 11.833 7.332 10.653 8.122 9.474 8.911 8.086 9.333 6.667 9.333 5.248 9.333 3.86 8.911 2.681 8.122 1.501 7.332 0.583 6.21 0.042 4.898ZM8.667 4.666C8.667 5.771 7.772 6.666 6.667 6.666 5.563 6.666 4.667 5.771 4.667 4.666 4.667 3.561 5.563 2.666 6.667 2.666 7.772 2.666 8.667 3.561 8.667 4.666Z" transform="translate(1.15 1.21)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    @break
  @case('preview-document')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 15 15" fill="none" aria-hidden="true"><path d="M6 0.664H1.333C0.98 0.664 0.641 0.805 0.391 1.055 0.141 1.305 0 1.644 0 1.997V11.331C0 11.684 0.141 12.024 0.391 12.274 0.641 12.524 0.98 12.664 1.333 12.664H10.667C11.02 12.664 11.359 12.524 11.609 12.274 11.859 12.024 12 11.684 12 11.331V6.664M10.25 0.414C10.515 0.149 10.875 0 11.25 0 11.625 0 11.985 0.149 12.25 0.414 12.515 0.679 12.664 1.039 12.664 1.414 12.664 1.789 12.515 2.149 12.25 2.414L6.241 8.424C6.083 8.582 5.888 8.698 5.673 8.76L3.757 9.32C3.327 9.337 3.341 9.082 3.904 6.992L4.241 6.424L10.25 0.414Z" transform="translate(1.16 1.16)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    @break
  @case('check')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 10 8" fill="none" aria-hidden="true"><path d="M8 0L2.5 5.5 0 3" transform="translate(1.25 1.36)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    @break
  @case('plus')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 10 10" fill="none" aria-hidden="true"><path d="M0 4.0838H8.1676M4.0838 0V8.1676" transform="translate(1.24 1.24)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    @break
  @case('export')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M9.3 12V7.3C9.3 7.2 9.3 7 9.1 6.9 9 6.7 8.8 6.7 8.7 6.7H3.3C3.2 6.7 3 6.7 2.9 6.9 2.7 7 2.7 7.2 2.7 7.3V12M2.7 0V2.7C2.7 2.8 2.7 3 2.9 3.1 3 3.3 3.2 3.3 3.3 3.3H8M8.1 0C8.5 0 8.8 0.1 9.1 0.4L11.6 2.9C11.9 3.2 12 3.5 12 3.9V10.7C12 11 11.9 11.4 11.6 11.6 11.4 11.9 11 12 10.7 12H1.3C1 12 0.6 11.9 0.4 11.6 0.1 11.4 0 11 0 10.7V1.3C0 1 0.1 0.6 0.4 0.4 0.6 0.1 1 0 1.3 0H8.1Z" transform="translate(1.17 1.17)" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    @break
@endswitch
