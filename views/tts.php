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
												<label class="control-label" for="text_IT"><?php echo _("Text IT"); ?></label>
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
									<span id="text_IT-help" class="help-block fpbx-help-block"><?php echo _("Enter the text you want to synthetize.\nYou can use: %n for name and %s for surname in the text"); ?></span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="textnotfound_IT"><?php echo _("Text not found IT"); ?></label>
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
									<span id="textnotfound_IT-help" class="help-block fpbx-help-block"><?php echo _("Enter the text if caller not found."); ?></span>
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
												<label class="control-label" for="text_EN"><?php echo _("Text EN"); ?></label>
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
									<span id="text_EN-help" class="help-block fpbx-help-block"><?php echo _("Enter the text you want to synthetize.\nYou can use: %n for name and %s for surname in the text"); ?></span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="textnotfound_EN"><?php echo _("Text not found EN"); ?></label>
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
									<span id="textnotfound_EN-help" class="help-block fpbx-help-block"><?php echo _("Enter the text if caller not found."); ?></span>
								</div>
							</div>
						</div>
					</div>	
					<?php // End ENG Message ?>

					<?php // Music on Hold ?>
					<div class="section-title" data-for="section4"><h3><i class="fa fa-minus"></i><?php echo _("Output Settings"); ?></h3></div>
					<div class="section" data-id="section4">
						<div class="element-container">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<h3 class="text-center">Backgorund Music in /var/lib/asterisk/sound/ttsng/BGSound.wav</h3>
										<input type="checkbox" name="music" id="music" class="form-control" value="1<?php // echo (isset($music) ? $music : '0'); ?>" 
										<?php 
											if(isset($music) && $music || !isset($music))
												echo "checked";
											else
												echo  ""; 
										?> >
									</div>
								</div>
							</div>
							<!-- <div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="music"><?php echo _("Background Music") ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="music"></i>
											</div>
											
											<div class="col-md-9">
												<?php if( !isset($tts_agi_error) ) { ?>
												<select name="music" id="music" class="form-control">
													<?php
													array_unshift($music_list,'inherit');
													$default = (isset($music) ? $music : 'inherit');
													if (isset($music_list) && is_array($music_list)) {
														foreach ($music_list as $tresult) {
															$searchvalue="$tresult";
															$ttext = $tresult;
															if($tresult == 'inherit') $ttext = _("inherit");
															if($tresult == 'none') $ttext = _("none");
															if($tresult == 'default') $ttext = _("default");
															echo '<option value="'.$tresult.'" '.($searchvalue == $default ? 'SELECTED' : '').'>'.$ttext;
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
									<span id="music-help" class="help-block fpbx-help-block"><?php echo _("Background Music overlapped with voice message. Pay attention that music is used as is .") ?></span>
								</div>
							</div> -->

							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="silence_t"><?php echo _("Voice Delay second"); ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="silence_t"></i>
											</div>
											<div class="col-md-9">
												<div class="col-md-9"><input type="number" class="form-control" name="silence_t" value="<?php echo (isset($silence_t) ? $silence_t : '0'); ?>" min="0" max="59"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="silence_t-help" class="help-block fpbx-help-block"><?php echo _("After how many seconds the voice message starts. If 0 no delay."); ?></span>
								</div>
							</div>

							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="drop_t"><?php echo _("Cut Message Second"); ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="drop_t"></i>
											</div>
											<div class="col-md-9">
												<div class="col-md-9"><input type="number" class="form-control" name="drop_t" value="<?php echo (isset($drop_t) ? $drop_t : '0'); ?>" min="0" max="59"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="drop_t-help" class="help-block fpbx-help-block"><?php echo _("After how many seconds cutting the message. If 0 no cut."); ?></span>
								</div>
							</div>

							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="fade_t"><?php echo _("Fade Out Second"); ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="fade_t"></i>
											</div>
											<div class="col-md-9">
												<div class="col-md-9"><input type="number" class="form-control" name="fade_t" value="<?php echo (isset($fade_t) ? $fade_t : '0'); ?>" min="0" max="59"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span id="fade_t-help" class="help-block fpbx-help-block"><?php echo _("In many seconds fade out the message. If 0 no fade out. "); ?></span>
								</div>
							</div>
						</div>
					</div>
					<?php //END Music on Hold ?>
					
					<?php //Destination ?>
					<div class="section-title" data-for="section5"><h3><i class="fa fa-minus"></i><?php echo _("Destination"); ?></h3></div>
					<div class="section" data-id="section5">
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
					<div class="section-title" data-for="section6"><h3><i class="fa fa-minus"></i><?php echo _("TTS Engines"); ?></h3></div>
					<div class="section" data-id="section6">
						<div class="element-container">
							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label class="control-label" for="engine"><?php echo _("Choose an Engine"); ?></label>
												<i class="fa fa-question-circle fpbx-help-icon" data-for="engine"></i>
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
									<span id="engine-help" class="help-block fpbx-help-block"><?php echo _("Only select Engine that point to a NodeJS interpreter."); ?></span>
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
