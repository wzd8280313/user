<?php
use yii\helpers\Html;
use app\assets\CategoryAsset;
use yii\helpers\Url;
use yii\grid\GridView;
CategoryAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>K-Blog | 管理系统</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?= Html::csrfMetaTags(); ?>
    <?php $this->head(); ?>
</head>
    <body class="skin-blue">
        <?php  $this->beginBody(); ?>
    <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                K-Blog
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Kang <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">个人中心</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">退出</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?= ADMIN_IMG_URL ?>avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Kang</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
                        </div>
                    </div>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>博客</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="list.php"><i class="fa fa-table"></i>博客列表</a></li>
                                <li><a href="add.php"><i class="fa fa-edit"></i>写博客</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>分类</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="list.php"><i class="fa fa-table"></i>分类列表</a></li>
                                <li><a href="add.php"><i class="fa fa-edit"></i>添加</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>标签Tag</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="list.php"><i class="fa fa-table"></i>标签列表</a></li>
                                <li><a href="add.php"><i class="fa fa-edit"></i>增加标签</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                  <h1>
                      分类
                      <small>添加分类</small>
                  </h1>
                  <ol class="breadcrumb">
                      <li><a href="#"><i class="fa fa-dashboard"></i> 管理中心</a></li>
                      <li class=""><a href="#">分类</a></li>
                      <li class="active">分类添加</li>
                  </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="box">

                        <div class="box-header">
                            <h3 class="box-title">列表</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
<!--                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>标题</th>
                                    <th>排序</th>
                                    <th>说明</th>
                                    <th style="width: 15%">操作</th>
                                </tr>

                                <?php /*foreach($model as $k=>$value): */?>
                                    <tr>
                                        <td><?/*=$value->id; */?></td>
                                        <td><?/*=$value->title ;*/?></td>
                                        <td><?/*= $value->order_num; */?></td>
                                        <td><?/*= $value->intra;  */?></td>
                                        <td>
        <a href="{:U('Back/Category/edit', array('id'=>$row['id']))}" class="btn btn-default" title="编辑"><span class="fa fa-pencil"></span></a>

        <a href="{:U('Back/Category/delete', array('id'=>$row['id']))}" class="btn btn-default" title="删除"><span class="fa fa-trash-o"></span></a>
                                        </td>
                                    </tr>
                                <?php /*endforeach; */?>

                            </tbody></table>-->
                            <?php echo GridView::widget([
                                'dataProvider'=>$model,
                                //分类开始
                                'layout'=>'{items}<div class="text-right tooltip-demo">{pager}</div>',
                                'pager'=>[
                                    //'options'=>['class'=>'hidden'],//关闭分页
                                    'firstPageLabel'=>'First',
                                    'prevPageLabel'=>'Prev',
                                    'nextPageLabel'=>'Next',
                                    'lastPageLabel'=>'Last'
                                ],
                                //分页结束
                                'columns'=>[
                                    '序号'=>['class'=>'yii\grid\SerialColumn','header'=>"序号"],
                                    'id',
                                    'title',
                                    [

                                    ]
                                ],
                            ]); ?>
                        </div><!-- /.box-body -->
                        <!--<div class="box-footer clearfix">
                                <?php /*echo \yii\widgets\LinkPager::widget(['pagination'=>$pagination]); */?>
                        </div>-->

                    </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->



    <?php $this->endBody(); ?>
    </body>
</html>
<?php $this->endPage(); ?>