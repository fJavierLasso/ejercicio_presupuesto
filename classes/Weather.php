<?php

class Weather {
    private $api_url = 'http://api.weatherstack.com/current';
    private $api_key = '27a82a8801cfaddafd33babf92d9e37a';

    public function getCurrentWeather($city) {
        $url = $this->api_url . '?access_key=' . $this->api_key . '&query=' . urlencode($city) . '&units=m';
        try {
            $response = file_get_contents($url);
            $weather_data = json_decode($response);

            if (isset($weather_data->error)) {
                throw new Exception($weather_data->error->info);
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }

        return $weather_data;
    }
}

?>