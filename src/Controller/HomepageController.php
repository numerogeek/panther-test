<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Panther\Client;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {


        $client = Client::createChromeClient();
// Or, if you care about the open web and prefer to use Firefox
 //       $client = Client::createFirefoxClient('');

        $client->request('GET', 'https://api-platform.com'); // Yes, this website is 100% written in JavaScript
        $client->clickLink('Getting started');

// Wait for an element to be present in the DOM (even if hidden)
        $crawler = $client->waitFor('#installing-the-framework');
// Alternatively, wait for an element to be visible
        $crawler = $client->waitForVisibility('#installing-the-framework');

        echo $crawler->filter('#installing-the-framework')->text();
        $client->takeScreenshot('screen.png'); // Yeah, screenshot!

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
}
