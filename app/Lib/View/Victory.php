<?php
if (isset($error)): ?>
<p class="error"><?php echo $error; ?></p>
<?php else: ?>
<img src="/uploads/<?php echo $result->filename; ?>" alt="Victory" />
<p>
	<?php echo $result->note; ?>
</p>
<?php endif; ?>
