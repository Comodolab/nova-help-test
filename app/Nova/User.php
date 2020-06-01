<?php

namespace App\Nova;

use Comodolab\Nova\Fields\Help\Help;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\User';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Help::header('Section title'),

            Gravatar::make(),

            Help::header('Section title', 'With section subtitle and <a href="#">link</a>')
                ->onlyOnDetail()
                ->displayAsHtml(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Help::info('With label', 'Context')
                ->withSideLabel(),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Help::header('Another section with info icon')
                ->icon('info')
                ->displayAsHtml(),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Help::info('Regular width info', 'Regular width'),

            Help::make('Using callable', function () {
                return 'My name is ' . $this->name;
            })->icon('help')->showFullWidthOnDetail(),

            Help::make('Using custom svg icon')
                ->icon('<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="m10 3.22-.61-.6a5.5 5.5 0 0 0 -7.78 7.77l8.39 8.39 8.39-8.4a5.5 5.5 0 0 0 -7.78-7.77z"/></svg>')
                ->showFullWidthOnDetail(),

            Help::make('', 'No title')
                ->showFullWidthOnDetail(),

            Help::info('Info full width', 'My message content...')
                ->showFullWidthOnDetail(),

            Help::success('Success full width', 'My message content...')
                ->showFullWidthOnDetail(),

            Help::warning('Warning full width', 'My message content...')
                ->showFullWidthOnDetail(),

            Help::danger('Danger full width', 'My message content...')
                ->showFullWidthOnDetail(),

            /**
             * Only index
             */
            Help::info('Info', 'Help message with <a href="#">link</a>')
                ->onlyOnIndex(),

            Help::danger('Danger', 'Danger message with <a href="#">link</a>')
                ->onlyOnIndex()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
