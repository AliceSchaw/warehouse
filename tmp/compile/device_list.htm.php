<?php echo $this->fetch('head.htm'); ?>
<?php echo $this->fetch('nav.htm'); ?>

<div class="span11">

		  <div class="page-header">
            <h3><?php echo $this->_var['title']; ?></h3>
            <?php if ($_SESSION['roleid'] == "1"): ?>
			<form action="?action=import" method="post" class="form-search">
		    	<input type="file" name="fileUpload"/>
		    	<button type="submit" class="btn"><i class="icon-edit"></i>导入</button>
		    	<a href="?action=export" class="btn" pull-right><i class="icon-edit"></i>导出</a>
		    	<a href="?action=address&do=returnlate" class="btn btn-primary pull-right"><i class="icon-edit icon-white"></i> 超期 </a>
		    </form>
    		<?php else: ?>

			<?php endif; ?>
          </div>

	<form class="form-search" action="" method="post" >
		<?php if ($_SESSION['roleid'] == "1"): ?>
		<a href="?action=address&do=new" class="btn btn-primary pull-right"><i class="icon-pencil icon-th-list icon-white"></i> 新建</a>


		<?php else: ?>

		<?php endif; ?>

		<input type="text" name="keywords" id="keywords" class="input-medium" value="<?php echo $_REQUEST['keywords']; ?>"  placeholder="关键字" onkeypress="if(event.keyCode==13) {ToSearch.click();return false;}" autocomplete="off">

		<a href="?action=address&keywords="onclick="this.href=this.href+document.getElementById('keywords').value" class="btn" id="ToSearch"><i class="icon-search"></i> 查询</a>
		<a href="?action=address" class="btn hidden-phone"><i class="icon-th-list"></i> 全部</a>

	</form>
          <div class="row-fluid" id="adrinfo">
            <div class="span12">

				<table class="table table-bordered table-striped">
                    <form class="form-search" method="post" action="?action=address&do=select&keywords=<?php echo $_REQUEST['keywords']; ?>" name="form">
					<thead>

					  <tr>

						  <th width="85"><select name="Obj" id="select" class="input-small" value="Type" onchange="form.submit()" style="width: 85px" >
							<option value="" selected="selected">Type</option>

							<?php $_from = $this->_var['Objrow']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'Typelist');if (count($_from)):
    foreach ($_from AS $this->_var['Typelist']):
?>
							<option value="<?php echo $this->_var['Typelist']['Type']; ?>"><?php echo $this->_var['Typelist']['Type']; ?></option>

							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						  </select></th>
						  <th width="110"><select name="Obj2" id="select" class="input-medium" value="Category" onchange="form.submit()" style="width: 100px">
							<option value="" selected="selected">Category</option>

							<?php $_from = $this->_var['Objrow2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'Typelist');if (count($_from)):
    foreach ($_from AS $this->_var['Typelist']):
?>
							<option value="<?php echo $this->_var['Typelist']['Category']; ?>"><?php echo $this->_var['Typelist']['Category']; ?></option>

							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						  </select></th>
					   <!--  <th class="hidden-phone">Interface</th> -->
						<th class="hidden-phone">Vendor</th>
						<th class="hidden-phone">ProductID</th>
						<th class="hidden-phone" width="100">Product Description</th>
						<th class="hidden-phone">Status</th>
						<th class="hidden-phone" width="95">借用人</th>
						<th class="hidden-phone" width="80">借出时间</th>
						<th class="hidden-phone">P_Date</th>
						<?php if ($_SESSION['roleid'] == "1"): ?>
						<th width="120">操作</th>
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
					<td class="hidden-phone"><?php echo empty($this->_var['list']['Vendor']) ? '' : $this->_var['list']['Vendor']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['list']['ProductID']) ? '' : $this->_var['list']['ProductID']; ?></td>
					<td class="hi5den-phone">
						<?php if ($this->_var['list']['REV'] != ""): ?>
						<?php echo empty($this->_var['list']['REV']) ? '' : $this->_var['list']['REV']; ?>&nbsp;
						<?php endif; ?>
						<?php echo empty($this->_var['list']['ProductName']) ? '' : $this->_var['list']['ProductName']; ?>&nbsp;
						<?php echo empty($this->_var['list']['DP/N']) ? '' : $this->_var['list']['DP/N']; ?>&nbsp;
						<?php echo empty($this->_var['list']['ModelNum']) ? '' : $this->_var['list']['ModelNum']; ?>&nbsp;
						<?php echo empty($this->_var['list']['FW']) ? '' : $this->_var['list']['FW']; ?>
					</td>
					<td class="hidden-phone"><?php echo empty($this->_var['list']['Status']) ? '' : $this->_var['list']['Status']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['user_list'][$this->_var['list']['UserName']]) ? '' : $this->_var['user_list'][$this->_var['list']['UserName']]; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['list']['LentOutDate']) ? '' : $this->_var['list']['LentOutDate']; ?></td>
					<td class="hidden-phone"><?php echo empty($this->_var['list']['P_Date']) ? '' : $this->_var['list']['P_Date']; ?></td>
					<?php if ($_SESSION['roleid'] == "1"): ?>
					<td>

						<a class="btn btn-small" href="?action=address&do=edit&ProductID=<?php echo $this->_var['list']['ProductID']; ?>">
							<i class="icon-edit"></i>编辑</a>
						<a class="btn btn-small" href="?action=address&do=del&ProductID=<?php echo $this->_var['list']['ProductID']; ?>" onclick="if(!confirm( '确认要删除吗? ')){return false;}"><i class="icon-trash"></i>删除</a>
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