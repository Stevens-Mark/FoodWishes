<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/user.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');
?>

<form action="<?php echo($rootUrl . 'comments/addComment_post.php'); ?>" method="POST">
  <div class="mb-3 visually-hidden">
    <input class="form-control" type="text" name="recipe_id" value="<?php echo($_GET['id']); ?>" />
  </div>
  <div class="mb-3">
    <label for="review" class="form-label">Rate the recipe (from 1 to 5)</label>
    <input type="number" class="form-control" id="review" name="review" min="0" max="5" step="1" />
  </div>
  <div class="mb-3">
    <label for="comment" class="form-label">Post a Comment</label>
    <textarea class="form-control" placeholder="Be respectful, we are human." id="comment" name="comment"></textarea>
  </div>
  <div class="text-end">
    <button type="submit" class="btn btn-sm btn-primary mb-3">Post</button>
  </div>
</form>
