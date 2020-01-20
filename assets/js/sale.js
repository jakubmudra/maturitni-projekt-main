//var cw = $('.child').width();
//$('.child').css({
  //  'height': cw + 'px'
//});




let height = (window.innerHeight > 0) ? window.innerHeight : screen.height;
$(".sale-main.container").css({'width' : height + 200 + 'px'});

let elementSelector = ".sale-item--inner";
//Resizing
$(elementSelector).each(function (element) {
    let elementHeight = $(this).width();
    let elementPadding = parseInt($(this).css("padding-left").replace("px","")) + parseInt($(this).css("padding-right").replace("px",""));
    console.log(elementPadding);
    $(this).css({'height' : elementHeight + elementPadding});
});

$(elementSelector).click(function () {
    console.log("Just clicked to product: " + $(this).data("productid") + " with price " + $(this).data("price"));
});

