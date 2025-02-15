@foreach ($events as $event)
<a class="event-link" href="{{ route('event.show', $event) }}">
    <div class="event">
        <img src="{{ $event->image }}" alt="{{ $event->name }}">
        <div>
            <p>{{ $event->name }}</p>
        </div>
    </div>
</a>
@endforeach
