<?php require APPROOT . '/views/includes/header.php' ?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <?php flash('register_success'); ?>
                <h2>Faça login</h2>
                <p>Por favor preencha seus dados para fazer login</p>
                <form action="<?php echo URLROOT ?>/users/login" method="POST">
                    <div class="form-group">
                        <label for="email">E-mail: <sup>*</sup></label>
                        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"><?php echo $data['email_error'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha: <sup>*</sup></label>
                        <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['password_error'] ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Login" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT ?>/users/register" class="btn btn-light btn-block">Sem conta? Crie uma</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php require APPROOT . '/views/includes/footer.php' ?>