<?php

namespace freelancerppe\Controller;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use freelancerppe\Domain\Calendar;


class CalendarController {
   
    public function indexAction(Application $app)  {

        return $app['twig']->render('calendar.html.twig');
    }
}
