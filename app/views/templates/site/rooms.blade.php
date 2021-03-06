<?
$rooms = Dic::whereSlugValues('room_type');
if (@count($rooms))
foreach ($rooms as $r => $room) {
#Helper::tad($room);
if (count($room->fields)) {
foreach ($room->fields as $field) {
$room->{$field->key} = $field->value;
}
unset($room->fields);
}
if ($room->slug)
$rooms[$room->slug] = $room;
unset($rooms[$r]);
}
#Helper::tad($rooms);
#$room_standard = Dic::valueBySlugs('room_type', 'standard');
#$room_business = Dic::valueBySlugs('room_type', 'standard');
?>
@extends(Helper::layout())


@section('style')
@stop


@section('content')

    <main role="main">
        @if (count($rooms))
            <section class="rooms">
                <div class="row clearfix no-padding">
                    @foreach ($rooms as $room_type => $room)
                        <?
                        $obj = $room;
                        #Helper::tad($obj->meta);
                        if (@!is_object($obj->meta) || !$obj->meta->name)
                        continue;

                        $photo = false;
                        if (@is_numeric($obj->image)) {
                        $photo = Photo::find($obj->image) ?: false;
                        }
                        ?>
                        <div class="column third">
                            <div class="room-item" style="background-image:url({{ (is_object($photo) ? $photo->full() : '') }});">
                                <a href="{{ URL::route('room', $room->slug) }}">
                                    @if ($room->name)
                                        <div class="room-name">
                                            {{ $room->meta->name }}
                                        </div>
                                    @endif
                                    @if ($room->prices)
                                        <div class="room-price room-prices">
                                            {{ $room->prices }}
                                        </div>
                                    @endif
                                    @if (0)
                                        @if ($room->price)
                                            <div class="room-price room-price-1">
                                                <span class="price-num">{{ $room->price }}</span>
                                                {{--{{ trans("interface.rooms.single_occupancy") }}--}}
                                            </div>
                                        @endif
                                        @if ($room->price_breakfast)
                                            <div class="room-price room-price-1b">
                                                <span class="price-num">{{ $room->price_breakfast }}</span>
                                                {{--{{ trans("interface.rooms.single_occupancy_breakfast") }}--}}
                                            </div>
                                        @endif
                                        @if ($room->price2)
                                            <div class="room-price room-price-2">
                                                <span class="price-num">{{ $room->price2 }}</span>
                                                {{--{{ trans("interface.rooms.double_occupancy") }}--}}
                                            </div>
                                        @endif
                                        @if ($room->price2_breakfast)
                                            <div class="room-price room-price-2b">
                                                <span class="price-num">{{ $room->price2_breakfast }}</span>
                                                {{--{{ trans("interface.rooms.double_occupancy_breakfast") }}--}}
                                            </div>
                                        @endif
                                    @endif
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="sect-wrap rooms-wrap">
            {{ is_object($page->meta) && is_object($page->meta->seo) ? '<h1 class="text-center">' . $page->meta->seo->h1 . '</h1>' : '' }}
            {{ $page->block('content') }}
        </section>

        <section class="sect-wrap">
            <p>
                <button class="btn btn-primary reserve_room">
                    <span class="icon icon-booking"></span> {{ trans('interface.menu.reserve') }}
                </button>
            </p>
        </section>

        {{ $page->block('seo') }}

    </main>
@stop


@section('scripts')
@stop