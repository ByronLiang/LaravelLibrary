$(function(){
	$("#test").click(function(){

		$.get('/ajaxbook',function(data){
			console.log($("#test"));
			var str = "";
			var i = 0;
			for(i=0; i< data['data'].length; i++)
			{
				str = str + "<tr style='height: 70px;' class='data_content'><td>" 
				+ data['data'][i].name + "</td><td>" 
				+ data['data'][i].uploadtime +"</td><td>" 
				+ data['data'][i].type + "</td><td>" 
				+ data['data'][i].leave_number 
				+ "</td><td>" 
				+ "<button value= '" + data['data'][i].id + "," + data['data'][i].name 
				+ "' onclick='putbook(this.value)'>放进书单</button></td></tr>"
				
			}
			$(".data_content").remove();
			$("#book_content").append(str);
		});
	});

	$("#pagecoentent a").click(function(){
		$.get('/ajaxbook?page=' + this.getAttribute('data'), function(data){
			console.log($("#test"));
			var str = "";
			var i = 0;
			for(i=0; i< data['data'].length; i++)
			{
				str = str + "<tr style='height: 70px;' class='data_content'><td>" 
				+ data['data'][i].name + "</td><td>" 
				+ data['data'][i].uploadtime +"</td><td>" 
				+ data['data'][i].type + "</td><td>" 
				+ data['data'][i].leave_number 
				+ "</td><td>" 
				+ "<button value= '" + data['data'][i].id + "," + data['data'][i].name 
				+ "' onclick='putbook(this.value)'>放进书单</button></td></tr>"
				
			}
			$(".data_content").remove();
			$("#book_content").append(str);
		});
	});
});