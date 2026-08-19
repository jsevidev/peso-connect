@php
  $currentPage = $currentPage ?? 1;
  $lastPage = $lastPage ?? 1;
  $routeName = $routeName ?? 'jobs.index';
  $query = $query ?? request()->except('page');
@endphp

@if ($lastPage > 1)
<nav class="public-pagination" aria-label="Pagination" style="display: flex;flex-direction: row;grid-column-gap: 0px;align-items: center;justify-content: center;width: 100%;position: relative;flex-shrink: 0;padding: 32px 0px 0px;flex-wrap: wrap;gap: 12px;">
  @if ($currentPage > 1)
    <a href="{{ route($routeName, array_merge($query, ['page' => $currentPage - 1])) }}" class="public-pagination__nav" style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 12px;background-color: #fff;display: inline-flex;flex-direction: row;grid-column-gap: 8px;align-items: center;justify-content: flex-start;padding: 10px 16px;text-decoration: none;margin-right: auto;">
      <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M4 8L0 4 4 0" transform="translate(1.5 1.25)" style="stroke: #0f172a;stroke-width: 2;stroke-linecap: round;"></path></svg>
      <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #0f172a;">Previous</span>
    </a>
  @else
    <span class="public-pagination__nav public-pagination__nav--disabled" aria-disabled="true" style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 12px;background-color: #f8fafc;display: inline-flex;flex-direction: row;grid-column-gap: 8px;align-items: center;padding: 10px 16px;opacity: 0.5;margin-right: auto;cursor: not-allowed;">
      <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M4 8L0 4 4 0" transform="translate(1.5 1.25)" style="stroke: #0f172a;stroke-width: 2;stroke-linecap: round;"></path></svg>
      <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #0f172a;">Previous</span>
    </span>
  @endif

  <div style="display: flex;flex-direction: row;grid-column-gap: 8px;align-items: center;flex-wrap: wrap;">
    @php
      $pages = [];
      if ($lastPage <= 5) {
          $pages = range(1, $lastPage);
      } else {
          $pages = array_unique(array_filter([
              1,
              max(1, $currentPage - 1),
              $currentPage,
              min($lastPage, $currentPage + 1),
              $lastPage,
          ]));
          sort($pages);
      }
      $prev = null;
    @endphp
    @foreach ($pages as $page)
      @if ($prev !== null && $page - $prev > 1)
        <span class="public-pagination__ellipsis" style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 12px;background-color: #fff;display: inline-flex;align-items: center;justify-content: center;width: 40px;height: 40px;font-size: 14px;font-family: Inter, system-ui, sans-serif;color: #0f172a;">...</span>
      @endif
      @if ($page === $currentPage)
        <span aria-current="page" style="border-radius: 12px;background-color: #1b3a6b;display: inline-flex;align-items: center;justify-content: center;width: 40px;height: 40px;font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 700;color: #fff;">{{ $page }}</span>
      @else
        <a href="{{ route($routeName, array_merge($query, ['page' => $page])) }}" style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 12px;background-color: #fff;display: inline-flex;align-items: center;justify-content: center;width: 40px;height: 40px;font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 500;color: #0f172a;text-decoration: none;">{{ $page }}</a>
      @endif
      @php $prev = $page; @endphp
    @endforeach
  </div>

  @if ($currentPage < $lastPage)
    <a href="{{ route($routeName, array_merge($query, ['page' => $currentPage + 1])) }}" class="public-pagination__nav" style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 12px;background-color: #fff;display: inline-flex;flex-direction: row;grid-column-gap: 8px;align-items: center;padding: 10px 16px;text-decoration: none;margin-left: auto;">
      <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #0f172a;">Next</span>
      <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M0 8L4 4 0 0" transform="translate(1.5 1.25)" style="stroke: #0f172a;stroke-width: 2;stroke-linecap: round;"></path></svg>
    </a>
  @else
    <span class="public-pagination__nav public-pagination__nav--disabled" aria-disabled="true" style="border-width: 1px;border-style: solid;border-color: #e2e8f0;border-radius: 12px;background-color: #f8fafc;display: inline-flex;flex-direction: row;grid-column-gap: 8px;align-items: center;padding: 10px 16px;opacity: 0.5;margin-left: auto;cursor: not-allowed;">
      <span class="text" style="font-size: 14px;font-family: Inter, system-ui, sans-serif;font-weight: 600;color: #0f172a;">Next</span>
      <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M0 8L4 4 0 0" transform="translate(1.5 1.25)" style="stroke: #0f172a;stroke-width: 2;stroke-linecap: round;"></path></svg>
    </span>
  @endif
</nav>
@endif
