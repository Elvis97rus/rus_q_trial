<?php
namespace App\Domain\Feedback;

class FileFeedbackRepository implements FeedbackRepositoryInterface
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = storage_path($filePath);
    }

    public function save(Feedback $feedback): void
    {
        // Получаем текущий контент файла (если есть)
        $existingData = file_exists($this->filePath) ? file_get_contents($this->filePath) : '';

        // Добавляем новые данные
        $newData = json_encode($feedback->toArray()) . PHP_EOL; // Добавляем новую строку

        // Записываем обновленные данные обратно в файл
        file_put_contents($this->filePath, $existingData . $newData, FILE_APPEND);
    }
}
