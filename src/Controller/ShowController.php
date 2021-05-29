<?php

namespace App\Controller;

use App\Stock;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowController extends AbstractController
{
    /**
     * @Route("/show", name="show")
     */
    public function index(Stock $stock): Response {

        $data = $stock->getKeyInfo();

        return $this->json($data);
    }

}
