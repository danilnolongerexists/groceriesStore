@include('includes.header')

<section class="main-section">
    <aside>
        @include('includes.categories')
    </aside>

    <main class="main-index">
        <div class="main-index-title">
            <h2>Акции</h2>
        </div>
        <div class="main-index-wrap">
            @include('includes.events')
        </div>
        @include('includes.footer')
    </main>
</section>




