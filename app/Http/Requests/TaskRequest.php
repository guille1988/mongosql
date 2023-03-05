<?php

namespace App\Http\Requests;

use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\Rules;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use App\Rules\RejectIfHasPosts;
use App\Rules\IsNotNumeric;
use App\Rules\IsValid;

class TaskRequest extends FormRequest
{
    use Rules;

    private int $minRecords = 1;
    private int $maxRecords = 1000;

    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation()
    {
        if($this->routeIs('tasks.destroy', 'tasks.update'))
            $this->merge(['id' => $this->route('task')]);
    }

    public function attributes(): array
    {
        return [
            'is_critical' => 'is critical?',
            'item_ids' => 'items'
        ];
    }

    public function messages(): array
    {
        $record = $this->minRecords == 1 ? 'record' : 'records';

        return [
            'id.prohibited' => "Task table must not have less than $this->minRecords $record",
            'name.prohibited' => "Task table must not have more than $this->maxRecords records"
        ];
    }

    public function quantityOfRecords(): int
    {
        return app(TaskRepositoryInterface::class)->all()->count();
    }

    public function tasksStore(): array
    {
        return [
            'name' =>
                [
                    'required',
                    'string',
                    new IsNotNumeric,
                    Rule::prohibitedIf($this->quantityOfRecords() >= $this->maxRecords)
                ],
            'duration' => ['required', 'numeric'],
            'is_critical' => ['required', 'boolean'],
            'item_ids' => ['array', 'required'],
            'item_ids.*' => [new IsValid(ItemRepositoryInterface::class)]
        ];
    }

    public function tasksUpdate(): array
    {
        return [
            'id' => ['required', new IsValid(TaskRepositoryInterface::class)],
            'name' => ['required', 'string', new IsNotNumeric],
            'duration' => ['required', 'numeric'],
            'is_critical' => ['required', 'boolean'],
            'item_ids' => ['array'],
            'item_ids.*' => [new IsValid(ItemRepositoryInterface::class)]
        ];
    }

    public function tasksDestroy(): array
    {
        return ['id' =>
            [
                'required',
                new IsValid(TaskRepositoryInterface::class),
                new RejectIfHasPosts,
                Rule::prohibitedIf($this->quantityOfRecords() <= $this->minRecords)
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if($this->routeIs('tasks.store', 'tasks.update'))
            throw new ValidationException($validator, new JsonResponse(['errors' => $validator->errors()->messages()], 422),);
    }
}
