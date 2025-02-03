@include('includes.header')

@foreach ($categories as $category)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img class="card-img-top" src="{{ $category->image }}" alt="{{ $category->name }}" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h2 class="card-title">{{ $category->name }}</h2>
                {{-- <a href="{{ route('category.show', $category) }}" class="btn btn-primary">Подробнее</a> --}}
            </div>
        </div>
    </div>
@endforeach

@foreach ($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h2 class="card-title">{{ $product->name }}</h2>
                {{-- <a href="{{ route('category.show', $category) }}" class="btn btn-primary">Подробнее</a> --}}
            </div>
        </div>
    </div>
@endforeach

