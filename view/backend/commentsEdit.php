<?php $title = 'Modérer les comentaires';

if(isset($_GET['reported'])){
	$h1 = "Modérer les comentaires signalés";
	$redirectTo = 'reported';
}elseif(isset($_GET['id'])) {
	$h1 = "Modérer les comentaires sur " . $post->title();
	$redirectTo = $_GET['id'];
}	else {
	$h1 = "Modérer les comentaires";
	$redirectTo = 'all';
}
?>

<?php ob_start(); ?>
<table class="box">
<?php
if($comments){
	foreach ($comments as $comment)
	{
	?>
		<tr>
		
			<td>

				Par: <?= $comment->author() ?>
				le: <?= $comment->dateFr() ?>
				<p><?= $comment->content() ?></p>

				<a href="admin.php?action=editComment&amp;id=<?= $comment->id() ?>">Modifier</a>
				<a href="admin.php?action=deleteComment&amp;redirect_to=<?= $redirectTo ?>&amp;id=<?= $comment->id() ?>">Supprimer</a>
				<a href="index.php?action=post&amp;id=<?= $comment->id() ?>">Article</a>
				
			</td>

		</tr>
		
	<?php
	}
} else {?>
		<tr>
			<td>Pas de commentaires à modérer</td>
		</tr>
<?php } ?>
</table>
<?php
require('/../frontend/pagination.php');

$content = ob_get_clean();

 require('template.php'); ?>