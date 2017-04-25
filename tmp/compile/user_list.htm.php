<?php echo $this->fetch('head.htm'); ?>
<?php echo $this->fetch('nav.htm'); ?>

<div class="span11">
		  <div class="page-header">
            <h3><?php echo $this->_var['title']; ?></h3>
          </div>

			<form class="form-search" action="" method="post">
			<?php if ($_SESSION['roleid'] == "1"): ?>	
			<a href="?action=user&do=new" class="btn btn-primary pull-right"><i class="icon-pencil icon-white"></i> 新建</a>
			<?php else: ?>
		     
		    <?php endif; ?>		
			
			<input type="text" name="keywords" id="keywords" class="input-medium" value="<?php echo $_REQUEST['keywords']; ?>"  placeholder="关键字">
			<?php echo $this->_var['select_userlist']; ?>
				<a href="?action=user&keywords="onclick="this.href=this.href+document.getElementById('keywords').value" class="btn"><i class="icon-search"></i> 查询</a>
			<a href="?action=user" class="btn hidden-phone"><i class="icon-th-list"></i> 全部</a>
			</form> 
          <div class="row-fluid" id="usrinfo">
            <div class="span12">

				<table width="100%" class="table table-bordered table-striped">
					<thead>
					  <tr>
						<th width="32">工号</th>
						<th width="42">姓名</th>
						<th width="47">邮箱</th>
						<th width="90" class="hidden-phone">中文名</th>
						<th width="130">操作</th>
					  </tr>
					</thead>
					<tbody>
					 
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr>
					<td><?php echo $this->_var['row']['UserName']; ?></td>
					<td><?php echo $this->_var['row']['Name']; ?></td>
					<td><?php echo $this->_var['row']['MailAddress']; ?></td>
					<td><?php echo $this->_var['row']['ChineseName']; ?></td>
					<td>
<?php if ($_SESSION['roleid'] == "1"): ?>	
		<a class="btn btn-small" href="?action=user&do=edit&UserName=<?php echo $this->_var['row']['UserName']; ?>"><i class="icon-edit"></i> 编辑</a>
		<a class="btn btn-small" href="?action=user&do=del&UserName=<?php echo $this->_var['row']['UserName']; ?>" onclick="if(!confirm( '确认要删除吗? ')){return false;}"><i class="icon-trash"></i> 删除</a>
<?php else: ?>
无权限
<?php endif; ?>		
					</td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
 
					</tbody>
				  </table>
				  
				<div class="pagination pagination-centered">
					  <ul class="">
						<li><span class="btn">共<?php echo $this->_var['total']; ?>条</span></li>
						<?php echo $this->_var['page']; ?>
					 </ul>
				</div>
	  
            </div>
          </div>
		  
		  
        </div>

<?php echo $this->fetch('foot.htm'); ?>