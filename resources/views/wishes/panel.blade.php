<div class="panel panel-wish panel-wish-{{ $wish->state }}">
    <div class="panel-heading m-b-sm text-center">
        <h3 class="panel-title">
            {!! $wish->getStateIcon() !!}
            {{ $wish->amount }}x {{ $wish->title }} <br>
        </h3>
    </div>
    <div class="panel-body">
        <span class="label label-default"><i class="voyager-company"></i>: {{ $wish->location->institution->name }}</span>
        <span class="label label-default"><i class="voyager-location"></i>: {{ $wish->location->name }} in {{ $wish->location->zip }} {{ $wish->location->city }}</span>
        <span class="label label-default"><i class="voyager-person"></i>: {{ $wish->from }}</span>
    </div>
    <div class="panel-body">
        <img class="img-responsive" src="{{ str_replace('\\', '/', Storage::disk(config('voyager.storage.disk'))->url($wish->image_url)) }}" class="img-rounded">

        @if ($action == 'browse')
            <p>{{ str_limit($wish->description, 280, '...') }}</p>
        @elseif ($action == 'show')
            <p>{{ $wish->description }}</p>
        @endif

        @include('wishes.action', [ 'wish' => $wish ])
    </div>

    @if ($action == 'show')
        <div class="panel-heading m-b-sm text-center">
            <h3 class="panel-title">
                Geschenkestatus
            </h3>
        </div>
        <div class="panel-body">
            @include('wishes.present-table', ['wish' => $wish])
            @foreach($wish->presents as $present)

            @endforeach
        </div>
    @endif

    @if ($action == 'show')
        <div class="panel-heading m-b-sm text-center">
            <h3 class="panel-title">
                Abgabeort
            </h3>
        </div>
        <div class="panel-body">
            <p>
                {{ $wish->location->name }}<br>
                z.H. {{ $wish->from }}<br>
                {{ $wish->location->street }}<br>
                {{ $wish->location->zip }} {{ $wish->location->city }}
            </p>
            <p><strong>Öffnungszeiten</strong></p>
            {!! $wish->location->getOpeningHoursAsHtml() !!}
        </div>
    @endif

    @if ($action == 'show')
        <div class="panel-heading m-b-sm text-center">
            <h3 class="panel-title">
                Über {{ $wish->location->institution->name }}
            </h3>
        </div>
        <div class="panel-body">
            <img class="img-responsive" src="{{ $wish->location->institution->image_url }}" class="img-rounded">
            {{ $wish->location->institution->description }}
        </div>
    @endif

    <div class="panel-footer">
        #WWC-{{ $wish->id }}
    </div>
</div>