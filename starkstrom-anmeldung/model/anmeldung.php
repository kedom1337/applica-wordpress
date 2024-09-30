<?php

namespace model;

class anmeldung {


	// Für Multiselect Auswahl der Interessen
	public static function getOptionInterests() {
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

	public static function getOptionCourseOfStudy() {
		$arrCourse = [
			1 => 'Studiengang 1',
			2 => 'Studiengang 2',
			3 => 'Studiengang 3',
			4 => 'Studiengang 4',
			5 => 'Studiengang 5',
		];

		return $arrCourse;
	}
}