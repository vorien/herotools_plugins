<div class="content" style="fbackground-color: #FFF; padding: 10px;">
	<div class="row">
		<h2>Upload a file</h2>

		<?php
		echo $this->Flash->render();
		echo $this->Form->create(null, array('type' => 'file'));
		echo $this->Form->input('file', array('type' => 'file', 'label' => false));
		echo $this->Form->hidden('action', ['default' => 'file']);
		echo $this->Form->submit('Upload');
		echo $this->Form->end();
		?>
	</div>
</div>

