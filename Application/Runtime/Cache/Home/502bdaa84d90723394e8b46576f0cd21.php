<?php if (!defined('THINK_PATH')) exit();?><table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th><?php echo (L("country_code")); ?></th>
			<th><?php echo (L("country_charts")); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if(is_array($countrys)): $k = 0; $__LIST__ = $countrys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$country): $mod = ($k % 2 );++$k;?><tr>
				<th scope="row"><input type="checkbox" name="country" value="<?php echo ($k); ?>"></th>
				<td><img src="<?php echo (ROOT_URL); ?>Public/images/lang/<?php echo ($country["code"]); ?>.png">&nbsp;<?php echo ($country["code"]); ?></td>
				<td><button type="button" class="btn btn-default btn-sm" onclick="charts(<?php echo ($k); ?>);"><?php echo (L("manage")); ?></button></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody>
</table>
<div class="well">
	<button type="button" class="btn btn-success btn-block" data="country" onclick="library_add('country');"><?php echo (L("add")); ?></button>
</div>
<script type="text/javascript" src="<?php echo (ROOT_URL); ?>Public/js/country.js"></script>