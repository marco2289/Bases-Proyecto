
$(".art").hover(
                 	function()
                 	{
                 		$(this).addClass("visible");
                 		$(this).find(".opt").show();
	                },
                 	function()
                 	{
                 		$(this).removeClass("visible");
                 		$(this).find(".opt").hide();          		
	                }
	            )