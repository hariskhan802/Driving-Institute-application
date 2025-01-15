    jQuery(document).ready(function(){
        // console.log(jQuery( ".date_train" ).length);
        var dateToday = new Date();
        var dInt = setInterval(function(){ 
            if (jQuery( "body .date_train" ).length > 0)
            {
                jQuery( "body .date_train" ).datepicker();
                // clearInterval(dInt);
            }
            if (jQuery( "body .s-date" ).length > 0)
            {
                jQuery( "body .s-date" ).datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1,
                    minDate: dateToday,
                    
                });
                // clearInterval(dInt);
            }

        }, 1);
        var sInt = setInterval(function(){ 
            /*if (jQuery( "select option" ).length > 0)
            {
                jQuery( "select option" ).each(function(){
                    var curElem = this;
                    if(jQuery(curElem).text() == "")
                    {
                        jQuery(curElem).remove();
                    }
                });
                    
                clearInterval(sInt);
            }*/

        }, 1);
        
        

        
    })