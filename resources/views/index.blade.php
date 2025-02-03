@include('includes.header')

<section class="main-section">
    <aside>
        @foreach ($categories as $category)
        <div class="categories">
            <div class="category">
                <img src="{{ $category->image }}" alt="{{ $category->name }}" style="height: 80px; object-fit: cover;">
                <div>
                    <h2><a href="{{ route('category.show', $category) }}">{{ $category->name }}</a></h2>
                </div>
            </div>
        </div>
        @endforeach
    </aside>

    <main class="main-index">

    </main>

    <aside class="cart-index">
        @include('pages.cart')
    </aside>


</section>




