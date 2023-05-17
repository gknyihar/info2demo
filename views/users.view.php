<div class="container my-4 flex-grow-1">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Kezdőlap</a></li>
            <li class="breadcrumb-item active" aria-current="page">Felhasználók</li>
        </ol>
    </nav>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="card-title">Felhasználók</h5>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Felhasználónév</th>
                    <th scope="col">Név</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Feladatok</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                <?php while ($user = mysqli_fetch_object($users)): ?>
                    <tr>
                        <th scope="row"><?= $user->id; ?></th>
                        <td><?= $user->username; ?></td>
                        <td><?= $user->name; ?></td>
                        <td>
                            <i class="bi bi-envelope"></i>
                            <a href="mailto:<?= $user->email; ?>">
                                <?= $user->email; ?>
                            </a>
                        </td>
                        <td>
                            <a href="/tasks?user=<?= $user->id; ?>"><?= $user->tasks; ?> feladat</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
            <div>
                Sorok száma: <?= $rows ?>
            </div>
        </div>

    </div>

</div>