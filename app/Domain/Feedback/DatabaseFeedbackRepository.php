<?php
namespace App\Domain\Feedback;

class DatabaseFeedbackRepository implements FeedbackRepositoryInterface
{
    public function save(Feedback $feedback): void
    {
        $feedback->save();
    }
}
