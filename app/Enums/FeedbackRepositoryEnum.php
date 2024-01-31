<?php
namespace App\Enums;

enum FeedbackRepositoryEnum: string {
    case DB_MYSQL = 'mysql';
    case FILE = 'file';
}
