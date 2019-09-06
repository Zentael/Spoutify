<fieldset>
    <legend>Envoyer une demande</legend>
    <?= $this->Form->create($newRequest) ?>
    <?= $this->Form->control('artist', [
        'label' => 'Un artiste que vous souhaitez écouter',
    ]) ?>
    <?= $this->Form->control('album', [
        'label' => 'Un album que vous souhaitez écouter',
    ]) ?>

    <?= $this->Form->button('Envoyer votre demande') ?>
    <?= $this->Form->end() ?>
</fieldset>
