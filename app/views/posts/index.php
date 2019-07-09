<?php require APPROOT . '/views/includes/header.php' ?>
    <?php flash('post_message'); ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Posts</h1>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary float-right">
                <i class="fa fa-pencil-alt"></i> Criar post
            </a>
        </div>
    </div>

<?php foreach($data['posts'] as $post) : ?>
    <div class="card card-body mb-3">
        <h3 class="card-title"><?php echo $post->title; ?></h3>
        <div class="bg-light p-2 mb-3">
            <h5><?php echo $post->name; ?></h5>
            <small><?php echo $post->postCreated; ?></small>
        </div>
        <p class="card-text"><?php echo $post->body; ?></p>
        <a href="<?php echo URLROOT ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">Ver mais</a>
    </div>

<?php endforeach ?>

<?php require APPROOT . '/views/includes/footer.php' ?>