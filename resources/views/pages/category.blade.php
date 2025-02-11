@include('includes.header')

<section class="main-section">
    <aside>
        @include('includes.categories')
    </aside>

    <main class="main-index">
        <div class="main-index-title">
            <h2>{{ $category->name }}</h2>
        </div>
        <div class="main-index-wrap">
            @if ($products->isEmpty())
                <p>Продукты ещё не добавлены! Ждите.</p>
            @else
                @include('includes.products')
            @endif
        </div>
        @include('includes.footer')
    </main>
</section>

<script src="{{ asset('js/modalProduct.js') }}"></script>
