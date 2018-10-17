<?php
require_once('header.php');

if($_GET["login"] == 1) {
    ?>
    <div class="alert alert-success text-center" id="alert" role="alert">Login efetuado com sucesso</div>
    <script>$("#alert").fadeOut(4000);</script>

    <?php
}


require_once('footer.php');
