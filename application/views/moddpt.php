<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <h2>Modificar empleat</h2>
    <form name="f1" class="form-inline" method="post">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" class="form-control" value="<?php echo $departament["nom"] ?>">
        
        <input type="submit" class="btn btn-info" value="Enviar">
    </form>

</div>
