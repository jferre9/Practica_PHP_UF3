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
                <td><?php echo $d["id"] ?></td>
                <td><?php echo $d["id"] ?></td>
                <td><?php echo $d["id"] ?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    
</div>
