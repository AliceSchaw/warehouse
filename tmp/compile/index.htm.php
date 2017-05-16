<?php echo $this->fetch('head.htm'); ?>
<?php echo $this->fetch('nav.htm'); ?>

<div class="span10">
    <?php if ($_SESSION['roleid'] != "1"): ?>

    <div class="span11">
        <div class="page-header">
            <h3><?php echo $this->_var['title']; ?></h3>

        </div>

        <form class="form-search"  action="" method="post">


            <select name="obj" class="input-medium" value="<?php echo $_REQUEST['obj']; ?>" >
                <option value="Category">Category</option>
                <option value="Status">Status</option>
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
                        <th class="hidden-phone">XorA</th>
                        <th class="hidden-phone">借出日期</th>
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
                        <td class="hidden-phone"><?php echo empty($this->_var['row']['XorA']) ? '无' : $this->_var['row']['XorA']; ?></td>
                        <td class="hidden-phone"><?php echo $this->_var['row']['LentOutDate']; ?></td>

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
    <?php else: ?>


    <h3>设备借还</h3>
    <div class="span11">

        <div align="center">
        <form class="form-search" action="?action=borrow&do=borrow" method="post" >
            <input type="text" name="IndexID" width="200" value="<?php echo $_POST['IndexID']; ?>"  placeholder="请输入工号/设备ID">
            <button type="submit" class="btn"><i class="icon-search"></i>提交</button>
        </form></div>
        <div class="row-fluid">
            <div class="span12">

                <table class="table table-bordered table-striped">
                    <thead>
                     <?php if ($_POST['IndexID'] != ""): ?>
                    <tr>

                        <th class="hidden-phone">ProductName</th>
                        <th class="hidden-phone">ProductID</th>
                        <th class="hidden-phone">Status</th>
                        <th class="hidden-phone">操作</th>

                    </tr>

                    </thead>
                    <tbody>
                   
                    <?php $_from = $this->_var['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list_0_11882600_1494904537');if (count($_from)):
    foreach ($_from AS $this->_var['list_0_11882600_1494904537']):
?>
                    <tr>
                        <td class="hidden-phone"><?php echo empty($this->_var['list_0_11882600_1494904537']['ProductName']) ? '无' : $this->_var['list_0_11882600_1494904537']['ProductName']; ?></td>
                        <td class="hidden-phone"><?php echo empty($this->_var['list_0_11882600_1494904537']['ProductID']) ? '无' : $this->_var['list_0_11882600_1494904537']['ProductID']; ?></td>
                        <td class="hidden-phone"><?php echo empty($this->_var['list_0_11882600_1494904537']['Status']) ? '无' : $this->_var['list_0_11882600_1494904537']['Status']; ?></td>
                        <td ><form method="post" action="?action=borrow&do=return" >
                            <button class="btn btn-success" type="submit" style="">归还</button>
                            <input type="text" name="BKid" value="<?php echo $this->_var['list_0_11882600_1494904537']['ProductID']; ?>" style="display:none;"/></form>
                        </td>



                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <?php endif; ?>
                    </tbody>

                </table>

            </div>
        </div>


    </div>
    <?php endif; ?>

</div>
<?php echo $this->fetch('foot.htm'); ?>