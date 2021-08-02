<?php



$fruit= array_rand($captcha);



echo 'Select the ' . $fruit. ' from the grid:<br>';
echo '<div class="captcha container">';
foreach ($captcha as $fruit => $filename) {
  echo '<div class="grid-item col-lg-3">
            <div>
                <img src="web-assets/images/captcha/'.$filename.'" data-filename="'.$filename.'"></img>
            </div>
        </div>';
}
echo "</div>";


?>
<input type="hidden" name="captcha" id="captcha" value="<?php echo $fruit; ?>">
<input type="hidden" name="answer" id="answer" value="">





