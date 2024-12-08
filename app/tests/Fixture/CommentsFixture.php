<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CommentsFixture
 */
class CommentsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'post_id' => 1,
                'content' => 'First comment.',
                'author_email' => 'commenter1@example.com',
                'created' => '2024-12-08',
            ],
            [
                'id' => 2,
                'post_id' => 1,
                'content' => 'Second comment.',
                'author_email' => 'commenter2@example.com',
                'created' => '2024-12-08',
            ],
        ];
        parent::init();
    }
}
