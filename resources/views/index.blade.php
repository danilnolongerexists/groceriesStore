@include('includes.header')

<section class="main-section">
    <aside>
        <div class="categories">
            <h2>Категории</h2>
            @foreach ($categories as $category)
            <div class="category">
                <img src="{{ $category->image }}" alt="{{ $category->name }}" style="height: 80px; object-fit: cover;">
                <div>
                    <h2><a href="{{ route('category.show', $category) }}">{{ $category->name }}</a></h2>
                </div>
            </div>
            @endforeach
        </div>
    </aside>

    <main class="main-index">
        <div class="events">
            <h2>Акции</h2>
            @foreach ($events as $event)
            <div class="event">
                <img src="{{ $event->image }}" alt="{{ $event->name }}" style="height: 200px; object-fit: cover;">
                <div>
                    <h2><a href="{{ route('event.show', $event) }}">{{ $event->name }}</a></h2>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    {{-- <aside class="cart-index">
        @include('pages.cart')
    </aside> --}}


</section>




