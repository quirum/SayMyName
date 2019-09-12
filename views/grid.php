<div id="toolbar-grid">
  <a href="?display=saymynamene&view=form" class="btn btn-default"><i class="fa fa-plus"></i>&nbsp;<?php echo _("Add Message")?></a>
</div>
<table data-url="ajax.php?module=saymynamene&amp;command=getJSON&amp;jdata=grid" data-cache="false" data-toggle="table" data-search="true" data-toolbar="#toolbar-grid" class="table" id="table-grid">
    <thead>
        <tr>
            <th data-sortable="true" data-field="name"><?php echo _('Name')?></th>
            <!-- <th data-sortable="true" data-field="text_IT" data-formatter="textFormatter"><?php echo _('Text IT')?></th>
            <th data-sortable="true" data-field="textnotfound_IT"  data-formatter="textFormatter"><?php echo _('Text not found IT')?></th>
            <th data-sortable="true" data-field="text_EN" data-formatter="textFormatter"><?php echo _('Text EN')?></th>
            <th data-sortable="true" data-field="textnotfound_EN"  data-formatter="textFormatter"><?php echo _('Text not found EN')?></th> -->
            <th data-sortable="true" data-field="engine"><?php echo _('Engine')?></th>
            <th data-sortable="true" data-field="id" data-formatter='actionFormatter'><?php echo _('Actions')?></th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
  function textFormatter(v){
    var html = v.substring(0,100);
    if(v.length > 100){
      html += '...'
    }
    return html;
  }
  function actionFormatter(value,row){
  	var html = '';
  	html += '<a href="?display=saymynamene&view=form&id='+value+'"><i class="fa fa-edit"></i></a>&nbsp;';
  	html += '<a href="?display=saymynamene&action=delete&id='+value+'" class="delAction"><i class="fa fa-trash"></i></a>';
  	return html;
  }
</script>
