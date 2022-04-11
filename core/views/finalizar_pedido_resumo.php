<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="my-3">resumo</h3>
            <hr>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">

            <div style="margin-bottom: 80px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th class="text-center">Quantidade</th>
                            <th class="text-end">Valor total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 0;
                        $total_rows = count($carrinho);
                        ?>
                        <?php foreach ($carrinho as $produto) : ?>
                            <?php if ($index < $total_rows - 1) : ?>

                                <!-- lista dos produtos -->
                                <tr>
                                    <td class="align-middle"><?= $produto['titulo'] ?></td>
                                    <td class="text-center align-middle"><?= $produto['quantidade'] ?></td>
                                    <td class="text-end align-middle"><?php echo 'R$'.str_replace('.', ',', $produto['preco']) ?></td>
                                </tr>

                            <?php else : ?>

                                <!-- total -->
                                <tr>
                                    <td></td>
                                    <td class="text-end">
                                        <h4>Total:</h4>
                                    </td>
                                    <td class="text-end">
                                        <h4><?php echo 'R$'.str_replace('.', ',', $produto) ?></h4>
                                    </td>
                                </tr>

                            <?php endif; ?>
                            <?php $index++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>


                <!-- dados do cliente -->
                <h5 class="bg-dark text-white p-2">Dados do Cliente</h5>
                <div class="row">
                    <div class="col">
                        <p>Nome: <strong><?= $cliente->nome ?></strong></p>
                        <p>Endereço: <strong><?= $cliente->endereco ?></strong></p>
                        <p>Cidade: <strong><?= $cliente->cidade ?></strong></p>
                    </div>
                    <div class="col">
                        <p>Email: <strong><?= $cliente->email ?></strong></p>
                        <p>Telefone: <strong><?= $cliente->telefone ?></strong></p>
                    </div>
                </div>

                <!-- Dados de Pagamento -->
                <h5 class="bg-dark text-white p-2">Dados do pagamento</h5>
                <div class="row">
                    <div class="col">
                    <p>Conta bancária: 2425436546</p>
                    <p>Código da compra: <strong><?= $_SESSION['codigo_compra']; ?></strong></p>
                    <p>Total: <strong><?php echo 'R$'.str_replace('.', ',', $produto) ?></strong></p>
                    </div>
                </div>


                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="use_endereco_alternativo" id="use_endereco_alternativo">
                    <label class="form-check-label" for="check_morada_alternativa">Definir uma morada alternativa.</label>
                </div>

                <div id="set_endereco_alternativo">
                    <div class="form-group">
                        <label class="form-label">Endereço</label>
                        <input type="text" class="form-control"  name="endereco_alternativo" id="endereco">

                        <label class="form-label">Cidade</label>
                        <input type="text" class="form-control"  name="cidade_alternativo" id="cidade">

                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email_alternativo" id="email">

                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control" name="telefone_alternativo" id="telefone">
                    </div>      
                </div>

                <div class="row my-5">
                    <div class="col">
                        <a class="btn btn-outline-primary" href="">Cancelar</a>
                    </div>

                    <div class="col text-end">
                        <a class="btn btn-outline-primary btn-sm" href="?a=metodo_pagamento" id="metodo_pagamento" onclick="set_endereco_alternativo()">Escolher método de pagamento</a>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</div>

