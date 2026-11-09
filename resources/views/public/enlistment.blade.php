@extends('layouts.public-site')

@section('title', 'Enlistment - PESO Ozamiz')

@section('body-bg', '#f8fafc')

@section('page-bg', '#f8fafc')

@section('content')
<section class="public-content" style="display: flex;flex-direction: column;align-items: center;width: 100%;padding: 40px clamp(20px, 5vw, 80px);">
  @include('partials.public.enlistment-form', [
    'formId' => 'form-enlistment',
    'idPrefix' => 'enlistment',
    'variant' => 'page',
    'jobs' => $jobs,
    'selectedJobPosition' => old('job_position', $selectedJobListing['title'] ?? ''),
  ])
</section>
@endsection
