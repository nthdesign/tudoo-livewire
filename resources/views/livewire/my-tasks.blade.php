<div class="max-w-7xl mx-auto">
    <h1 class="text-xl m-5">My Tasks</h1>
    <div class="m-5 p-5 bg-white shadow-md rounded-lg">
        <form wire:submit="addTask">
            <div class="flex">
                <input class="block flex-auto mr-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-96 p-2.5" type="text" wire:model="taskLabel" placeholder="Task" />
                <button type="button" wire:click="addTask" class="flex-none block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Add Task</button>
            </div>
        </form>
    </div>

    <div class="m-5 relative overflow-x-auto shadow-md rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-white uppercase bg-blue-500">
            <tr>
                <th scope="col" class="px-6 py-3">

                </th>
                <th scope="col" class="px-6 py-3">
                    Task
                </th>
                <th scope="col" class="px-6 py-3">
                    Date Completed
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($tasks as $task)
                <tr wire:key="{{ $task->id }}" class="bg-white border-b">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input
                                wire:click="toggleComplete({{ $task->id }})"
                                id="task-checkbox-{{ $task->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" {{ $task->completed ? 'checked' : '' }}>
                            <label for="task-checkbox-{{ $task->id }}" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        <span class="{{ $task->completed ? 'line-through' : '' }}">
                            {{ $task->label }}
                        </span>
                    </th>
                    <td class="w-60 px-6 py-4">
                        @isset($task->dateTimeCompleted)
                            {{ \Carbon\Carbon::parse($task->dateTimeCompleted)->diffForHumans() }}
                        @endisset
                    </td>
                    <td class="w-24 px-6 py-4">
                        <button
                            type="button"
                            wire:click="deleteTask({{ $task->id }})"
                            wire:confirm="Are you sure you want to delete this task?"
                            class="inline-flex items-center px-5 py-1 text-sm font-medium text-center text-red-800 bg-white border-red-800 border rounded-lg hover:bg-red-800 hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-50 text-right"
                        >
                            X
                        </button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <br/>

</div>
