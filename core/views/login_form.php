<div class="container-fluid">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3 ">
            <h3>Login</h3>

            <?php if(isset($_SESSION['erro'])): ?>
                <div class="row">
                    <div class="alert alert-danger text-center p-2">
                        <?php echo $_SESSION['erro'] ?>
                        <?php unset($_SESSION['erro']); ?>
                    </div>
                </div>
            <?php endif; ?>

            <form action="?a=conectar" method="post">
                <div class="container">
   
                <div class="my-3">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Digite seu email" class="form-control" require/>
                </div>

                <div class="my-3">
                    <label>Senha</label>
                    <input type="password" name="senha" placeholder="Digite sua senha" class="form-control" require/>
                </div>

                <input type="submit" class="submit" value="Criar Conta" class="btn btn-primary" />
                </div>

               
            </form>
        
        </div>
    </div>
</div>
