$(document).ready(function() {
    $('a[data-confirm]').click(function() {
            var href = $(this).attr('href');
            if (!$('#dataConfirmModal').length) {
                    $('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content">\n\
                                        <div class="modal-header">\n\
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>\n\
                                            <h4 id="dataConfirmLabel">Confirmación</h4>\n\
                                        </div>\n\
                                        <div class="modal-body"></div>\n\
                                        <div class="modal-footer">\n\
                                            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">\n\
                                                Cancelar\n\
                                            </button>\n\
                                            <a class="btn btn-primary" id="dataConfirmOK">\n\
                                                OK\n\
                                            </a>\n\
                                        </div>\n\
                                       </div></div></div>');
            } 
            $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
            $('#dataConfirmOK').attr('href', href);
            $('#dataConfirmModal').modal({show:true});
            return false;
    });
});

