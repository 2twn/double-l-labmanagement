
<script>
    $(function() {
        $(".jquery_date" ).datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
    });
	
	function add_document() {
 		doc_num = $("#DocsNum")[0].value;
 		sel_vals = $(".docs_select:checked");
 		for ($i=0;$i<sel_vals.length;$i++) {
	 		sel_docs = $("#doc_name_"+sel_vals[$i].value);
			$("#docs_tbl")[0].innerHTML = $("#docs_tbl")[0].innerHTML + "<tr id=\"tr_doc_"+doc_num+"\"><td>"
										+ "<a href='javascript:del_document(\"tr_doc_"+doc_num+"\")'>刪除</a> "
			                            + sel_docs[0].value
			                            + "<input type=\"hidden\" name=\"data[Training][docs_id][]\" value=\""+sel_vals[$i].value
										+ "\" id=\"TrainingDocsId\"/>"
										+ "</td></tr>"
			$("#DocsNum")[0].value = $("#DocsNum")[0].value++;
 		}
		$.unblockUI();						
	}

	function search_document(page_num) {
		doc_topic = $("#doc_topic")[0].value;
		post_url = '<?php echo $this->html->url(array('controller'=>'training', 'action' => 'document_search'))."/";?>'+page_num;
		$.ajax(
				{	
					url: post_url, 
					data:{ doc_topic: doc_topic }, 
					type: "post", 
					success: function(response){
						$("#select_doc_tbl")[0].innerHTML = response;
						a_obj = $("#select_page_doc > a");
                                                for (i = 0; i < a_obj.length; i++) { 
						    $(a_obj[i]).bind();
						}
					}
				}
			);
		return false;
//		$.unblockUI();						
	}

	function search_user(page_num) {
		user_pattern = $("#user_pattern")[0].value;
		post_url = '<?php echo $this->html->url(array('controller'=>'training', 'action' => 'user_search'))."/";?>'+page_num;
		$.ajax(
				{	
					url: post_url, 
					data:{ user_pattern: user_pattern }, 
					type: "post", 
					success: function(response){
						$("#select_user_tbl")[0].innerHTML = response;
						a_obj = $("#select_page_user > a");
                                                for (i = 0; i < a_obj.length; i++) { 
						    $(a_obj[i]).bind();
						}
					}
				}
			);
		return false;
//		$.unblockUI();						
	}
	
	function del_document(obj) {
		tr_id = "#"+obj;
		del_tr = $(tr_id);
		del_tr.remove();
	}

	function add_user() {
		user_num = $("#UsersNum")[0].value;
 		sel_vals = $(".users_select:checked");
 		for ($i=0;$i<sel_vals.length;$i++) {
	 		sel_users = $("#user_name_"+sel_vals[$i].value);
			$("#users_tbl")[0].innerHTML = $("#users_tbl")[0].innerHTML + "<tr id=\"tr_doc_"+user_num+"\"><td>"
										+ "<a href='javascript:del_user(\"tr_user_"+user_num+"\")'>刪除</a> "
			                            + sel_users[0].value
			                            + "<input type=\"hidden\" name=\"data[Training][user_id][]\" value=\""+sel_vals[$i].value
										+ "\" id=\"TrainingUsersId\"/>"
										+ "</td></tr>"
			$("#UsersNum")[0].value = $("#UsersNum")[0].value++;	
 		}
		$.unblockUI();						
	}
	
	function add_member() {
		user_num = $("#UsersNum")[0].value;
		sel_val = $("#TrainingUsers")[0].selectedIndex;
		$("#users_tbl")[0].innerHTML = $("#users_tbl")[0].innerHTML + "<tr id=\"tr_user_"+user_num+"\"><td>"
									+ "<a href='javascript:del_user(\"tr_user_"+user_num+"\")'>刪除</a> "
		                             + $("#TrainingUsers")[0][sel_val].text
									 + "<input type=\"hidden\" name=\"data[Training][user_id][]\" value=\""+$("#TrainingUsers")[0][sel_val].value
									 + "\" id=\"TrainingUsersId\"/>"
									 + "</td></tr>"	
		$("#UsersNum")[0].value = $("#UsersNum")[0].value++;							
	}

	function del_user(obj) {
		tr_id = "#"+obj;
		del_tr = $(tr_id);
		del_tr.remove();
	}

    function open_document() { 
        $.blockUI({ message: $('#document_list'),
            css: { 
                padding:        0, 
                margin:         0, 
                width:          '600px', 
                height:         '500px', 
                top:            '20px', 
                left:           '35%', 
                textAlign:      'center', 
                }  
             }); 
    }; 

    function open_user() { 
        $.blockUI({ message: $('#user_list'),
            css: { 
            padding:        0, 
            margin:         0, 
            width:          '600px', 
            height:         '500px', 
            top:            '20px', 
            left:           '35%', 
            textAlign:      'center', 
            }  
        }); 
    }; 

    function close_ui() {
    	$.unblockUI();	
    }
