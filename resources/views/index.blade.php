@include('includes.header')

<section class="main-section">
    <aside>
        <h2 align='center'>Категории</h2>
        <div class="categories">
            @foreach ($categories as $category)
                <div class="category">
                    <a class="categorya" href="{{ route('category.show', $category) }}">
                        <img class="category-img" src="{{ $category->image }}" alt="{{ $category->name }}">
                        <div>
                            <p>{{ $category->name }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </aside>

    <main class="main-index">
        <div class="main-index-title">
            <h2>Акции</h2>
        </div>
        <div class="main-index-wrap">
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
        </div>
        @include('includes.footer')
    </main>
</section>




