<?php

namespace MVC\App\Core;

class View
{
    static public function render(string $view,array $model): void
    {
        require __DIR__ . "/../../Views/partials/header.php";
        require __DIR__ . "/../../Views/" . $view . ".php";
        require __DIR__ . "/../../Views/partials/footer.php";
    }
}