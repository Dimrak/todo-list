<div class="border-dark border fixed-flex" id="completedTodos">
    <?php foreach ($this->todos as $todo): ?>
        <?php if ($todo->active == 0): ?>
            <?php $todoArray = []; ?>
            <?php if (array_search($todo->id, $todoArray)): ?>
            <?php else: ?>
                <div id="completed<?php echo $todo->id ?>" class="w-50">
                    <div class="card m-1 colorCompleted remove">
                        <div class="card-body">
                            <h4 class="card-subtitle mb-2 text-muted">Completed</h4>
                            <h4 class="card-title"><?php echo $todo->title ?></h4>
                            <p class="d-block edit-todo card-text"><?php echo $todo->todo ?></p>
                            <?php include 'delete.php' ?>
                        </div>
                    </div>
                </div>
                <?php array_push($todoArray, $todo->id) ?>
            <?php endif ?>
        <?php endif ?>
    <?php endforeach ?>
</div>

