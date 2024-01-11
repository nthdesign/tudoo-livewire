<?php

namespace App\Livewire;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Tasks')]
#[Layout('layouts.app')]
class MyTasks extends Component
{
    public $taskLabel = '';

    public function render()
    {
        return view('livewire.my-tasks', [
            'tasks' => Task::where('user_id', Auth::id())->get()
        ]);
    }

    public function addTask()
    {
        $task = new Task();
        $task->label = $this->taskLabel;
        $task->user_id = Auth::id();
        $task->save();

        $this->reset('taskLabel');
    }

    public function toggleComplete($id)
    {
        $task = Task::findOrFail($id);
        if(Auth::user()->can('update', $task)) {
            $task->completed = !$task->completed;
            if ($task->completed) {
                $task->dateTimeCompleted = Carbon::now()->toDateTimeString();
            } else {
                $task->dateTimeCompleted = null;
            }
            $task->save();
        }
    }

    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        if(Auth::user()->can('delete', $task)) {
            $task->delete();
        }
    }
}
