<?php

class Helper {


    public static function parseFieldsJson($arrData) {
        $result = [];

        if (isset($arrData['result']) && is_array($arrData['result'])) {
            foreach ($arrData['result'] as $field) {
                if (isset($field['id']) && isset($field['name'])) {
                    $result[$field['id']] = $field['name'];
                }
            }
        }
        return $result;
    }


    public static function generateOptionSelect(array $arrData, bool $blnParse = false) {
        if ($blnParse) {
            $arrData = self::parseFieldsJson($arrData);
        }
    $strOptions = '';
    foreach ($arrData as $strValue => $strDisplayName) {
        $strOptions .= '<option value="' . htmlspecialchars($strValue) . '">' . htmlspecialchars($strDisplayName) . '</option>';
    }
    return $strOptions;
}

}