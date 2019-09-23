<?php

namespace Codenation;

use Codenation\Cyphers\Cypher;
use GuzzleHttp\Client;

class CodenationJob
{

    private $urlGenerate = '';
    private $urlSolution = '';
    private $responseBody;
    private $answerFile;
    private $resultFile;
    private $jsonData;
    private $cypher;

    public function __construct(Cypher $cypher)
    {
        $this->cypher = $cypher;
        $this->client = new Client();

        $this->urlGenerate = getenv('API_URL') . 'generate-data?token=' . getenv('API_TOKEN');
        $this->urlSolution = getenv('API_URL') . 'submit-solution?token=' . getenv('API_TOKEN');

        $resourcesFolder = __DIR__ . '/../resources/';
        $this->answerFile = $resourcesFolder . 'answer.json';
        $this->resultFile = $resourcesFolder . 'result.json';
    }

    public function process()
    {
        $this->retrieveAnswerJson();
        $this->saveAnswerJson();
        $this->readAnswerJson();
        $this->setCesarCypher();
        $this->cypher->decrypt();
        $this->fillJsonResult();
        $this->writeResult();
        $this->sendResult();
    }

    private function retrieveAnswerJson()
    {

        $response = $this->client->request('GET', $this->urlGenerate);
        $this->responseBody = $response->getBody();
    }


    private function saveAnswerJson()
    {
        $fp = fopen($this->answerFile, 'w');
        fwrite($fp, $this->responseBody);
        fclose($fp);
    }

    private function readAnswerJson()
    {
        $json = file_get_contents($this->answerFile);
        $this->jsonData = json_decode($json, true);
    }

    private function setCesarCypher()
    {
        $range = $this->jsonData['numero_casas'] * -1;
        $string = $this->jsonData['cifrado'];

        $this->cypher->range = $range;
        $this->cypher->string = $string;
    }

    private function fillJsonResult()
    {
        $this->jsonData['decifrado'] = $this->cypher->encrypted;
        $this->jsonData['resumo_criptografico'] = sha1($this->cypher->encrypted);
    }

    private function writeResult()
    {
        $json = json_encode($this->jsonData);
        $fp = fopen($this->resultFile, 'w');
        fwrite($fp, $json);
        fclose($fp);
    }

    private function sendResult()
    {
        $this->client->post($this->urlSolution, [
            'multipart' => [
                [
                    'name' => 'answer',
                    'filename' => 'answer.json',
                    'contents' => fopen($this->resultFile, 'r')
                ]
            ]
        ]);
    }

}
