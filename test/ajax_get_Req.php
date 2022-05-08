<?PHP
/*********************************************
 * FileName---: ajax_get_Req.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 20/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Document</title>
    </head>
    <body>
        <h1>Ajax sned get request</h1>
        <input type="button" name="btnAjax" id="btnAjax" value="Send get_ajax Request"/>
    </body>
</html>

<script type="text/javascript">
    // 绑定点击事件
    document.querySelector('#btnAjax').onclick = function () 
    {
        // 发送ajax 请求 需要 五步

        // （1）创建异步对象
        var ajaxObj = new XMLHttpRequest();

        // （2）设置请求的参数。包括：请求的方法、请求的url。
        ajaxObj.open('get', 'ajax_get_Rsp.php');

        // （3）发送请求
        ajaxObj.send();

        //（4）注册事件。 onreadystatechange事件，状态改变时就会调用。
        //如果要在数据完整请求回来的时候才调用，我们需要手动写一些判断的逻辑。
        ajaxObj.onreadystatechange = function () 
        {
            // 为了保证 数据 完整返回，我们一般会判断 两个值
            if (ajaxObj.readyState == 4 && ajaxObj.status == 200) 
            {
                // 如果能够进到这个判断 说明 数据 完美的回来了,并且请求的页面是存在的
                // 5.在注册的事件中 获取 返回的 内容 并修改页面的显示
                console.log('数据返回成功');

                // 数据是保存在 异步对象的 属性中
                console.log(ajaxObj.responseText);

                // 修改页面的显示
                document.querySelector('h1').innerHTML = ajaxObj.responseText;
            }
        }
    }
</script>
