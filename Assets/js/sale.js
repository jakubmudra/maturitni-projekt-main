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
        this.getFromLocal();
        this.render();
    }

    add(product) {
        this.getFromLocal();
        if(this.products.some(singleProduct => singleProduct.id === product.id )){
            let id = this.products.findIndex(singleProduct => singleProduct.id === product.id);
            this.quantities[id] += 1;
        } else{
            this.products.push(product);
            this.quantities.push(1);
        }
        this.saveToLocal();
    }

    get() {
        return this.products;
    }

    getSubTotal()
    {
        let subTotal = 0;

        for(var i = 0; i < this.products.length; i++)
        {
            subTotal += Math.round(this.products[i].price * this.quantities[i] * 100) / 100;
        }

        return (subTotal).toFixed(2);
    }

    render() {
        let rtn = "";

        for(var i = 0; i < this.products.length; i++)
        {
            rtn += "<tr>";
            rtn += "<td>" +  + this.quantities[i] +"</td>";
            rtn += "<td>" + this.products[i].name + "</td>";
            rtn += "<td>" + (Math.round(this.products[i].price * this.quantities[i] * 100) / 100).toFixed(2)+ "</td>";
            rtn += "</tr>";
        }

        $("#CART").html(rtn);
        $("#SUBTOTAL").html(this.getSubTotal());
        console.log(this);
    }

    saveToLocal()
    {
        localStorage.setItem("cart" + this.id, JSON.stringify(this));
    }

    getFromLocal()
    {
        let loaded = localStorage.getItem("cart" + this.id);
        if(loaded != null)
        {
            let parsed = JSON.parse(loaded);
            this.products = parsed.products;
            this.quantities = parsed.quantities;
        }

        return true;
    }
}

let ct = new cart($("#transactionID").data("tid"));

$(".sale-item--inner.product").click(function () {
    let product = $(this);
    ct.add({id: product.data("productid"), name: product.data("name"), price: product.data("price")});
    ct.render();
});
