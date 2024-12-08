<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostsTable Test Case
 */
class PostsTableTest extends TestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    protected array $fixtures = [
        'app.Posts',
        'app.Comments',
    ];

    /**
     * Test subject
     *
     * @var \App\Model\Table\PostsTable
     */
    protected $Posts;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->Posts = $this->getTableLocator()->get('Posts');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Posts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $validData = [
            'title' => 'Test Post',
            'description' => 'This is a test description.',
            'content' => 'This is the content of the post.',
            'author_email' => 'test@example.com',
        ];
        $post = $this->Posts->newEntity($validData);
        $this->assertEmpty($post->getErrors(), 'The post should be valid.');

        $invalidData = [
            'title' => '',
            'description' => '',
            'content' => '',
            'author_email' => 'invalid-email',
        ];
        $post = $this->Posts->newEntity($invalidData);
        $this->assertNotEmpty($post->getErrors(), 'The post should not be valid.');
        $this->assertArrayHasKey('title', $post->getErrors(), 'Title should have a validation error.');
        $this->assertArrayHasKey('description', $post->getErrors(), 'Description should have a validation error.');
        $this->assertArrayHasKey('author_email', $post->getErrors(), 'Author email should have a validation error.');
    }

    /**
     * Test comment_count virtual property
     *
     * @return void
     */
    public function testCommentCount(): void
    {
        $post = $this->Posts->get(1, contain: ['Comments']);
        $this->assertEquals(2, $post->comment_count, 'The post should have 2 comments.');
    }

    /**
     * Test finding posts
     *
     * @return void
     */
    public function testFindPosts(): void
    {
        $query = $this->Posts->find();
        $this->assertInstanceOf('Cake\ORM\Query', $query, 'The find query should return a Query instance.');

        $posts = $query->toArray();
        $this->assertNotEmpty($posts, 'The posts table should not be empty.');
    }

    /**
     * Test finding a specific post by ID
     *
     * @return void
     */
    public function testFindPostById(): void
    {
        $post = $this->Posts->get(1);
        $this->assertEquals(1, $post->id, 'The post ID should be 1.');
        $this->assertEquals('First Post', $post->title, 'The post title should match the fixture.');
    }

    /**
     * Test deleting a post
     *
     * @return void
     */
    public function testDeletePost(): void
    {
        $post = $this->Posts->get(1);
        $this->assertTrue($this->Posts->delete($post), 'The post should be successfully deleted.');

        $this->expectException(\Cake\Datasource\Exception\RecordNotFoundException::class);
        $this->Posts->get(1); // This should throw an exception
    }

    /**
     * Test saving a new post
     *
     * @return void
     */
    public function testSaveNewPost(): void
    {
        $newPost = $this->Posts->newEntity([
            'title' => 'New Post',
            'description' => 'Description of the new post.',
            'content' => 'Content of the new post.',
            'author_email' => 'new_author@example.com',
            'created' => date('Y-m-d')
        ]);

        $this->assertNotFalse($this->Posts->save($newPost), 'The new post should be successfully saved.');
        $this->assertNotNull($newPost->id, 'The new post should have an ID after being saved.');
    }

    /**
     * Test updating an existing post
     *
     * @return void
     */
    public function testUpdatePost(): void
    {
        $post = $this->Posts->get(1);
        $post->title = 'Updated Title';
        $this->assertNotFalse($this->Posts->save($post), 'The post should be successfully updated.');

        $updatedPost = $this->Posts->get(1);
        $this->assertEquals('Updated Title', $updatedPost->title, 'The post title should be updated.');
    }

    /**
     * Test validation for long title
     *
     * @return void
     */
    public function testValidationLongTitle(): void
    {
        $post = $this->Posts->newEntity([
            'title' => str_repeat('a', 256), // Title longer than the max length
            'description' => 'Valid description',
            'content' => 'Valid content',
            'author_email' => 'test@example.com',
        ]);

        $this->assertNotEmpty($post->getErrors(), 'Validation should fail for a title that is too long.');
        $this->assertArrayHasKey('title', $post->getErrors(), 'The title field should have a validation error.');
    }

    /**
     * Test retrieving posts with no comments
     *
     * @return void
     */
    public function testPostWithoutComments(): void
    {
        $post = $this->Posts->get(3, contain: ['Comments']); // Assuming post 3 has no comments in the fixture
        $this->assertEquals(0, $post->comment_count, 'The post should have 0 comments.');
    }
}
