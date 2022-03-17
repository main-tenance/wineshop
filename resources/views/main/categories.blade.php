<div class="categories">
    <div class="categories__list">
        @foreach (__('app.categories') as $category)
            <div class="categories__item lazy"
                 data-src="/images/categories/{{$category['svg']}}.jpg">
                <a href="/catalog/{{$category['svg']}}/">
                    <svg class="categories__icon">
                        <use xlink:href="/images/svg/sprite.svg#{{$category['svg']}}"></use>
                    </svg>
                    <span>{{$category['name']}}</span>
                </a>
            </div>
        @endforeach
    </div>
</div>
