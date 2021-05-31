<?php

namespace App\Controller;

use App\Service\Stock;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateController extends AbstractController {

    /**
     * @Route("/update", name="update")
     */
    public function index(Stock $stock): Response {

        $quotes_arr = $stock->getQuotes();

        $result = $stock->updateQuotes($quotes_arr);

        return new Response('Saved new quotes, last ID is ' . $result);
    }

}
