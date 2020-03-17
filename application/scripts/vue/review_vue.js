/***
 * View file loaded on the review page. It's main function is to dynamically load review comments as they are added. A review button can be clicked. The page does not need reloading
 * to view new comments.
 *
 * @type {Vue}
 */
var app = new Vue({
	el: '#app', //div to target
	reviewID: "",
	data: {
		Comments: [] //initial comment data block to reserve the data type in memory
	},
	created(){

		//after view is initialized, do this

		this.reviewID = $('#review_id').val(); //in a hidden input, from codeigniter, we have stored the review id on the review page.

		this.getComments();
	},
	methods: {
		//method definitions
		/**
		 * attempts to get all comments for the review, alerts user if failed
		 */
		getComments: function ()
		{
			let self = this; //https://stackoverflow.com/questions/44869287/set-object-in-data-from-a-method-in-vue-js . can't set data using "this" inside ajax get. save "this" into "self" ;>)
			$.get($('#base_url_input').val()+'/review/comments/'+this.reviewID, function(data, status){ //base url is also stored in hidden input
				if(status == 'success' || status == 200)
				{
					self.Comments = data; //update the comments variable
				}
				else
				{
					self.Comments = "";
					alert("Vue didn't work :>(."); //if we failed to contact the controller, let users know something is wrong. this could be implemented better.
				}
			});
		},

		/**
		 * posts a new comment to current review, alerts users if not logged in, or the comment is blank
		 */
		postNewComment: function() //this method is refereced vie vue:on-click within the html
		{
			let reviewID =  $('#review_id').val(); //get review id again

			let comment = $('#commentInput').val(); //get comment

			let user_name= $('#user_name').val(); //get username


			if(user_name == undefined)
			{
				alert("You must be logged in to post a comment.");
			}
			else if(comment == "")
			{
				alert("Comment can not be blank.");
			}
			else
			{
				$.post($('#base_url_input').val()+'/review/comments/'+reviewID+'/postComment', {comment: comment}, function(){ //build url to post, in essense base_url.review_controller.review_id.method
				});

				this.Comments.push({UserComment: comment, UserName: user_name}); //push our comment to the vue comment block
			}
		}
	}
});
