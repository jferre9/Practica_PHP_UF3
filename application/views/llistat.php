<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
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
            <?php foreach($departaments as $d): ?>
            <tr>
                <td><?php echo $d["nom"] ?></td>
                <td><a class="btn btn-info" href="<?php echo site_url("welcome/detalls/".$d["id"]) ?>">Detalls</a></td>
                <td><a class="btn btn-info" href="<?php echo site_url()."welcome/moddpt/".$d["id"] ?>">Modificar</a></td>
                <td><a class="btn btn-danger" href="<?php echo site_url()."welcome/rmdpt/". $d["id"] ?>">Eliminar</a></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    
    <h2>Crear Depratament</h2>
    <form class="form-inline" method="post">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" class="form-control">
        <input type="submit" class="btn btn-success">
    </form>
    
</div>
