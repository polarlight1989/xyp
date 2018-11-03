
$(function () {

    //
    try {

        top.popMenuNew.init($(".navOne-new"));
        $(".navOne-new>li").hover(function () {
            var $elem = $(this);
            //$elem.addClass("hover");
            var $id = $elem.attr("id");
            if ($id == "bankLi" || $id == "insuranceLi" || $id == "investmentLi") {
                // $elem.addClass("downhover");
                $elem.removeClass("czBtn");
                $elem.addClass("czBtnOn");
                if (top.location != location) {

                    var offset = $elem.offset();
                    top.popMenuNew.open({
                        id: $id,
                        css: {
                            display: "block",
                            top: offset.top + $elem.outerHeight(),
                            left: offset.left
                        }
                    });
                }
            }
        }, function () {
            var $id = $(this).attr("id");
            if ($id == "bankLi" || $id == "insuranceLi" || $id == "investmentLi") {
                
                if (top.location != location) {
                    top.popMenuNew.close($id + "-down");
                }
            }
            else {
                hideNav();
            }
        });

        top.popTopUser.init($(".topuser"));

        $(".topuser").hover(function () {
            var $elem = $(this);
            if (top.location != location) {

                var offset = $elem.offset();
                top.popTopUser.open({
                    css: {
                        display: "block",
                        top: offset.top + $elem.outerHeight(),
                        left: offset.left
                    }
                });
            }
        }, function () {
            top.popTopUser.close();
        });
    }
    catch (e) {
        ///alert(e.message)
    }
});

window.hideNav = function (id) {
    id = id ? "#" + id : "";
    id = id.replace("-down", "");
    $(".navOne-new li" + id).removeClass("hover downhover");
}
