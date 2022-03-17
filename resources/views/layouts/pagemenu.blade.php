<div class="page_menu">
    @foreach ($pageMenu->getMenu(Route::currentRouteName()) as $item)
        <div class="href"><a href="{{$item['url']}}">{{$item['caption']}}</a></div>
    @endforeach
</div>
