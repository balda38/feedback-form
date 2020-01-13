<?php

namespace App\Core;

/** 
 * Базовый класс отвечающий за взаимодействие с моделью и отрисовку вьюшки.
 */
abstract class Controller
{
    protected $model;
    protected $view;

    /**
     * Базовый метод, выполняющийся при создании экземпляра класса.
     * 
     * @return void
     */
    public function __construct()
    {

    }
}
