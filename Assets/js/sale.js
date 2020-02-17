//var cw = $('.child').width();
//$('.child').css({
  //  'height': cw + 'px'
//});




let height = (window.innerHeight > 0) ? window.innerHeight : screen.height;
$(".sale-main.container").css({'width' : height + 200 + 'px'});

let elementSelector = ".sale-item--inner";

$(elementSelector).each(function (element) {
    let elementHeight = $(this).width();
    let elementPadding = parseInt($(this).css("padding-left").replace("px","")) + parseInt($(this).css("padding-right").replace("px",""));
    console.log(elementPadding);
    $(this).css({'height' : elementHeight + elementPadding});
});

window.onresize = function(event) {

    //Resizing
    $(elementSelector).each(function (element) {
        let elementHeight = $(this).width();
        let elementPadding = parseInt($(this).css("padding-left").replace("px","")) + parseInt($(this).css("padding-right").replace("px",""));
        console.log(elementPadding);
        $(this).css({'height' : elementHeight + elementPadding});
    });
};



//cart

class cart {

    constructor(id) {
        this.id = id;
        this.products = [];
        this.quantities = [];
    }

    render() {
        let rtn = "";
        let transactionID = $("#transactionID").data("tid");
        let data = {trans_id : transactionID,  action: "getProducts"};

        $.ajax({
            type:"POST",
            cache:true,
            url:"/api/saveTransaction",
            data:data,
            success: function (result) {
                this.products = result;
                let subTotal = 0;

                for(var i = 0; i < result.length; i++)
                {
                    subTotal +=  Math.round(result[i][2] * result[i][3] * 100) / 100;

                    rtn += "<tr>";
                    rtn += "<td>" + result[i][3] +"</td>";
                    rtn += "<td>" + result[i][1] + "</td>";
                    rtn += "<td>" + (Math.round(result[i][2] * result[i][3] * 100) / 100).toFixed(2)+ "</td>";
                    rtn += "</tr>";
                }

                $("#CART").html(rtn);
                $("#SUBTOTAL").html( (subTotal).toFixed(2) );
            }
        });

    }
}

let ct = new cart("2019012321");
ct.render();

$(".sale-item--inner.product").click(function () {
    let transactionID = $("#transactionID").data("tid");
    let product = $(this);
    let data = {trans_id : transactionID, product_id: product.data("productid"), quantity : 1, action: "addProduct"};
    ct.render();
    let ajaxTime= new Date().getTime();
    $.ajax({
        type:"POST",
        cache:true,
        url:"/api/saveTransaction",
        data:data    // multiple data sent using ajax
    }).done(function () {
        let totalTime = new Date().getTime()-ajaxTime;
        // Here I want to get the how long it took to load some.php and use it further
        console.log("ajax : " + totalTime + " ms");
    });

});
