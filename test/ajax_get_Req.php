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
    // �󶨵���¼�
    document.querySelector('#btnAjax').onclick = function () 
    {
        // ����ajax ���� ��Ҫ �岽

        // ��1�������첽����
        var ajaxObj = new XMLHttpRequest();

        // ��2����������Ĳ���������������ķ����������url��
        ajaxObj.open('get', 'ajax_get_Rsp.php');

        // ��3����������
        ajaxObj.send();

        //��4��ע���¼��� onreadystatechange�¼���״̬�ı�ʱ�ͻ���á�
        //���Ҫ�������������������ʱ��ŵ��ã�������Ҫ�ֶ�дһЩ�жϵ��߼���
        ajaxObj.onreadystatechange = function () 
        {
            // Ϊ�˱�֤ ���� �������أ�����һ����ж� ����ֵ
            if (ajaxObj.readyState == 4 && ajaxObj.status == 200) 
            {
                // ����ܹ���������ж� ˵�� ���� �����Ļ�����,���������ҳ���Ǵ��ڵ�
                // 5.��ע����¼��� ��ȡ ���ص� ���� ���޸�ҳ�����ʾ
                console.log('���ݷ��سɹ�');

                // �����Ǳ����� �첽����� ������
                console.log(ajaxObj.responseText);

                // �޸�ҳ�����ʾ
                document.querySelector('h1').innerHTML = ajaxObj.responseText;
            }
        }
    }
</script>
