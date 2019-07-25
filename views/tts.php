<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<?php
				if (!empty($id)) {
			?>
					<h2>
						<?php echo _("Say My Name").": ". $name; ?>
					</h2>
			<?php
				}
			?>
			<div class="fpbx-container">
				<div class="display full-border">
					<form class="fpbx-submit popover-form" autocomplete="off" name="editTTS" action="?display=saymyname" method="post"
					<?php echo !empty($id) ? 'data-fpbx-delete="config.php?display=saymyname&id='.$id.'&action=delete"' : ''; ?>>
					<input type="hidden" name="display" value="saymyname">
					<input type="hidden" name="action" value="<?php echo (!empty($id) ? 'edit' : 'add') ?>">
					<?php if (!empty($id)) { ?>
						<input type="hidden" name="id" value="<?php echo $id; ?>">
					<?php } ?>

					<?php //Main Settings ?>
					<div class="section-title" data-for="section1"><h3><i class="fa fa-minus"></i><?php echo _("Main settings"); ?></h3></div>
					<div class="section" data-id="section1">
						<div class="element-container">
							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="name"><?php echo _("Name"); ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="name"></i>
											</div>
											<div class="col-md-9"><input type="text" class="form-control" name="name" value="<?php echo (isset($name) ? $name : ''); ?>" required></div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="name-help" class="help-block fpbx-help-block"><?php echo _("Give this TTS Destination a brief name to help you identify it"); ?></span>
								</div>
							</div>
						</div>
					</div>
					<?php // End Main Settings ?>

					<?php // IT Message ?>
					<div class="section-title" data-for="section2"><h3><i class="fa fa-minus"></i><?php echo _("Italian Message"); ?></h3></div>
					<div class="section" data-id="section2">					
						<div class="element-container">
							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="name"><?php echo _("Text IT"); ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="text_IT"></i>
											</div>
											<div class="col-md-9">
												<textarea name="text_IT" class="form-control" cols=50 rows=5 required><?php echo (isset($text_IT) ? $text_IT : ''); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="text-help" class="help-block fpbx-help-block"><?php echo _("Enter the text you want to synthetize.\nYou can use: %n for name and %s for surname in the text"); ?></span>
								</div>
							</div>
							<div class="element-container">
							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="name"><?php echo _("Text not found IT"); ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="textnotfound_IT"></i>
											</div>
											<div class="col-md-9">
												<textarea name="textnotfound_IT" class="form-control" cols=50 rows=5 required><?php echo (isset($textnotfound_IT) ? $textnotfound_IT : ''); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="textnotfound-help" class="help-block fpbx-help-block"><?php echo _("Enter the text if caller not found."); ?></span>
								</div>
							</div>
						</div>
					</div>
					<?php // End IT Message ?>

					<?php // ENG Message ?>
					<div class="section-title" data-for="section3"><h3><i class="fa fa-minus"></i><?php echo _("English Message"); ?></h3></div>
					<div class="section" data-id="section3">
						<div class="element-container">
							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="name"><?php echo _("Text EN"); ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="text_EN"></i>
											</div>
											<div class="col-md-9">
												<textarea name="text_EN" class="form-control" cols=50 rows=5 required><?php echo (isset($text_EN) ? $text_EN : ''); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="text-help" class="help-block fpbx-help-block"><?php echo _("Enter the text you want to synthetize.\nYou can use: %n for name and %s for surname in the text"); ?></span>
								</div>
							</div>
							<div class="element-container">
							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="name"><?php echo _("Text not found EN"); ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="textnotfound_EN"></i>
											</div>
											<div class="col-md-9">
												<textarea name="textnotfound_EN" class="form-control" cols=50 rows=5 required><?php echo (isset($textnotfound_EN) ? $textnotfound_EN : ''); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="textnotfound-help" class="help-block fpbx-help-block"><?php echo _("Enter the text if caller not found."); ?></span>
								</div>
							</div>
						</div>
					</div>	
					<?php // End ENG Message ?>
					
					<?php //Destination ?>
					<div class="section-title" data-for="section4"><h3><i class="fa fa-minus"></i><?php echo _("Destination"); ?></h3></div>
					<div class="section" data-id="section4">
						<div class="element-container">
							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="goto"><?php echo _("Destintation"); ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="goto"></i>
											</div>
											<div class="col-md-9">
												<?php
												if (isset($goto)) {
													echo drawselects($goto,0,false,true,null,true);
												} else {
													echo drawselects(null, 0,false,true,null,true);
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="goto-help" class="help-block fpbx-help-block"><?php echo _("After the Text to Speech was played go to"); ?></span>
								</div>
							</div>
						</div>
					</div>
					<?php //END Destination ?>
					<?php //TTS Engine ?>
					<div class="section-title" data-for="section5"><h3><i class="fa fa-minus"></i><?php echo _("TTS Engines"); ?></h3></div>
					<div class="section" data-id="section5">
						<div class="element-container">
							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="engine"><?php echo _("Choose an Engine"); ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="engine">Only select Engine that point to a NodeJS interpreter</i>
											</div>
											<div class="col-md-9">
												<?php if( !isset($tts_agi_error) ) { ?>
													<select name="engine" class="form-control">
														<?php
															foreach ($engine_list as $e)
															{
																if ($e['name'] == $engine) {
																	echo '<option value="' . $e['name'] . '" selected>' . $e['name'] . '</option>';
																} else {
																	echo '<option value="' . $e['name'] . '">' . $e['name'] . '</option>';
																}
															}
														?>
													</select>
												<?php } else { ?>
													<i><?php echo $tts_agi_error; ?></i>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="engine-help" class="help-block fpbx-help-block"><?php echo _("List of TTS engine detected on the server. Choose the one you want to use for the current sentence."); ?></span>
								</div>
							</div>
						</div>
						<div class="element-container">
							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="goto"><?php echo _("Destintation"); ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="goto"></i>
											</div>
											<div class="col-md-9">
												<?php
												if (isset($goto)) {
													echo drawselects($goto,0,false,true,null,true);
												} else {
													echo drawselects(null, 0,false,true,null,true);
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="goto-help" class="help-block fpbx-help-block"><?php echo _("After the Text to Speech was played go to"); ?></span>
								</div>
							</div>
						</div>
					</div>
					<?php //END TTS Engines ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
