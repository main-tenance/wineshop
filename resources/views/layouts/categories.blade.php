@foreach (__('app.categories') as $category)
    <li data-category_id="{{$category['id']}}" data-category_code="{{$category['svg']}}"
        class="{{$category['svg']}}">
        @if ($svg)
            <svg class="catalog_menu__icon">
                <use
                    xlink:href="/images/svg/sprite.svg#{{$category['svg']}}"></use>
            </svg>
        @endif
        @if (URL::current() == '/catalog/' . $category['svg'])
            <a>{{$category['name']}}</a>
        @else
            <a href="/catalog/{{$category['svg']}}">{{$category['name']}}</a>
        @endif
    </li>
@endforeach
