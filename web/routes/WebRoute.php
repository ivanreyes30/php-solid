<?php

include_once "$filepath/routing/contracts/RouteInterface.php";
include_once "$filepath/web/controllers/ViewLoginController.php";
include_once "$filepath/web/controllers/ViewStudentController.php";

class WebRoute implements RouteInterface
{
    public function redirect(string $url)
    {
        switch (true) {
            case str_contains($url, '/login'):
                $web = new ViewLoginController();
                $web->login();
                break;

            case str_contains($url, '/student/read-update'):
                    $web = new ViewStudentController();
                    $web->readUpdate();
                    break;
        }
    }
}
