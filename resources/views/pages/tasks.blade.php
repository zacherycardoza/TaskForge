@extends('layouts.app')

@section('title', 'Tasks')
@section('breadcrumb', 'Tasks')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-8 col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tasks</h5>
            </div>
            <div class="card-body">
                <!-- Add Task Inline -->
                <input type="text" id="newTaskInput" class="form-control mb-3" placeholder="Add a new task and press Enter">

                <ul class="list-group list-group-flush" id="taskList">
                    @forelse($tasks as $task)
                    <li class="list-group-item d-flex justify-content-between align-items-center {{ $task->is_done ? 'list-group-item-success' : '' }}" data-id="{{ $task->id }}">
                        <span class="task-name" style="cursor: pointer;">{{ $task->name }}</span>
                        <div>
                            <button class="btn btn-success btn-sm me-2 toggle-btn">{{ $task->is_done ? 'Undo' : 'Done' }}</button>
                            <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                        </div>
                    </li>
                    @empty
                    <li class="list-group-item text-center text-muted">No Current Tasks</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const taskList = document.getElementById('taskList');
    const newTaskInput = document.getElementById('newTaskInput');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Add task on Enter
    newTaskInput.addEventListener('keydown', async function(e){
        if(e.key !== 'Enter') return;
        e.preventDefault();

        const name = newTaskInput.value.trim();
        if(!name) return;

        try {
            const res = await fetch("{{ route('tasks.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ name })
            });
            if(!res.ok) throw new Error('Failed to add task');
            const task = await res.json();
            addTaskToDOM(task);
            newTaskInput.value = '';
        } catch(err) {
            console.error(err);
        }
    });

    function addTaskToDOM(task){
        const noTasks = taskList.querySelector('.text-muted');
        if(noTasks) noTasks.remove();

        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        li.dataset.id = task.id;
        li.innerHTML = `
            <span class="task-name" style="cursor: pointer;">${task.name}</span>
            <div>
                <button class="btn btn-success btn-sm me-2 toggle-btn">Done</button>
                <button class="btn btn-danger btn-sm delete-btn">Delete</button>
            </div>
        `;
        taskList.prepend(li);
    }

    // Task actions: toggle, delete, inline edit
    taskList.addEventListener('click', async function(e){
        const li = e.target.closest('li');
        if(!li) return;
        const id = li.dataset.id;

        // Toggle done/undo
        if(e.target.classList.contains('toggle-btn')){
            const res = await fetch(`/tasks/${id}/toggle`, { method:'PATCH', headers:{'X-CSRF-TOKEN': csrfToken} });
            const data = await res.json();
            li.classList.toggle('list-group-item-success', data.is_done);
            e.target.textContent = data.is_done ? 'Undo' : 'Done';
        }

        // Delete
        if(e.target.classList.contains('delete-btn')){
            await fetch(`/tasks/${id}`, { method:'DELETE', headers:{'X-CSRF-TOKEN': csrfToken} });
            li.remove();
            if(taskList.children.length === 0){
                const empty = document.createElement('li');
                empty.className = 'list-group-item text-center text-muted';
                empty.textContent = 'No Current Tasks';
                taskList.appendChild(empty);
            }
        }

        // Inline edit
        if(e.target.classList.contains('task-name')){
            const span = e.target;
            const currentName = span.textContent;
            const input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control form-control-sm';
            input.value = currentName;
            span.replaceWith(input);
            input.focus();

            input.addEventListener('blur', async function(){
                const newName = input.value.trim();
                if(newName && newName !== currentName){
                    const res = await fetch(`/tasks/${id}`, {
                        method:'PATCH',
                        headers:{'Content-Type':'application/json','X-CSRF-TOKEN': csrfToken},
                        body: JSON.stringify({name:newName})
                    });
                    const updatedTask = await res.json();
                    const newSpan = document.createElement('span');
                    newSpan.className = 'task-name';
                    newSpan.style.cursor = 'pointer';
                    newSpan.textContent = updatedTask.name;
                    input.replaceWith(newSpan);
                } else {
                    const newSpan = document.createElement('span');
                    newSpan.className = 'task-name';
                    newSpan.style.cursor = 'pointer';
                    newSpan.textContent = currentName;
                    input.replaceWith(newSpan);
                }
            });

            input.addEventListener('keydown', function(ev){
                if(ev.key === 'Enter') input.blur();
            });
        }
    });

    // Drag-and-drop with persistent order
    new Sortable(taskList, {
        animation: 150,
        onEnd: async function(){
            const order = Array.from(taskList.children)
                .filter(li => li.dataset.id)
                .map(li => li.dataset.id);
            try {
                await fetch("{{ route('tasks.reorder') }}", {
                    method: 'POST',
                    headers:{
                        'Content-Type':'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept':'application/json'
                    },
                    body: JSON.stringify({ order })
                });
            } catch(err){
                console.error('Failed to save order', err);
            }
        }
    });
});
</script>
@endsection
