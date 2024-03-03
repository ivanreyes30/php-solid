<?php

include_once "$filepath/routing/contracts/RouteInterface.php";
include_once "$filepath/web/controllers/ViewAuthController.php";
include_once "$filepath/web/controllers/ViewStudentController.php";
include_once "$filepath/web/controllers/ViewAdminController.php";
include_once "$filepath/web/controllers/ViewErrorController.php";

class WebRoute implements RouteInterface
{
    public function redirect(string $url)
    {
        switch (true) {
            case str_contains($url, '/login'):
                $web = new ViewAuthController();
                $web->login();
                break;

            case str_contains($url, '/sign-up'):
                $web = new ViewAuthController();
                $web->signUp();
                break;

            case str_contains($url, '/student/home'):
                $web = new ViewStudentController();
                $web->home();
                break;

            case str_contains($url, '/admin/home'):
                $web = new ViewAdminController();
                $web->home();
                break;

            case str_contains($url, '/not-found'):
                $web = new ViewErrorController();
                $web->notFound();
                break;

            case str_contains($url, '/forbidden'):
                $web = new ViewErrorController();
                $web->forbidden();
                break;

            case str_contains($url, '/unauthorized'):
                $web = new ViewErrorController();
                $web->unauthorized();
                break;
        }
    }
}
