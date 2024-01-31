<?php
namespace App\Domain\Feedback;


class FeedbackService
{
    public function saveFeedback(array $data): void
    {
        $feedbackRepository = FeedbackRepositoryFactory::create();
        $feedback = Feedback::create($data);
        $feedbackRepository->save($feedback);
    }
}
