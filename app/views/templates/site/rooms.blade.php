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
            <div class="column half">
                <div class="room-item" style="background-image:url({{ (is_object($photo) ? $photo->full() : '') }});">
                    <a href="{{ URL::route('room', $room->slug) }}">
                        @if ($room->name)
                        <div class="room-name">
                            {{ $room->name }}
                        </div>
                        @endif
                        @if ($room->price)
                        <div class="room-price">
                            {{ $room->price }}
                        </div>
                        @endif
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{ $page->block('content') }}

</main>
@stop


@section('scripts')
@stop