 function ajax(url, fnSucc, fnFailed) {
                // 1. 建立一個Ajax物件
                // IE6 不兼容 new XMLHttpRequest()
                if(window.XMLHttpRequest){
                var oAjax = new XMLHttpRequest();
                } else {
                // 只有在IE底下可以使用(包括IE6)
                var oAjax = new ActiveXObject("Microsoft.XMLHTTP");
                };
                // alert(oAjax);

                // 2.連接伺服器
                // open(連接方法, 檔名, 異步傳輸(多件事可以一起做))
                oAjax.open('POST', url, true);
                oAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                // 3.發送請求
                oAjax.send();

                // 4.接收返回
                oAjax.onreadystatechange =  function() {
                    if(oAjax.readyState == 4) {  // 讀取完成 不代表讀取成功 需再用status檢查
                        if(oAjax.status == 200) { // 成功
                            fnSucc(oAjax.responseText);
                        } else {
                            if(fnFailed) {
                                fnFailed(oAjax.status);
                            }
                            
                        }
                    }
                }
            }
  