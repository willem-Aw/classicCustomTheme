<?php

$count = absint(get_comments_number());
?>

<?php if ($count > 0): ?>
    <h3 style="font-family: var(--body-family);"><?= $count ?> Comment<?= $count !== 1 ? 's' : '' ?></h3>
<?php else : ?>
    <h3 style="font-family: var(--body-family);">No comments yet</h3>
    <p>Be the first to comment</p>
<?php endif; ?>

<?php if (comments_open()) {
    comment_form(
        [
            'title_reply' => '',
        ]
    );
} ?>

<?php wp_list_comments(
    [
        'style' => 'div',
    ]
) ?>

<?php paginate_comments_links() ?>