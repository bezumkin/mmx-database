Eloquent for MODX 3
---

> This extra is part of **MMX** initiative - the **M**odern **M**OD**X** approach.


### Prepare

This package can be installed only with Composer. 

If you are still not using Composer with MODX 3, just download the `composer.json` of your version:
```bash
cd /to/modx/root/
wget https://raw.githubusercontent.com/modxcms/revolution/v3.0.4-pl/composer.json
```

Then run `composer update` and you are ready to install the **mmx** packages.

### Install

```bash
composer require mmx/database
composer exec mmx-database install
```

### Remove

```bash
composer exec mmx-database remove
composer remove mmx/database
```

### How to use

`mmxDatabase` service will be registered globally, so you can use its models anywhere in your PHP code inside MODX.

Get all published resources with Template and TV values.

```php
$resources = \MMX\Database\Models\Resource::query()
    ->with('Template:id,templatename')
    ->with('TvValues')
    ->where('published', true)
    ->get();
foreach ($resources as $resource) {
    print_r($resource->toArray());
}
```

Get categories with relations:
```php
$categories = \MMX\Database\Models\Category::query()
    ->with('Templates')
    ->with('Plugins')
    ->with('Snippets')
    ->with('Chunks')
    ->with('Tvs')
    ->get();
foreach ($categories as $category) {
    print_r($category->toArray());
}
```

You can see all currently available models with their relations in [Models][1] directory.

Do not forget to read the official [Eloquent documentation][2].

### Nota bene!

mmxDatabase models are not contain any MODX related logic, like clearing cache or calling plugin events.

This is just a convenient way to work with MODX database directly, without xPDO.

Project is still under development, do not hesitate to use [issues][3] if you have any.

[1]: https://github.com/bezumkin/mmx-database/tree/main/core/src/Models
[2]: https://laravel.com/docs/10.x/eloquent
[3]: https://github.com/bezumkin/mmx-database/issues