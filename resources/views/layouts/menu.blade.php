<ul>
    @foreach(\App\Menus\MainMenu::getMainMenu() as $item)
        <li><a href="{{$item['link']}}">{{$item['text']}}</a></li>
    @endforeach
</ul>

