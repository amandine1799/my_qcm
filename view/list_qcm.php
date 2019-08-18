<?php
include_once 'controller/CrudController.php';
$crudcontroller = new CrudController();
$qcms = $crudcontroller->fetchQCM();
?>

<?php foreach ($qcms as $v): ?>
<div class="box-container">
    <div class="description"><?php echo $v["name"]; ?></div>
    <div class="action">
        <div class="row">
            <a href="view/quizz.php?id=<?php echo $v['id']; ?>" class="btn btn-primary btn-add">Faire le quizz</a><br>
            <a href="view/add_questions.php"><button class="btn btn-primary btn-add">Add Question</button></a>
            <a href="model/edit.php?id=<?php echo $v['id']; ?>"><button class="btn btn-primary btn-add">Edit</button></a>
        </div>
    </div>
</div>
<?php endforeach; ?>