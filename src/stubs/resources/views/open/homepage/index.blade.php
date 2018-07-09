@component('open._layouts.app', [
    'isHome' => true,
    'bodyClass' => 's-view-homepage',
    'metaDescription' => trans('layout.description'),
])
    @include('open.homepage._partials.hero')
    @include('open.homepage._partials.section')
@endcomponent