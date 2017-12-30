<div>
	<div>
		<h1>Tela de Videos</h1>
	</div>
	<?php if ($this->session->flashdata('error') == TRUE): ?>
		<p><?php echo $this->session->flashdata('error'); ?></p>
	<?php endif; ?>
	<?php if ($this->session->flashdata('success') == TRUE): ?>
		<p><?php echo $this->session->flashdata('success'); ?></p>
	<?php endif; ?>

	<form method="post" action="<?=base_url('salvar')?>" enctype="multipart/form-data">
		<div>
			<label>Nome:</label>
			<input type="text" name="nome" value="<?=set_value('name')?>" required/>
		</div>

		<div>
			<label>Descrição:</label>
			<input type="textarea" name="descricao" value="<?=set_value('descricao')?>" required/>
		</div>

		<div>
			<label>LinkVideo:</label>
			<input type="text" name="linkvideo" value="<?=set_value('linkvideo')?>" required/>
		</div>

		<div>
			<label>Categoria:</label>
			<input type="text" name="categoria" value="<?=set_value('categoria')?>" required/>
		</div>



		<div>
			<label><em>Todos os campos são obrigatórios.</em></label>
			<input type="submit" value="Salvar"/>
		</div>
	</form>
	<div>
		<table>
			<caption>Contatos</caption>
			<thead>
				<tr>
					<th>Nome</th>
					<th>Descrição</th>
					<th>linkvideo</th>
					<th>categoria</th>
					<th>Operações</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($videos == FALSE): ?>
					<tr><td colspan="2">Nenhum video encontrado</td></tr>
				<?php else: ?>
					<?php foreach ($videos as $row): ?>
						<tr>
							<td><?= $row['NAME'] ?></td>
							<td><?= $row['DESCRICAO'] ?></td>
							<td><?= $row['LINKVIDEO'] ?></td>
							<td><?= $row['CATEGORIA'] ?></td>
							<td><a href="<?= $row['editar_url'] ?>">[Editar]</a> <a href="<?= $row['excluir_url'] ?>">[Excluir]</a></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>

</div>