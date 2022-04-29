<div class="flex flex-col gap-4">
    <?php foreach ($tasks as $task): ?>
        <div class="bg-white p-4 shadow border-gray-200 rounded-lg">
            <h1 class="text-xl font-bold">
                <?= $task->title; ?>
            </h1>
            <p class="mt-4">
                <?= $task->description; ?>
            </p>
        </div>
    <?php endforeach; ?>
</div>
</div>
