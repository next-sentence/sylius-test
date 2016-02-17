
(function ($) {
    'use strict';

    function increaseAttributesWidgetNumber() {
        var currentIndex = parseInt(getNextIndex());
        $('#widgets .collection-list1').attr('data-length', currentIndex+1);
    }

    function getNextIndex() {
        return $('#widgets .collection-list1').attr('data-length');
    }

    function modifyModalOnItemDelete() {
        $('a[data-form-collection="delete"]').on('mousedown', function(){
            setTimeout(function(){
                controlAttributesList();
            }, 500);
        });
    }

    function controlAttributesList() {
        $.each($('#widget-modal a'), function() {
            $(this).css('display', 'block');
            $(this).find('input').attr('checked', false);
        });
        $.each($('#widgets .collection-item'), function(){
            var usedAttributeId =  $(this).find('input').val();

            $('#widget-modal').find('input[value="'+usedAttributeId+'"]').parent().css('display', 'none');
        });
    }

    function modifyAttributeWidgetForms(data) {
        $.each($(data).find('input,select,textarea'), function(){
            if ($(this).attr('data-name') != null) {
                $(this).attr('name', $(this).attr('data-name'));
            }
        });

        return data;
    }

    function setAttributeWidgetChoiceListener() {
        $('#attributeChoice').submit(function(event) {
            event.preventDefault();
            var form = $(this);

            $.ajax({
                type: 'GET',
                url: form.attr('action'),
                data: form.serialize()+'&count='+getNextIndex(),
                dataType: 'html'
            }).done(function(data){
                var finalData = modifyAttributeWidgetForms($(data));
                $('#widgets .collection-list1').append(finalData);
                $('#widget-modal').modal('hide');
                modifyModalOnItemDelete();
                increaseAttributesWidgetNumber();
            });
        });
    }

    $(document).ready(function(){
        var attributesModal = $('#widget-modal');
        var archetypeParent = $('#sylius_product_archetype_parent');

        attributesModal
            .on('shown.bs.modal', function () {
                setAttributeWidgetChoiceListener();
            })
            .on('hide.bs.modal', function () {
                $('#attributeChoice').unbind();
            })
            .on('hidden.bs.modal', function() {
                controlAttributesList();
            })
        ;

        archetypeParent
            .on('change', function () {
                var value = $(this).val();
                $('#archetype_parent').val(value);
                $('a[data-form-collection="delete"]').click();

                var form = $('#attributeChoice');
                $.ajax({
                    type: 'GET',
                    url: form.attr('action'),
                    data: form.serialize()+'&count='+getNextIndex(),
                    dataType: 'html'
                }).done(function(data){
                    var finalData = modifyAttributeWidgetForms($(data));
                    $('#widgets .collection-list1').append(finalData);
                    $('#widget-modal').modal('hide');
                    controlAttributesList();
                    modifyModalOnItemDelete();
                    increaseAttributesWidgetNumber();
                });
            })
        ;

        controlAttributesList();
        modifyModalOnItemDelete();
    });
})( jQuery );