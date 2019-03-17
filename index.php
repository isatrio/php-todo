<?php
spl_autoload_register(function($className)
{
    $className = str_replace('\\', '/', $className);
    $class="./{$className}.php";
    include_once($class);
});

use Classes\Todo as Todo;

$todo = new Todo();
$todos = [];
$oneTodo = null;

if ($_POST) {
    if($_POST['id']!='') {
        $todo->update($_POST['id'], $_POST['text']);
    } else {
        $todo->store($_POST['text']);    
    }
    
} else if ($_GET) {
    $oneTodo = $todo->get($_GET['id']);
}


$todos = $todo->getAllTodos();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todos!</title>

    <link href="bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <main role="main">

        <div class="container">

            <div class="row">

                <div class="col-6">
                    <h1>Todo App</h1>

                    <?php if ($todo->statusDB): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $todo->statusDB; ?>
                        </div>
                    <?php endif; ?>

                    <form action="" id="add-text" method="POST">

                        <div class="form-group">
                            <label for="">Text</label>
                            <input type="text" class="form-control" id="textTodo" name="text" aria-describedby="textTodo" placeholder="Your to do..." value="<?php echo $oneTodo[0][text]; ?>">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $oneTodo[0][id]; ?>">
                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>
                </div><!-- .col-* -->

                <div class="col-6">
                    <ul>
                        <?php foreach ($todos as $value) {
                            echo '<li>' . $value[text] . '<a href="?id=' . $value[id] . '">Edit</a></li>';
                        } ?>
                    </ul>
                </div>
            </div><!-- .row -->

        </div><!-- .container -->

    </main><!-- main -->

</body>
</html>
