<?php
namespace App\Domain\Feedback;

interface FeedbackRepositoryInterface
{
    public function save(Feedback $feedback): void;
}
