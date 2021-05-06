<?php

require "db/dbconfig.php";
require "controllers/todoControllres.php";

session_start();

// Fetch all todos
$todos = $conn->query("SELECT * FROM todos")->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include "templates/head.php"; ?>

<body>
    <div class="lg:w-1/2 container mx-auto p-10 flex flex-col items-center h-screen space-y-10">
        <h1 class="md:text-7xl text-5xl text-gray-600 text-center">TODO APP</h1>
        <div class="h-1 text-green-500"><?php echo $msg["success"] ?? "" ?></div>

        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" class="w-full">
            <div class="flex flex-col space-y-3">
                <label for="todo" class="text-gray-800">Add todo</label>
                <input type="text" name="todo" id="todo" class="rounded p-1 border border-gray-600" autofocus required>
                <div class="h-10 text-red-700"><?php echo $msg["error"] ?? "" ?></div>
                <input type="submit" name="submit" value="Submit" class="rounded p-2 bg-gray-900 text-gray-200 hover:bg-gray-700 cursor-pointer">
            </div>
        </form>

        <div class="w-full">
            <ul>
                <?php foreach ($todos as $todo) :
                    $_SESSION["todo-" . $todo["id"]] = $todo["item"];
                ?>
                    <li id="<?php echo $todo["id"] ?>" class="bg-gray-900 text-gray-200 px-5 py-3 mb-3 flex justify-between items-center rounded">
                        <span><?php echo htmlspecialchars($todo["item"]) ?></span>
                        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" class="flex items-center m-0 space-x-3">
                            <input type="hidden" name="todo-id" value="<?php echo $todo["id"] ?>" class="hidden">
                            <button class="hover:text-red-600" name="delete">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button class="hover:text-green-600">
                                <a href="/edit.php?id=<?php echo $todo["id"] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            </button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>

</html>