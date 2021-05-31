<?php

namespace App\Controller;

use App\Stock;
use App\Repository\QuotesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShowController extends AbstractController {

    /**
     * @Route("/", name="keyinfo")
     */
    public function index(Stock $stock): Response {

        $data = $stock->getKeyInfo();

        return $this->json($data);
    }

    /**
     * @Route("/chart/{pair}/{interval}", name="chart")
     */
    public function chart(Stock $stock, string $pair = 'btc-usd', string $interval, Request $request, QuotesRepository $quotesRepository): Response {

        $data = [];

        $period = [
            'start' => \DateTime::createFromFormat('Y-m-d H:i', $request->query->get('start-date')),
            'end' => \DateTime::createFromFormat('Y-m-d H:i', $request->query->get('end-date'))
        ];

        //$pair_arr may be composed from db in a future releases
        if (!in_array($pair, $pair_arr = ['btc-usd', 'btc-eur', 'btc-cny'])) {
            return new Response((string) 'Unsupported currency pair name!', 400);
        } else {


            switch ($interval) {
                case '1h':
                    
                    $data = $quotesRepository->hourlyPairQuotesForPeriod($pair, $period);

                    break;

                case '1d':
                    break;

                case '1w':
                    break;

                //case '...etc'

                default:
                    return new Response((string) 'Unsupported interval!', 400);
                    break;
            }

            
        }

        return $this->json($data);
    }

}
