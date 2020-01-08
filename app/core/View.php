<?php

/** 
 * Базовый класс отвечающий за отрисовку вьюшки.
 */
class View
{
    /**
     * Метод, выполняющий файл для отрисовки вьюшки.
     * 
     * @param string $content_view  Вид отображающий контент страницы.
     * @param string $template_view Общий для всех страниц шаблон.
     * @param array  $data          Массив, содержащий данные для отображения 
     *                              контента страницы.
     * 
     * @return void
     */
    function generate($content_view, $template_view, $data)
    {
        include_once 'app/views/'.$content_view;
    }
}
