<?php

include_once "$filepath/api/routes/contracts/RouteInterface.php";
include_once "$filepath/web/controllers/ViewLoginController.php";

class WebRoute implements RouteInterface
{
    public function redirect(string $url)
    {
        switch (true) {
            case str_contains($url, '/login'):
                $web = new ViewLoginController();
                $web->view();
                break;
        }
    }
}
