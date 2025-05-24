<?php

// Увага! Цей файл є частиною пакету Flowaxy Templater. 
// Не редагуйте цей файл без необхідності. 
// Для налаштувань використовуйте відповідні конфігураційні файли вашого проєкту.

if (class_exists(\Leaf\Config::class)) {
    \Leaf\Config::addScript(
        fn() => \Leaf\Config::attachView(\Flowaxy\Templater::class, 'template')
    );
}