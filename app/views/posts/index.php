<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row mb-3">
    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil">Add Post</i></a>
    </div>
</div>
<?php foreach ($data['posts'] as $post) : ?>
    <?php flash('post_message'); ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $post->post_title ?></h4>
        <div class="bg-light p-2 mb-3">
            Written by <?php echo $post->user_name; ?> on <?php echo $post->created_at; ?>
        </div>
        <p class="card-text"><?php echo $post->post_body ?></p>
        <a href="<?php echo  URLROOT; ?>/posts/show/<?php echo $post->post_id ?>" class="btn btn-dark">Read more</a>
    </div>
<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>