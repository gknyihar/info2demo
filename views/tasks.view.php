<div class="container my-4 flex-grow-1">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Kezdőlap</a></li>
            <li class="breadcrumb-item"><a href="/users">Felhasználók</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $user->name ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <?php while ($task = mysqli_fetch_object($tasks)): ?>
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-title">
                                <?= $task->title ?>
                            </h5>
                            <?php if ($task->status == 'new'): ?>
                                <form method="post">
                                    <input type="hidden" name="task" value="<?= $task->id ?>">
                                    <button type="submit" name="delete" class="btn btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                        <h6 class="card-subtitle mb-2 <?= $status[$task->status]['class'] ?>">
                            <?= $status[$task->status]['title'] ?>
                        </h6>
                        <p class="card-text">
                            <?= $task->description ?>
                        </p>
                        <?php if ($task->status != 'done'): ?>
                            <form method="post">
                                <input type="hidden" name="task" value="<?= $task->id ?>">
                                <?php if ($task->status != 'in_progress'): ?>
                                    <input type="submit" class="btn btn-outline-primary" name="in_progress"
                                           value="Folyamatban"/>
                                <?php else: ?>
                                    <input type="submit" class="btn btn-outline-primary" name="done" value="Kész"/>
                                <?php endif; ?>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="col">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        Új feladat
                    </h5>
                    <form method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label">Cím</label>
                            <input type="text" id="title" name="title" value="<?= $title ?>"
                                   class="form-control <?= isset($error['title']) ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= $error['title'] ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Leírás</label>
                            <textarea id="description" name="description"
                                      class="form-control <?= isset($error['description']) ? 'is-invalid' : '' ?>"
                                      rows="10"><?= $description ?></textarea>
                            <div class="invalid-feedback">
                                <?= $error['description'] ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="save">Mentés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
