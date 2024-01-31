<?php
namespace App\Domain\Feedback;

use App\Enums\FeedbackRepositoryEnum;

class FeedbackRepositoryFactory
{
    public static function create(): FeedbackRepositoryInterface
    {
        $type = config('repositories.default');
        $path = config('repositories.path');

        if ($type === FeedbackRepositoryEnum::DB_MYSQL->value) {
            return new DatabaseFeedbackRepository();
        } elseif ($type === FeedbackRepositoryEnum::FILE->value) {
            return new FileFeedbackRepository($path);
        }else{
            throw new \InvalidArgumentException("Unknown repository type: $type");
        }
    }
}
