<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Админ-панель предприятия ООО «Марафон»';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Здесь можно управлять категориями, продуктами, пользователями, заказами, а также проводить анализ организации';
    }

    /**
     * The screen's action buttons.
     *
     *
     */
    // public function commandBar(): iterable
    // {
    //     return [];
    // }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            // Layout::view('platform::partials.update-assets'),
            // Layout::view('platform::partials.welcome'),
        ];
    }
}
