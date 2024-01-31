<?php
namespace App\Http\Controllers\Api;

use App\Domain\Feedback\FeedbackService;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    private $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    public function store(FeedbackRequest $request): JsonResponse
    {
        try {
            $this->feedbackService->saveFeedback($request->validated());
            return response()->json(['message' => 'Feedback saved successfully', "data" => $request->all()], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'BAD DATA', "data" => $e->getMessage()], 422);
        }

    }
}
