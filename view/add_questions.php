<?php
if (isset($_POST["add"])) {
    include_once '../controller/CrudController.php';
    $crudcontroller = new CrudController();
    $result = $crudcontroller->addQuestion($_GET['id']);
    header("Location: reponse.php?id=".$result);
}
?>
<html>
<head>
<title>CRUD</title>
<link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../public/css/styles.css">
<script src="../public/js/crudEvent.js"></script>

</head>
<body>

    <div class="row">

        <div class="form-container">
            <form method="POST">
                <div class="form-group">
                    <div class="row">
                        <label>Question</label> <input type="text"
                            name="q_question" id="title" class="form-control"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <button class="btn btn-primary" name="add">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</body>
</html>