<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comment $comment
 * @var integer $post_id
 */
?>
<div class="row">
    <div class="column">
        <div class="comments form content">
            <?= $this->Form->create($comment) ?>
            <fieldset>
                <legend><?= __('Add Comment') ?></legend>
                <?php
                    echo $this->Form->hidden('post_id', ['value' => $post_id]);
                    echo $this->Form->control('content');
                    echo $this->Form->control('author_email', ['type' => 'email']);
                    echo $this->Form->hidden('created', ['value' => date('Y-m-d')]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
