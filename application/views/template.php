<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to CodeIgniter</title>
        <link href="<?php echo base_url('public/estils/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url('public/estils/css/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/estils/estil.css') ?>">
    </head>
    <body>

        <header>
            <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                        </button>
                        <a class="navbar-brand" href="#">Frankfurt</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Home</a></li>
                        </ul>
                        <form class="navbar-form navbar-left">
                            <!--div class="form-group">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button-->
                            <label for="sel1">Driver:</label>
                            <select class="form-control" id="sel1" onchange="this.form.submit()">
                                <option value="ModelMysqli" <?php if ($driver === "ModelMysqli") echo "selected"?>>Mysqli</option>
                                <option value="ModelPdo" <?php if ($driver === "ModelPdo") echo "selected"?>>Pdo</option>
                                <option value="ModelAdodb" <?php if ($driver === "ModelAdodb") echo "selected"?>>Adodb</option>
                                <option value="ModelOdbc" <?php if ($driver === "ModelOdbc") echo "selected"?>>Odbc</option>
                                <option value="ModelOracle" <?php if ($driver === "ModelOracle") echo "selected"?>>Oracle</option>
                            </select>
                        </form>
                    </div>
                </div>
            </nav>
        </header>

        <?php $this->load->view($vista); ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url('public/estils/js/bootstrap.min.js') ?>"></script>
    </body>
</html>