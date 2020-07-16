<?php if (!empty($errores)): ?> <!--Si la variable errores no esta vacia mostramos-->
    <div class="alert alert-danger my-4 w-50 mx-auto text-center" role="alert">
        <?php echo $errores;?>
    </div>
<?php endif ?>


<?php if (!empty($registroOk)): ?> <!--Si la variable registroOk no esta vacia mostramos-->
     <div class="alert alert-success my-4 w-50 mx-auto text-center" role="alert">
        <?php echo $registroOk;?>
    </div>
    <div class="botonLogin d-flex justify-content-center mt-4">
        <a class="btn btn-outline-primary" href="login.php" role="button">Logearme</a>
    </div>
<?php endif ?>