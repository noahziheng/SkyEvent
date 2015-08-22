<?php if (!defined('THINK_PATH')) exit();?><div class="row" id="post">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo (L("list")); ?></h3>
			</div>
			<!-- Table -->
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo (L("post_title")); ?></th>
						<th><?php echo (L("post_type")); ?></th>
						<th><?php echo (L("event_status")); ?></th>
						<th><?php echo (L("event_author")); ?></th>
						<th><?php echo (L("action")); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($events)): $i = 0; $__LIST__ = $events;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$event): $mod = ($i % 2 );++$i;?><tr id="tr-<?php echo ($event["id"]); ?>">
							<th scope="row"><?php echo ($event["id"]); ?></th>
							<td><a id="title-<?php echo ($event["id"]); ?>" class="body-btn" data="Event/view/<?php echo ($event["id"]); ?>" style="cursor:pointer;"><?php echo ($event["title"]); ?></a></td>
							<td><span class="label label-info"><?php echo ($event['type']); ?></span></td>
							<td><?php echo ($event["status"]); ?></td>
							<td><?php echo ($event["author"]); ?></td>
							<td>
								<button type="button" class="btn btn-default btn-sm"><?php echo (L("admin_booking")); ?></button>
								<?php if($event["statusid"] != '1'): ?><a href="/Event/unpublish/<?php echo ($event["id"]); ?>" class="btn btn-warning btn-sm"><?php echo (L("admin_unpublish")); ?></a>
								<?php else: ?>
									<a href="/Event/publish/<?php echo ($event["id"]); ?>" class="btn btn-success btn-sm"><?php echo (L("admin_publish")); ?></a><?php endif; ?>
								<a href="#" class="btn btn-default btn-sm" onclick="editModal(<?php echo ($event["id"]); ?>);"><?php echo (L("admin_edit")); ?></a>
								<a href="#" class="btn btn-danger btn-sm"  onclick="confirm('<?php echo (L("admin_del")); ?>',<?php echo ($event["id"]); ?>,'del')"><?php echo (L("admin_del")); ?></a>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<script src="<?php echo (ROOT_URL); ?>Public/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo (ROOT_URL); ?>Public/js/ckeditor/adapters/jquery.js"></script>
<script src="<?php echo (ROOT_URL); ?>Public/js/eventadmin.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo (ROOT_URL); ?>Public/js/global.js" type="text/javascript" charset="utf-8"></script>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editModalLabel"><?php echo (L("admin_edit")); ?></h4>
      </div>
      <div class="modal-body" id="edit-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo (L("close")); ?></button>
        <button type="button" class="btn btn-primary" onclick="edit();"><?php echo (L("confirm")); ?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="confirmClose();" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="confirmModalLabel"><?php echo (L("confirm")); ?></h4>
      </div>
      <div class="modal-body" id="confirm-body">
        <?php echo (L("doconfirm")); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="confirmClose();"><?php echo (L("back")); ?></button>
        <button type="button" class="btn btn-primary" id="confirm-btn"><?php echo (L("confirm")); ?></button>
      </div>
    </div>
  </div>
</div>