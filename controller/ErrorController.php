<?php

declare(strict_types=1);

class ErrorController
{

    public function notFound(): void {
        require_once('../view/error-404.php');
    }

}