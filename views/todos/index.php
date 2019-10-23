<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<div class="header-container mx-auto ct-border">
    <header class="wrapper clearfix pt-3">
        <h1 class="title">Todo-list</h1>
        <nav>
            <ul class="mx-auto">
                <!--Add select to choose the file format that wants to be downloaded-->
                <a href="<?php echo urlStyle('downloads/todo_template.csv')?>" download>
                    <i class="fi-swluxl-download-solid"></i>
                </a>
                <li><a href="<?php echo url('todo/destroyAll') ?>">Destruction</a></li>
            </ul>
        </nav>
    </header>
</div>
<div>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="message">
            <!--            --><?php //echo $_SESSION['message'] ?>
        </div>
    <?php endif ?>
</div>
<div class="main-container bg-image-custom">
    <div class="main wrapper clearfix">

        <article>
            <header>
                <h1>Pending Todos</h1>
                <p>Aim of the application is to create Todos and administrate your day</p>
            </header>
            <section id="displayTodos" class="row">
                <?php if ($this->todos > 0): ?>
                    <?php foreach ($this->todos as $todo): ?>
                        <?php if ($todo->active == 1): ?>
                            <div class="card col-sm-10 col-md-5 col-lg-5 m-1 width-cards"
                                 id="divCard<?php echo $todo->id ?>">
                                <div class="card-body">
                                    <h4 class="card-title"
                                        id="title<?php echo $todo->id ?>"><?php echo $todo->title ?></h4>
                                    <input id="titleEdit<?php echo $todo->id ?>"
                                           class="display"
                                           value="<?php echo $todo->title ?>"
                                           type="text"
                                           name="titleEdit">
                                    <p class="d-block edit-todo card-text"
                                       id="todo<?php echo $todo->id ?>"><?php echo $todo->todo ?></p>
                                    <textarea id="todoEdit<?php echo $todo->id ?>"
                                              rows="6"
                                              class="w-100 display"
                                              name="todoEdit"><?php echo $todo->todo ?>
                                </textarea>
                                    <input id="submitEdit<?php echo $todo->id ?>"
                                           class="submit-changes display"
                                           value="submit"
                                           type="submit"
                                           name="submitEdit<?php echo $todo->id ?>">
                                    <a class="card-link edit bg-warning text-white rounded p-1 ml-2"
                                       href="/" id="<?php echo $todo->id ?>">Edit</a>
                                    <a id="<?php echo $todo->id ?>"
                                       class="completed card-link bg-success text-white rounded p-1 ml-2"
                                       href="/">Complete</a>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php endif ?>
            </section>
            <div class="border border-dark w-100 h-50 mt-5 mb-5"></div>
            <section id="" class="mt-2 container">
                <!--                --><?php //if (isset($_SESSION['delete'])): ?>
                <!--                    <div class="removed pt-1 pb-1 pr-3 pl-3 bg-info rounded w-25">-->
                <!--                        --><?php //echo $_SESSION['delete'] ?>
                <!--                    </div>-->
                <!--                --><?php //endif ?>
                <h3>Completed todos</h3>
                <?php include 'completed.php' ?>
            </section>
            <div id=""></div>
        </article>

        <aside id="aside" class="">
            <div class="container">
                <h3 class="pl-2">Create Todos</h3>
                <div class="">
                    <?php echo $this->form; ?>
                    <?php include 'upload.php' ?>
                </div>
                <div class="mt-5"></div>
                <div class="ct-border-radius p-3">
                    <h4>Uploaded files: </h4>
                    <div class="w-25 rounded">
                        <?php foreach ($this->files as $file => $detail): ?>
                            <button class="mt-1" type="submit" id="addTodos<?php echo $detail->id ?>"
                                    class="add"><?php echo $detail->name ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </aside>

    </div> <!-- #main -->
</div> <!-- #main-container -->
