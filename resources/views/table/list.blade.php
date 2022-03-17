@foreach($table->getBody() as $tr)
    <div class="tr" data-id="{{$tr['id']}}">
        @foreach($table->getFields() as $td)
            <div class="td {{$td['class']}}" style="{{$td['style']}}">
                @isset($td['unescaped'])
                    {!! $tr[$td['field']] !!}
                @else
                    {{$tr[$td['field']]}}
                @endisset
            </div>
        @endforeach
    </div>
@endforeach
