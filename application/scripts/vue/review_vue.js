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
			$.get('/review/comments/'+reviewID, function(data, status){
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

		postNewComment: function (message, userID)
		{
			let reviewID = window.location.href.split('/').pop();


			getComments(reviewID);
		}
		//    Add your methods here.
	}
});
