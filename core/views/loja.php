<?php
print_r($_SESSION);
?>

<div class="container store">

    <div class="row">
        <div class="col-12 text-center my-4">
            <h1>Loja</h1>
            <a class="btn btn-outline-primary" href="?a=loja&c=todos">Todos</a>
            <?php foreach($categorias as $categoria): ?>
                <a class="btn btn-outline-primary" href="?a=loja&c=<?php echo $categoria?>"><?php echo ucfirst($categoria)?></a>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <?php if(count($produtos) == 0): ?>
                <div class="text-center my-5">
                    <h1>Nenhum produto disponível</h1>
                </div>
            <?php else: ?>
                
            <?php foreach($produtos as $produto): ?>
            <div class="col-sm-3 col-md p-1">
                <div class="text-center p-3 card">
                    <img src="assets/img/produtos/<?php echo $produto->imagem ?>" class="img-fluid" alt="" />
                    <h4><?php echo $produto->nome ?></h4>
                    <h2><?php echo 'R$'.preg_replace('/\./', ',', $produto->preco) ?></h2>

                    <?php if($produto->estoque <= 0): ?>
                        <button class="btn btn-danger" disabled><i class="fa-solid fa-xmark"></i> Produto indisponível</button>
                    <?php else: ?>
                    <button class="btn btn-primary" id="add_cart" onclick="add_carrinho(<?php echo $produto->id_produto ?>)"><i class="fa-solid fa-cart-shopping"></i> Adicionar</button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</div>
