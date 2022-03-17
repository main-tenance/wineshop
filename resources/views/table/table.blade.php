<div class="table std-table @if ($table->isClickable()) clickable @endif" data-url="{{$url}}">
    @csrf
    <div class="thead">
        <div class="tr sortable" data-sortfield="{{$table->getSortField()}}"
             data-sortdirection="{{$table->getSortDirection()}}">
            @foreach ($table->getFields() as $th)
                <div class=" th column_title @isset($th['sortby']) sortby @endisset"
                     style="{{$th['style']}}" data-sortfield="{{$th['field']}}">
                    {{$th['caption']}}
                    @isset($th['sortby'])
                        @if ($table->getSortField() == $th['field'] && $table->getSortDirection() == 'asc')
                            <i class="sortsign fas fa-sort-up"></i>
                        @elseif ($table->getSortField() == $th['field'] && $table->getSortDirection() == 'desc')
                            <i class="sortsign fas fa-sort-down"></i>
                        @else
                            <i class="sortsign fas fa-sort"></i>
                        @endif
                    @endisset
                </div>
            @endforeach
        </div>
    </div>
    <div class="tbody list content">
        @include('table.list')
    </div>
</div>
<div class="more_wrapper">
    @if ($table->getPageCount() > $table->getPageId())
        <div class="more">Показать еще</div>
    @endif
</div>
