<?php

namespace App\Core;

class View
{
    static public function render(string $view,array $data): void
    {
        global $BASEURL;
        require __DIR__ . "/../../Views/partials/header.php";
        require __DIR__ . "/../../Views/" . $view . ".php";
        require __DIR__ . "/../../Views/partials/footer.php";
    }
}