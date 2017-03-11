<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <?php
    if ($error) { 
        echo "<div class='error'>$error</div>";
    } ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Detalls</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($departaments as $e): ?>
            <tr>
                <td><?php echo $e["nom"] ?></td>
                <td><a class="btn btn-info" href="<?php echo site_url("welcome/detalls/".$e["id"]) ?>">Detalls</a></td>
                <td><a class="btn btn-info" href="<?php echo site_url()."/welcome/moddpt/".$e["id"] ?>">Modificar</a></td>
                <td><a class="btn btn-danger" href="<?php echo site_url()."/welcome/eliminardpt/". $e["id"] ?>">Eliminar</a></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    
    <h2>Crear Depratament</h2>
    <form name="f1" class="form-inline" method="post">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" class="form-control">
        <input type="submit" class="btn btn-success" value="Enviar">
    </form>
    
    
    
</div>
