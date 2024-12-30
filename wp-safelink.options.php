<?php
/*
	@package : themeson.com
	Author : Themeson
	Don't touch baby!
 */
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<style>
	ul.wpsafmenu {
		background:#20192b;padding:10px 10px;color: white;box-shadow: 0 3px 8px 0 rgb(33, 15, 89) !important;margin-bottom: 20px;margin-top: 10px;
      border-radius:20px;
	}

	ul.wpsafmenu li {
		list-style: none;
		display: inline-block;
		padding-top: 8px;
		margin: 0 5px 0 0;
	}

	ul.wpsafmenu li span {
		font-size: 14px;
		padding: 10px 15px;
		text-decoration: none;
		display: block;
		outline: 0;
		cursor: pointer;
		-webkit-border-radius: 12px;
		-moz-border-radius: 12px;
		border-radius: 5px 5px 0 0;
		margin-bottom: -1px
	}

	ul.wpsafmenu li span.actived {
		background: #ff0561;
		font-weight: bold;
		border: none;
		border-radius: 50px;
	}

	ul.wpsafmenu li a:active {
		outline: none;
	}

	ul.wpsafmenu li #human {
		position: relative;
		padding-top: 5px;
	}

	ul.wpsafmenu li strong {
		position: absolute;
		left: 0px;
		bottom: -2px;
		font-size: 10px;
		color: red;
	}

	a:active {
		outline: none;
	}

	#safe_lists a {
		text-decoration: none;
		color: #000;
	}

	#safe_lists td {
		position: relative;
	}

	a.elips {
		width: auto;
		max-width: 100%;
		position: absolute;
		left: 10px;
		right: 10px;
		top: 6px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
</style>
<div class="wrap">
<!--Safelink Redirecting code-->
	<script language="javascript">
document.write(unescape('%3C%63%65%6E%74%65%72%3E%3C%68%33%3E%57%50%20%54%72%75%65%6C%69%6E%6B%20%76%32%2E%30%2E%31%20%62%79%20%3C%61%20%68%72%65%66%3D%22%68%74%74%70%73%3A%2F%2F%73%67%75%34%74%65%63%68%2E%62%6C%6F%67%73%70%6F%74%2E%63%6F%6D%22%3E%53%47%55%20%54%45%43%48%3C%2F%61%3E%3C%2F%68%33%3E%3C%2F%63%65%6E%74%65%72%3E'));
</script>



	<ul class="wpsafmenu">
		<?php if($cek) : ?>
		<li><span id="generate" <?php if ($_GET['tb'] == '') echo 'class="actived"'; ?>>Generate Link</span></li>
		<li><span id="autog" <?php if ($_GET['tb'] == 'autog') echo 'class="actived"'; ?>>Auto Generate Link</span></li>
		<li><span id="setting" <?php if ($_GET['tb'] == 'setting') echo 'class="actived"'; ?>>Settings & Adlinkfly</span></li>
		<li><span id="human" <?php if ($_GET['tb'] == 'human') echo 'class="actived"'; ?>>Template 2 Setup</span></li>
		<li><span id="campaign" <?php if ($_GET['tb'] == 'campaign') echo 'class="actived"'; ?>>Advertisements</span></li>
		<li><span id="adb" <?php if ($_GET['tb'] == 'adb') echo 'class="actived"'; ?>>Anti Adblock</span></li>
		<li><span id="lic" <?php if ($_GET['tb'] == 'lic') echo 'class="actived"'; ?>>License</span></li>
		<?php endif; ?>
	</ul>

	<div id="lic" <?php echo ($cek && $_GET['tb'] != 'lic') ? 'style="display:none"' : ""; ?> class="tabcon">
		<div class="wp-pattern-example">
			<h3>License</h3>
			<form action="?page=wp-safelink&tb=lic" method="post">
				<table class="form-table">
					<tr>
						<td width="200px" valign="top" style="padding-top:8px;">Domain</td>
						<td><input type="text" size="40" name="domain" <?php echo 'value="' . $domen . '" readonly'; ?>>
						</td>
					</tr>
					<tr>
						<td valign="top" style="padding-top:8px;">License Key:</td>
						<td><input type="text" size="40" autocomplete="off" <?php if ($cek) echo 'value="' . $this->ceklis('key') . '" readonly';
															else echo 'name="lisensi"'; ?>>
						</td>
					</tr>
					<tr>
						<td><a href="http://telegram.me/jit362" target="_blank">Get License Key</a></td>
						<td>
							<input type="submit" name="submit" class="button-primary" <?php if ($cek) echo 'disabled'; ?> value="Validate License"> &nbsp; &nbsp;
							<?php if ($cek) { ?><input name="sub" type="submit" class="button" value="Change License"> <?php } ?>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	
	<?php if($cek) : ?>
	<div id="generate" <?php if ($_GET['tb'] != '') echo 'style="display:none"'; ?> class="tabcon">
		<div class="wp-pattern-example">
			<h3>Generate Link</h3>
			<form action="?page=wp-safelink" method="post">
				<table class="form-table">
					<tbody>
						<tr>
							<td><input value="" type="text" size="70" name="linkd" placeholder="https://www.google.com" />
								<input name="generate" type="submit" class="button button-primary button-large" value="Generate" />
							</td>
						</tr>
						<?php if ($generated3 != '') { ?>
							<tr>
								<td>
									<p><br />Target Link : <code>
											<a href="<?php _e($linkd); ?>" target="_blank"><?php _e($linkd); ?></a></code></p>
									<p>Your Safelink : <code>
											<a href="<?php _e($generated3); ?>" target="_blank"><?php _e($generated3); ?></a></code>
										<b>OR</b> <code><a href="<?php _e($generated2); ?>" target="_blank"><?php _e($generated2); ?></a></code></p>
								</td>
							</tr>
						<?php } ?>
				</table>
			</form>
			<div style="width:auto;padding:15px;margin:10px 0;background:#fff;">
				<table id="safe_lists" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="15%">Date Added</th>
							<th width="20%">Safelink (long)</th>
							<th width="20%">Safelink (short)</th>
							<th width="20%">Target URL</th>
							<th width="5%">View</th>
							<th width="5%">Click</th>
							<th width="1%"></th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($safe_lists as $d) {
							$encrypted = $this->encrypt_link($d['link'], $d['safe_id']);
							if ($wpsaf->permalink == 1) {
								$safelink_link = home_url() . '/' . $wpsaf->permalink1 . '/' . $d['safe_id'];
								$safelink_links = home_url() . '/' . $wpsaf->permalink1 . '/' . base64_encode($d['link']);
								$encrypt_link = home_url() . '/' . $wpsaf->permalink1 . '/' . $encrypted;
							} else if ($wpsaf->permalink == 2) {
								$safelink_link = home_url() . '/?' . $wpsaf->permalink2 . '=' . $d['safe_id'];
								$safelink_links = home_url() . '/?' . $wpsaf->permalink2 . '=' . base64_encode($d['link']);
								$safelink_links = home_url() . '/?' . $wpsaf->permalink2 . '=' . $encrypted;
								$encrypt_link = home_url() . '/?' . $wpsaf->permalink2 . '=' . $encrypted;
							} else {
								$safelink_link = home_url() . '/?' . $d['safe_id'];
								$safelink_links = home_url() . '/?' . base64_encode($d['link']);
								$safelink_links = home_url() . '/?' . $encrypted;
								$encrypt_link = home_url() . '/?' . $encrypted;
							}
							echo '<tr>
								<td>' . date('Y-m-d H:i', strtotime($d['date'])) . '</td>
								<td>' . ($d['safe_id'] != "" ? "<a class='elips' href='" . $encrypt_link . "' target='_blank'>" . $encrypt_link . "</a>" : "") . '</td> 
								<td>' . ($d['safe_id'] != "" ? "<a class='elips' href='" . $safelink_link . "' target='_blank'>" . $safelink_link . "</a>" : "") . '</td> 
								<td>' . ($d['link'] != "" ? "<a class='elips' href='" . $d['link'] . "' target='_blank'>" . $d['link'] . "</a>" : "") . '</td> 
								<td style="text-align:center">' . $d['view'] . '</td>
								<td style="text-align:center">' . $d['click'] . '</td>
								<td style="text-align:center"><a href="?page=wp-safelink&delete=' . $d['ID'] . '">delete</a></td>
							</tr>';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<form action="?page=wp-safelink" method="post">

		<div id="human" <?php if ($_GET['tb'] != 'human') echo 'style="display:none"'; ?> class="tabcon">
			<input name="save" type="submit" class="button button-primary button-large" value="Save" />&nbsp;
			<input name="reset" type="submit" class="button button-large" value="Reset" />
			<h3>New Safelink - With Human Verification</h3>
			<p><strong style="color:red">You must activate template2 for using this feature</strong></p>
			<p><strong>1.</strong> Paste this code above on your website : <code>&lt;?php if(function_exists('newwpsafelink_top')) newwpsafelink_top();?&gt;</code></p>
			<p><strong>2.</strong> Paste this code bellow on your website : <code>&lt;?php if(function_exists('newwpsafelink_bottom')) newwpsafelink_bottom();?&gt;</code></p>

		</div>
		<div class="wp-pattern-example">
			<div id="setting" <?php if ($_GET['tb'] != 'setting') echo 'style="display:none"'; ?> class="tabcon">
				<input name="save" type="submit" class="button button-primary button-large" value="Save" />&nbsp;
				<input name="reset" type="submit" class="button button-large" value="Reset" />
				<h3>Permalink</h3>
				<table class="form-table">
					<tbody>
						<tr>
							<td width="200px"><strong>Permalink</strong></td>
							<td>
								<input type="radio" name="wpsaf[permalink]" <?php if ($wpsaf->permalink == 1) echo "checked"; ?> value="1" id="permalink1">
								<label for="permalink1"><code><?php _e(home_url()); ?>/</code><input style="text-align:center" value="<?php echo $wpsaf->permalink1; ?>" type="text" size="12" name="wpsaf[permalink1]" />
									<code>/safelink_code</code></label><br />
								<input type="radio" name="wpsaf[permalink]" <?php if ($wpsaf->permalink == 2) echo "checked"; ?> value="2" id="permalink2">
								<label for="permalink2"><code><?php _e(home_url()); ?>/?</code><input style="text-align:center" value="<?php echo $wpsaf->permalink2; ?>" type="text" size="12" name="wpsaf[permalink2]" />
									<code>=safelink_code</code></label><br />
								<input type="radio" name="wpsaf[permalink]" <?php if ($wpsaf->permalink == 3) echo "checked"; ?> value="3" id="permalink3">
								<label for="permalink3"><code><?php _e(home_url()); ?>/?safelink_code</code></label>
							</td>
						</tr>
					</tbody>
				</table>
				<h3>Content </h3>
				<table class="form-table">
					<tbody>
						<tr>
							<td valign="top" width="200px"><strong>Content</strong></td>
							<td><select name="wpsaf[content]" id="cont">
									<?php
									$conts = array('Random All Posts', 'Random Spesific Post by Id');
									foreach ($conts as $n => $c) {
										$s = $n == $wpsaf->content ? 'selected' : '';
										echo '<option value="' . $n . '" ' . $s . '>' . $c . '</option>';
									}
									?>
								</select><br />
								<div id="contentidt" <?php if ($wpsaf->content != 1) echo 'style="display:none"'; ?>>Post ID (Separated by commas): <code>Eg: 1,20,34,45</code> <br />
									<input name="wpsaf[contentid]" size="30" type="text" value="<?php echo $wpsaf->contentid; ?>"></div>
							</td>
						</tr>
					</tbody>
				</table>
				<h3>Second Safelink</h3>
				<p>Now you can open the second safelink for more convert the ads</p>
				<table class="form-table">
					<tbody>
						<tr>
							<td valign="top" width="200px"><strong>The URL</strong></td>
							<td>
							<input type="text" value="<?php echo $wpsaf->second_safelink_url; ?>" placeholder="Place your another safelink website with full url" name="wpsaf[second_safelink_url]" id="second_safelink_url" class="regular-text">
							</td>
						</tr>
					</tbody>
				</table>
				<h3>Template </h3>
				<table class="form-table">
					<tbody>
						<tr>
							<td width="200px"><strong>Template</strong></td>
							<td><select name="wpsaf[template]">
									<?php $temps = glob(WPSAF_DIR . 'template/*.php');
									foreach ($temps as $t) {
										$t = explode('/', $t);
										$t = $t[count($t) - 1];
										$t = str_replace('.php', '', $t);
										$s = $wpsaf->template == $t ? 'selected' : '';
										echo '<option value="' . $t . '" ' . $s . '>' . $t . '</option>';
									}
									?></select>
							</td>
						</tr>
						<tr>
							<td valign="" width="200px"><b>Skip verification page (For template3)</b></td>
							<td>
								<input <?php if ($wpsaf->skipverification == 1) echo 'checked'; ?> type="radio" name="wpsaf[skipverification]" value="1" id="skipverification1"><label for="skipverification1">Yes</label>
								<input <?php if ($wpsaf->skipverification == 2) echo 'checked'; ?> type="radio" name="wpsaf[skipverification]" value="2" id="skipverification0"><label for="skipverification0">No</label>
							</td>
						</tr>
						<tr>
							<td><strong>Time Delay</strong></td>
							<td><input value="<?php echo $wpsaf->delay; ?>" type="number" min="0" max="99" name="wpsaf[delay]" /> seconds</td>
						</tr>
						<tr>
							<td><b>Time Delay Display Text</b></td>
							<td><input value="<?php echo $wpsaf->delaytext; ?>" type="text" placeholder="" size="40" name="wpsaf[delaytext]" /> *Use syntax <code>{time}</code></td>
						</tr>
						<tr>
							<td><b>Logo Image</b></td>
							<td>
								<input type="text" value="<?php echo $wpsaf->logo; ?>" name="wpsaf[logo]" id="logo" class="regular-text">
								<input type="button" name="upload-btn" id="upload-logo" class="logo button-secondary" value="Upload Image">
							</td>
						</tr>
						<tr>
							<td></td>
							<td><img src="<?php _e($wpsaf->logo); ?>" style="max-width:300px;max-height:100px;" id="preview-logo"></td>
						</tr>
						<tr>
							<td><b>Image Button (Human Verification)</b></td>
							<td>
								<input type="text" value="<?php echo !empty($wpsaf->image4) ? $wpsaf->image4 : WPSAF_URL . '/assets/human-verification4.png'; ?>" name="wpsaf[image4]" id="image4" class="regular-text">
								<input type="button" name="upload-btn" id="upload-btn4" class="image4 button-secondary" value="Upload Image">
							</td>
						</tr>
						<tr>
							<td></td>
							<td><img src="<?php echo !empty($wpsaf->image4) ? $wpsaf->image4 : WPSAF_URL . '/assets/human-verification4.png'; ?>" style="max-width:300px;max-height:100px;" id="preview-image4"></td>
						</tr>
						<tr>
							<td><b>Image Button 1 (Generate Link)</b></td>
							<td>
								<input type="text" value="<?php echo $wpsaf->image1; ?>" name="wpsaf[image1]" id="image1" class="regular-text">
								<input type="button" name="upload-btn" id="upload-btn1" class="image1 button-secondary" value="Upload Image">
							</td>
						</tr>
						<tr>
							<td></td>
							<td><img src="<?php _e($wpsaf->image1); ?>" style="max-width:300px;max-height:100px;" id="preview-image1"></td>
						</tr>
						<tr>
							<td><b>Image Button 2 (Please Wait)</b></td>
							<td>
								<input type="text" value="<?php _e($wpsaf->image2); ?>" name="wpsaf[image2]" id="image2" class="regular-text">
								<input type="button" name="upload-btn" id="upload-btn2" class="image2 button-secondary" value="Upload Image">
							</td>
						</tr>
						<tr>
							<td></td>
							<td><img src="<?php _e($wpsaf->image2); ?>" style="max-width:300px;max-height:100px;" id="preview-image2"></td>
						</tr>
						<tr>
							<td><b>Image Button 3 (Target Link)</b></td>
							<td>
								<input type="text" value="<?php _e($wpsaf->image3); ?>" name="wpsaf[image3]" id="image3" class="regular-text">
								<input type="button" name="upload-btn" id="upload-btn3" class="image3 button-secondary" value="Upload Image">
							</td>
						</tr>
						<tr>
							<td></td>
							<td><img src="<?php echo $wpsaf->image3; ?>" style="max-width:300px;max-height:100px;" id="preview-image3"></td>
						</tr>
					</tbody>
				</table>

				<h3>reCAPTCHA v2</h3>
				<p>You can get the recaptcha site key and secret key from <a href="https://www.google.com/recaptcha/" target="_blank">https://www.google.com/recaptcha/</a>. More information you can see this screenshot <a href="http://prntscr.com/tx0pu2" target="_blank">http://prntscr.com/tx0pu2</a></p>
				<table class="form-table">
					<tbody>
						<tr>
							<td valign="" width="200px"><b>Enable reCAPTCHA v2</b></td>
							<td>
								<input <?php if ($wpsaf->recaptcha_enable == 1) echo 'checked'; ?> type="radio" name="wpsaf[recaptcha_enable]" value="1" id="recaptcha_enable1"><label for="recaptcha_enable1">Yes</label>
								<input <?php if (empty($wpsaf->recaptcha_enable) || $wpsaf->recaptcha_enable == 2) echo 'checked'; ?> type="radio" name="wpsaf[recaptcha_enable]" value="2" id="recaptcha_enable0"><label for="activerecaptcha0">No</label>
							</td>
						</tr>
						<tr>
							<td><b>reCAPTCHA Site Key</b></td>
							<td><input value="<?php echo $wpsaf->recaptcha_site_key; ?>" type="text" placeholder="" size="40" name="wpsaf[recaptcha_site_key]" />
						</tr>
						<tr>
							<td><b>reCAPTCHA Secret Key</b></td>
							<td><input value="<?php echo $wpsaf->recaptcha_secret_key; ?>" type="text" placeholder="" size="40" name="wpsaf[recaptcha_secret_key]" />
						</tr>
						<tr>
							<td><b>reCAPTCHA Alert Verification Text</b></td>
							<td><input value="<?php echo !empty($wpsaf->recaptcha_text) ? $wpsaf->recaptcha_text : "Please complete reCAPTCHA verification"; ?>" type="text" placeholder="" size="40" name="wpsaf[recaptcha_text]" />
						</tr>
					</tbody>
				</table>

				<h3>Adlinkfly Integration</h3>
				<p>You can enable this feature when you want to integrate adlinkfly.</p>
				<table class="form-table">
					<tbody>
						<tr>
							<td valign="" width="200px"><b>Enable Adlinkfly Integration</b></td>
							<td>
								<input <?php if ($wpsaf->adlinkfly_enable == 1) echo 'checked'; ?> type="radio" name="wpsaf[adlinkfly_enable]" value="1" id="adlinkfly_enable1"><label for="adlinkfly_enable1">Yes</label>
								<input <?php if (empty($wpsaf->adlinkfly_enable) || $wpsaf->adlinkfly_enable == 2) echo 'checked'; ?> type="radio" name="wpsaf[adlinkfly_enable]" value="2" id="adlinkfly_enable0"><label for="activerecaptcha0">No</label>
							</td>
						</tr>
						<tr>
							<td><b>Your Adlinkfly Main Domain</b></td>
							<td><input value="<?php echo $wpsaf->adlinkfly_domain; ?>" type="text" placeholder="https://sgushort.in" size="40" name="wpsaf[adlinkfly_domain]" />
						</tr>
					</tbody>
				</table>

				<h3>WP Safelink Client Integrator</h3>
				<p>You can download the plugin <a href="https://themeson.com/member/" target="_blank">WP Safelink (Client Version)</a></p>
				<table class="form-table">
					<tbody>
						<tr>
							<td width="200px"><strong>Copy this code and paste into WP Safelink Client version to integrate your client site</strong></td>
							<td><textarea rows="10" name="code_integrator" readonly="readonly" onclick="this.focus();this.select()" class="large-text code"><?php 
								$wpsaf->license = $this->ceklis('', true);
								$code = base64_encode(json_encode($wpsaf));
								echo $code;
							?></textarea></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="campaign" <?php if ($_GET['tb'] != 'campaign') echo 'style="display:none"'; ?> class="tabcon">
				<input name="save" type="submit" class="button button-primary button-large" value="Save" />&nbsp;
				<input name="reset" type="submit" class="button button-large" value="Reset" />
				<h3>Ads & Organic Setup</h3>
				<table class="form-table">
					<tbody>
						<tr>
							<td width="200px"><b>Advertisement Top<b></td>
							<td><textarea cols="70" rows="5" name="wpsaf[ads1]"><?php _e($wpsaf->ads1); ?></textarea></td>
						</tr>
						<tr>
							<td><b>Advertisement Bottom</b></td>
							<td><textarea cols="70" rows="5" name="wpsaf[ads2]"><?php _e($wpsaf->ads2); ?></textarea></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="adb" <?php if ($_GET['tb'] != 'adb') echo 'style="display:none"'; ?> class="tabcon">
				<input name="save" type="submit" class="button button-primary button-large" value="Save" />&nbsp;
				<input name="reset" type="submit" class="button button-large" value="Reset" />
				<table class="form-table">
					<tbody>
						<tr>
							<td width="200px"><b>Status</b></td>
							<td><select name="wpsaf[adb]">
									<option value="1" <?php if ($wpsaf->adb == 1) echo 'selected'; ?>>Enabled</option>
									<option value="2" <?php if ($wpsaf->adb == 2) echo 'selected'; ?>>Disabled</option>
								</select></td>
						</tr>
						<tr>
							<td><b>Header text 1<b></td>
							<td><textarea cols="70" rows="5" name="wpsaf[adb1]"><?php _e($wpsaf->adb1); ?></textarea></td>
						</tr>
						<tr>
							<td><b>Header text 2</b></td>
							<td><textarea cols="70" rows="5" name="wpsaf[adb2]"><?php _e($wpsaf->adb2); ?></textarea></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="autog" <?php if ($_GET['tb'] != 'autog') echo 'style="display:none"'; ?> class="tabcon">
				<input name="save" type="submit" class="button button-primary button-large" value="Save" />&nbsp;
				<input name="reset" type="submit" class="button button-large" value="Reset" /><br><br>
				<table class="form-table">
					<tbody>
						<tr>
							<td valign="" width="200px"><b>Auto Convert Link</b></td>
							<td>
								<input <?php if ($wpsaf->autoconvert == 1) echo 'checked'; ?> type="radio" name="wpsaf[autoconvert]" value="1" id="autoconvert1"><label for="autoconvert1">Yes</label>
								<input <?php if (empty($wpsaf->autoconvert) || $wpsaf->autoconvert == 2) echo 'checked'; ?> type="radio" name="wpsaf[autoconvert]" value="2" id="autoconvert0"><label for="autoconvert0">No</label>
							</td>
						</tr>
						<tr>
							<td valign="" width="200px"><b>Auto Save Safelink</b></td>
							<td>
								<input <?php if ($wpsaf->autosave == 1) echo 'checked'; ?> type="radio" name="wpsaf[autosave]" value="1" id="autosave1"><label for="autosave1">Active</label>
								<input <?php if ($wpsaf->autosave == 2) echo 'checked'; ?> type="radio" name="wpsaf[autosave]" value="2" id="autosave0"><label for="autosave0">Non-Active</label>
							</td>
						</tr>
						<tr>
							<td valign="" width="200px"><b>Open in new tab</b><br/><small>Your safelink will open in new tab</small></td>
							<td>
								<input <?php if ($wpsaf->new_tab == 1) echo 'checked'; ?> type="radio" name="wpsaf[new_tab]" value="1" id="new_tab1"><label for="new_tab1">Yes</label>
								<input <?php if ($wpsaf->new_tab == 2) echo 'checked'; ?> type="radio" name="wpsaf[new_tab]" value="2" id="new_tab0"><label for="new_tab0">No</label>
							</td>
						</tr>
						<tr>
							<td valign="" width="200px"><b>Base URL Safelink</b></td>
							<td valign="top">
								<input value="<?php echo (empty($wpsaf->base_url) ? get_bloginfo('url') . '/' : $wpsaf->base_url); ?>" type="text" name="wpsaf[base_url]" class="regular-text" readonly />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<p style="color:red;font-weight: bold;">WARNING: IF YOU ARE USING CLOUDFLARE MAKE SURE YOU CLEAR THE CLOUDFLARE CACHE AFTER CHANGE THE INCLUDE DOMAIN LIST OR EXCLUDE DOMAIN LIST</p>
							</td>
						</tr>
						<tr>
							<td valign="" width="200px"><b>Auto Convert Link Method</b></td>
							<td>
								<input <?php if (empty($wpsaf->autoconvertmethod) || $wpsaf->autoconvertmethod == "include") echo 'checked'; ?> type="radio" name="wpsaf[autoconvertmethod]" value="include" id="autoconvertmethod1"><label for="autoconvertmethod1">Include Domain</label>
								<input <?php if ($wpsaf->autoconvertmethod == "exclude") echo 'checked'; ?> type="radio" name="wpsaf[autoconvertmethod]" value="exclude" id="autoconvertmethod0"><label for="autoconvertmethod0">Exclude Domain</label>
							</td>
						</tr>
						<tr>
							<td valign="top" width="200px"><br /><b>Include Domain List </b><br /><small>one per line</small></td>
							<td><textarea cols="70" rows="10" name="wpsaf[domain]" placeholder="Insert your protected url and separate with enter (one domain one line). Eg : zippyshare.com"><?php _e($wpsaf->domain); ?></textarea></td>
						</tr>
						<tr>
							<td valign="top" width="200px"><br /><b>Exclude Domain List </b><br /><small>one per line</small></td>
							<td><textarea cols="70" rows="10" name="wpsaf[exclude_domain]" placeholder="Insert your exclude url, BEWARE it will automatically generate all links on your site and separate with enter (one domain one line). Eg : zippyshare.com"><?php _e($wpsaf->exclude_domain); ?></textarea></td>
						</tr>
					</tbody>
				</table>
				<h3>How to use</h3>
				<p>Place this code before the <b>&lt;/body&gt;</b> tag</p>
				<p style="color:red;"><code>&lt;script src="<?php echo home_url() ?>/wpsafelink.js"&gt;&lt;/script&gt;</code></p>

				<h3>Auto Generate Link</h3>
				<table class="form-table">
					<tr>
						<td width="200px">
							<h4>Shortcode</h4>
						</td>
						<td><code>[wpsafelink=<span style="color:red">your-download-link</span>]</code>
							eg: <code>[wpsafelink=<span style="color:red">http://www.google.com</span>]</code><br />
							<h4>Example:</h4><code>&lt;a href="[wpsafelink=<span style="color:red">http://www.google.com</span>]"&gt;Download Disini&lt;/a&gt;</code>
							<br /><br />
						</td>
					</tr>
					<tr>
						<td width="200px">
							<h4>PHP Code</h4>
						</td>
						<td><code>&lt;?php echo do_shortcode('[wpsafelink=<span style="color:red">your-download-link</span>]'); ?&gt;</code>
							eg: <code>&lt;?php echo do_shortcode('[wpsafelink=<span style="color:red">http://www.google.com</span>]'); ?&gt;</code>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</form>
	<?php endif; ?>
</div>
<?php
//wp_enqueue_script('jquery'); 
wp_enqueue_media();
?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {
		$('#safe_lists').DataTable();
	});
</script>
<script>
	jQuery(document).ready(function($) {
		$(".wpsafmenu span").click(function() {
			var idm = $(this).attr('id');
			var idm = idm.replace("#", "");
			$(".wpsafmenu span").removeClass('actived');
			$(".wpsafmenu span#" + idm).addClass('actived');
			$("div.tabcon").hide();
			$("div#" + idm).show();
			return false;
		});
		$('#cont').on('change', function() {
			var va = this.value;
			if (va == 1) {
				$("#contentidt").show();
			} else {
				$("#contentidt").hide();
			}
		})
		$('#upload-btn1').click(function(e) {
			var wsclass = $(this).attr('class');
			var wsclass = wsclass.split(' ')[0];
			e.preventDefault();
			var image = wp.media({
					title: 'Upload Image',
					multiple: false
				}).open()
				.on('select', function(e) {
					var uploaded_image = image.state().get('selection').first();
					console.log(uploaded_image);
					var image_url = uploaded_image.toJSON().url;
					$('#' + wsclass).val(image_url);
					$('#preview-' + wsclass).attr("src", image_url);
				});
		});
		$('#upload-btn2').click(function(e) {
			var wsclass = $(this).attr('class');
			var wsclass = wsclass.split(' ')[0];
			e.preventDefault();
			var image = wp.media({
					title: 'Upload Image',
					multiple: false
				}).open()
				.on('select', function(e) {
					var uploaded_image = image.state().get('selection').first();
					console.log(uploaded_image);
					var image_url = uploaded_image.toJSON().url;
					$('#' + wsclass).val(image_url);
					$('#preview-' + wsclass).attr("src", image_url);
				});
		});
		$('#upload-btn3').click(function(e) {
			var wsclass = $(this).attr('class');
			var wsclass = wsclass.split(' ')[0];
			e.preventDefault();
			var image = wp.media({
					title: 'Upload Image',
					multiple: false
				}).open()
				.on('select', function(e) {
					var uploaded_image = image.state().get('selection').first();
					console.log(uploaded_image);
					var image_url = uploaded_image.toJSON().url;
					$('#' + wsclass).val(image_url);
					$('#preview-' + wsclass).attr("src", image_url);
				});
		});
		$('#upload-btn4').click(function(e) {
			var wsclass = $(this).attr('class');
			var wsclass = wsclass.split(' ')[0];
			e.preventDefault();
			var image = wp.media({
					title: 'Upload Image',
					multiple: false
				}).open()
				.on('select', function(e) {
					var uploaded_image = image.state().get('selection').first();
					console.log(uploaded_image);
					var image_url = uploaded_image.toJSON().url;
					$('#' + wsclass).val(image_url);
					$('#preview-' + wsclass).attr("src", image_url);
				});
		});
		$('#upload-logo').click(function(e) {
			var wsclass = $(this).attr('class');
			var wsclass = wsclass.split(' ')[0];
			e.preventDefault();
			var image = wp.media({
					title: 'Upload Image',
					multiple: false
				}).open()
				.on('select', function(e) {
					var uploaded_image = image.state().get('selection').first();
					console.log(uploaded_image);
					var image_url = uploaded_image.toJSON().url;
					$('#' + wsclass).val(image_url);
					$('#preview-' + wsclass).attr("src", image_url);
				});
		});
	});
</script>
<br/>
<!--Adsence Lazyload script-->
<script language="javascript">

document.write(unescape('%3C%68%32%3E%4D%61%64%65%20%77%69%74%68%20%6C%6F%76%65%20%62%79%20%3C%61%20%68%72%65%66%3D%22%68%74%74%70%73%3A%2F%2F%73%67%75%34%74%65%63%68%2E%62%6C%6F%67%73%70%6F%74%2E%63%6F%6D%22%3E%53%47%55%20%54%45%43%48%3C%2F%61%3E%3C%2F%68%32%3E'));

</script>