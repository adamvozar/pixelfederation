<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateComments extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('comments');
        $table->addColumn('post_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ])->addForeignKey('post_id', 'posts', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $table->addColumn('content', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('author_email', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('created', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
