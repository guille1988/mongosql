<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Http\Requests\TaskRequest;
use App\Services\DatabaseService;
use Exception;
use Error;
class TaskController extends Controller
{
    public function __construct(private readonly TaskRepositoryInterface $taskRepository){}

    public function index(): View
    {
        try
        {
            $tasks = $this->taskRepository->all()->load(['posts', 'items']);
            $posts = app(PostRepositoryInterface::class)->all();
            $items = app(ItemRepositoryInterface::class)->all();

            $databaseInfo = app(DatabaseService::class)->getAllDataInfo(config('database.default'));
            $data = array_merge(compact(['posts', 'tasks', 'items']), $databaseInfo);

            return view('tables.tasks.table', $data);
        }
        catch(Exception|Error $error)
        {
            return view('tables.tasks.table')->with(compact('error'));
        }
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        try
        {
            $task = $this->taskRepository->create($request->safe()->except('item_ids'));
            $task->items()->sync($request->validated('item_ids'));

            return back()->with(['success' => 'Task created successfully']);
        }
        catch(Exception|Error $error)
        {
            return back()->with(compact('error'));
        }
    }

    public function update(TaskRequest $request): RedirectResponse
    {
        try
        {
            $validated = $request->safe()->except(['id', 'item_ids']);
            $id = $request->validated('id');
            $item_ids = $request->validated('item_ids');

            $task = $this->taskRepository->find($id);
            $task->update($validated);
            $task->items()->sync($item_ids);

            return back()->with(['success' => 'Task updated successfully']);
        }
        catch(Exception|Error $error)
        {
            return back()->with(compact('error'));
        }
    }

    public function destroy(TaskRequest $request): RedirectResponse
    {
        try
        {
            $task = $this->taskRepository->find($request->validated('id'));
            $task->items()->sync([]);
            $task->delete();

            return back()->with(['success' => 'Task deleted successfully']);
        }
        catch (Exception|Error $error)
        {
            return back()->with(compact('error'));
        }
    }
}
