@php
  $pesoFlash = null;

  if (session('error')) {
      $pesoFlash = [
          'type' => 'danger',
          'title' => 'Unable to continue',
          'message' => session('error'),
      ];
  } elseif ($errors->any()) {
      $pesoFlash = [
          'type' => 'danger',
          'title' => 'Please check your form',
          'message' => 'Some fields need correction before you can submit.',
          'items' => $errors->all(),
          'fields' => $errors->keys(),
      ];
  } elseif (session('status')) {
      $pesoFlash = [
          'type' => 'success',
          'title' => 'Success',
          'message' => session('status'),
      ];
  }
@endphp

@if ($pesoFlash)
  <script type="application/json" id="peso-flash-payload">@json($pesoFlash)</script>
@endif
