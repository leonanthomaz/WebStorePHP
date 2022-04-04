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
            <div class="col-sm-4 col-md p-1">
                <div class="text-center p-3 card">
                    <img src="assets/img/produtos/<?php echo $produto->imagem ?>" class="img-fluid" alt="" />
                    <h4><?php echo $produto->nome ?></h4>
                    <h2><?php echo 'R$'. $produto->preco ?></h2>
                    <button>Adicionar</button>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</div>
