<?php require APPROOT . '/views/includes/header.php' ?>
    <a href="<?php echo URLROOT ?>/posts" class="btn btn-light"><i class="fa fa-arrow-left"></i> Voltar</a>
    <br>
    <h1><?php echo $data['post']->title; ?></h1>
    <div class="bg-secondary text-white p-2 mb-3">
        <small>Por: <?php echo $data['user']->name; ?> | Data: <?php echo $data['post']->created_at; ?></small>
    </div>
    <p><?php echo $data['post']->body; ?></p>

    <?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
        <hr>
        <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Editar</a>

        <form class="float-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
            <input type="submit" value="Deletar" class="btn btn-danger">
        </form>
    <?php endif; ?>

<?php require APPROOT . '/views/includes/footer.php' ?>