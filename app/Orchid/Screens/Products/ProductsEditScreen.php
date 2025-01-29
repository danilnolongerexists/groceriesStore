<?php

namespace App\Orchid\Screens\Products;

use App\Models\Product;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use App\Models\Category;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Cropper;

class ProductsEditScreen extends Screen
{

    public $product;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Product $product): iterable
    {
        return [
            'product' => $product
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->product->exists ? 'Редактировать' : 'Создать';
    }


    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать')
            ->icon('pencil')
            ->method('createOrUpdate')
            ->canSee(!$this->product->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->product->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->product->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('product.name')
                    ->title('Название'),
                Input::make('product.description')
                    ->title('Описание'),
                Cropper::make('product.image')
                    ->targetId()
                    ->title('Фото')
                    ->width(500)
                    ->height(500),
                Input::make('product.price')
                    ->title('Цена'),
                Relation::make('product.category_id')
                    ->title('Категория')
                    ->fromModel(Category::class, 'name', 'id'),
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->product->fill($request->get('product'))->save();

        Alert::info('Продукт успешно сохранён!');

        return redirect()->route('platform.product.list');
    }

    public function remove()
    {
        $this->product->delete();

        Alert::info('Продукт был удалён!');

        return redirect()->route('platform.product.list');
    }

}
