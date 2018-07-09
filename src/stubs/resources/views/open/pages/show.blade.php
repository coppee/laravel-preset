@component('open._layouts.app', [
    'metaTitle' => $page['title'],
    'metaDescription' => $page['description']
])
    <section class="c-section c-section--sm">
        <div class="container">
            <h1 class="c-section__title">{{ $page['title'] }}</h1>
            <p class="c-section__subtitle">{{ $page['description'] }}</p>
            {{ $page['body'] }}
        </div>
    </section>
@endcomponent