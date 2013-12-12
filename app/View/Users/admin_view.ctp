<?=$this->Form->create('User', array('url' => $this->Html->url(array('controller' => 'users', 'action' => 'edit', 'user' => $user['User']['id'])), 'class' => 'form form-user-note-edit', 'type' => 'file')); ?>
	<div class="row">
		<div class="col-md-12 page-header">
			<div class="row">
				<div class="col-md-8"><h3><?=@$pageTitle;?></h3></div>
				<div class="col-md-3">
					<div class="btn-group pull-right">
						<?=$this->Html->link(__('Back'), array('action' => 'index'), array('class' => 'btn btn-danger'));?>
						<?=$this->Form->submit(__('Save Changes'), array('div' => false, 'label' => false, 'type' => 'submit', 'class' => 'btn btn-success'));?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="tabbable">
				<ul class="nav nav-tabs" id="user-view-tabbing">
					<li class="active"><a href="#basicInformation" data-toggle="tab"><?=__('Info');?> <i class="icon icon-edit"></i></a></li>
					<li><a href="#extraInformation" data-toggle="tab"><?=__('Extra Info.');?> <i class="icon icon-edit"></i></a></li>
					<li><a href="#userNotes" data-toggle="tab"><?=__('Notes');?> <i class="icon icon-edit"></i></a></li>
					<li><a href="#uploads" data-toggle="tab"><?=__('Uploads');?> <i class="icon icon-edit"></i></a></li>
				</ul>
		 
				<div id="user-view-content" class="tab-content">
					<div class="tab-pane active in" id="basicInformation">
						<div class="well">
							<div class="row">
								<div class="col-md-6">
									<?=$this->Form->hidden('id');?>
									<?=$this->Form->input('group_id');?>
									<?/* =$this->Form->input('status_id'); */?>
									<?=$this->Form->input('email');?>
									<?/* =$this->Form->input('password'); */?>
									<?=$this->Form->input('title', array('empty' => __('Please select a country'), 'options' => $userTitles));?>
									<?=$this->Form->input('firstname');?>
									<?=$this->Form->input('lastname');?>
									<?/* =$this->Form->input('gender'); */?>
									<div class="input-append date input-datepicker">
										<?=$this->Form->input('date_of_birth', array('type' => 'text', 'div' => false, 'data-format' => 'dd/MM/yyyy', 'value' => $this->Time->nice($user['User']['date_of_birth'])));?>
										<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
									</div>
									<?=$this->Form->input('phone');?>
								</div>
								<div class="col-md-5">
									<?=$this->Form->input('address_1');?>
									<?=$this->Form->input('address_2');?>
									<?=$this->Form->input('address_3');?>
									<?=$this->Form->input('city');?>
									<?=$this->Form->input('region');?>
									<?=$this->Form->input('postcode');?>
									<?=$this->Form->input('country', array('empty' => __('Please select a country'), 'options' => $countries));?>
									<?=$this->Form->input('mobile');?>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="extraInformation">
						<div class="well">
							<div class="col-md-5">
								<? foreach($userDataFields as $userDataField): ?>
									<? if($userDataField['UserDataField']['type'] == 'text'): ?>
										<?=$this->Form->input('UserDataField.'.$userDataField['UserDataField']['id'], array('type' => 'text', 'label' => $userDataField['UserDataField']['description']));?>
									<? elseif($userDataField['UserDataField']['type'] == 'textarea'): ?>
										<?=$this->Form->input('UserDataField.'.$userDataField['UserDataField']['id'], array('type' => 'textarea', 'label' => $userDataField['UserDataField']['description']));?>
									<? elseif($userDataField['UserDataField']['type'] == 'list'): ?>
										<?=$this->Form->input('UserDataField.'.$userDataField['UserDataField']['id'], array('empty' => __('Please select an option:'), 'options' => $userDataField['UserDataField']['options'], 'label' => $userDataField['UserDataField']['description']));?>
									<? elseif($userDataField['UserDataField']['type'] == 'boolean'): ?>
										<?=$this->Form->input('UserDataField.'.$userDataField['UserDataField']['id'], array('type' => 'checkbox', 'label' => $userDataField['UserDataField']['description']));?>
									<? endif; ?>
								<? endforeach; ?>
							</div>
						<div class="clear">&nbsp;</div>
						</div>
					</div>	
					<div class="tab-pane fade" id="userNotes">
						<div class="well">
							<h3><?=__('Notes');?></h3>
							<div class="row">
								<div class="col-md-6">
									<div>
										<?=$this->Form->input(__('UserNote.id'), array('value' => ''));?>
										<?=$this->Form->input(__('UserNote.summary'));?>
										<?=$this->Form->input(__('UserNote.description'));?>
										<?=$this->Form->button(__('Save', true), array('class' => 'btn btn-info'))?>
									</div>
								</div>
								<div class="col-md-6">
									<? if (!empty($user['UserNote'])): ?>
										<div class="accordion">
											<div class="panel-group success" id="user-notes">
											<? foreach ($user['UserNote'] as $index => $userNote): ?>
												<div class="panel panel-warning">
													<div class="panel-heading">
														<a data-toggle="collapse" data-parent="#user-notes" href="#collapse<?=$index;?>" class="alignLeft accordion-toggle">
															<h4 class="panel-title">
																<?=$userNote['summary'];?>
															</h4>
														</a>
													</div>
													<div id="collapse<?=$index;?>" class="panel-collapse collapse">
														<div class="panel-body">
															<p class="alert alert-info">
																<strong><?=__('Created By: ', true);?></strong><?=@$users[$userNote['creator_id']];?><br />
																<strong><?=__('Created On: ', true);?></strong><?=$this->Time->nice($userNote['created']);?><strong><?=__(' @: ', true);?></strong><?=$this->Time->niceTime($userNote['created']);?><br />
															</p>
															<p class="alert alert-success"><?=nl2br(Sanitize::html($userNote['description']));?></p>
															<div class="btn-group">
																<?=$this->Html->link(__('Edit', true), '#', array('class' => 'btn btn-success btn-user-note-edit', 'data-id' => $userNote['id'], 'data-summary' => $userNote['summary'], 'data-description' => Sanitize::html($userNote['description'])))?>
																<?=$this->Html->link(__('Delete', true), array('controller' => 'users', 'action' => 'delete_user_note', 'userNote' => $userNote['id']), array('class' => 'btn btn-danger'))?> 
															</div>
														</div>
													</div>
												</div>
											<? endforeach; ?>
											</div>
										</div>
									<? else: ?>
										<div class="alert"><?=__('No Notes have been added yet');?></div>
									<? endif; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="uploads">
						<p>Uploads</p>
					</div>
				</div>
			</div>
		</div>
	</div>
<?=$this->Form->end(); ?>