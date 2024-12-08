<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PostsFixture
 */
class PostsFixture extends TestFixture
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
                'title' => 'First Post',
                'description' => 'Description for the first post.',
                'content' => 'Content of the first post. It provides information about the topic.',
                'author_email' => 'author1@example.com',
                'created' => '2024-12-08',
            ],
            [
                'id' => 2,
                'title' => 'Second Post',
                'description' => 'Description for the second post.',
                'content' => 'Content of the second post. It provides further information.',
                'author_email' => 'author2@example.com',
                'created' => '2024-12-07',
            ],
            [
                'id' => 3,
                'title' => 'Third Post',
                'description' => 'Description for the third post.',
                'content' => 'Content of the third post. It discusses another topic.',
                'author_email' => 'author3@example.com',
                'created' => '2024-12-06',
            ],
        ];
        parent::init();
    }
}
