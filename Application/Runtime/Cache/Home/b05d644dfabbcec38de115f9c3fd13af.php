<?php if (!defined('THINK_PATH')) exit();?><form class="form-horizontal" id="form-airport" action="<?php echo (ROOT_URL); ?>Admin/airportedit" method="POST">
	<input type="hidden" name="id" value="<?php echo ($airport["id"]); ?>">
	<div class="form-group">
		<label class="col-sm-4 control-label"><?php echo (L("airport_code")); ?></label>
		<div class="col-sm-8">
			<?php echo ($airport["code"]); ?><input type="hidden" name="code" value="<?php echo ($airport["code"]); ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="namecn" class="col-sm-3 control-label"><?php echo (L("airport_name_cn")); ?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control input-sm" name="namecn" placeholder="<?php echo (L("airport_name_cn")); ?>" value="<?php echo ($airport["name"]["zh-cn"]); ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="nameen" class="col-sm-3 control-label"><?php echo (L("airport_name_en")); ?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control input-sm" name="nameen" placeholder="<?php echo (L("airport_name_en")); ?>" value="<?php echo ($airport["name"]["en-us"]); ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="remarkcn" class="col-sm-3 control-label"><?php echo (L("airport_remark_cn")); ?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control input-sm" name="remarkcn" placeholder="<?php echo (L("airport_remark_cn")); ?>" value="<?php echo ($airport["remark"]["zh-cn"]); ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="remarken" class="col-sm-3 control-label"><?php echo (L("airport_remark_en")); ?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control input-sm" name="remarken" placeholder="<?php echo (L("airport_remark_en")); ?>" value="<?php echo ($airport["remark"]["en-us"]); ?>">
		</div>
	</div>
</form>
<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th><?php echo (L("scenery_name")); ?></th>
			<th><?php echo (L("scenery_href_cn")); ?></th>
			<th><?php echo (L("scenery_href_en")); ?></th>
			<th><?php echo (L("manage")); ?></th>
		</tr>
	</thead>
	<tbody id="tbody-scenery">
		<?php if(is_array($scenerys)): $i = 0; $__LIST__ = $scenerys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$scenery): $mod = ($i % 2 );++$i;?><tr>
				<th scope="row"><?php echo ($scenery["id"]); ?></th>
				<td><?php echo ($scenery["name"]); ?></td>
				<td><?php echo ($scenery["href"]["zh-cn"]); ?></td>
				<td><?php echo ($scenery["href"]["en-us"]); ?></td>
				<td><button type="button" class="btn btn-danger btn-sm" onclick="scenerydel(<?php echo ($scenery["id"]); ?>,this);"><?php echo (L("admin_del")); ?></button></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody>
</table>
<div class="well">
	<form class="form-inline">
		<div class="form-group">
			<input type="text" class="form-control input-sm" id="scenery-name" placeholder="<?php echo (L("scenery_name")); ?>">
		</div>
		<div class="form-group">
			<input type="text" class="form-control input-sm" id="scenery-hrefcn" placeholder="<?php echo (L("scenery_href_cn")); ?>">
		</div>
		<div class="form-group">
			<input type="text" class="form-control input-sm" id="scenery-hrefen" placeholder="<?php echo (L("scenery_href_en")); ?>">
		</div>
		<button type="button" class="btn btn-default" onclick="sceneryadd(<?php echo ($airport["id"]); ?>);"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo (L("add")); ?></button>
	</form>
</div>
<script type="text/javascript">
	function sceneryadd (id) {
		var name = $("#scenery-name").val();
		var hrefcn = $("#scenery-hrefcn").val();
		var hrefen = $("#scenery-hrefen").val();
		$.post(p_rooturl+'Admin/scenery/'+id,{ name : name , hrefcn : hrefcn , hrefen : hrefen },function(data,status){
			if (status != 'success') {
				alert(data);
			}else{
				if (data == '1') {
					alert('Error Code 1!');
				}else if (data == '0'){
					$("#tbody-scenery").append('<tr><th scope="row"></th><td>'+name+'</td><td>'+hrefcn+'</td><td>'+hrefen+'</td><td><button type="button" class="btn btn-danger btn-sm" onclick="alert(\'Please refresh to delete!\');"><?php echo (L("admin_del")); ?></button></td></tr>');
				}else{
					alert('Error Code 0 !');
				};
			};
		});
	}
</script>