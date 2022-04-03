<?php 
use core\classes\Store; 
//$_SESSION['cliente'] = 'Leonan';
?>

<div class="container-fluid navigation">
    <div class="row">
        
        <div class="col-6 p-3"> 
            <a href="?a=home">
                <?php
                echo APP_NAME 
                ?>
            </a>
        </div>
        <div class="col-6 text-end p-3 ">

            <a href="?a=home" class="navigation-link">Home</a>
            <a href="?a=loja" class="navigation-link">Loja</a>

            <!-- -->
            <?php 
            if(Store::clienteLogado()):
            ?>
            <a href="?a=logout" class="navigation-link">Logout</a>
            <a href="?a=minha_conta" class="navigation-link">Minha Conta</a>
            <?php else: ?>
            <a href="?a=login" class="navigation-link">Login</a>
            <a href="?a=cadastrar" class="navigation-link">Cadastrar</a>
            <?php endif; ?>

            <a href="?a=carrinho" class="navigation-link"><i class="fa-solid fa-cart-shopping"></i></a>
            <span class="badge bg-warning"></span>
        </div>
    </div>
</div>