@foreach ($events as $event)
<a href="{{ route('event.show', $event) }}">
    <div class="event">
        <img src="{{ $event->image }}" alt="{{ $event->name }}">
        <div>
            <p>{{ $event->name }}</p>
        </div>
    </div>
</a>
@endforeach
