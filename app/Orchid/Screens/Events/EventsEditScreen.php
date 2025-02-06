<?php

namespace App\Orchid\Screens\Events;

use App\Models\Event;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Cropper;

class EventsEditScreen extends Screen
{
    public $event;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Event $event): iterable
    {
        return [
            'event' => $event
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->event->exists ? 'Редактировать' : 'Создать';
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
                ->canSee(!$this->event->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->event->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->event->exists),
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
                Input::make('event.name')
                    ->title('Название'),
                Cropper::make('event.image')
                    ->targetId()
                    ->title('Фото')
            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->event->fill($request->get('event'))->save();

        Alert::info('Акция успешно сохранена!');

        return redirect()->route('platform.event.list');
    }

    public function remove()
    {
        $this->event->delete();

        Alert::info('Акция была удалена!');

        return redirect()->route('platform.event.list');
    }

}
