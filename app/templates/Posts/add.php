<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>
<div class="row">
    <div class="column">
        <div class="posts form content">
            <?= $this->Html->link(__('List Blog Messages'), ['action' => 'index'], ['class' => 'button']) ?>
            <?= $this->Form->create($post) ?>
            <fieldset>
                <legend><?= __('Add Blog Message') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('description');
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
