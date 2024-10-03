<?php

class API_Application {

    const ARRAY_RESPONSE = 0;
    const JSON_RESPONSE = 1;

    private $intResponseType = 0;

    public function __construct() {
    }

    public function setResponseType($intType) {
        $this->intResponseType = $intType;
    }

    public function getResponseType() {
        return $this->intResponseType;
    }

    public function getCourses() {
        return $this->makeRequest('GET', 'courses');
    }

    public function getFields() {
        return $this->makeRequest('GET', 'fields');
    }

    public function sendApplication($arrFields) {
        $strUrl = API_URL . 'applications';
        return $this->makeRequest('POST', 'applications', $arrFields);
    }

    private function makeRequest($strMethod, $strRoute, $arrData = []) {
        $oCurl = curl_init();
        $strUrl = API_URL . "/" . $strRoute;

        switch (strtoupper($strMethod)) {
            case 'POST':
                curl_setopt($oCurl, CURLOPT_POST, true);
                curl_setopt($oCurl, CURLOPT_POSTFIELDS, http_build_query($arrData));
                break;
            case 'PUT':
                curl_setopt($oCurl, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($oCurl, CURLOPT_POSTFIELDS, http_build_query($arrData));
                break;
            case 'DELETE':
                curl_setopt($oCurl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
            case 'GET':
            default:
                if (!empty($arrData)) {
                    $strUrl .= '?' . http_build_query($arrData);
                }
                break;
        }

        curl_setopt($oCurl, CURLOPT_URL, $strUrl);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($oCurl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded'
        ]);

        $oResponse = curl_exec($oCurl);
        curl_close($oCurl);

        if ($this->getResponseType() == self::JSON_RESPONSE) {
            $oResponse = json_decode($oResponse, true);
        }

        return $oResponse;
    }
}
