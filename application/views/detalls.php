<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <form name="eliminar" method="post">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Modificar</th>
                    <th>Canviar departament</th>
                    <th class="text-center">Eliminar</th>
                    <th class="text-center">Eliminar múltiple</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleats as $e): ?>
                    <tr>
                        <td><?php echo $e["nom"] ?></td>
                        <td><a class="btn btn-info" href="<?php echo site_url() . "/welcome/modemp/" . $e["id"] ?>">Modificar</a></td>
                        <td><select class="form-control" name="departament[<?php echo $e["id"] ?>]">
                                <?php
                                foreach ($departaments as $d) {
                                    echo "<option value='" . $d["id"] . "' ". ($d["id"] == $departament["id"] ? "selected":"").">" . $d["nom"] ."</option>";
                                }
                                ?>
                            </select></td>
                            <td class="text-center"><a class="btn btn-danger" href="<?php echo site_url("welcome/eliminaremp/".$e["id"]) ?>">Eliminar</a></td>
                            <td><input type="checkbox" class="form-control"  name="empleat[<?php echo $e["id"] ?>]"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <input type="submit" name="eliminar" value="Eliminar" class="btn btn-danger">
        <input type="submit" name="canviar" value="Canviar departament" class="btn btn-info">
    </form>

    <h2>Crear Empleat</h2>
    <form name="crear" class="form-inline" method="post">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" class="form-control">
        <input type="submit" class="btn btn-success" value="Enviar" name="crear">
    </form>


</div>
