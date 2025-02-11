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
