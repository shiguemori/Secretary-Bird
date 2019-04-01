$(document).ready(function () {

    let preventParentClick = false;

    //Flash mensagem administration
    $('#flash-overlay-modal').modal();
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

    setTimeout(function () {
        $('body').addClass('shown');
    }, 100);

    $(document).on('click', 'a.link-out', function (e) {
        if (!e.ctrlKey) {
            var thisHref = $(this).attr('href');
            if (thisHref && thisHref != '' && !$(this).hasClass('done') && !$(this).hasClass('disable')) {
                $('body').removeClass('shown');
                setTimeout(function () {
                    return true;
                }, 100);
            } else {
                return false;
            }
        }
    });

    /**
     * Select os switcher parents
     */
    $(document).on('change', '.permission', function () {
        if (preventParentClick) {
            preventParentClick = false;
            return;
        }

        let elem = this;
        if (typeof $(elem).data('id') !== 'undefined') {
            if (!$(elem).is(':checked')) {
                $('input[data-parent="' + $(elem).data('id') + '"]').each(function () {
                    if ($(this).is(':checked')) {
                        $(this).trigger("click");
                    }
                });
            } else {
                $('input[data-parent="' + $(elem).data('id') + '"]').each(function () {
                    if (!$(this).is(':checked')) {
                        $(this).trigger("click");
                    }
                });
            }
        }

        if (typeof $(elem).data('parent') !== 'undefined') {
            if ($(elem).is(':checked')) {
                if (!$('input[data-id="' + $(elem).data('parent') + '"]').is(':checked')) {
                    preventParentClick = true;
                    $('input[data-id="' + $(elem).data('parent') + '"]').trigger("click");
                }
            }
        }
    });

    /**
     * Executa o ladda de block no botão para evitar duplos cliques
     */
    $(document).on('submit', '.form-ladda', function () {
        let elem = this;
        var l = Ladda.create(document.querySelector('.ladda-button'));
        l.start();
        setTimeout(function () {
            if ($(elem).find('.input-error').length) {
                $(elem).find('.input-error').first().focus();

                l.stop();
                return false;
            }
        }, 500);
    });

    /**
     * Adicionar a classe no form de delete para usar o confirm
     */
    $('.confirmDelete').submit(function (e) {
        let form = $(this)
        e.preventDefault();
        swal({
            title: 'Atenção!!!',
            text: "Deseja mesmo remover este item?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }).then(function (isConfirm) {
            if (isConfirm.value === true) {
                form.unbind('submit').submit();
            }
        })
    })

});
