<?php

namespace Flowaxy;

class Templater
{
    private static $config = [
        'path' => null,
        'params' => [],
        'config' => null,
        'viewEngine' => null,
        'render' => null,
        'extend' => null,
    ];

    /*
    |--------------------------------------------------------------------------
    | Template Settings - Allows you to set the path to templates.
    |--------------------------------------------------------------------------
    */

    public static function config($item, $value = null)
    {
        if (is_array($item)) {
            static::$config = array_merge(static::$config, $item);
        } else {
            static::$config[$item] = $value;
        }

        // Додаємо підтримку кастомної конфігурації з config-файлу
        $configCallback = static::$config['config'] ?? null;
        if (is_callable($configCallback)) {
            call_user_func($configCallback, static::class, static::$config);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Template Rendering - Responsible for connecting and displaying templates.
    |--------------------------------------------------------------------------
    */

    public static function render(string $view, array $data = [])
    {
        // Якщо заданий кастомний метод рендеру, використовуємо його
        $renderCallback = static::$config['render'] ?? null;
        if (is_callable($renderCallback)) {
            return call_user_func($renderCallback, $view, $data);
        }

        $view = static::getView($view);
        $path = static::$config['path'] ?? (class_exists(\Leaf\Config::class) ? \Leaf\Config::get('views.path') : './');
        $file = rtrim($path, '/\\') . DIRECTORY_SEPARATOR . $view;

        if (!file_exists($file)) {
            trigger_error("Файл $view не знайдено.");
            return null;
        }

        extract(array_merge($data, ['template' => self::class], static::$config['params']));

        ob_start();
        try {
            include $file;
        } catch (\Throwable $th) {
            trigger_error($th);
        }
        return ob_get_clean();
    }

    /*
    |--------------------------------------------------------------------------
    | Getting the template name - Extension .flx.php.
    |--------------------------------------------------------------------------
    */

    private static function getView($view)
    {
        return str_ends_with($view, '.flx.php') ? $view : $view . '.flx.php';
    }
}