<div id="fondo">
  <div id="centro">
    <div id="barrasup"> </div>
    <div id="contenido">
      <div id="logos">
        <div id="logosaspa"></div>
        <div id="saspa"></div>
        <div class="subtitulo">Digite el nombre de usuario y contrase&ntilde;a</div>
        <div id="camposLog">
           
            <?php echo form_tag('autenticacion/login', array('name' => 'formulario') ) ?>

            <ul>
                <table>
                    <tr  class="etiqueta">
                        <td> <label for="usuario" >Usuario:</label> </td>
                        <td> <?php echo input_tag('usuario',$sf_params->get('usuario'),'') ?> </td>
                    </tr>

                    <tr  class="etiqueta">
                        <td> <label for="contrasena">Contrase&ntilde;a:</label> </td>
                        <td> <?php echo (input_password_tag('contrasena')) ?> </td>
                    </tr>
                    <tr>
                        <td colspan="2">
			    <div id="informe">
				<?php
				    if(isset($autenticado))
				    {
						if($autenticado == 'false')
						{
					    echo 'Usuario y/o contrase&ntilde;a incorrectos';
						}else if($autenticado == 'false2')
						{
							echo 'El usuario fue inabilitado';
						}
				    }
				?>
			    </div>
                        </td>
                    </tr>
                    <tr>
                        <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
                        <td></td>
                        <td  class="btn"> <?php echo submit_tag('Ingresar',array('onclick' => 'return validar();')) ?> </td> 
                    </tr>
                </table>
            </ul>
            </form>
        </div>
	<div id="login"></div>
    </div>
    <div id="barrainf"> </div>
  </div>
</div>
