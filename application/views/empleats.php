<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <form name="eliminar" method="post" action="http://sport.es/"></form>
        <form name="canviar" method="post" action="http://google.es/"></form>
        <input name="qwe" form="canviar" type="text">
        <input name="eliminar" form="canviar" type="text">
        
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($empleats as $d): ?>
            <tr>
                <td><?php echo $d["nom"] ?></td>
                <td><a class="btn btn-info" href="<?php echo site_url()."/welcome/modemp/".$d["id"] ?>">Modificar</a></td>
                <td><input type="checkbox" name="empleat[<?php echo $d["id"] ?>]"></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
        <input type="submit" form="eliminar" value="Eliminar" class="btn btn-danger" onclick="document.forms.eliminar.submit()">
            <input type="submit" form="canviar" value="Canviar departament" class="btn btn-info" onclick="document.forms.canviar.submit()">
    
    <h2>Crear Empleat</h2>
    <form name="f2" class="form-inline" method="post">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" class="form-control">
        <!--label for="departament">Departament:</label>
        <select class="form-control">
            <-?php foreach ($departaments as $d): 
                echo "<option value='".$d["id"]."'>".$d["nom"]."</option>";
             endforeach ?>
        </select-->
        <input type="submit" class="btn btn-success" value="Enviar">
    </form>
   
    
</div>
