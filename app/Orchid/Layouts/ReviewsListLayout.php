<?php

namespace App\Orchid\Layouts;

use App\Models\Review;
use App\Models\User;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class ReviewsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'reviews';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            // TD::make('name', __('Пользователь'))
            //     ->sort()
            //     ->filter(Input::make())
            //     ->render(function (Review $review) {
            //         return $review->order()->user()->name;
            //     }),
            TD::make('rating', __('Оценка'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Review $review) {
                    return $review->rating;
                }),
            TD::make('comment', __('Комментарий'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Review $review) {
                    return $review->comment;
                }),
        ];
    }
}
