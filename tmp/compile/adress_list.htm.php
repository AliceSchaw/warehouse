<?php echo $this->fetch('head.htm'); ?>
<?php echo $this->fetch('nav.htm'); ?>

<div class="span11">

		  <div class="row-fluid">
            <h3><?php echo $this->_var['title']; ?></h3>
          </div>

			<form class="form-search" action="" method="post">
			<?php if ($_SESSION['roleid'] == "1"): ?>
				<a href="?action=address&do=new" class="btn btn-primary pull-right"><i class="icon-pencil icon-white"></i> 新建</a>
			<?php else: ?>
		     
		    <?php endif; ?>
				<select name="obj" class="input-medium" value="<?php echo $_REQUEST['obj']; ?>" >
					<option value="Category">Category</option>
					<option value="Status">Status</option>
					<option value="ProductName" selected="selected">ProductID</option>
					<option value="ProductName" selected="selected">ProductName</option>
					<option value="XorA">XorA</option>
				</select>
			<input type="text" name="keywords" class="input-medium" value="<?php echo $_REQUEST['keywords']; ?>"  placeholder="关键字">
			<?php echo $this->_var['select_userlist']; ?>	

			<button type="submit" class="btn"><i class="icon-search"></i> 查询</button>
            <a href="" class="btn hidden-phone"><i class="icon-th-list"></i> 全部</a>
			
			</form> 
          <div class="row-fluid">
            <div class="span12">

				<table class="table table-bordered table-striped">
					<thead>
					  <tr>
						<th>Type</th>
						<th class="hidden-phone">Category</th>
						<th class="hidden-phone">Vendor</th>
						  <th class="hidden-phone">ProductID</th>
						<th class="hidden-phone">ProductName</th>
						  <th class="hidden-phone">Status</th>
						  <th class="hidden-phone">UserName</th>
						    <th class="hidden-phone">XorA</th>


						<?php if ($_SESSION['roleid'] == "1"): ?>
						<th>操作</th>
						<?php else: ?>
						<th class="hidden-phone">操作</th>
					    <?php endif; ?>	
						</tr>	
					</thead>
					<tbody>
					 
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr>
					<td><?php echo $this->_var['row']['Type']; ?></td>
					<td class="hidden-phone"><?php echo $this->_var['row']['Category']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['row']['Vendor']) ? '无' : $this->_var['row']['Vendor']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['row']['ProductID']) ? '无' : $this->_var['row']['ProductID']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['row']['ProductName']) ? '无' : $this->_var['row']['ProductName']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['row']['Status']) ? '无' : $this->_var['row']['Status']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['row']['UserName']) ? '' : $this->_var['row']['UserName']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['row']['XorA']) ? '' : $this->_var['row']['XorA']; ?></td>





		<?php if ($_SESSION['roleid'] == "1"): ?>
		<td>
		<a class="btn btn-small" href="?action=address&do=edit&ProductID=<?php echo $this->_var['row']['ProductID']; ?>">
			<i class="icon-edit"></i>编辑</a>
		<a class="btn btn-small" href="?action=address&do=del&ProductID=<?php echo $this->_var['row']['ProductID']; ?>" onclick="if(!confirm( '确认要删除吗? ')){return false;}"><i class="icon-trash"></i>
		删除</a>
					</td><?php else: ?><td class="hidden-phone">无权限</td><?php endif; ?>
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