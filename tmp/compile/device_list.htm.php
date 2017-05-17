<?php echo $this->fetch('head.htm'); ?>
<?php echo $this->fetch('nav.htm'); ?>

<div class="span11">

		  <div class="page-header">
            <h3><?php echo $this->_var['title']; ?></h3>
          </div>

	<form class="form-search" action="" method="post" >
		<?php if ($_SESSION['roleid'] == "1"): ?>
		<a href="?action=address&do=new" class="btn btn-primary pull-right"><i class="icon-pencil icon-white"></i> 新建</a>
		<?php else: ?>

		<?php endif; ?>

		<input type="text" name="keywords" id="keywords" class="input-medium" value="<?php echo $_REQUEST['keywords']; ?>"  placeholder="关键字">

		<a href="?action=address&keywords="onclick="this.href=this.href+document.getElementById('keywords').value" class="btn"><i class="icon-search"></i> 查询</a>
		<a href="?action=address" class="btn hidden-phone"><i class="icon-th-list"></i> 全部</a>

	</form>
          <div class="row-fluid" id="adrinfo">
            <div class="span12">

				<table class="table table-bordered table-striped">
                    <form class="form-search" method="post" action="?action=address&do=select&keywords=<?php echo $_REQUEST['keywords']; ?>" name="form">
					<thead>

					  <tr>

						  <th class="hidden-phone"><select name="Obj" id="select" class="input-small" value="Type" onchange="form.submit()">
							<option value="" selected="selected">Type</option>

							<?php $_from = $this->_var['Objrow']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'Typelist');if (count($_from)):
    foreach ($_from AS $this->_var['Typelist']):
?>
							<option value="<?php echo $this->_var['Typelist']['Type']; ?>"><?php echo $this->_var['Typelist']['Type']; ?></option>

							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						  </select></th>
						  <th class="hidden-phone"><select name="Obj2" id="select" class="input-medium" value="Category" onchange="form.submit()">
							<option value="" selected="selected">Category</option>

							<?php $_from = $this->_var['Objrow2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'Typelist');if (count($_from)):
    foreach ($_from AS $this->_var['Typelist']):
?>
							<option value="<?php echo $this->_var['Typelist']['Category']; ?>"><?php echo $this->_var['Typelist']['Category']; ?></option>

							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						  </select></th>
						<th class="hidden-phone">Vendor</th>
						  <th class="hidden-phone">ProductID</th>
						<th class="hidden-phone">ProductName</th>
						  <th class="hidden-phone">Status</th>
						  <th class="hidden-phone">Borrower</th>
						    <th class="hidden-phone">REV</th>


						<?php if ($_SESSION['roleid'] == "1"): ?>
						<th width="130pix">操作</th>
						<?php else: ?>
						<th class="hidden-phone">操作</th>
					    <?php endif; ?>	
						</tr>	
					</thead></form>
					<tbody>

				<?php $_from = $this->_var['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
				<tr>
					<td><?php echo $this->_var['list']['Type']; ?></td>
					<td class="hidden-phone"><?php echo $this->_var['list']['Category']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['list']['Vendor']) ? '无' : $this->_var['list']['Vendor']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['list']['ProductID']) ? '无' : $this->_var['list']['ProductID']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['list']['ProductName']) ? '无' : $this->_var['list']['ProductName']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['list']['Status']) ? '无' : $this->_var['list']['Status']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['list']['UserName']) ? '' : $this->_var['list']['UserName']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['list']['REV']) ? '' : $this->_var['list']['REV']; ?></td>





					<?php if ($_SESSION['roleid'] == "1"): ?>
					<td>
					<a class="btn btn-small" href="?action=address&do=edit&ProductID=<?php echo $this->_var['list']['ProductID']; ?>">
						<i class="icon-edit"></i>编辑</a>
					<a class="btn btn-small" href="?action=address&do=del&ProductID=<?php echo $this->_var['list']['ProductID']; ?>" onclick="if(!confirm( '确认要删除吗? ')){return false;}"><i class="icon-trash"></i>
					删除</a>
						</td><?php else: ?><td class="hidden-phone">无权限</td><?php endif; ?>
				</tr>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
 
					</tbody>
				  </table>
				  
				<div class="pagination pagination-centered">
					  <ul class="">

						<li><span class="btn">共<?php echo $this->_var['total']; ?>条 </span></li>

						  <?php echo $this->_var['page']; ?>

					  </ul>
				</div>

            </div>
          </div>
		  
		  
        </div>

<?php echo $this->fetch('foot.htm'); ?>