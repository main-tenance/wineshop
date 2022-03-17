<div class="form__item" style="{{$field['style']}}">
    <div class="form__label"></div>
    <div class="form__item__checkbox">
        <div class="label">
            <div>
                <input type="checkbox" name="{{$field['name']}}"
                        value="1"
                @if(isset($model->{$field['name']}) && $model->{$field['name']} == 1) checked @endif >
            </div>
            <div>{{$field['label']}}</div>
        </div>
    </div>
</div>
