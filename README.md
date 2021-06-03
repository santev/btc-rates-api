# btc-rates-api
API to API, Symfony 5 application (proxy API). It allows you to collect data on Bitcoin quotes for USD, EUR, CNY, and so on. Takes the data on the cryptocurrency exchange and stores it in a local database for subsequent provision at the request of the client.

# Application setup manual:

1) Register a developer account at https://pro.coinmarketcap.com/signup/ and get an API key.
2) Install Docker.
3) Install Symfony.

4) Run the following few commands in a terminal:
```
$ symfony check:requirements
$ cd projects/
$ git clone https://github.com/santev/btc-rates-api.git
$ cd btc-rates-api/
$ composer install
$ symfony server:start
$ sudo docker-compose up -d --build
```
5) Make sure the docker is running MySQL database and check server HOST and PORT in /config/packages/doctrine.yaml. If all is ok, make model schema, run command:
```
$ symfony console doctrine:migrations:migrate
```
6) Open to edit .env file and paste API key to variable 
```
CMC_PRO_API_KEY="your_cmc_api_key_string_here"
```
7) Go to http://127.0.0.1:8001/ and make sure that the application is running and returns data to JSON with information about the API key.
8) Go to http://127.0.0.1:8001/update and check if no errors occur and the data on quotes appeared in the Quotes table of the btc_db database.

9) Add the following string to your crontab (#crontab -u user -e) to automatically update quotes every 5 minutes: 
```
*/5 * * * * /path to your btc-rates-api/bin/console app:quotes-update
```
10) After some time make query to API to get data for chart:
	
		$url = 'http://127.0.0.1:8001/chart/btc-usd/1h';//   BTC/USD
		//$url = 'http://127.0.0.1:8001/chart/btc-eur/1h';// BTC/EUR
		//$url = 'http://127.0.0.1:8001/chart/btc-cny/1h';// BTC/CNY

		$parameters = [
			  'start-date' => date("Y-m-d H:i:s", time() - (24 * 60 * 60)),
			  'end-date' => date("Y-m-d H:i:s")
		];

		$headers = [
		  'Accepts: application/json'
		];
		$qs = http_build_query($parameters); // query string encode the parameters
		$request = "{$url}?{$qs}"; // create the request URL

		$curl = curl_init(); // Get cURL resource
		// Set cURL options
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $request,            // set the request URL
		  CURLOPT_HTTPHEADER => $headers,     // set the headers 
		  CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
		));

		$response = curl_exec($curl); // Send the request, save the response
		print_r(json_decode($response)); // print json decoded response
		curl_close($curl); // Close request

