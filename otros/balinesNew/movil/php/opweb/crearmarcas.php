<div>
    <div>nombre</div>
    <div>
        <input name="nombre" id="nombre" placeholder="Nombre de la marca" type="text" maxlength="255" />
    </div>
</div>
<div>
    <div>descripcion</div>
    <div>
        <input name="descripcion" id="descripcion" placeholder="Una descripcion general" type="text" maxlength="255" />
    </div>
</div>
<div>
    <div>imagen</div>
    <div>
        <a class="vinculo" data-role="button" data-icon="action" data-iconpos="left" href="#" onClick="abrirInput('archivos');" <?php echo tipoTrans ?>>seleccionar imagen</a>
        <div style="height:0; width:0; top:0; left:0; position:absolute;"><input id="archivos" type="file" name="archivos[]" style="visibility:hidden;" /></div>
    </div>
</div>
<a class="vinculo" data-role="button" data-icon="check" data-iconpos="left" href="#" onClick="nuevaMarca()" <?php echo tipoTrans ?>>crear marca</a>
