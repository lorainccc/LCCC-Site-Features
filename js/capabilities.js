jQuery(document).ready(function(){
 //Set the box checked by default
 jQuery("#rvy_save_as_pending_rev").prop('checked', true);

 jQuery("#rvy_save_as_pending_rev").on('change', function(){
  this.checked=!this.checked?!alert('This function has been disabled.'):true;
 });

});

