$(function () {
    //----------Add To Cart----------//
    $('.addtocart').click(function () {
        var _that = $(this);
        //----------Prepare Data Send To Ajax: URL, Data(optional)-----------//
        var _url = _that.data('href');
        $.ajax({
            url: _url,
            method: 'POST',
            success: function (d) {
                if (d.status == 'success') {
                    $('.subtotal').html(d.subtotal);
                    $('.countcart').html(d.countitem);
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(d.msg);
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(d.msg);
                }

            },
            error: function (d) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.error(d.responseJSON.message);
            }
        })
    })
    //----------Update Cart----------//
    $('.qtyorder').change(function () {
        var _that = $(this);
        var _id = _that.data('id');
        //----------Prepare Data Send To Ajax: URL, Data(optional)-----------//
        var _url = _that.data('href');
        $.ajax({
            url: _url,
            data: {
                qty: _that.val()
            },
            method: 'PUT',
            success: function (d) {
                if (d.status == 'success') {
                    _that.data('old', _that.val());
                    $('#amount-' + _id).html(d.amount);
                    $('#subtotal').html(d.subtotal);
                    $('.subtotal').html(d.subtotal);
                    $('#total').html(d.total);
                    $('.countcart').html(d.countitem);
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(d.msg);
                    _that.val(_that.data('old'));
                }
            },
            error: function (d) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.error(d.responseJSON.message);
                _that.val(_that.data('old'));
            }
        });
    });
    //----------Delete Item Cart----------//
    $(document).on('click', ".delitem", function () {
        var _that = $(this);
        var _id = _that.data('id');

        //----------Prepare Data Send To Ajax: URL, Data(optional)-----------//
        var _url = _that.data('href');
        alertify.confirm("Remove Product", "Are You Sure You Want To Remove This Product?", function () {
            $.ajax({
                url: _url,
                method: 'DELETE',
                success: function (d) {
                    if (d.status == 'success') {
                        if (d.countitem == 0) {
                            window.location.reload();
                        }
                        _that.parents("tr").remove();
                        $('#subtotal').html(d.subtotal);
                        $('.subtotal').html(d.subtotal);
                        $('#total').html(d.total);
                        $('.countcart').html(d.countitem);
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(d.msg);

                    }
                },
                error: function (d) {
                    alert(d.responseJSON.message);
                }
            });
        }, function () {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Cancel Remove Product');
        });
    });
    //----------Clear Cart----------//
    $('.clearcart').click(function () {
        var _that = $(this);
        //----------Prepare Data Send To Ajax: URL, Data(optional)-----------//
        var _url = _that.data('href');
        alertify.confirm("Clear Cart", "Are You Sure You Want To Clear Cart?", function () {
            $.ajax({
                url: _url,
                method: 'DELETE',
                success: function (d) {
                    if (d.status == 'success') {
                        window.location.reload();
                    }
                }
            });
        }, function () {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Cancel Clear Cart');
        });
    });
});
