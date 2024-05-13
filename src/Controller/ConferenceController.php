<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Util\UseStatementGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConferenceController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {

        return new Response(<<<EOF
        
                    <html>
                      <body><img src="/images/under-construction.gif" /></body>
                   </html>
           EOF);
    }
}
UseStatementGenerator