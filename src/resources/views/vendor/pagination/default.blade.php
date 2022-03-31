@if ($paginator->hasPages())
<?php
$eachSidePageNum = 3;
$minPerPage = $paginator->currentPage() - $eachSidePageNum;
$maxPerPage = $paginator->currentPage() + $eachSidePageNum;
?>
<div class="pager">
  <ul class="pager-items">

    {{-- Previous Page Link --}}
    @if ($paginator->currentPage() > 1)
    <li class="pager-item first">
      <a href="{{ $paginator->url(1) }}" class="pager-arrow-first"><span>最初へ</span></a>
    </li>
    <li class="pager-item pre">
      <a href="{{ $paginator->previousPageUrl() }}" class="pager-arrow-previous"><span>前へ</span></a>
    </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
      @if (is_array($element))
        @foreach ($element as $page => $url)
         @if ($minPerPage <= $page && $page <=  $maxPerPage)
    <li class="pager-item">
      <a href="{{ $url }}" @if($page == $paginator->currentPage())class="is-active"@endif><span>{{ $page }}</span></a>
    </li>
         @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li class="pager-item next">
      <a href="{{ $paginator->nextPageUrl() }}" class="pager-arrow-next"><span>次へ</span></a>
    </li>
    <li class="pager-item last">
      <a href="{{ $paginator->url($paginator->lastPage()) }}" class="pager-arrow-last"><span>最後へ</span></a>
    </li>
    @endif
  </ul>
</div>
@endif
