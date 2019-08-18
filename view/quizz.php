<?php
include_once '../controller/CrudController.php';
$crud = new CrudController();

$id_qcm = $_GET['id'];
$questions = $crud->fetchQuestions($id_qcm);
$questions_wrong = [];
?>

<?php if(!empty($_POST)): ?>
<?php
$result = $crud->validate($id_qcm, $_POST);
$questions_wrong = $result['questions_wrong'];
?>
<?php if($result['success'] === false): ?>
  <p><?php echo $result['error_message']; ?></p>
<?php else: ?>
  <p>Bravo !</p>
<?php endif; ?>
<?php endif; ?>

<form method="post">
  <?php foreach($questions as $q): ?>
    <fieldset>
      <legend <?php if (in_array($q["id"], $questions_wrong)): ?>style="background: red"<?php endif ?>><?php echo $q['question']; ?></legend>
      <?php foreach($crud->fetchResponses($q['id']) as $r): ?>
        <input name="q<?php echo $q['id']; ?>[]" value="<?php echo $r['id']; ?>" type="checkbox"> <?php echo $r['response']; ?><br>
      <?php endforeach; ?>
    </fieldset>
  <?php endforeach; ?>
  <button type="submit" name="endqcm">Valider mes réponses</button>
</form>