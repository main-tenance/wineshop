<div class="wrapper">
        <img class="picture" src="http://myapp/storage/pictures/detail/{{$wine->id}}.jpg">
    <div class="left">
        <table>
            <tr>
                <td style="vertical-align: top;" colspan="2"><span class="brown vintage">Ромашка-М</span></td>
            </tr>
            <tr>
                <td style="width: 130px; vertical-align: top;">
                    <img style="width: 100px; margin-left: 10px;"
                         src="{{public_path('images/logotype.png')}}" alt="">
                </td>
                <td style="width: 900px; vertical-align: top;">
                    <div class="header title">{{$wine->name}}</div>
                    <div class="header subtitle">{{$wine->original}}</div>
                    <br>
                    <div class="header subtitle">{{$wine->color}}</div>
                </td>
            </tr>
        </table>
        <br>
        <span class="info">
            {{$wine->country}},&nbsp;{{$wine->area}}
            </span>
        <br>
        <span class="info">Производитель: {{$creator->name}}</span>
        <br>
        @isset($wine->offers)
            @foreach ($wine->offers as $offer)
                <br>
                <table>
                    <tr>
                        <td></td>
                    </tr>
                </table>
                <span class="offer gray">{{$offer->name}}</span>
                <span class="offer gray">{{$offer->sugar}}</span>
                @if ($offer->active == 1)
                    <span class="offer brown"> {{$offer->price}} руб.</span>
                @else
                    <span>&nbsp;&nbsp;Нет в продаже</span>
                @endif

            @endforeach
        @endisset
    </div>
    <div class="description">
        <div class="point_header">{!! $wine->description !!}</div>
    </div>
</div>

