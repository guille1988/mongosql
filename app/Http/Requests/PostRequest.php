<?php

namespace App\Http\Requests;

use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\Rules;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use App\Rules\IsNotNumeric;
use App\Rules\IsValid;

class PostRequest extends FormRequest
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
        if ($this->routeIs('posts.destroy', 'posts.update'))
            $this->merge(['id' => $this->route('post')]);
    }

    public function attributes(): array
    {
        return ['task_id' => 'tasks'];
    }

    public function messages(): array
    {
        $record = $this->minRecords == 1 ? 'record' : 'records';

        return [
          'id.prohibited' => "Post table must not have less than $this->minRecords $record",
          'title.prohibited' => "Post table must not have more than $this->maxRecords records"
        ];
    }

    public function quantityOfRecords(): int
    {
        return app(PostRepositoryInterface::class)->all()->count();
    }

    public function postsStore(): array
    {
        return [
            'title' =>
                [
                    'required',
                    'string',
                    new IsNotNumeric,
                    Rule::prohibitedIf($this->quantityOfRecords() >= $this->maxRecords)
                ],
            'body' => ['required', 'string', new IsNotNumeric],
            'slug' => ['required', 'string', new IsNotNumeric],
            'task_id' => ['required', new IsValid(TaskRepositoryInterface::class)]
        ];
    }

    public function postsDestroy(): array
    {
        return ['id' =>
            [
                'required',
                new IsValid(PostRepositoryInterface::class),
                Rule::prohibitedIf($this->quantityOfRecords() <= $this->minRecords)
            ]
        ];
    }

    public function postsUpdate(): array
    {
        return [
            'id' => ['required', new IsValid(PostRepositoryInterface::class)],
            'title' => ['required', 'string', new IsNotNumeric],
            'body' => ['required', 'string', new IsNotNumeric],
            'slug' => ['required', 'string', new IsNotNumeric],
            'task_id' => ['required', new IsValid(TaskRepositoryInterface::class)]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if($this->routeIs('posts.store', 'posts.update'))
            throw new ValidationException($validator, new JsonResponse(['errors' => $validator->errors()->messages()], 422),);
    }
}
