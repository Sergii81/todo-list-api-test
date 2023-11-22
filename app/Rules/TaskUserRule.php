<?php

namespace App\Rules;

use App\Models\Task;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class TaskUserRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userId = auth('sanctum')->user()->getAuthIdentifier();
        $task = Task::where('id', $value)->first();
        if($task->user_id != $userId) {
            $fail('Wrong user');
        }
    }
}
