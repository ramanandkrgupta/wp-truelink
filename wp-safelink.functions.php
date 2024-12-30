<?php
/*
	@package : themeson.com
	author : Themeson
	Don't touch baby!
*/

if ($_POST['newwpsafelink']) {
	$linktarget = json_decode(base64_decode($_POST['newwpsafelink']), true);
	$_GET['newsafelink'] = $linktarget;
}

function newwpsafelink_top()
{
	$code = $_GET['newsafelink'];
	if ($code) {
		$wpsaf = json_decode(get_settings('wpsaf_options'));

		$code['delaytext'] = str_replace('<span id=\"wpsafe-time\">', '<span id="wpsafe-time">', $code['delaytext']);
		$code['ads1'] = str_replace('\"', '"', $code['ads1']);
		?>
			<style>
				
.fa {
  margin-left: -12px;
  margin-right: 8px;
} 
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.buttons {
    text-align: center;
}

.btn-hover {
    
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
    text-align: center;
    height: 25px;
    text-align:center;
    border: none;
    height:30px;

    border-radius: 50px;
    moz-transition: all .4s ease-in-out;
    -o-transition: all .4s ease-in-out;
    -webkit-transition: all .4s ease-in-out;
    transition: all .4s ease-in-out;
}

.btn-hover:hover {
    background-position: 100% 0;
    moz-transition: all .4s ease-in-out;
    -o-transition: all .4s ease-in-out;
    -webkit-transition: all .4s ease-in-out;
    transition: all .4s ease-in-out;
}

.btn-hover:focus {
    outline: none;
}



.btn-hover.color-1 {
    background-image: linear-gradient(to right, #25aae1, #40e495, #30dd8a, #2bb673);
    box-shadow: 0 4px 15px 0 rgba(49, 196, 190, 0.75);
}
.btn-hover.color-2 {
    background-image: linear-gradient(to right, #f5ce62, #e43603, #fa7199, #e85a19);
    box-shadow: 0 4px 15px 0 rgba(229, 66, 10, 0.75);
}
.btn-hover.color-3 {
    background-image: linear-gradient(to right, #667eea, #764ba2, #6B8DD6, #8E37D7);
    box-shadow: 0 4px 15px 0 rgba(116, 79, 168, 0.75);
  height:40px!important;
}
.btn-hover.color-4 {
    background-image: linear-gradient(to right, #fc6076, #ff9a44, #ef9d43, #e75516);
    box-shadow: 0 4px 15px 0 rgba(252, 104, 110, 0.75);
  width: 190px;
}
.btn-hover.color-5 {
    background-image: linear-gradient(to right, #0ba360, #3cba92, #30dd8a, #2bb673);
    box-shadow: 0 4px 15px 0 rgba(23, 168, 108, 0.75);
  
}
.btn-hover.color-6 {
    background-image: linear-gradient(to right, #009245, #FCEE21, #00A8C5, #D9E021);
    box-shadow: 0 4px 15px 0 rgba(83, 176, 57, 0.75);
}
.btn-hover.color-7 {
    background-image: linear-gradient(to right, #6253e1, #852D91, #A3A1FF, #F24645);
    box-shadow: 0 4px 15px 0 rgba(126, 52, 161, 0.75);
}
.btn-hover.color-8 {
    background-image: linear-gradient(to right, #29323c, #485563, #2b5876, #4e4376);
    box-shadow: 0 4px 15px 0 rgba(45, 54, 65, 0.75);
}
.btn-hover.color-9 {
    background-image: linear-gradient(to right, #25aae1, #4481eb, #04befe, #3f86ed);
    box-shadow: 0 4px 15px 0 rgba(65, 132, 234, 0.75);
}
.btn-hover.color-10 {
        background-image: linear-gradient(to right, #ed6ea0, #ec8c69, #f7186a , #FBB03B);
    box-shadow: 0 4px 15px 0 rgba(236, 116, 149, 0.75);
}
.btn-hover.color-11 {
       background-image: linear-gradient(to right, #eb3941, #f15e64, #e14e53, #e2373f);  box-shadow: 0 5px 15px rgba(242, 97, 103, .4);
}				

				
				
				
				.wpsafe-top {
					clear: both;
					width: auto;
					text-align: center;
					margin-bottom: 20px;
				}

				.wpsafe-top img {
					display: block;
					margin: 0 auto;
				}

				.img-logo {
					max-height: 30px;
				}

				.navbar-brand {
					padding: 10px;
				}

				.wpsafe-bottom {
					clear: both;
					width: auto;
					text-align: center;
					margin-top: 0px;
				}

				#wpsafe-generate {
					display: none;
				}

				#wpsafe-wait2 {
					display: none;
				}

				#wpsafe-link {
					display: none;
				}

				.adb {
					display: none;
					position: fixed;
					width: 100%;
					height: 100%;
					left: 0;
					top: 0;
					bottom: 0;
					background: rgba(51, 51, 51, 0.9);
					z-index: 10000;
					text-align: centerx;
					color: #111;
				}

				.adbs {
					margin: 0 auto;
					width: auto;
					min-width: 400px;
					position: fixed;
					z-index: 99999;
					left: 50%;
					top: 50%;
					transform: translate(-50%, -50%);
					padding: 20px 30px 30px;
					background: rgba(255, 255, 255, 0.9);
					-webkit-border-radius: 12px;
					-moz-border-radius: 12px;
					border-radius: 12px;
				}

				#wpsafe-link img, #wpsafe-wait2 img {
					display: block;
					margin: 0 auto;
				}

				.safelink-recatpcha {
					text-align: center;
				}
				.g-recaptcha {
					display: inline-block;
				}
			</style>
			<div class="wpsafe-top text-center">
				<div><?php echo $code['ads1']; ?></div>
				<?php if($_POST['humanverification']) : ?>
					<?php
						if ($wpsaf->content == '0') {
							$args = array(
								'post_type' => 'post',
								'orderby'	=> 'rand',
								'posts_per_page' => 1,
							);
							$post_all = get_posts($args);
							$posts = $post_all[0];
						} else if ($wpsaf->content == '1') {
							$ID = explode(',', $wpsaf->contentid);
							shuffle($ID);
							foreach ($ID as $id) {
								$posts = get_post($id);
								break;
							}
						}
					?>
					<form id="wpsafelink-landing" name="dsb" action="<?php echo get_permalink($posts->ID) ?>" method="post">
						<input type="hidden" name="newwpsafelink" value="<?php echo $_POST['newwpsafelink'];?>">
						<?php if($wpsaf->recaptcha_enable == 1): ?>
							<script src="https://www.google.com/recaptcha/api.js" async defer></script>
							<div class="safelink-recatpcha">
								<div class="g-recaptcha" data-sitekey="<?php echo $wpsaf->recaptcha_site_key; ?>" data-callback="wpsafelink_recaptcha"></div>
							</div>

							<script type="text/javascript">
								window.RECAPTCHA_SAFELINK = 'recaptcha';
							</script>
						<?php endif; ?>
					<style="display: block; margin: 0px; font-family: Nunito;"><h4style="text-align:center;">You Are Currently On Step <span style="color:red">1/2</span></h4>
                              <div class="buttons"></div>
      <div><?php echo $code['ads1']; ?></div>
							  <!-- show 10 second countdown -->
							  <div id="wpsafe-wait2" style="display:block; border: 2px solid black; border-radius:50px">
      <b>Click on Image 👆 👇 and Wait for <span id="wpsafe-countdown2">10 </span> Seconds...</b>
							  </div>
							  
							  <center>
                                <button id="humanbutton" class="btn btn-primary btn-captcha" type="submit" style="display:none; align-items:center; border-radius:30px;"> Continue</button>
						<div><?php echo $code['ads2']; ?></div>
						<br/>
						<button style="display:none;" id="humanbutton" class="btn-hover ray">Verify Now</button>
								</center>
							  <!-- change wpsafe-countdown2 seconds in countdown -->
							  <script type="text/javascript">
								var wpsafe_countdown2 = 10;
								var wpsafe_countdown_interval2 = setInterval(function() {
								  wpsafe_countdown2--;
								  if(wpsafe_countdown2 < 0) {
									clearInterval(wpsafe_countdown_interval2);
									wpsafe_countdown2 = 10;
									document.getElementById('wpsafe-wait2').style.display = 'none';
									document.getElementById('humanbutton').style.display = 'block';
								  }
								  document.getElementById('wpsafe-countdown2').innerHTML = wpsafe_countdown2;
								}, 1000);
							  </script>	
								  </div>
						</a>
						</a>
					</form>
				<?php else: ?>
				<div id="wpsafe-wait1">
                               <h4 style="text-align:center;">You Are Currently On Step <span style="color:red">2/2</span></h4>
                              <div class="buttons"/>
<div><?php echo $code['ads1']; ?></div>
                                <button class="btn-hover color-5">Please Wait <span id="timer">20</span> Seconds...</button>
								  </div></div>
                  <br/><h5 style="text-align:center;">Click on ads 👇 👆 to skip <span style="color:red">Timer</span>.</h5>
                   <div><?php echo $code['ads2']; ?></div>           
                  <script>
  let timeLeft = 20;
  const timerDisplay = document.getElementById("timer");

  const countdown = setInterval(() => {
    timeLeft--;
    timerDisplay.textContent = timeLeft;

    if (timeLeft <= 0) {
      clearInterval(countdown);
    }
  }, 1000);
</script>
                  
                  
                  
		<div id="wpsafe-generate"> <style="display: block; margin: 0px; font-family: Nunito;"><h4 style="margin:0;font-family:Nunito;font-size: 22px">Scroll down &amp; click on <b><span style="color:blue;">Continue</span></b> button for your destination link</h4></a></div>
				<?php endif; ?>
	
			</div>

			<script type="text/javascript">
				document.addEventListener("DOMContentLoaded", function(event) { 
					document.getElementById('wpsafelinkhuman').style.display = "block";
				});

				function wpsafehuman() {
					<?php if($wpsaf->recaptcha_enable == 1): ?>
					if(window.RECAPTCHA_SAFELINK == 'recaptcha') {
						var response = grecaptcha.getResponse();
						if(response.length == 0) {
							alert("<?php echo !empty($wpsaf->recaptcha_text) ? $wpsaf->recaptcha_text : "Please complete reCAPTCHA verification"; ?>");
							return false;
						}
					}
					<?php endif; ?>
					document.getElementById('wpsafelink-landing').submit();
				}
			</script>
	<?php
	}
}

function newwpsafelink_bottom()
{
	$code = $_GET['newsafelink'];
	if ($code) {
		$code['ads2'] = str_replace('\"', '"', $code['ads2']);
?> <div class="wpsafe-bottom text-center" id="wpsafegenerate">
			<div id="wpsafe-wait2"><img src="<?php echo $code['image20']; ?>" />
		 <h4 style="text-align:center;">You Are Currently On Step <span style="color:red">2/4</span></h4>
            <button class="btn-hover color-1">
                <i class="fa fa-spinner fa-spin"></i>Please Wait
              </button>
		</div>
		
			<div id="wpsafe-link">
<?php
function decrypt_link($link)
{
$key ="iujfiniubjdofbhb7df98an6t5";
if (strpos($link, 'wApbsCadfEeFlgiHnik') !== false) {
$explode = explode('wApbsCadfEeFlgiHnik', $link);
$key = $explode[0];
$link = base64_decode($explode[1]);
$test = openssl_decrypt($link, "AES-256-ECB", $key);
}
return openssl_decrypt($link, "AES-256-ECB", $key);
} 
?>
			   <div><?php echo $code['ads1']; ?></div>
				<a onclick="window.open('<?php echo $code['linkr']; ?>', '_blank')" rel="nofollow" style="cursor:pointer">
					<img src="<?php echo $code['image30']; ?>" />
					
                <button class="btn-hover color-3">Continue</button>
				</a>
			</div>
			<div><?php echo $code['ads2']; ?></div>
			</div>
			<?php if ($code['adb'] == '1') : ?>
				<div class="adb" id="adb">
					<div class="adbs">
						<h3><?php echo $code['adb1']; ?></h3>
						<p><?php echo $code['adb2']; ?></p>
					</div>
				</div>
			<?php endif; ?>
			<script src="<?php echo WPSAF_URL; ?>/assets/fuckadblock.js"></script>
			<script type="text/javascript">
				<?php if ($code['adb'] == '1') : ?>

					function adBlockDetected() {
						document.getElementById("adb").setAttribute("style", "display:block");
					}

					function adBlockNotDetected() {}
					if (typeof fuckAdBlock === 'undefined') {
						adBlockDetected();
					} else {
						fuckAdBlock.setOption({
							debug: true
						});
						fuckAdBlock.onDetected(adBlockDetected).onNotDetected(adBlockNotDetected);
						var count = <?php echo $code['delay']; ?>;
					}
				<?php else : ?>
					var count = <?php echo $code['delay']; ?>;
				<?php endif; ?>

				<?php if(!$_POST['humanverification']) : ?>
				var counter = setInterval(timer, 2000);
				function timer() {
					count = count - 1;
					if (count <= 0) {
						document.getElementById('wpsafe-wait1').style.display = 'none';
						document.getElementById('wpsafe-generate').style.display = 'block';
						document.getElementById('wpsafegenerate').focus();
					document.getElementById('wpsafe-link').style.display = 'none';
					document.getElementById('wpsafe-wait2').style.display = 'block';
					var timer = setInterval(function() {
						document.getElementById('wpsafe-wait2').style.display = 'none';
					}, 2000);
					var timer = setInterval(function() {
						document.getElementById('wpsafe-link').style.display = 'block';
					}, 2000);
					
					
						
						clearInterval(counter);
						return;
						
						
					}
					document.getElementById("wpsafe-time").innerHTML = count;
				}

				function wpsafegenerate() {
					document.getElementById('wpsafegenerate').focus();
					document.getElementById('wpsafe-link').style.display = 'none';
					document.getElementById('wpsafe-wait2').style.display = 'block';
					var timer = setInterval(function() {
						document.getElementById('wpsafe-wait2').style.display = 'none';
					}, 5000);
					var timer = setInterval(function() {
						document.getElementById('wpsafe-link').style.display = 'block';
					}, 5000);
				}
				<?php endif; ?>
			</script>
		<?php
	}
}