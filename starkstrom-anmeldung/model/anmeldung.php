<?php
require_once PLUGIN_PATH . "api/application.php";
require_once( PLUGIN_PATH . "/helper.php" );

class Mod_Application {

    public $oApplica;

    public function __construct() {
        $this->oApplica = new API_Application();
        $this->oApplica->setResponseType(API_Application::JSON_RESPONSE);
    }

    public function getOptionInterests() {
        $arrInterest = [
            0 => 'Keine interessen',
            1 => 'Interesse 1',
            2 => 'Interesse 2',
            3 => 'Interesse 3',
            4 => 'Interesse 4',
            5 => 'Interesse 5',
            6 => 'Interesse 6',
        ];

        return $arrInterest;
    }

	public function getOptionInterestsOld() {
		$arrInterest = [
			0 => 'Keine interessen',
			1 => 'Interesse 1',
			2 => 'Interesse 2',
			3 => 'Interesse 3',
			4 => 'Interesse 4',
			5 => 'Interesse 5',
			6 => 'Interesse 6',
		];

		return $arrInterest;
	}

    public function getOptionFieldAreas() {
        $arrFieldAreas = $this->oApplica->getFields();
        $strOptions = Helper::generateOptionSelect($arrFieldAreas, true);
        echo $strOptions;
    }

	public function getOptionCourseOfStudy() {
        $arrCourse = $this->oApplica->getCourses();
        echo "Kurse" . var_dump($arrCourse);
        $strOptions = Helper::generateOptionSelect($arrCourse, true);
		echo $strOptions;
	}
}