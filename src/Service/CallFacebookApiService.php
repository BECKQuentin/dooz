<?php

namespace App\Service;

use App\Repository\EventRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallFacebookApiService
{
    private string $facebookAccessTokenEpisode0;
    private string $facebookAccessTokenMalleus;
    private string $facebookAccessTokenVanaheim;

    public function __construct(string $facebookAccessTokenEpisode0, string $facebookAccessTokenMalleus, string $facebookAccessTokenVanaheim)
    {
        $this->facebookAccessTokenEpisode0= $facebookAccessTokenEpisode0;
        $this->facebookAccessTokenMalleus = $facebookAccessTokenMalleus;
        $this->facebookAccessTokenVanaheim = $facebookAccessTokenVanaheim;
    }

    public function getAllEventsApiFacebook() {

        $arrDatasEvents = [];

        $arrDatasEvents[] = $this->getEventsApiFacebookEpisode0();
        $arrDatasEvents[] = $this->getEventsApiFacebookMalleus();
        $arrDatasEvents[] = $this->getEventsApiFacebookVanaheim();

        return $arrDatasEvents;
    }

    //récupération des données de l'EPISODE 0
    public function getEventsApiFacebookEpisode0()
    {
        $pageName = "episode0barajeux";

        $i = 0;
        do {
            $curl = curl_init("https://graph.facebook.com/v14.0/" . $pageName . "/events"
                . "?fields=id,name,place,description,start_time,end_time,cover,created_time,interested_count,attending_count,ticket_uri"
                . "&access_token=" . $this->facebookAccessTokenEpisode0);
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CAINFO => dirname(__DIR__) . '/../config/certificate/cert.cer',
                CURLOPT_TIMEOUT => 1,
            ]);
            $data = curl_exec($curl);
            $i++;
        } while ($data === false || $i < 2);

        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
            return json_decode($data, true);
        }

        return [];
    }


    //Récupération des données du MALLEUS
    public function getEventsApiFacebookMalleus() {
        $pageName = "malleusbar";

        $i = 0;
        do {
            $curl = curl_init("https://graph.facebook.com/v14.0/" . $pageName . "/events"
                . "?fields=id,name,place,description,start_time,end_time,cover,created_time,interested_count,attending_count,ticket_uri"
                . "&access_token=" . $this->facebookAccessTokenMalleus);
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CAINFO => dirname(__DIR__) . '/../config/certificate/cert.cer',
                CURLOPT_TIMEOUT => 1,
            ]);
            $data = curl_exec($curl);
            $i++;
        } while ($data === false || $i < 2);

        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
            return json_decode($data, true);
        }

        return [];
    }

    //récupération des données de VANAHEIM
    public function getEventsApiFacebookVanaheim() {
        $pageName = "dooz.vanaheim";

        $curlVanaheim = curl_init("https://graph.facebook.com/v14.0/".$pageName."/events"
            ."?fields=id,name,place,description,start_time,end_time,cover,created_time,interested_count,attending_count,ticket_uri"
            ."&access_token=".$this->facebookAccessTokenEpisode0);
        curl_setopt_array($curlVanaheim, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CAINFO => dirname(__DIR__) . '/../config/certificate/cert.cer',
            CURLOPT_TIMEOUT => 1,
        ]);
        $dataVanaheim = curl_exec($curlVanaheim);

        if ($dataVanaheim === false) {
            //retry
        } else {
            if (curl_getinfo($curlVanaheim, CURLINFO_HTTP_CODE) === 200) {
                return json_decode($dataVanaheim, true);
            }
        }
        return [];
    }
}