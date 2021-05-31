<?php

namespace App\Controller;

use App\Stock;
use App\Entity\Quotes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Annotation\Route;

class UpdateController extends AbstractController {

    /**
     * @Route("/update", name="update")
     */
    public function index(Stock $stock, ValidatorInterface $validator): Response {

        $quotes_arr = $stock->getQuotes();

        $entityManager = $this->getDoctrine()->getManager();

        if (array_key_exists('data', $quotes_arr)) {
            foreach ($quotes_arr['data'] as $cmc_id => $cmc_arr) {
                $quotes = new Quotes();
                $quotes->setCmcId($cmc_id);
                $quotes->setName($cmc_arr['name']);
                $quotes->setSymbol($cmc_arr['symbol']);
                $quotes->setSlug($cmc_arr['slug']);
                $quotes->setLastUpdated(\DateTime::createFromFormat('Y-m-d\TH:i:s.vO', $cmc_arr['last_updated']));
                $quotes->setBTCPrice($cmc_arr['quote']['BTC']['price']);
                $quotes->setPriceLastUpdated(\DateTime::createFromFormat('Y-m-d\TH:i:s.vO', $cmc_arr['quote']['BTC']['last_updated']));

                $errors = $validator->validate($quotes);
                if (count($errors) > 0) {
                    return new Response((string) $errors, 400);
                }

                $entityManager->persist($quotes);
            }
        }

        $entityManager->flush();

        return new Response('Saved new quotes in ' . date_format($quotes->getLastUpdated(), 'Y-m-d H:i:s'));
    }

}
