<?php

namespace App\Controller;

use App\Stock;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateController extends AbstractController {

    /**
     * @Route("/update", name="update")
     */
    public function index(Stock $stock): Response {

        $data = $stock->updQuotes();

        return $this->json($data);
    }

}

/*
{
  "status": {
    "timestamp": "2021-05-29T17:29:59.663Z",
    "error_code": 0,
    "error_message": null,
    "elapsed": 18,
    "credit_count": 1,
    "notice": null
  },
  "data": {
    "2781": {
      "id": 2781,
      "name": "United States Dollar",
      "symbol": "USD",
      "slug": "united-states-dollar",
      "num_market_pairs": 0,
      "date_added": "2013-04-28T00:00:00.000Z",
      "tags": [],
      "max_supply": null,
      "circulating_supply": 0,
      "total_supply": 0,
      "is_active": 0,
      "platform": null,
      "cmc_rank": null,
      "is_fiat": 1,
      "last_updated": "2021-05-29T17:29:01.000Z",
      "quote": {
        "BTC": {
          "price": 0.000029123550980711138,
          "volume_24h": 1e-8,
          "percent_change_1h": 0.03648966,
          "percent_change_24h": 5.22051137,
          "percent_change_7d": 11.6902526,
          "percent_change_30d": 54.8458475,
          "percent_change_60d": 71.86027808,
          "percent_change_90d": 27.4656445,
          "market_cap": 0,
          "last_updated": "2021-05-29T17:29:02.000Z"
        }
      }
    },
    "2787": {
      "id": 2787,
      "name": "Chinese Yuan",
      "symbol": "CNY",
      "slug": "chinese-yuan",
      "num_market_pairs": 0,
      "date_added": "2013-04-28T00:00:00.000Z",
      "tags": [],
      "max_supply": null,
      "circulating_supply": 0,
      "total_supply": 0,
      "is_active": 0,
      "platform": null,
      "cmc_rank": null,
      "is_fiat": 1,
      "last_updated": "2021-05-29T17:29:01.000Z",
      "quote": {
        "BTC": {
          "price": 0.000004573134693284152,
          "volume_24h": 1e-8,
          "percent_change_1h": 0.18975657,
          "percent_change_24h": 5.6910112,
          "percent_change_7d": 13.24687965,
          "percent_change_30d": 54.8458475,
          "percent_change_60d": 71.86027808,
          "percent_change_90d": 27.4656445,
          "market_cap": 0,
          "last_updated": "2021-05-29T17:29:02.000Z"
        }
      }
    },
    "2790": {
      "id": 2790,
      "name": "Euro",
      "symbol": "EUR",
      "slug": "euro",
      "num_market_pairs": 0,
      "date_added": "2013-04-28T00:00:00.000Z",
      "tags": [
        "fiat"
      ],
      "max_supply": null,
      "circulating_supply": 0,
      "total_supply": 0,
      "is_active": 0,
      "platform": null,
      "cmc_rank": null,
      "is_fiat": 1,
      "last_updated": "2021-05-29T17:29:01.000Z",
      "quote": {
        "BTC": {
          "price": 0.00003550903404612331,
          "volume_24h": 1e-8,
          "percent_change_1h": 0.20316246,
          "percent_change_24h": 5.97538962,
          "percent_change_7d": 13.47628026,
          "percent_change_30d": 54.8458475,
          "percent_change_60d": 71.86027808,
          "percent_change_90d": 27.4656445,
          "market_cap": 0,
          "last_updated": "2021-05-29T17:29:02.000Z"
        }
      }
    }
  }
}
*/