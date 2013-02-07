<table>
	<thead>
		<tr>
			<td>Image</td>
			<td>Note</td>
			<td>Submitted</td>
			<td>Approved</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($results as $result): ?>
		<?php
		$form = "<form data-ajax=\"approveComplete\" action=\"/admin/approve/$result->filename\" method=\"post\">";
		$form .= "<input type=\"submit\" value=\"Approve\" />";
		$form .= "</form>";
		?>
		<tr>
			<td><img class="small" src="/uploads/<?php echo $result->filename; ?>" /></td>
			<td><?php echo $result->note; ?></td>
			<td><?php echo $result->created; ?></td>
			<td><?php echo $result->approved ? '&#x2713;' : $form; ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php
if ($page-1 > 0) {
	echo '<a href="/admin/'.($page-1).'">Prev</a>';
}
$padding = 5;
$pages = range(max(1, $page - $padding), min($page + $padding, $maxpages));
$c = 0;
while ($c < count($pages)) {
	echo "<a href=\"/admin/$pages[$c]\">$pages[$c]</a>";
	$c++;
}
if ($page < $maxpages) {
	echo '<a href="/admin/'.($page+1).'">Next</a>';
}
?>
<script>
	function approveComplete(data, status, xhr) {
		if (data == '1') {
			$(this).parent('td').html('&#x2713;');
		}
	}
</script>