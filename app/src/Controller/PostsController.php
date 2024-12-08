<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Posts->find()->contain(['Comments']);

        $this->paginate = [
            'limit' => 5,
            'order' => ['Posts.created' => 'desc'],
        ];

        $posts = $this->paginate($query);

        $this->set(compact('posts'));
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, contain: ['Comments']);
        $this->set(compact('post'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEmptyEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $this->set(compact('post'));
    }

    /**
     * Add comment method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function addComment($post_id)
    {
        $comment = $this->Posts->Comments->newEmptyEntity();
        if ($this->request->is('post')) {
            $comment = $this->Posts->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Posts->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'view', $post_id]);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $this->set(compact('comment', 'post_id'));
    }
}
