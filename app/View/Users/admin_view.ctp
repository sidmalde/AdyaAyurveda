<?=$this->Form->create('User', array('url' => $this->Html->url(array('controller' => 'users', 'action' => 'edit', 'user' => $user['User']['id'])), 'class' => 'form form-user-note-edit', 'type' => 'file')); ?>
	<div class="outer-5">
		<div class="col-md-12">
			<div class="tabbable">
				<ul class="nav nav-tabs" id="user-view-tabbing">
					<li class="active"><a href="#basicInformation" data-toggle="tab"><?=__('Info');?> <i class="icon icon-edit"></i></a></li>
					<li><a href="#extraInformation" data-toggle="tab"><?=__('Extra Info.');?> <i class="icon icon-edit"></i></a></li>
					<li><a href="#userNotes" data-toggle="tab"><?=__('Notes');?> <i class="icon icon-edit"></i></a></li>
					<li><a href="#uploads" data-toggle="tab"><?=__('Uploads');?> <i class="icon icon-edit"></i></a></li>
					<li><a href="#orders" data-toggle="tab"><?=__('Orders');?> <i class="icon icon-edit"></i></a></li>
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
									<div class="input-group datepicker">
										<label for="date_of_birth">Date of Birth</label>
										<div class="controls">
											<input name="data[User][date_of_birth]" type="text" class="form-control datepicker" id="datepicker" value="<?=$this->Time->nice($user['User']['date_of_birth']);?>">
										</div>
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
							<div class="col-md-12">
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
																<strong><?=__('Created On: ', true);?></strong><?=$this->Time->nice($userNote['created']);?><br />
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
						<div class="well">
							<h3><?=__('Attachments');?></h3>
							<div class="row">
								<div class="col-md-6">
									<?=$this->Form->input('attachment', array('type' => 'file'));?>
									<div class="alert alert-info">
										<p> Allowed Extensions: </p>
										<p><?=implode(", ", array_values($allowedUploadExtensions));?></p>
									</div>
								</div>
								<div class="col-md-6">
									<?$collapseOffset=0;?>
									<? if (!empty($user['UserAttachment'])): ?>
										<div class="accordion" id="user-attachments">
											<? foreach ($user['UserAttachment'] as $index => $userAttachment): ?>
												<div class="accordion-group success">
													<div class="accordion-heading">
														<a data-toggle="collapse" data-parent="#user-attachments" href="#collapseAttach<?=$index;?>" class="alignLeft accordion-toggle btn btn-warning">
															<?=$userAttachment['label'];?>
														</a>
													</div>
													<div id="collapseAttach<?=$index;?>" class="accordion-body collapse">
														<div class="accordion-inner">
															<p class="alert alert-info">	
																<strong><?=__('Uploaded By: ', true);?></strong><?=@$users[$userAttachment['user_id']];?><br />
																<strong><?=__('Uploaded On: ', true);?></strong><?=$this->Time->niceDate($userAttachment['created']);?><strong><?=__(' @: ', true);?></strong><?=$this->Time->niceTime($userAttachment['created']);?><br />
																<strong><?=__('Size: ', true);?></strong><?=round($userAttachment['filesize']/1024).'Kb';?><br />
																<?=nl2br(Sanitize::html($userAttachment['description']));?>
															</p>
															<? if (strpos($userAttachment['content_type'], 'image') !== false): ?>
																<p class="alert alert-success">	
																	<?=$this->Html->image($userAttachment['location']);?>
																</p>
															<? endif;?>
															<div class="btn-group">
																<?=$this->Html->link(__('Download'), $userAttachment['location'], array('target' => '_blank', 'class' => 'btn btn-primary'));?>
																<?=$this->Html->link(__('Delete'), array('action' => 'delete_attachment', 'userAttachment' => $userAttachment['id']), array('class' => 'btn btn-danger'));?>
															</div>
														</div>
													</div>
												</div>
												<?$collapseOffset = $index+1;?>
											<? endforeach; ?>
										</div>
									<? else: ?>
										<div class="alert"><?=__('No Attachments have been added yet');?></div>
									<? endif; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="orders">
						<div class="well">
							<h3><?=__('Orders');?></h3>
							<div class="row">
								<div class="col-md-12">
									<? if(!empty($user['Order'])): ?>
										<? $collapseOffset = 0; ?>
										<? foreach($user['Order'] as $index => $order): ?>
											<div class="accordion-group success">
													<div class="accordion-heading">
														<a data-toggle="collapse" data-parent="#user-attachments" href="#collapseOrder<?=$index;?>" class="alignLeft accordion-toggle btn btn-warning text-center">
															Order Ref #<?=$order['ref'];?>: - <?=$this->Number->currency($order['total'], 'GBP');?>
														</a>
													</div>
													<div id="collapseOrder<?=$index;?>" class="accordion-body collapse">
														<div class="accordion-inner">
															<table>
																<tr>
																	<th><?=__('Name');?></th>
																	<th><?=__('Quantity');?></th>
																	<th><?=__('Notes');?></th>
																	<th><?=__('Sub Total');?></th>
																	<th>&nbsp;</th>
															<? foreach($order['OrderItem'] as $orderItem): ?>
																<tr>
																	<td><?=$orderItem['Product']['name'];?></td>
																	<td><?=$orderItem['Product']['quantity'].' '.$orderItem['Product']['measurement'];?></td>
																	<td><?=$orderItem['notes'];?></td>
																	<td><?=$this->Number->currency($orderItem['sub_total'], 'GBP');?></td>
																	<td class="condensed">
																		<div class="btn-group">
																			<button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=__('Actions')?> <span class="caret"></span></button>
																			<ul class="dropdown-menu">
																				<li><?=$this->Html->link(__('View / Edit'), array('controller' => 'orders', 'action' => 'edit', 'order' => $order['id']));?></li>
																				<li><?=$this->Html->link(__('Delete'), array('controller' => 'orders', 'action' => 'delete', 'order' => $order['id']));?></li>
																			</ul>
																		</div>
																	</td>
																</tr>
															<? endforeach; ?>
															</table>
														</div>
													</div>
												</div>
												<?$collapseOffset = $index+1;?>
										<? endforeach; ?>
									<? else: ?>
										<div class="alert"><?=__('No Orders have been placed yet');?></div>
									<? endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?=$this->Form->end(); ?>