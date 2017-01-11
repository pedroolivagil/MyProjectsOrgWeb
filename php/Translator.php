<?php

/**
 * Description of Translator
 *
 * @author Oliva
 */
class Translator {

    //put your code here
    private $lang;

    function __construct($lang) {
        $this->lang = $lang;
    }

    function getLang() {
        return $this->lang;
    }

    function getText($label, $lang = null) {
        $lang = ($lang == null) ? $this->lang : $lang;
        $idioma = Database::preparedQuery(PaisesFindByISO, array("iso" => $lang));
        $params = array(
            "id_idioma" => $idioma[0]['id'],
            "label" => $label
        );
        $result = Database::preparedQuery(ParametroByEtiqueta, $params);
        return $result[0]['texto'];
    }

    static function getTextStatic($label, $lang = "es") {
        $lang = ($lang == null) ? LOCALE : $lang;
        $idioma = Database::preparedQuery(PaisesFindByISO, array("iso" => $lang));
        $params = array(
            "id_idioma" => $idioma[0]['id'],
            "label" => $label
        );
        $result = Database::preparedQuery(ParametroByEtiqueta, $params);
        return (!is_null($result[0]['texto']) && !empty($result[0]['texto'])) ? $result[0]['texto'] : $label;
    }

}
