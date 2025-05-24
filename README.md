# 🔒 Flowaxy Templater
Flowaxy UI - templating engine

## 📦 Installation
```sh
npm install --save flowaxy-templater
```

---

## 📦 Usage
```php
return [
    
    /*
    |--------------------------------------------------------------------------
    | Template Engine [EXPERIMENTAL]
    |--------------------------------------------------------------------------
    */

    'viewEngine' => \Flowaxy\Templater::class,

    /*
    |--------------------------------------------------------------------------
    | Custom configuration method
    |--------------------------------------------------------------------------
    */

    'config' => function ($engine, $config) {
        $engine::config([
            'path' => $config['views'],
            'params' => [],
        ]);
    },

    /*
    |--------------------------------------------------------------------------
    | Custom rendering method
    |--------------------------------------------------------------------------
    */

    'render' => null,

    /*
    |--------------------------------------------------------------------------
    | Template engine extension
    |--------------------------------------------------------------------------
    */

    'extend' => null,
];

```