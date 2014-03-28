    $(document).ready(function () {
        //we bind the effect of mouseover and mouseenter on the food-box wrapper.
        $(".food-box").bind("mouseover, mouseenter", function () {
            //this will change the user name to white text as we apply this class
            $(this).find(".food-box-uploadby").addClass("white-text");
 
            //this will find the child food-box-transparentbg div and slide/show the hidden box
            $(this).find(".food-box-transparentbg").slideDown(300);
 
            //this will show the comments, rating information in a delay of 0.2 sec
            $(this).find(".food-box-info").show(200);
 
            //we bind when the effect of mouseout and mouseleave on the food-box wrapper
        }).bind("mouseout, mouseleave", function () {
            //this will find the child food-box-transparentbg div and hide the hidden box
            $(this).find(".food-box-transparentbg").slideUp(300);
 
            //this will remove the class white-text we add before and will make the color back to its original color
            $(this).find(".food-box-uploadby").removeClass("white-text");
 
            //this will hide the comments, rating information in a delay of 0.3 sec
            $(this).find(".food-box-info").hide(300);
        });
 
        /*
        This is optional, if you want to enable url when user click the box, you can use this function. Otherwise you can leave it or remove it from the code.
        */
        $(".food-box").bind("click", function () {
            window.location.href = "#";
        });
    });