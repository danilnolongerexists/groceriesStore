<?php

namespace App\Orchid\Screens\Categories;

use App\Models\Category;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Cropper;

class CategoriesEditScreen extends Screen
{
    public $category;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Category $category): iterable
    {
        return [
            'category' => $category
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->category->exists ? 'Редактировать' : 'Создать';
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
                ->canSee(!$this->category->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->category->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->category->exists),
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
                Input::make('category.name')
                    ->title('Название'),
                Cropper::make('category.image')
                    ->targetId()
                    ->title('Фото')
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->category->fill($request->get('category'))->save();

        Alert::info('Категория успешно сохранена!');

        return redirect()->route('platform.category.list');
    }

    public function remove()
    {
        $this->category->delete();

        Alert::info('Категория была удалена!');

        return redirect()->route('platform.category.list');
    }


}
