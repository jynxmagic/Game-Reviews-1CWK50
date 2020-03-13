/***
 * View file loaded on the review page. It's main function is to dynamically load review comments as they are added on the fly. The page does not need reloading
 * to view new comments - Vue allows for bidirectional communication.
 * @type {Vue}
 */
var app = new Vue({
	el: '#app', //div to target
	data: {
		Comments: [] //initial comment data block to reserve the data type in memory
	},
	created(){

		//after view is initialized, do this

		let reviewID = $('#review_id').val(); //in a hidden input, from codeigniter, we have stored the review id on the review page.

		this.getComments(reviewID);
	},
	methods: {
		//method definitions
		getComments: function (reviewID)
		{
			let self = this; //https://stackoverflow.com/questions/44869287/set-object-in-data-from-a-method-in-vue-js . can't set data using "this" inside ajax get. save "this" into "self" ;>)
			$.get($('#base_url_input').val()+'/review/comments/'+reviewID, function(data, status){ //base url is also stored in hidden input
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

		postNewComment: function() //this method is refereced vie vue:on-click within the html
		{
			let reviewID =  $('#review_id').val(); //get review id again

			let comment = $('#commentInput').val(); //get comment

			$.post($('#base_url_input').val()+'/review/comments/'+reviewID+'/postComment', {comment: comment}, function(){ //build url to post, in essense base_url.review_controller.review_id.method
				//on post completed. could check for errors/success here.
			});

			//reload comment data
			this.getComments(reviewID); //load latest comments. this is used as substitute for a success method within jQuery - if a user can't see their comment, they'll know something is wrong.
		}
	}
});
