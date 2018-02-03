<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;


class WebController {

    /**
     * @Route("/message", name="message")
     */
    function messageAction(Request $request, \App\Services\BotService $botService)
    {
        // Create a BotMan instance, using the WebDriver
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
        $botman = BotManFactory::create([]); //No config options required

        // Give the bot some things to listen for.
        $botman->hears('(hello|hi|hey)', function (BotMan $bot) use ($botService) {
            $bot->reply($botService->handleHello());
        });

        $botman->hears('(what night|when) is club night.*', function (BotMan $bot) use ($botService) {
            $bot->reply($botService->handleClubNights());
        });

        $botman->hears('.*this week.*', function (Botman $bot) use ($botService) {
            $bot->reply($botService->handleThisWeeksActivities());
        });

        $botman->hears('.*enrolment.*', function (Botman $bot) use ($botService) {
            $bot->reply($botService->handleEnrolment());
        });

        // Start listening
        $botman->listen();

        //Send an empty response (Botman has already sent the output itself - https://github.com/botman/botman/issues/342)
        return new Response();
    }



}
