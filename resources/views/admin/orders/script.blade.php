<script>

    var modal = UIkit.modal('#order-show',{bgclose:false}), content = $('#content'),order = $('#order');

    order.on('click', '.show', function (e) {
        e.preventDefault();

        var that = $(this);
        var id = parseInt(that.data('id')) || 1;


        getAjax('/admin/orders/' + id,'get','html', function (h) {
            content.html(h);
            modal.show();
        });
    });

    content.on('change','#status',function () {
        $('#order-button').show();
    });

    content.on('click','#order-button',function () {

        getAjax('/admin/orders/' + $(this).val(),'put','json',function (j) {
            $('[data-order="' + j['id'] +'"]').html(j['status']).addClass('uk-animation-scale-down');
            modal.hide();
            UIkit.notify(j['status'] + ' Статус заказа #' + j['id'] + ' изменен', {pos:'top-center',status:'success'});
        },$('#order-form').serializeArray());
    });
</script>