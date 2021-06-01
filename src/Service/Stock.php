<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use App\Entity\Quotes;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\QuotesRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Description of Stock
 *
 * @author den
 */
class Stock {

    private $stock;
    private $doctrine;
    private $validator;

    public function __construct(
            HttpClientInterface $stockApi,
            EntityManagerInterface $entityManager,
            ValidatorInterface $validator
    ) {
        $this->stock = $stockApi;
        $this->doctrine = $entityManager;
        $this->validator = $validator;
    }

    public function getKeyInfo(): array {
        #=)
        $response = $this->stock->request(
                'GET',
                '/v1/key/info',
        );

        $status_code = $response->getStatusCode();
        if (200 !== $status_code) {
            // handle the HTTP request error (e.g. retry the request)
            $content = [
                'error_code' => $status_code,
                'error_message' => 'Stock request error.',
            ];
        } else {
            $content = $response->getContent(); // returns the raw content returned by the server (JSON in this case)
            $content = $response->toArray(); // transforms the response JSON content into a PHP array
        }
        return $content;
    }

    public function getQuotes() {
        $response = $this->stock->request(
                'GET',
                '/v1/cryptocurrency/quotes/latest',
                [
                    'query' => [
                        'id' => '2781,2790,2787', //USD,EUR,CNY
                        'convert' => 'BTC'
                    ]
                ]
        );

        $status_code = $response->getStatusCode();
        if (200 !== $status_code) {
            // handle the HTTP request error (e.g. retry the request)
            $content = [
                'error_code' => $status_code,
                'error_message' => 'Stock request error.',
            ];
        } else {
            $content = $response->getContent(); // returns the raw content returned by the server (JSON in this case)
            $content = $response->toArray(); // transforms the response JSON content into a PHP array
        }
        return $content;
    }

    public function updateQuotes($quotes_arr) {

        $entityManager = $this->doctrine;

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

                $errors = $this->validator->validate($quotes);
                if (count($errors) > 0) {
                    return new Response((string) $errors, 400);
                }

                $entityManager->persist($quotes);
            }
        }

        $entityManager->flush();

        
        
        return $quotes->getId();
    }

}
