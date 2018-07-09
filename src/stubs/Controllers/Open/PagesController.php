<?php
namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function show($slug)
    {
        $pagesLangLabels = [
            'fr' => array_flip(trans('routes')),
            'nl' => array_flip(trans('routes')),
        ];

        if(!in_array($slug, trans('routes')))
            abort(404);

        $langLabel = $pagesLangLabels[locale()][$slug];

        $page['title'] = trans('pages.' . $langLabel . '.title');
        $page['description'] = trans('pages.' . $langLabel . '.description');
        $page['body'] = trans('pages.' . $langLabel . '.body');

        return view('open.pages.show', compact('page'));
    }
}
