<div class="form pretty-form std-form" data-url="{{$url}}" data-method="{{$form->getMethod()}}">
    @method($form->getMethod())
    @csrf
    <div class="form__items">
        @foreach ($form->getFields() as $field)
            @include('form.' . $field['type'])
        @endforeach
    </div>
    <div class="form__items">
        @foreach ($form->getButtons() as $button)
            <div class="form__item form__button" style="{{$button['style']}}">
                <button class="{{$button['class']}}">{{$button['label']}}</button>
            </div>
        @endforeach
    </div>
    <div class="show_errors"></div>
    <div class="show_ok"></div>
</div>