</script>
<div class="pageheader_div">
	<h1 id="pageheader">教育訓練維護</h1>
</div>
<div class="pagemenu_div"><?php
echo $this->Html->link ( '回教育訓練列表', array (
		'controller' => 'training',
		'action' => 'training_list' 
), array (
		'class' => 'button' 
) );
?></div>
<?php echo $this->Form->create('Training', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
<table>
	<tr>
		<td>
			文件編號：<?php echo $this->Html->link('選擇文件', 'javascript:open_document()',array('onclick'=>''));?>
			<table style="padding: 0px; margin: 0px" border=0 id="docs_tbl">
				<?php $doc_num =1; ?>
				<?php foreach($this->request->data["TrainingWDocument"] as $docs):?>
				<tr id="tr_doc_<?php echo $doc_num;?>">
					<td><a
						href='javascript:del_document("tr_doc_<?php echo $doc_num;?>")'>刪除</a>
						<?php echo $documents[$docs["training_document_id"]];?>
						<input type="hidden" id="TrainingDocsId"
						value="<?php echo $docs["training_document_id"];?>"
						name="data[Training][docs_id][]"></td>
				</tr>
				<?php $doc_num++ ;?>
				<?php endforeach; ?>
			</table> <input type="hidden" id="DocsNum"
			value="<?php echo $doc_num;?>">
		</td>
	</tr>
	<tr>
		<td>上課日期：<?php echo $this->Form->text('start_date', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date', 'readonly'=>true, 'size'=>8, 'style'=>'width:150px'));?></td>
	</tr>
	<tr>
		<td>開始時間：<?php echo $this->Form->text('b_start_time', array('size'=>8, 'style'=>'width:150px'));?>
			    結束時間：<?php echo $this->Form->text('b_end_time', array('size'=>8, 'style'=>'width:150px'));?></td>
	</tr>
	<tr>
		<td>會議室：<?php echo $this->Form->select('meeting_room_id', $meeting_rooms, array('empty'=>false));?></td>
	</tr>
	<tr>
		<td>
			上課人員：<?php echo $this->Html->link('選擇人員', 'javascript:open_user()',array('onclick'=>''));?>
			<table style="padding: 0px; margin: 0px" border=0 id="users_tbl">
				<?php $user_num =1; ?>
				<?php foreach($this->request->data["TrainingUser"] as $docs):?>
				<tr id="tr_user_<?php echo $user_num;?>">
					<td><a
						href='javascript:del_user("tr_user_<?php echo $user_num;?>")'>刪除</a>
						<?php echo $users[$docs["user_id"]];?>
						<input type="hidden" id="TrainingUsersId"
						value="<?php echo $docs["user_id"];?>"
						name="data[Training][user_id][]"></td>
				</tr>
				<?php $user_num++ ;?>
				<?php endforeach; ?>
			</table> <input type="hidden" id="UsersNum"
			value="<?php echo $user_num;?>">
		</td>
	</tr>
	<tr>
		<td>授課人員：<?php echo $this->Form->input('instructor', array('style'=>'width:150px'));?></td>
	</tr>
	<tr>
		<td>說明：(最多30個中文字)</td>
	</tr>
	<tr>
		<td><?php echo $this->Form->text('training_desc', array('style'=>'width:450px'));?></td>
	</tr>
	<tr>
		<td colspan=2>
				<?php echo $this->Form->hidden('id');?>
				<?php echo $this->Form->submit('儲存');?>
			</td>
	</tr>
</table>
<?php echo $this->Form->end(); ?>
<div id="document_list" style="display: none; cursor: default;height:400px"> 
	關鍵字：
	<?php echo $this->Form->text('doc_topic', array('size'=>8, 'style'=>'width:150px') );?>
    <?php echo $this->Html->link('搜尋', 'javascript:void(0);',array('onclick'=>'search_document(1);'));?>
    <div id="select_doc_tbl" style="overflow:auto"></div>
    <?php echo $this->Html->link('加入', 'javascript:void(0);',array('onclick'=>'add_document();'));?>
    <?php echo $this->Html->link('取消', 'javascript:void(0);',array('onclick'=>'close_ui();'));?>
    </div>
<div id="user_list" style="display: none; cursor: default;height:400px"> 
	關鍵字：
	<?php echo $this->Form->text('user_pattern', array('size'=>8, 'style'=>'width:150px') );?>
    <?php echo $this->Html->link('搜尋', 'javascript:void(0);',array('onclick'=>'search_user(1);'));?>
    <div id="select_user_tbl"></div>
    <?php echo $this->Html->link('加入', 'javascript:void(0);',array('onclick'=>'add_user();'));?>
    <?php echo $this->Html->link('取消', 'javascript:void(0);',array('onclick'=>'close_ui();'));?>
    </div>
