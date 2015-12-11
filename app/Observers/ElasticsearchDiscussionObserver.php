<?php namespace App\Observers;

use Riari\Forum\Models\Thread;
use Es;

class ElasticsearchDiscussionObserver
{
    public function created(Thread $thread)
    {
        Es::index([
            'index' => 'discussions',
            'type' => 'threads',
            'id' => $thread->id,
            'body' => $thread->toArray()
        ]);
    }

    public function updated(Thread $thread)
    {
        Es::index([
            'index' => 'discussions',
            'type' => 'threads',
            'id' => $thread->id,
            'body' => $thread->toArray()
        ]);
    }

    public function deleted(Thread $thread)
    {
        Es::delete([
            'index' => 'discussions',
            'type' => 'threads',
            'id' => $thread->id
        ]);
    }
}
