<link href="{views:css/user_index.css}" rel="stylesheet" type="text/css" />
  <link href="{views:css/font-awesome.min.css}" rel="stylesheet" type="text/css" />
  <link href="{views:css/pay_ment.css}" rel="stylesheet" type="text/css" /> 

   <!-- 头部控制 -->
  <link href="../css/topnav20141027.css" rel="stylesheet" type="text/css">
            <!--start中间内容-->    
            <div class="user_c_list no_bor">
                <div class="user_zhxi">


                    
                   <div class="checkim">
                       <h2>核对买家下单信息</h2>

                       <table class="detail_tab" border="1" cellpadding="0" cellspacing="0" width="100%">
                                  <tbody><tr class="detail_title">
                                    <td colspan="10"><strong>订单详情</strong></td>
                                  </tr>
                                  <tr style="line-height: 30px;">
                                    <td style="background-color: #F7F7F7;" width="100px">订单号</td>
                                    <td colspan="3" width="230px">{$data['order_no']}</td>
                                    <td style="background-color: #F7F7F7;" width="100px">订单日期</td>
                                    <td colspan="5" width="230px">{$data['create_time']}</td>
                                  </tr>
                                  <tr>
                                    <td style="background-color: #F7F7F7; padding-top: 5px;" valign="top" width="100px">商品信息</td>
                                    <td colspan="10" style="padding-left: 0px;">
                                        <table style="line-height: 30px;" border="0" cellpadding="0" cellspacing="0" width="100%">
                                          <tbody><tr style="border-bottom:1px dashed #BFBFBF;">
                                            <td width="240px">品名</td>
                                            <!-- <td width="130px">生产厂家</td> -->
                                            <td width="120px">仓库</td>
                                            <td width="100px">单价</td>
                                            <td width="100px">数量</td>
                                            <td width="100px">重量</td>
                                            <td width="100px">小计</td>
                                            <td width="100px">手续费</td>
                                          </tr>

                                          
                                          <tr>
                                            <td>{$data['name']}</td>
                                         <!--   <td></td> --> 
                                            <td>多方位仓库</td>
                                            <td>
                                                    <label class="" id="d_price_1">
                                                        {$data['price']} 
                                                    </label> 元/{$data['unit']}
                                            </td>
                                            <td>
                                            --
                                        </td>
                                            <td>{$data['num']}
                                            {$data['unit']}</td>
                                            <td><label class="">
                                        
                                            <label class="price02">￥</label>
                                            <label class="" id="d_sum_money_1">
                                                {$data['amount']}
                                            </label>
                                        
                                        
                                        </label></td>
                                        <td><label class="">
                                        
                                            <label class="price02">￥</label>
                                            <label class="" id="d_sum_comm_1">
                                                0.00
                                            </label>
                                        </label></td>
                                          </tr>  
                                           
                                        </tbody></table>
                                </td>
                              </tr>
                              <tr style="line-height: 35px;">
                                <td style="background-color: #F7F7F7;" width="100px">合同</td>
                                <td colspan="3" width="" style="color: #c81624;">已支付定金，等耐卖家缴纳保证金</td>
                                <td style="background-color: #F7F7F7;" width="100px">合同金额</td>
                                <td colspan="1" width="">
                                        <span class="orange price02" style="font-size:18px; text-decoration: none; list-style: none;">￥</span>
                                        <span class="orange" style="font-size:18px; text-decoration: none; list-style: none;" id="b_o_q">
                                            {$data['amount']}
                                        </span>   
                                </td>
                                 <td style="background-color: #F7F7F7;" width="100px">保证金比例</td>
                                <td colspan="1" width="">
                                        <span class="orange price02" style="font-size:18px; text-decoration: none; list-style: none;"></span>
                                        <span class="orange" style="font-size:18px; text-decoration: none; list-style: none;" id="b_o_q">
                                            {$data['seller_percent']}%
                                        </span>   
                                </td>

                                <td style="background-color: #F7F7F7;" width="100px">需缴纳保证金</td>
                                <td colspan="1" width="">
                                        <span class="orange price02" style="font-size:18px; text-decoration: none; list-style: none;">￥</span>
                                        <span class="orange" style="font-size:18px; text-decoration: none; list-style: none;" id="b_o_q">
                                            {$data['seller_deposit']}
                                        </span>   
                                </td>
                              </tr>
                            </tbody></table>

                          <div class="pay_type">
                              <h3 class="add_zhifu">支付方式：</h3>
                              <h3 class="addwidth">
                                <div class="yListr" id="yListr">
                                  
                                      <ul>
                                          <li><em name="chooice" class="yListrclickem">市场代理账户<i></i></em> <em name="chooice">银行签约账户<i></i></em> <em name="chooice">票据账户<i></i></em> </li>
                                      </ul>
                              </div> 

                        <script type="text/javascript">
                            $(function() {
                                $(".yListr ul li em").click(function() {
                                    $(this).addClass("yListrclickem").siblings().removeClass("yListrclickem");
                                })
                            });
                        </script>
                       
                   <div id="bain_bo">
                   <form action="" method="post">
                   <!-- <div class="sty_online" style="display:block;">
                        
                           <label for=""><input name="abc" type="radio" value="" />余额支付</label>
                            <label for=""><input name="abc" type="radio" value="" />支付宝</label>
                             <label for=""><input name="abc" type="radio" value="" />银联在线</label>

                   </div>
                   <div class="sty_offline">
                        <ul>
                            <li>账户名称：XX科技有限公司</li>
                            <li>开户银行：XX银行XXXX支行</li>
                            <li>银行账号：100004454415113</li>
                            <li>请您将贷款转到此账户，我们将为您审核，联系卖家发货！</li>
                            <li><span>上传凭证：</span>
                            <div id="preview"></div>
    
                            <input class="uplod" type="file" onchange="previewImage(this)" />


                            </li>
                        </ul>
                      
                    
                    </div> -->
                   </form> 
                  </div>  
                            
                       </h3> 
                         </div>


                  <div class="pay_bton">
                    <h5>待支付金额：<i>{$data['seller_deposit']}</i>元</h5>
                    <a href="{url:/Deposit/sellerDeposit?order_id=$data['id']&pay=1}">立即缴纳保证金</a>
                  </div>


                           </div>


               

                </div>              
                
            </div>
            <!--end中间内容-->  
                    