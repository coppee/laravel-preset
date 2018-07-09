@component('open._layouts.app', [
    'metaTitle' => '404',
    'metaDescription' => trans('layout.description')
])
    <section class="c-section c-section--sm">
        <div class="container">
            <h1 class="c-section__title">@lang('errors.404.title')</h1>
            @lang('errors.404.body')
        </div>
    </section>
@endcomponent