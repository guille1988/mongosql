<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Http\Requests\PostRequest;
use App\Services\DatabaseService;
use Exception;
use Error;

class PostController extends Controller
{
    public function __construct(private readonly PostRepositoryInterface $postRepository){}

    public function index(): View
    {
        try
        {
            $posts = $this->postRepository->all()->load('task');
            $tasks = app(TaskRepositoryInterface::class)->all();

            $databaseInfo = app(DatabaseService::class)->getAllDataInfo(config('database.default'));
            $data = array_merge(compact(['posts', 'tasks']), $databaseInfo);

            return view('tables.posts.table', $data);
        }
        catch(Exception|Error $error)
        {
            return view('tables.posts.table')->with(compact('error'));
        }
    }

    public function store(PostRequest $request): JsonResponse
    {
        try
        {
            $this->postRepository->create($request->validated());

            return response()->success('Post created successfully');
        }
        catch(Exception|Error $error)
        {
            return response()->error($error->getMessage());
        }
    }

    public function update(PostRequest $request): RedirectResponse
    {
        try
        {
            $validated = $request->safe()->except('id');
            $id = $request->validated('id');

            $this->postRepository->update($validated, $id);

            return back()->with(['success' => 'Post updated successfully']);
        }
        catch(Exception|Error $error)
        {
            return back()->with(compact('error'));
        }
    }

    public function destroy(PostRequest $request): RedirectResponse
    {
        try
        {
            $this->postRepository->delete($request->validated('id'));

            return back()->with(['success' => 'Post deleted successfully']);
        }
        catch (Exception|Error $error)
        {
            return back()->with(compact('error'));
        }
    }
}
