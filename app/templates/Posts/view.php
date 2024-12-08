<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>
<div class="row">
    <div class="column">
        <div class="posts view content">
            <?= $this->Html->link(__('List Blog Messages'), ['action' => 'index'], ['class' => 'button']) ?>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($post->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Author Email') ?></th>
                    <td><?= h($post->author_email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($post->created->format('d.m.Y')) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Content') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($post->content)); ?>
                </blockquote>
            </div>
            <div class="related">
                <?= $this->Html->link(__('Add Comment'), ['action' => 'addComment', $post->id], ['class' => 'button']) ?>
                <h4><?= __('Related Comments') ?></h4>
                <?php if (!empty($post->comments)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Content') ?></th>
                            <th><?= __('Author Email') ?></th>
                            <th><?= __('Created') ?></th>
                        </tr>
                        <?php foreach ($post->comments as $comment) : ?>
                        <tr>
                            <td><?= h($comment->content) ?></td>
                            <td><?= h($comment->author_email) ?></td>
                            <td><?= h($comment->created->format('d.m.Y')) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
