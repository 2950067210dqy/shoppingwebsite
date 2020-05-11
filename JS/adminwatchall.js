function allok(choiceBtn) {
    var arr=document.getElementsByName("jiaquan[]");
    for(var i=0;i<arr.length;i++){
        arr[i].checked=choiceBtn.checked;//循环遍历看是否全选
    }
    var arr=document.getElementsByName("jiangquan[]");
    for(var i=0;i<arr.length;i++){
        arr[i].checked=choiceBtn.checked;//循环遍历看是否全选
    }
}

function alldelete(choiceBtn) {
    var arr=document.getElementsByName("delete[]");
    for(var i=0;i<arr.length;i++){
        arr[i].checked=choiceBtn.checked;//循环遍历看是否全选
    }
    var arr=document.getElementsByName("delete2[]");
    for(var i=0;i<arr.length;i++){
        arr[i].checked=choiceBtn.checked;//循环遍历看是否全选
    }
}