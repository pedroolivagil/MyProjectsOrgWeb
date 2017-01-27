<?php

/**
 * Description of Template
 *
 * @author Oliva
 */
abstract class Template {

    public static function getHeader() {
        $userPanel = '';
        if (!Tools::isUserSession()) {
            $userPanel = '<ul class="nav navbar-nav navbar-right">'
                    . '<li><a href="' . _ROOT_PATH_ . 'login">' . Translator::getTextStatic('LOGIN_PAGE_SIGN_IN') . '</a></li>'
                    . '<li><a href="' . _ROOT_PATH_ . 'signup">' . Translator::getTextStatic('LOGIN_PAGE_SIGN_UP') . '</a></li>'
                    . '</ul>';
        } else {
            $userPanel = '<ul class="nav navbar-nav navbar-right">'
                    . '<li class="dropdown">'
                    . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'
                    . ucfirst(Tools::getCookie(SESSION_USUARIO_NAME)) . ' <span class="caret"></span></a>'
                    . '<ul class="dropdown-menu">'
                    . '<li class="dropdown-header">' . Translator::getTextStatic('USER_DROPDOWN_HEADER_PROFILE') . '</li>'
                    . '<li><a href="' . _ROOT_PATH_ . 'user-panel">' . Translator::getTextStatic('USER_DROPDOWN_CONTROL_PANEL') . '</a></li>'
                    . '<li><a href="' . _ROOT_PATH_ . 'user-panel">' . Translator::getTextStatic('USER_DROPDOWN_NEW_PASS') . '</a></li>'
                    . '<li role="separator" class="divider"></li>'
                    . '<li class="dropdown-header">' . Translator::getTextStatic('USER_DROPDOWN_HEADER_PROJECTS') . '</li>'
                    . '<li><a href="' . _ROOT_PATH_ . 'user-project/pag/1">' . Translator::getTextStatic('USER_DROPDOWN_VIEW_PROJECTS') . '</a></li>'
                    . '<li><a href="' . _ROOT_PATH_ . 'user-project/create-project">' . Translator::getTextStatic('USER_DROPDOWN_NEW_PROJECT') . '</a></li>'
                    . '<li role="separator" class="divider"></li>'
                    . '<li><a href="' . _ROOT_PATH_ . 'logout">' . Translator::getTextStatic('USER_DROPDOWN_LOGOUT') . '</a></li>'
                    . '</ul>'
                    . '</li>
          </ul>';
        }
        $params = array(
            '[CSS]' => _CSS_PATH_,
            '[IMG_BRAND]' => '<img src="' . _IMAGE_PATH_ . 'logo.png" class="header-img" />',
            '[GENERIC_TITLE]' => Translator::getTextStatic('GENERIC_TITLE'),
            '[HOME_PAGE]' => Translator::getTextStatic('HOME_PAGE'),
            '[ABOUT_PAGE]' => Translator::getTextStatic('ABOUT_PAGE'),
            '[CONTACT_PAGE]' => Translator::getTextStatic('CONTACT_PAGE'),
            '[USER_PANEL]' => $userPanel,
            '[GENERIC_TITLE_DELETE]' => Translator::getTextStatic('GENERIC_TITLE_DELETE'),
            '[GENERIC_BODY_DELETE]' => Translator::getTextStatic('GENERIC_BODY_DELETE'),
            '[DELETE]' => Translator::getTextStatic('GENERIC_DELETE'),
            '[CLOSE]' => Translator::getTextStatic('GENERIC_CLOSE'),
            '[GENERIC_NEXT]' => Translator::getTextStatic('GENERIC_NEXT'),
            '[GENERIC_PREV]' => Translator::getTextStatic('GENERIC_PREV'),
            '[LOCALE]' => LOCALE
        );
        $tpl = self::getContentOfFile(_PAGES_PATH_ . 'header.php', $params);
        print self::htmlEntityDecode($tpl);
    }

    /*
     * @param $url array asociativo con el titulo y la url
     */

    public static function getBreadCrumbs($breads) {
        $breadcrumbs = '<!--// BreadCrumbs //-->';
        $breadcrumbs .= '<ol class="breadcrumb panel-primary shadow">';
        $breadcrumbs .= '<li><a href="' . _ROOT_PATH_ . 'home">' . Translator::getTextStatic('HOME_PAGE') . '</a></li>';
        $x = 0;
        foreach ($breads as $title => $url) {
            if ($x < (count($breads) - 1)) {
                $breadcrumbs .= '<li><a href="' . _ROOT_PATH_ . $url . '">' . $title . '</a></li>';
            } else {
                $breadcrumbs .= '<li class="active">' . $title . '</li>';
            }
            $x++;
        }
        $breadcrumbs .= '</ol>';
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

    public static function openPanelHeader($css = NULL) {
        print '<div class="panel-heading ' . $css . '">';
    }

    public static function closePanelHeader() {
        print '</div>';
    }

    public static function openPanelBody($css = NULL) {
        print '<div class="panel-body ' . $css . '">';
    }

    public static function closePanelBody() {
        print '</div>';
    }

    public static function openPanelFooter() {
        print '<div class="panel-footer">';
    }

    public static function closePanelFooter() {
        print '</div>';
    }

    public static function openPanel() {
        print '<div class="panel panel-primary panel-derecha">';
    }

    public static function closePanel() {
        print '</div>';
    }

    public static function getFooter($scripts = '') {
        $params = array(
            '[JS]' => _JS_PATH_,
            '[SCRIPTS]' => $scripts,
            '[PUBLICIDAD]' => Translator::getTextStatic('BANNER_ADS'),
            '[LOCALE]' => LOCALE
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

    public static function showADSLargo() {
        return '<!-- banner largo -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-2083012446340886"
                data-ad-slot="7976441102"
                data-ad-format="auto"></ins>';
    }

    public static function showADSAdaptable() {
        return '<!-- banner inferior MyProjectsOrg -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-2083012446340886"
                 data-ad-slot="7720919102"
                 data-ad-format="auto"></ins>';
    }

}
