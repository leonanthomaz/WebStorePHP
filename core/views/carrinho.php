
<div class="container">
    <div class="row">
        <div class="col">
            <div class="my-5">
                <h3>Carrinho</h3>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <?php if($carrinho == null):?>
                <h4 class="alert alert-warning text-center">Carrinho vazio</h4>
                <div class="mt-4 text-center">
                    <a href="?a=loja" class="btn btn-primary">Voltar a loja</a>
                </div>
            <?php else: ?>
                <div class="mb-5">
                <table class="table">
                    <thead> 
                        <tr>
                            <th></th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $index = 0; 
                        $total_rows = count($carrinho); 
            
                        ?>
                        <?php foreach($carrinho as $produto): ?>
                            <?php if($index < $total_rows - 1): ?>
                            <tr>
                                <td><img src="assets/img/produtos/<?php echo $produto['imagem'] ?>" class="img-fluid" width="50px"></td>
                                <td><?php echo $produto['titulo'] ?></td>
                                <td><?php echo $produto['quantidade'] ?></td>
                                <td><?php echo 'R$'.str_replace('.', ',', $produto['preco']) ?></td>
                                <td><a href="?a=remover_item&id_produto=<?php echo $produto['id_produto'] ?>" class="btn btn-danger"><i class="fas fa-times"></i></a></td>
                            </tr>
                            <?php else: ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo 'R$'.str_replace('.', ',', $produto) ?></td>
                                    <td></td> 
                                </tr>
                                
                            <?php endif; ?>
                            <?php $index ++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="row my-5">
                    <div class="col">
                         <!-- <a id="confirmar_limpar_carrinho" href="?a=limpar_carrinho" class="btn btn-sm btn-outline-primary">Limpar</a> -->
                         <a id="confirmar_limpar_carrinho" class="btn btn-sm btn-outline-primary">Limpar</a>
                        <span class="box-confirm" style="display: none;">Deseja realmente?
                            <a class="btn btn-sm btn-outline-primary" id="box-confirm-off">Não</a>
                            <a class="btn btn-sm btn-outline-danger" id="box-confirm-on" href="?a=limpar_carrinho">Sim</a>
                        </span>
                    </div>

                    <div class="col text-end">
                        <a href="?a=finalizar_pedido" class="btn btn-sm btn-outline-primary">Finalizar</a>
                    </div>
                </div>
           
                </div>
            <?php endif; ?>
            
        </div>
    </div>
</div>

