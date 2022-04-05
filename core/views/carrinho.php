<h3>Carrinho</h3>
<a href="?a=limpar_carrinho" class="btn btn-sm btn-outline-primary">Limpar</a>

<div class="container">
    <div class="row">
        <div class="col">
            <?php if($carrinho == null):?>
                <h1>Carrinho vazio</h1>
            <?php else: ?>
                <h1>carrinho...</h1>
            <?php endif; ?>
        </div>
    </div>
</div>