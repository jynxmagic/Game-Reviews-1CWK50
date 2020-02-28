var app = new Vue({
	el: '#app',
	data: {
		Comments: []
	},
	created(){
		let reviewID = window.location.href.split('/').pop();

		this.getComments(reviewID);
	},
	methods: {
		getComments: function (reviewID)
		{
			let self = this; //https://stackoverflow.com/questions/44869287/set-object-in-data-from-a-method-in-vue-js . can't set data using "this" inside ajax get. save "this" into "self" ;>)
			$.get($('#base_url_input').val()+'/review/comments/'+reviewID, function(data, status){
				if(status == 'success' || status == 200)
				{
					self.Comments = data;
				}
				else
				{
					self.Comments = "";
					alert("Vue didn't work :>(. maybe the application is running in a subfolder?");
				}
			});
		},

		postNewComment: function ()
		{
			let reviewID = window.location.href.split('/').pop();
			let comment = $('#commentInput').val();

			$.post($('#base_url_input').val()+'/review/comments/'+reviewID+'/postComment', {comment: comment}, function(){

			});

			//reload comment data
			this.getComments(reviewID);
		}
	}
});
