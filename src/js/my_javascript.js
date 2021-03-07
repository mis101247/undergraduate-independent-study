
$(function(){
/*上方選單的javascript_須搭被semantic*/
$('.main.menu')
  .visibility({
    type   : 'fixed'
  })
; 
});

function f_menu(){
	/*手機平板選單的javascript_須搭被semantic*/
$('#show_menu')
  .sidebar('setting', 'transition', 'overlay')
  .sidebar('toggle')
;
}