<h1>
    Demande de <?= $requestUser->pseudo?>
</h1>

<ul>
    <li>
        <?= $requestUser->pseudo?> souhaite écouter
        <?= $request->artist ?>
    </li>
    <li>
        <?= $requestUser->pseudo?> souhaite écouter
        <?= $request->album ?>
    </li>
</ul>

<?= $this->Html->link('Retourner à l\'index des requêtes', ['action' => 'index']) ?>
--//WIP\\--
<?= $this->Html->link('Accepter la requête', ['action' => 'accept', $request->id]) ?>
--//WIP\\--

