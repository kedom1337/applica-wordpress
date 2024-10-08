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
        $strOptions = Helper::generateOptionSelect($arrCourse, true);
		echo $strOptions;
	}

    public function makeAnmeldung(): void {
        $arrData = [
            'firstName'   => sanitize_text_field($_POST['firstName']),
            'lastName'    => sanitize_text_field($_POST['lastName']),
            'email'       => sanitize_email($_POST['email']),
            'phone'       => sanitize_text_field($_POST['phone']),
            'courseId'    => intval($_POST['courseId']),
            'semester'    => intval($_POST['semester']),
            'degree'      => sanitize_text_field($_POST['degree']),
            'experience'  => sanitize_textarea_field($_POST['experience']),
            'information' => sanitize_textarea_field($_POST['information']),
            'course'      => intval($_POST['course']),
            'fields'      => array_map('intval', explode(',', $_POST['fields'])),
        ];
        $oApplica = $this->oApplica;
        $oApplica->setRequestType(API_Application::JSON_REQUEST);
        $oResponse = $oApplica->sendApplication($arrData);
        wp_send_json_success($oResponse);
    }
}