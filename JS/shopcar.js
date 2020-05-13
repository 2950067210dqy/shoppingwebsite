function allok(choiceBtn) {
	var arr = document.getElementsByName("choose[]");
	for (var i = 0; i < arr.length; i++) {
		arr[i].checked = choiceBtn.checked;//循环遍历看是否全选
	}
	
}