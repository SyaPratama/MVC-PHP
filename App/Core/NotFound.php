<?php

namespace App\Core;

class NotFound
{
  function Error()
  {
    require __DIR__ . "/../../Views/Error.php";
  }
}