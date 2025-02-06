<?php

namespace App\Orchid\Layouts\Events;

use App\Models\Event;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class EventsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'events';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', __('Название'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Event $event) {
                    return Link::make($event->name)
                        ->route('platform.event.edit', $event);
                }),
            TD::make('count_products', __('Кол-во продуктов'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Event $event) {
                    return $event->products->count();
                }),
        ];
    }
}
