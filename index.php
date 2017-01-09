<?php
require_once('config.php');
Database::init_db();
Template::getHeader();

?>
<div class="container well text-justify">
    <h3>AVISO LEGAL</h3>
    <p>La Web de <strong>[DOMINIO]</strong> tiene como objetivo informar a los clientes actuales así como a nuevos usuarios de los productos, servicios y novedades que ofrece. </p>
    <p>El dominio <strong>[DOMINIO]</strong> es propiedad de <strong>[EMPRESA]</strong> es el titular de los derechos de propiedad intelectual sobre los logotipos, imágenes, diseños y textos o de cualquier otro elemento de esta web. </p>
    <p>En caso de no ser el titular, <strong>[EMPRESA]</strong> dispone de los permisos necesarios para la utilización de los mismos. Por ello, queda prohibida su reproducción, comercialización, distribución o transformación de cualquier tipo sin el consentimiento por escrito por parte de los responsables de <strong>[EMPRESA]</strong>. </p>
    <p><strong>[EMPRESA]</strong> no asume la responsabilidad que se derive de la mala utilización de los contenidos y se reserva el derecho a realizar las modificaciones (eliminación o restricción total o parcial) de los contenidos que crea oportunos sin previo aviso. </p>
    <p><strong>[EMPRESA]</strong> no se responsabiliza de cualquier consecuencia directa o indirecta que pueda ocasionar la exactitud de los contenidos de la web. </p>
    <h3>PROTECCIÓN DE DATOS </h3>
    <p>En cumplimiento de la normativa de datos de carácter personal id'áccord con la LOPD 15/1999, los datos de carácter personal aportados a través de la cumplimentación de los formularios de esta web formarán parte de un fichero propiedad de <strong>[EMPRESA]</strong> . </p>
    <p>Al enviar estos datos, el usuario o cliente da su consentimiento para que formen parte de este fichero que tiene como finalidad el envío de comunicaciones de carácter comercial o informativo. </p >
    <p>En cumplimiento de esta ley <strong>[EMPRESA]</strong> no realizará ninguna cesión total o parcial de dichos datos a ninguna empresa u organización ni los utilizará para ningún otro fin que no sea el descrito en el párrafo anterior. </p>
    <p>El titular de los datos podrá ejercer los derechos de acceso, rectificación, cancelación y oposición en los términos y plazos establecidos por la LOPD 15/1999, dirigiéndose a: </p>
    <div class="well well-sm translucid-80">
        <p class="mar10-lr"><strong>[EMPRESA]</strong></p>
        <p class="mar10-lr"><abbr title="Correo electrónico">eM:</abbr> <a href="mailto:[EMAIL]">[EMAIL]</a></p>
    </div>
</div>
<?php
Template::getFooter();
Database::close_db();
?>
