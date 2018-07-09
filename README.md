## Installation

This package isn't on Packagist (yet), so to get started, add it as a repository to your `composer.json` file:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/coppee/laravel-preset"
    }
]
```

Next, run this command to add the preset to your project:

```
composer require coppee/laravel-preset --dev
```

Finally, apply the scaffolding by running:

```
php artisan preset coppee
```
