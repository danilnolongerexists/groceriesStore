@include('includes.header')

<section class="main-section">

    <aside>
        @include('includes.categories')
    </aside>

    <main class="main-index">
        <div class="main-index-title">
            <h1>Результаты поиска для "{{ $query }}"</h1>
        </div>
        <div class="main-index-wrap">
            @if ($products->isEmpty())
                <p>Товары не найдены.</p>
            @else
                @include('includes.products')
            @endif
            {{ $products->appends(['query' => $query])->links() }}
        </div>
        @include('includes.footer')
    </main>

</section>
<script src="{{ asset('js/modalProduct.js') }}"></script>
