
function successNotify(mensaje){

    $.notify({
        title: '  ',
        icon: 'glyphicon glyphicon-ok',

        message: mensaje,
    },{
        type: 'success',

        animate: {
            enter: 'animated fadeInRight',
            exit: 'animated fadeOutRight'
        },
        placement: {
            from: "bottom",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
    });



}

function infoNotify(mensaje) {
    $.notify({
        title: '  ',

        message: mensaje,
    },{
        type: 'black',

        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutDown'
        },
        placement: {
            from: "top",
            align: "left"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
    });

}

function errorNotify(mensaje) {

    $.notify({
        title: '  ',
        icon: 'glyphicon glyphicon-remove',
        message: mensaje,
    }, {
        type: 'danger',

        animate: {
            enter: 'animated fadeInLeft',
            exit: 'animated fadeOutLeft'
        },
        placement: {
            from: "bottom",
            align: "left"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
    });
}
    function warningNotify(mensaje) {

        $.notify({
            title: '  ',
            icon: 'glyphicon glyphicon-remove',
            message: mensaje,
        },{
            type: 'warning',

            animate: {
                enter: 'animated fadeInLeft',
                exit: 'animated fadeOutLeft'
            },
            placement: {
                from: "bottom",
                align: "left"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
        });


    }
