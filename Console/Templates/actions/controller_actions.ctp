<?php
/**
 * Bake Template for Controller action generation.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.actions
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
	
		/**
		 * <?php echo $admin ?>index method
		 *
		 * @return void
		 */
		public function <?php echo $admin ?>index() {
			$this->paginate = array('contain' => false);
			$<?php echo $pluralName ?> = $this->paginate();
			$this->set(compact('<?php echo $pluralName ?>'));
		}

		/**
		 * <?php echo $admin ?>view method
		 *
		 * @throws NotFoundException
		 * @param string $id
		 * @return void
		 */
		public function <?php echo $admin ?>view($id = null) {
			if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
				throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
			}
			$<?php echo $singularName; ?> = $this-><?php echo $currentModelName; ?>->find('first', array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id)));
			$this->set(compact('<?php echo $singularName; ?>'));
		}

<?php $compact = array(); ?>
		/**
		 * <?php echo $admin ?>add method
		 *
		 * @return void
		 */
		public function <?php echo $admin ?>add() {
			if ($this->request->is('post')) {
				$this-><?php echo $currentModelName; ?>->create();
				if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
					$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been saved'), 'flash/success');
					$this->redirect(array('action' => 'view', $this-><?php echo $currentModelName; ?>->id));
<?php else: ?>
					$this->flash(__('<?php echo ucfirst(strtolower($currentModelName)); ?> saved.'), array('action' => 'index'));
<?php endif; ?>
				} else {
<?php if ($wannaUseSession): ?>
					$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'), 'flash/error');
<?php endif; ?>
				}
			}
<?php foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc): ?>
<?php foreach ($modelObj->{$assoc} as $associationName => $relation): ?>
<?php if (!empty($associationName)): ?>
<?php $otherModelName = $this->_modelName($associationName); ?>
<?php $otherPluralName = $this->_pluralName($associationName); ?>
			<?php echo "\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n"; ?>
<?php $compact[] = "'{$otherPluralName}'"; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php if (!empty($compact)): ?>
			<?php echo "\$this->set(compact(".join(', ', $compact)."));\n"; ?>
<?php endif; ?>
		}

<?php $compact = array(); ?>
		/**
		 * <?php echo $admin ?>edit method
		 *
		 * @throws NotFoundException
		 * @param string $id
		 * @return void
		 */
		public function <?php echo $admin; ?>edit($id = null) {
			if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
				throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
					$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been saved'), 'flash/success');
					$this->redirect(array('action' => 'view', $this-><?php echo $currentModelName; ?>->id));
<?php else: ?>
					$this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), array('action' => 'index'));
<?php endif; ?>
				} else {
<?php if ($wannaUseSession): ?>
					$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'), 'flash/error');
<?php endif; ?>
				}
			} else {
				$this->request->data = $this-><?php echo $currentModelName; ?>->find('first', array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id), 'contain' => false));
			}
<?php foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc): ?>
<?php foreach ($modelObj->{$assoc} as $associationName => $relation): ?>
<?php if (!empty($associationName)): ?>
<?php $otherModelName = $this->_modelName($associationName); ?>
<?php $otherPluralName = $this->_pluralName($associationName); ?>
			<?php echo "\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n"; ?>
<?php $compact[] = "'{$otherPluralName}'"; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php if (!empty($compact)): ?>
			<?php echo "\$this->set(compact(".join(', ', $compact)."));\n"; ?>
<?php endif; ?>
		}

		/**
		 * <?php echo $admin ?>delete method
		 *
		 * @throws NotFoundException
		 * @throws MethodNotAllowedException
		 * @param string $id
		 * @return void
		 */
		public function <?php echo $admin; ?>delete($id = null) {
			$this-><?php echo $currentModelName; ?>->id = $id;
			if (!$this-><?php echo $currentModelName; ?>->exists()) {
				throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this-><?php echo $currentModelName; ?>->delete()) {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> deleted'), 'flash/success');
				$this->redirect(array('action' => 'index'));
<?php else: ?>
				$this->flash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> deleted'), array('action' => 'index'));
<?php endif; ?>
			}
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> was not deleted'), 'flash/error');
<?php else: ?>
			$this->flash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> was not deleted'), array('action' => 'index'));
<?php endif; ?>
			$this->redirect(array('action' => 'index'));
		}
