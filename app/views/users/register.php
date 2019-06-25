<?php require APPROOT . '/views/includes/header.php' ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light my-5">
                <h2>Crie sua conta</h2>
                <p>Por favor preencha este formulário para cadastrar-se</p>
                <form action="<?php echo URLROOT ?>/users/register" method="POST">
                    <div class="form-group">
                        <label for="name">Nome: <sup>*</sup></label>
                        <input required type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_error'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name_error'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail: <sup>*</sup></label>
                        <input required type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"><?php echo $data['email_error'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha: <sup>*</sup></label>
                        <input required type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['password_error'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirme a senha: <sup>*</sup></label>
                        <input required type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['confirm_password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_error'] ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Registrar" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT ?>/users/login" class="btn btn-light btn-block">Tem uma conta? Faça login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php require APPROOT . '/views/includes/footer.php' ?>