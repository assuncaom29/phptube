<div>
	<h1>Editando o cadastro do video</h1>
</div>

<?php if ($this->session->flashdata('error') == TRUE): ?>
	<p><?php echo $this->session->flashdata('error'); ?></p>
<?php endif; ?>
<?php if ($this->session->flashdata('success') == TRUE): ?>
	<p><?php echo $this->session->flashdata('success'); ?></p>
<?php endif; ?>

<form method="post" action="<?=base_url('atualizar')?>" enctype="multipart/form-data">
		<div>
			<label>Nome:</label>
			<input type="text" name="name" value="<?=$video['name']?>" required/>
		</div>
		<div>
			<label>Descricao:</label>
			<input type="textarea" name="descricao" value="<?=$video['descricao']?>" required/>
		</div>
		<div>
			<label>LinkVideo:</label>
			<input type="text" name="linkvideo" value="<?=$video['linkvideo']?>" required/>
		</div>
		<div>
			<label>Categoria:</label>
			<input type="text" name="Categoria" value="<?=$video['categoria']?>" required/>
		</div>
	<div>
		<label><em>Todos os campos são obrigatórios.</em></label>
		<input type="hidden" name="id" value="<?=$video['idvideo']?>"/>
		<input type="submit" value="Salvar" />
	</div>
</form>