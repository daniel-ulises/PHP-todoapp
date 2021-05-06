<?php

require "db/dbconfig.php";
require "controllers/todoControllres.php";


$id = $_GET["id"];

?>

<?php include "templates/head.php"; ?>

<body>
    <div class="lg:w-1/2 container mx-auto p-10 flex flex-col items-center h-screen space-y-10">
        <h1 class="md:text-7xl text-5xl text-gray-600 text-center">EDIT TODO</h1>
        <div class="h-1 text-green-500"><?php echo $msg["success"] ?? "" ?></div>

        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" class="w-full">
            <div class="flex flex-col space-y-3">
                <label for="todo" class="text-gray-800">Edit todo</label>
                <input type="hidden" name="todo-id" value="<?php echo $id ?>">
                <input type="text" name="todo" id="todo" class="rounded p-1 border border-gray-600" value="<?php echo $_SESSION["todo-$id"] ?>" autofocus required>
                <div class="h-10 text-red-700"><?php echo $msg["error"] ?? "" ?></div>
                <input type="submit" name="update" value="Submit" class="rounded p-2 bg-gray-900 text-gray-200 hover:bg-gray-700 cursor-pointer">
                <button class="rounded p-2 bg-gray-900 text-gray-200 hover:bg-gray-700 cursor-pointer"><a href="/">Go back</a></button>
            </div>
        </form>


    </div>
</body>

</html>