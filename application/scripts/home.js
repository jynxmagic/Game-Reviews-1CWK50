$('.carousel').carousel(1); //start carousel on 1st slide


let urlObj = new URL(window.location.href);
let slug = urlObj.searchParams.get("slug");

if(slug != false)
{
	let option_index = $('#'+slug).index();
	$('#slug_select').prop("selectedIndex", option_index)
}

$('#slug_select').on('change', function(){
	let slug = $('#slug_select').find(':selected').val();
	let urlObj = new URL(window.location.href);
	urlObj.searchParams.set('slug', slug);
	urlObj.searchParams.set('start_pos', 0);
	window.location.href = urlObj.href;
})


