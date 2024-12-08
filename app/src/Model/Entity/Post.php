<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $author_email
 * @property \Cake\I18n\Date $created
 * @property int $comment_count
 *
 * @property \App\Model\Entity\Comment[] $comments
 */
class Post extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'title' => true,
        'description' => true,
        'content' => true,
        'author_email' => true,
        'created' => true,
        'comments' => true,
    ];

    /**
     * Virtual properties that should be included when this entity is converted to an array or JSON.
     *
     * @var array<string>
     */
    protected array $_virtual = ['comment_count'];

    /**
     * Get the count of comments for the post.
     *
     * @return int
     */
    protected function _getCommentCount(): int
    {
        return isset($this->comments) ? count($this->comments) : 0;
    }
}
