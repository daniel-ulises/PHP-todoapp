<?php
session_start();


$msg = [
    "error" => "",
    "success" => "",
];

// Create a todo item
if (isset($_POST["submit"])) {
    if (!empty($_POST["todo"])) {
        $todo = htmlspecialchars($_POST["todo"]);
        $sql = "INSERT INTO todos (item) VALUES(:todo)";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute([":todo" => $todo])) {
            $msg["success"] = "Item created sucessfully!";
        } else {
            $msg["error"] = "Something went wrong";
        }
    } else {
        $msg["error"] = "Can't leave field empty";
    }
}

// Delete a todo item
if (isset($_POST["delete"])) {
    $id = $_POST["todo-id"];
    $sql = "DELETE FROM todos WHERE id=:id";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([":id" => $id])) {
        $todos = $conn->query("SELECT * FROM todos")->fetchAll(PDO::FETCH_ASSOC);
        $msg["success"] = "Deleted successfully!";
    } else {
        $msg["error"] = "Something went wrong!";
    }
}

// Edit a todo item
if (isset($_POST["update"])) {
    $id = $_POST["todo-id"];
    $sql = "UPDATE todos SET item=:newtodo WHERE id=:id";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([":newtodo" => $_POST["todo"], ":id" => $id])) {
        $msg["success"] = "Updated successfully!";
        header("Location: index.php");
    } else {
        $msg["error"] = "Something went wrong!";
    }
}
