<table border="0"  id='productAdd'>
    {foreach: items=$attrs item=$attr}

        <tr class="attr">
            <td nowrap="nowrap"><span></span>{$attr['name']}：</td>
            <td colspan="2">
                <input class="text" type="text" name="attribute[{$attr['id']}]" >
            </td>
        </tr>


    {/foreach}
    <tr>
        <th colspan="3">基本挂牌信息</th>
    </tr>
    <tr>
        <td nowrap="nowrap"><span></span>商品标题：</td>
        <td colspan="2">
            <span><input class="text" type="text" datatype="s1-30" errormsg="填写商品标题" name="warename"></span>
            <span></span>
        </td>

    </tr>
    <tr>
        <td nowrap="nowrap"><span></span>商品单价:</td>
        <td>
            <span> <input class="text" type="text" datatype="float" errormsg="填写正确填写单价" name="price"></span>
            <span></span>
        </td>
        <!--                                 <td>
            请选择付款方式：
            <input type ="radio" name ="safe" checked="checked" style="width:auto;height:auto;"> 线上
            <input type ="radio" name ="safe" style="width:auto;height:auto;"> 线下
        </td> -->
    </tr>
    <tr>
        <td nowrap="nowrap"><span></span>数量:</td>
        <td>
            <span><input class="text" type="text" datatype="float" errormsg="填写正确填写数量" name="quantity"></span>
            <span></span>
        </td>
        <span></span>
        <!--  <td>
            请选择支付保证金比例：
            <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">

        </td> -->

    <tr>
        <td>产地:</td>
        <td colspan="2">
            <span>{area:data=getAreaData()}</span>
            <span></span>
        </td>

    </tr>



    <tr>
        <td>图片预览：</td>
        <td colspan="2">
                                    <span class="zhs_img" id='imgContainer'>

                                    </span>
        </td>
    </tr>
    <tr>
        <td>上传图片：</td>
        <td>
                                    <span>
                                        <div>

                                            <input id="pickfiles"  type="button" value="选择文件">
                                            <input type="button"  id='uploadfiles' class="tj" value="上传">
                                        </div>
                                        <div id="filelist"></div>
                                        <pre id="console"></pre>
                                    </span>
        </td>
    </tr>
    <tr>
        <th colspan="3"><b>详细信息</b></th>
    </tr>

    </tr>
    <tr>
        <td><span>*</span>是否可拆分：</td>
        <td>
            <select name="divide" id="divide">
                <option value="0" selected >可以</option>
                <option value="1" selected >不可以</option>
            </select>
        </td>
    </tr>
    <tr id='nowrap' style="display: none">
        <td nowrap="nowrap" ><span>*</span>最小起订量：</td>
        <td>
            <input name="minimum" id="" type="text" class="text"  />
        </td>
        <td>
            <span>*</span>
            最小起订量即为最小起增量，最小设为1，不填写规则为不可拆分
        </td>
    </tr>
    <tr>
        <td>交收地点：</td>
        <td colspan="2">
            <span><input type="text" class='text' datatype="s1-30" errormsg="填写商品标题" name="accept_area"></span>
            <span></span>
        </td>
    </tr>
    <td>交收时间：</td>
    <td colspan="2">
        <span><input type="text" class='text' name="accept_day"></span>
        <span></span>
    </td>
    </tr>

    <tr>
        <!--  <td>是否投保：</td>
         <td colspan="2">
<input type ="radio" name ="safe" checked="checked" style="width:auto;height:auto;">投保
<input type ="radio" name ="safe" style="width:auto;height:auto;"> 不投保
         </td>
     </tr>  -->
    <tr>
        <td>产品描述：</td>
        <td colspan="2">
            <textarea name="note"></textarea>
        </td>
    </tr>
