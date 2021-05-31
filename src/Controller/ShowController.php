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

        //Validation of submitted date period values.
        $start = \DateTime::createFromFormat('Y-m-d H:i:s', $request->query->get('start-date'));
        $end = \DateTime::createFromFormat('Y-m-d H:i:s', $request->query->get('end-date'));
        if (!is_object($start) || !is_object($end)) {
            return new Response((string) 'Period date format error!', 400);
        } else {
            $period = [
                'start' => $start->format('Y-m-d H:i:s'),
                'end' => $end->format('Y-m-d H:i:s')
            ];
        }
        
        //validation of requested values of currency pair
        if (!in_array($pair, $pair_arr = ['btc-usd', 'btc-eur', 'btc-cny'])) {
            return new Response((string) 'Unsupported requested of currency pair name!', 400);
        }
        
        
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
                return new Response((string) 'Unsupported requested of interval value!', 400);
                break;
        }


        return $this->json($data);
    }

}
