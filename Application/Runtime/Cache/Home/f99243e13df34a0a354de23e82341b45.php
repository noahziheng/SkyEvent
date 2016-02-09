<?php if (!defined('THINK_PATH')) exit(); var_dump($datas); var_dump($divisions); ?>
<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th><?php echo (L("division_code")); ?></th>
			<th><?php echo (L("division_name")); ?></th>
			<th><?php echo (L("division_logo")); ?></th>
			<th><?php echo (L("division_remark")); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if(is_array($datas)): $i = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$d): $mod = ($i % 2 );++$i;?><tr>
				<th scope="row"><input type="checkbox" name="division" value="<?php echo ($k); ?>"></th>
				<td><?php echo ($d["code"]); ?></td>
				<td><?php echo ($d["name"]); ?></td>
				<td><img src="<?php echo ($d["logo"]); ?>" class="img-responsive" /></td>
				<td><?php echo ($d["remark"]); ?></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody>
</table>
<div class="well">
	<button type="button" class="btn btn-success btn-block" data="division" onclick="library_add('division');"><?php echo (L("add")); ?></button>
</div>
<script type="text/javascript" src="<?php echo (ROOT_URL); ?>Public/js/division.js"></script>