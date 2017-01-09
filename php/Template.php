<?php

/**
 * Description of Template
 *
 * @author Oliva
 */
abstract class Template {

    public static function getHeader() {
        $params = array(
            '[CSS]' => _CSS_PATH_,
            '[GENERIC_TITLE]' => Translator::getTextStatic('GENERIC_TITLE', LOCALE),
            '[HOME_PAGE]' => Translator::getTextStatic('HOME_PAGE', LOCALE),
            '[ABOUT_PAGE]' => Translator::getTextStatic('ABOUT_PAGE', LOCALE),
            '[CONTACT_PAGE]' => Translator::getTextStatic('CONTACT_PAGE', LOCALE),
            '[LOGIN_PAGE_SIGN_IN]' => Translator::getTextStatic('LOGIN_PAGE_SIGN_IN', LOCALE),
            '[LOGIN_PAGE_SIGN_UP]' => Translator::getTextStatic('LOGIN_PAGE_SIGN_UP', LOCALE)
        );
        $tpl = self::getContentOfFile(_PAGES_PATH_ . 'header.php', $params);
        print self::htmlEntityDecode($tpl);
    }

    /*
     * @param $url array asociativo con el titulo y la url
     */

    public static function getBreadCrumbs($breads) {
        $breadcrumbs = '<!--// BreadCrumbs //-->';
        $breadcrumbs .='<ol class="breadcrumb">';
        $breadcrumbs.='<li><a href="home">' . Translator::getTextStatic('HOME_PAGE') . '</a></li>';
        $x = 0;
        foreach ($breads as $title => $url) {
            if ($x < (count($breads) - 1)) {
                $breadcrumbs.='<li><a href="' . $url . '">' . $title . '</a></li>';
            } else {
                $breadcrumbs.='<li class="active">' . $title . '</li>';
            }
            $x++;
        }
        $breadcrumbs .='</ol>';
        print self::htmlEntityDecode($breadcrumbs);
    }

    public static function getLegalFile() {
        $params = array(
            '[DOMINIO]' => $_SERVER['SERVER_NAME'],
            '[EMPRESA]' => EMPRESA,
            '[EMAIL]' => MAILTECNICO
        );
        $tpl = Template::getContentOfFile(_DOCS_PATH_ . 'legal_' . LOCALE . '.txt', $params);
        print self::htmlEntityDecode($tpl);
    }

    public static function getFooter() {
        $params = array(
            '[JS]' => _JS_PATH_
        );
        $tpl = self::getContentOfFile(_PAGES_PATH_ . 'footer.php', $params);
        print self::htmlEntityDecode($tpl);
    }

    private static function htmlEntityDecode($tpl) {
        return html_entity_decode($tpl, ENT_QUOTES, 'UTF-8');
    }

    private static function getContentOfFile($url, $params = false) {
        Tools::chmodAll($url);
        $txt = "";
        $keys = array_keys($params);
        $values = array_values($params);
        $file = fopen($url, "r") or exit("Error de lectura de 'Header'");
//Output a line of the file until the end is reached
        while (!feof($file)) {
            if ($params) {
                $txt .= str_replace($keys, $values, fgets($file)) . "\n";
            } else {
                $txt .= fgets($file) . "\n";
            }
        }
        fclose($file);
        Tools::chmodDef($url);
        return $txt;
    }

}
