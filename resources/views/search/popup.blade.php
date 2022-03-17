@if(empty($offers))
    <div>{{__('main.search.not_found')}}</div>
@else
    <div class="finded-list">
        @foreach($offers as $offer)
            <div class="finded-item"><a href="{{\App\Http\Routes\Web\WebRoutesProvider::offerShow($offer)}}">
                    {{$offer->wine->name}}
                </a>
            </div>
        @endforeach
    </div>
@endif
