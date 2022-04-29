<div class="flex flex-col gap-4">
    <div class="bg-white p-4 shadow border-gray-200 rounded-lg">
        <h1 class="text-xl font-bold">
            Felhasználók
        </h1>
        <table class="mt-4">
            <?php foreach ($users as $user): ?>
                <tr>
                    <td class="border p-2"><?= $user->id; ?></td>
                    <td class="border p-2"><?= $user->username; ?></td>
                    <td class="border p-2"><?= $user->name; ?></td>
                    <td class="border p-2"><?= $user->email; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p class="mt-4">
        </p>
    </div>
</div>

