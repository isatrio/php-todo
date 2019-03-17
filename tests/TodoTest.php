<?php
spl_autoload_register(function($className)
{
    $className = str_replace('\\', '/', $className);
    $class="./{$className}.php";
    include_once($class);
});

use Classes\Todo;
use PHPUnit\Framework\TestCase;

class TodoTest extends TestCase {

    public function testStoreData() {
        $todo = new Todo;
        $doTodo = $todo->store('This is text');
        $this->assertSame(1, $doTodo);
    }

    public function testStoreDataFalse() {
        $todo = new Todo;
        $doTodo = $todo->store(0);
        $this->assertFalse($doTodo);
    }

    public function testGetData() {
        $todo = new Todo;
        $doTodo = $todo->get(1);
        $this->assertSame(1, count($doTodo));
    }

    public function testGetAllData() {
        $todo = new Todo;
        $doTodo = $todo->getAllTodos();
        $this->assertIsArray($doTodo);
    }
}