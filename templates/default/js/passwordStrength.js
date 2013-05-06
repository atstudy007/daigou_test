/* 
 * Plugin:  Password Strength Tester (jQuery)
 * Author:  Ashit Vora (ashit AT innib DOT com)
 *          http://www.innib.com
 * Date:    04/18/2009
 * 
 * Useage:  After including jQuery,
 *          $('passwordfield').passwordStrength();
 */

jQuery.fn.passwordStrength = function(lan) {
  
    var element = this;
    var checkstrong;

    /* html css */

	var check_password={

			'text-align':'left',
			'list-style':'none',
			'margin':'0px',
			'padding':'0px',
			'margin-top':'3px'
     }
  
    var check_password_li={
			
			'float':'left',
			'border':'1px #CCCCCC solid',
			'width':'50px',
			'text-align':'center',
			'font-size':'12px',
			'color':'#666666'
}
	
	/* display html*/
 
    if(lan=='zh'){
  
		$('#mypassword').after("<ul class='check_password'><li id='strength_W' class='check_password_li'>弱</li><li id='strength_A' class='check_password_li' >中</li><li id='strength_S' class='check_password_li' >强</li></ul>");
	
	}else{
		$('#mypassword').after("<ul class='check_password'><li id='strength_W' class='check_password_li'>Weak</li><li id='strength_A' class='check_password_li' >Average</li><li id='strength_S' class='check_password_li' >Secure</li></ul>");
		
	}

	$('.check_password').css(check_password);   
    $('.check_password_li').css(check_password_li);
	
    /*Observe Key Up event display password Strength Result*/
    $(this).live('keyup', function() {
        var pass = $.trim($(this).val());
        var numericTest = /[0-9]/;
        var lowerCaseAlphaTest = /[a-z]/;
        var upperCaseAlphaTest = /[A-Z]/;
        var symbolsTest = /[.,!@#$%^&*()}{:<>|]/;
        var score = 0;
        var result;

        /*Test for the validations*/
        if (numericTest.test(pass)) {
            score++;
        }
        if (lowerCaseAlphaTest.test(pass)) {
            score++;
        }
        if (upperCaseAlphaTest.test(pass)) {
            score + 3;
        }
        if (symbolsTest.test(pass)) {
            score++;
        }
        /*Test Complete*/
        /*Calculate the result*/
        if (pass.length == 0 || pass=='' || pass==null) {
        
           W_color=A_color=G_color=S_color="#ffffff";
           var W_weight=A_weight=S_weight='normal';
		       checkstrong='weak';
        
        }else{
         	
           var s_level=score * pass.length;
           switch(true){
           
           		case s_level<8 :
           		   W_color="#FE707E";
				   A_color=S_color="#ffffff";
				   W_weight="bolder";
				   A_weight=S_weight="normal";
				   checkstrong='weak'; 
				   
                 break; 
                 
                case s_level<16 :
                
                    W_color=A_color="#FCFA93";
				    S_color="#ffffff";
				    W_weight=S_weight="normal";
				    A_weight="bolder";
				    checkstrong='average'; 		    
           	      break;
           	      
           	     default :
           	     
           	        W_color=A_color=G_color=S_color="#BDFEA6";
           	        S_weight="bolder";
           	        w_weight=A_weight="normal";
           	        checkstrong='secure';      
           }        
        }
        /*Calculate result end*/
        $('#strength_W').css({"background-color":W_color,"font-weight":W_weight});
        $('#strength_A').css({"background-color":A_color,"font-weight":A_weight});
        $('#strength_S').css({"background-color":S_color,"font-weight":S_weight});
      	$.passwordStrength = checkstrong;
    });
};