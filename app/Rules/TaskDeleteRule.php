<?php

namespace App\Rules;

use App\Enum\TaskStatusEnum;
use App\Models\Task;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class TaskDeleteRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $task = Task::query()->where('id', '=', $value)->first();
        $childrenTaskStatuses = $task->descendants()->get()->pluck('status.value')->toarray();
        if (in_array(TaskStatusEnum::TODO->value, $childrenTaskStatuses)) {
            $fail('There are unfinished tasks');
        }
    }
}
