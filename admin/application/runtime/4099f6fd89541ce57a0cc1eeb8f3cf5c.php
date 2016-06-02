<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>

	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/min.css" />
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="http://localhost/nn2/admin/public/views/pc/css/H-ui.min.css">
</head>
<body>
<!DOCTYPE html>
<html>
 <head>
        <title>交易管理后台</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        
        <!-- jQuery AND jQueryUI -->
        <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.6/jquery.min.js"></script>
        <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>

        <link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/min.css" />
        <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/min.js"></script>
        <style type="text/css">
            html { overflow-y:hidden; }
        </style>
        
    </head>
    <body>
        
        <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/content/settings/main.js"></script>
<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/content/settings/style.css" />


        <div id="head">
            <div class="left">
                <a href="#" class="button profile"><img src="http://localhost/nn2/admin/public/views/pc/img/icons/top/huser.png" alt="" /></a>
                <?php echo isset($info['role'])?$info['role']:"";?>
                <a href="#"><?php echo isset($info['name'])?$info['name']:"";?></a>
                |
                <a href="http://localhost/nn2/admin/public/login/logout">退出</a>
            </div>
            <div class="right">
                <form action="#" id="search" class="search placeholder">
                    <label>查找</label>
                    <input type="text" value="" name="q" class="text"/>
                    <input type="submit" value="rechercher" class="submit"/>
                </form>
            </div>
        </div>
                
                
        <!--            
                SIDEBAR
                         --> 
        <div id="sidebar">
            <ul>
                <li>
                    <a href="#" no_access='no_access'>
                        <img src="http://localhost/nn2/admin/public/views/pc/img/icons/menu/inbox.png" alt="" />
                        耐耐网后台管理系统
                    </a>
                </li>
                <li class="current"><a target="content"><img src="http://localhost/nn2/admin/public/views/pc/img/icons/menu/layout.png" alt="" />系统管理</a>
                    <ul>
                        <li class="current"><a target="content">权限管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/public/system/rbac/roleList/" target="content">管理员分组</a></li>
                                <li><a href="http://localhost/nn2/admin/public/system/rbac/accessList/" target="content">权限分配</a></li>
                            </ul>
                        </li>
                        <li><a target="content">系统配置项</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/public/system/confsystem/creditList/" target="content">信誉值配置列表</a></li>
                                <li><a href="http://localhost/nn2/admin/public/system/confsystem/scaleOfferOper/" target="content">报盘费率设置</a></li>
                            </ul>
                        </li>
                        <li><a target="content">管理员信息</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/public/system/admin/adminAdd/" target="content">新增管理员</a></li>
                                <li><a href="http://localhost/nn2/admin/public/system/admin/adminList/" target="content">管理员列表</a></li>
                                <li><a href="http://localhost/nn2/admin/public/system/admin/logList/" target="content">管理员操作记录</a></li>
                            </ul>
                        </li>
                        <li><a href="system-base.html" target="content">系统设置</a></li>
                        <li><a href="table.html" target="content">导航栏目管理</a></li>
                        <li><a href="gallery.html" target="content">客服添加</a></li>
                    </ul>
                </li>
                <li><a target="content"><img src="http://localhost/nn2/admin/public/views/pc/img/icons/menu/brush.png" alt="" />会员管理</a>
                    <ul>
                        <li><a href="" target="content">会员认证</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/public/member/certmanage/dealercert" target="content">交易商认证</a></li>
                                <li><a href="http://localhost/nn2/admin/public/member/certmanage/storecert" target="content">仓库认证</a></li>
                            </ul>
                        </li>
                        <li><a href='' target="content">子账户权限管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/public/member/subrolelist" target="content">角色列表</a></li>
                                <li><a href="http://localhost/nn2/admin/public/member/roleadd" target="content">添加角色</a></li>
                            </ul>
                        </li>
                        <li><a href="http://localhost/nn2/admin/public/member/usergroup/grouplist" target="content">角色分组</a></li>
                        <li><a href="http://localhost/nn2/admin/public/member/member/memberlist" target="content">会员列表</a></li>
                        <li><a href='javascript:voie(0)' target="content">代理商管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/public/member/agent/agentlist" target="content">代理商列表</a></li>
                                <li><a href="http://localhost/nn2/admin/public/member/agent/addagent" target="content">代理商添加</a></li>
                            </ul>
                        </li>
                        <li><a href="shop-list.html" target="content">商铺管理</a></li>
                        <li><a href="business-list.html" target="content">业务撮合人员列表</a></li>
                    </ul>
                </li>
                <li><a target="content"><img src="http://localhost/nn2/admin/public/views/pc/img/icons/menu/brush.png" alt="" />交易管理</a>
                    <ul>
                        <li><a href="http://localhost/nn2/admin/public/trade/product/categoryadd" target="content">产品分类设置</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/public/trade/product/categoryadd" target="content">分类添加</a></li>
                                <li><a href="http://localhost/nn2/admin/public/trade/product/categorylist" target="content">分类列表</a></li>
                            </ul>
                        </li>
                        <li><a href="http://localhost/nn2/admin/public/trade/product/attributeadd" target="content">产品属性设置</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/public/trade/product/attributeadd" target="content">属性添加</a></li>
                                <li><a href="http://localhost/nn2/admin/public/trade/product/attributelist" target="content">属性列表</a></li>
                            </ul>
                        </li>
                        <li><a target="content">交易费率设置</a>
                            <ul>
                                <li><a href="scale-bond.html" target="content">保证金收取比例</a></li>
                                <li><a href="scale-hand.html" target="content">手续费收取比例</a></li>
                                <li><a href="scale-offer.html" target="content">自由报盘收费设置</a></li>
                            </ul>
                        </li>
                        <li><a target="content">报盘管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/public/trade/offermanage/offerList/" target="content">报盘管理</a></li>
                                <li><a href="http://localhost/nn2/admin/public/trade/offermanage/offerReview/" target="content">报盘审核</a></li>
                                <li><a href="#" target="content">历史报盘信息查询</a></li>
                                <li><a href="http://localhost/nn2/admin/public/trade/offermanage/offerRecycle/" target="content">报盘信息垃圾箱</a></li>
                            </ul>
                        </li>
                        <li><a target="content">合同管理</a>
                            <ul>
                                <li><a href="#" target="content">审核</a></li>
                                <li><a href="#" target="content">列表</a></li>
                                <li><a href="#" target="content">状态</a></li>
                            </ul>
                        </li>
                        <li><a href="appeal-list.html" target="content">申诉管理</a></li>
                    </ul>
                </li>
                <li><a target="content"><img src="http://localhost/nn2/admin/public/views/pc/img/icons/menu/lab.png" alt="" /> 结算管理</a>
                    <ul>
                        <li><a href="" target="content">入金审核</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/public/balance/fundin/onlinelist" target="content">线上入金</a></li>
                                <li><a href="http://localhost/nn2/admin/public/balance/fundin/offlinelist" target="content">线下入金</a></li>
                            </ul>
                        </li>
                        <li><a href="http://localhost/nn2/admin/public/balance/fundout/fundoutlist" target="content">出金审核</a></li>
                        <li><a target="content">账户管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/public/balance/accmanage/useracclist" target="content">会员账户</a></li>
                                <li><a href="account-market.html" target="content">市场账户</a></li>
                                <li><a href="account-agent.html" target="content">经纪人账户</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a target="content"><img src="http://localhost/nn2/admin/public/views/pc/img/icons/menu/lab.png" alt="" /> 信誉管理</a>
                    <ul>
                        <li><a target="content">算法设置</a>
                            <ul>
                                <li><a href="element-add.html" target="content">添加元素</a></li>
                                <li><a href="set-scale.html" target="content">设置比例</a></li>
                            </ul>
                        </li>
                        <li><a href="rank-list.html" target="content">等级管理</a></li>
                        <li><a href="honor-list.html" target="content">信誉排名</a></li>
                    </ul>
                </li>
                <li class="nosubmenu"><a href="modal.html" class="zoombox w450 h700" target="content"><img src="http://localhost/nn2/admin/public/views/pc/img/icons/menu/comment.png" alt="" /> 数据统计</a></li>
                <li class="nosubmenu"><a href="javascript:void(0)" class="zoombox w450 h700" target="content"><img src="http://localhost/nn2/admin/public/views/pc/img/icons/menu/comment.png" alt="" /> 仓库管理</a>
                    <ul>
                        <li><a href="" target="content">仓库管理</a>
                            <ul>
                                <li><a target="content" href="http://localhost/nn2/admin/public/store/store/storelist">仓库列表</a></li>
                                <li><a href="http://localhost/nn2/admin/public/store/store/storeadd" target="content">仓库添加</a></li>
                            </ul>
                        </li>
                        <li><a href="" target="content">仓单管理</a>
                            <ul>
                                <li><a target="content" href="http://localhost/nn2/admin/public/store/storeproduct/getlist">仓单列表</a></li>
                                <li><a href="http://localhost/nn2/admin/public/store/storeproduct/reviewlist" target="content">仓单审核</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>
            </ul>


        </div>
        <script type="text/javascript">
            $(function(){
                var menus = <?php echo isset($menus)?$menus:"";?>;
                if(menus != 'admin'){
                    $('ul a').each(function(){
                        var href = $(this).attr('href');
                        if($(this).attr('no_access') != 'no_access'){
                            var flag = 0;
                            if(href){
                                for(var i=0;i<menus.length;i++){
                                    var href = href.toLocaleLowerCase();
                                    if(href.indexOf(menus[i]) > 0){
                                        flag = 1;
                                    }
                                }
                            }else{
                                flag = 1;
                            }
                            if(flag == 0){
                                $(this).parent().remove();
                            }
                        }        
                    });
                    $("#sidebar>ul>li>ul>li>a").each(function(){
                        if($(this).siblings('ul').length == 0 || $(this).siblings('ul').children().length == 0){
                            if(!$(this).attr('href') || $(this).attr('href').length < 10){
                                $(this).parent().remove();
                            }
                        }
                    });
                    $("#sidebar>ul>li>ul>li>ul").each(function(){
                        if($(this).find('li').length == 0){
                            $(this).remove();
                        }
                    });
                    // $("#sidebar>ul>li>ul>li").each(function(){
                    //     if($(this).find('ul').length == 0){
                    //         $(this).remove();
                    //     }
                    // });
                    // 
                    
                    $("#sidebar>ul>li>ul").each(function(){
                        if($(this).find('li').length == 0){
                            $(this).remove();
                        }
                    });

                    $("#sidebar>ul>li:not(:first)").each(function(){
                        if($(this).find('ul').length == 0){
                            $(this).remove();
                        }
                    });

                    
                    // 
                    // 
                    


                }
            });    
        </script>
        
                
        <!--            
              CONTENT 
                        --> 
        <div class="main_content" id="content_1" >
            <iframe class="white" scrolling="yes" frameborder="0" src="http://localhost/nn2/admin/public/index/index/welcome/" name="content" marginheight="0" marginwidth="0" width="100%" height="600px"  id="iframe" style="overflow-y:scroll;"></iframe>

     </div>
</div>
        
    
    </body>
</html>
</body>
</html>