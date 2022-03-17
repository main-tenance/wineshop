@if ($table->getPageCount() > 1)
    <div>
        Страница
    </div>
    <div class="form__range">
        <input class="page" type="number" value="{{$table->getPageId()}}" min="1"
               max="{{$table->getPageCount()}}" data-lastval="{{$table->getPageId()}}"
               data-pagecount="{{$table->getPageCount()}}">
    </div>
    <div>
        из <span class="pagecount">{{$table->getPageCount()}}</span>
    </div>
    <div class="catalog_pagination__arrows">
        <span class="arrow left" href=""><i class="fas fa-arrow-left"></i></span>
        |
        <span class="arrow right" href=""><i class="fas fa-arrow-right"></i></span>
    </div>
@else
    <input type="hidden" class="page" value="1">
@endif
