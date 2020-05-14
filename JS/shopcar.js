function allok(choiceBtn) {
	var arr = document.getElementsByName("choose[]");
	for (var i = 0; i < arr.length; i++) {
		arr[i].checked = choiceBtn.checked;//循环遍历看是否全选
	}
	var arr2 = document.getElementsByName("allchecked");
	for (var i = 0; i < arr2.length; i++) {
		arr2[i].checked = choiceBtn.checked;//循环遍历看是否全选
	}
}