$.tools.dateinput.localize("ru", {
    months: 'Январь,Февраль,Март,Апрель,Май,Июнь,Июль,Август,Сентябрь,Октябрь,Ноябрь,Декабрь',
    shortMonths:  'Янв,Фев,Март,Апр,Май,Июнь,Июль,Авг,Сент,Окт,Нояб,Дек',
    days:         'Воскресенье,Понедельник,Вторник,Среда,Четверг,Пятницы,Суббота',
    shortDays:    'Вс,Пн,Вт,Ср,Чт,Пт,Сб'
});

$(function() {
    $('.styled').styler();


    /* datepicker */
    initDatepicker();

    if ($('#js-calendar').length) {
        $('#js-calendar :date').dateinput( {
            firstDay: 1,
            lang: 'ru',
            onHide: function()  {
                return false;
            },
            change: function(e, date)  {
                // to do something
            }
        }).data("dateinput").setValue(0).show();
    }


    /* Small Calendar for Plan item */
    $('body').on('click', '.js-show-calendar-wrap', function() {
        var link = $(this),
            arrowRight = link.offset().left - $('#main-content').offset().left;
        link.addClass('hovered active');
        link.parents('.plan-item').find('.js-small-calendar .arrow').css('right', 780 - arrowRight - 25); // 780 -> left col width
        link.parents('.plan-item').find('.js-small-calendar').fadeIn(200);
    });
    $('body').on('mouseleave', '.js-show-calendar-wrap', function() {
        var link = $(this),
            calendar = $(this).parents('.plan-item').find('.js-small-calendar');
        setTimeout(function() {
            if (!calendar.hasClass('hovered')) {
                calendar.fadeOut(200);
            }
            link.removeClass('hovered');
        }, 300);
    });
    $('body').on('mouseenter', '.js-small-calendar', function() {
        $(this).addClass('hovered');
    });
    $('body').on('mouseleave', '.js-small-calendar', function() {
            var calendar = $(this),
                link = $(this).parents('.plan-item').find('.js-show-calendar-wrap');

            if (calendar.is('[data-hideOnLeave]')) {
                calendar.removeClass('hovered');
                setTimeout(function() {
                    if (!link.hasClass('hovered')) {
                        calendar.fadeOut(200);
                        link.removeClass('active');
                    }
                }, 300);
            }
    });


    /* Big Calendar */
    $('#js-show-big-calendar').on({
        click: function() {
            var calendarWrap = $('#js-big-calendar'),
                calendarWidget = $('#calroot'),
                toggleLink = $(this);

            if (!calendarWrap.is(':visible')) {
                calendarWrap.slideDown('fast', function() {
                    calendarWidget.css('left', calendarWrap.offset().left).toggleClass('showed');
                    toggleLink.toggleClass('active');
                });
            } else {
                calendarWidget.toggleClass('showed');
                calendarWrap.slideUp('fast', function() {
                    toggleLink.toggleClass('active');
                });
            }
        }
    });
    $('#calweeks').selectable({
        filter: 'a',
        stop: function( event, ui ) {
            if ($('#calweeks .ui-selected').length > 1) {
                $('#js-new-task-dialog').dialog('open');
            }
        }
    });


	/* Tabs - http://jquerytools.github.io/documentation/tabs/index.html */
    $('.js-tabs-toggle').tabs('.js-tabs-panes > .item');


    /* Dialogs */
    $('.js-dialog').dialog({
        autoOpen: false,
        draggable: false,
        modal: true,
        resizable: false,
        width: 580,
        create: function( event, ui ) {
            if ($(this).hasClass('small')) {
                $(this).dialog( "option", "width", 335 );
            }
        }
    });
    $('#js-open-login-dialog').on({
        click: function(){
            $('#js-login-dialog').dialog('open');
        }
    });
    $('body').on('click', '.js-open-delete-sphera-dialog', function() {
        $('#js-delete-sphera-dialog').dialog('open');
    });
    $('#js-open-photo-dialog').on({
        click: function(){
            $('#js-photo-dialog').dialog('open');
        }
    });
    $('#js-open-aims-dialog').on({
        click: function(){
            $('#js-aims-dialog').dialog('open');
        }
    });
    $('body').on('click', '.js-edit-popup', function() {
        var popupsection = $(this).data('popupsection'),
		    tabApi = $('#js-tabs-plan1').data('tabs');
        $('#js-edit-plan-dialog').dialog('open');
		switch (popupsection) {
			case 'sphera': tabApi.click(4); break;
			case 'files': tabApi.click(3); break;
			case 'members': tabApi.click(2); break;
			case 'comments': tabApi.click(1); break;
			case 'clock': tabApi.click(0); break;
			default: tabApi.click(0);
		}
    });
    $('body').on('click', '.js-show-pick-files-dialog', function() {
        $('#js-edit-plan-dialog').dialog('close');
        $('#js-pick-files-dialog').dialog('open');
    });


    /* Sphera */
    $('body').on('click', '.js-open-edit-sphera-dialog', function() {
        $('#js-edit-sphera-dialog').dialog('open');
		var tabApi = $('#js-tabs-shpera1').data('tabs');
        if ($(this).hasClass('members')) {
            tabApi.click(1);
        } else if ($(this).hasClass('hex-wrap')) {
            tabApi.click(0);
        }
    });
    $('body').on('click', '.js-show-members', function() {
        var listBlock = $(this).prev('.js-member-list');
        listBlock.css('max-height', listBlock.height() + 275); // 275 = 55 * 5
    });
    $('body').on('click', '.js-edit-sphera', function() {
        var editBlock = $(this).parent().siblings('.sphera-edit-block');
        $(this).parents('.sphera-item').addClass('edit');
        editBlock.show();
        editBlock.children('.js-sphera-edit-input').focus();
    });
    $('body').on('click', '.js-activate-sphera', function() {
        $('#js-sidebar-sphera-block .sphera-item').removeClass('active');
        $(this).parents('.sphera-item').addClass('active');
    });
    $('body').on('click', '.js-sphera-edit-ok', function() {
        var value = $(this).siblings('.js-sphera-edit-input').val(),
            item = $(this).parents('.sphera-item');
        if (value != '') {
            item.find('.js-sphera-name').text(value);
            item.removeClass('edit new-item');
            $('.sphera-edit-block').hide();
        } else {
            $(this).siblings('.js-sphera-edit-cancel').click();
        }
    });
    $('body').on('click', '.js-sphera-edit-cancel', function() {
        var value = $(this).siblings('.js-sphera-edit-input').val(),
            item = $(this).parents('.sphera-item');

        $(this).siblings('.js-sphera-edit-input').val(item.find('.js-sphera-name').text());
        item.removeClass('edit');
        $('.sphera-edit-block').hide();

        if (value == '' && item.hasClass('new-item')) {
            item.remove();
        }
    });
    $('#js-add-new-sphera').on({
        click: function(){
            var addLink = $(this),
                newSpheraHtml = '<div class="sphera-item new-item clearer-block js-new-sphera-item">' +
                        '<div class="hex-wrap js-open-edit-sphera-dialog"><div class="hex small"></div></div>' +
                        '<div class="sphera-name text-ellipsis js-activate-sphera js-sphera-name"></div>' +
                        '<div class="sphera-hover-menu clearer-block">' +
                            '<a href="javascript:void(0)" class="link members text-hidden fleft js-open-edit-sphera-dialog">Другие участники</a>' +
                            '<a href="javascript:void(0)" class="link settings text-hidden fleft js-show-sphera-settings">Меню</a>' +
                        '</div>' +
                        '<div class="sphera-main-menu clearer-block">' +
                            '<a href="javascript:void(0)" class="link trash text-hidden fleft js-open-delete-sphera-dialog">Удалить</a>' +
                            '<a href="javascript:void(0)" class="link members text-hidden fleft js-open-edit-sphera-dialog">Участники</a>' +
                            '<a href="javascript:void(0)" class="link edit text-hidden fleft js-edit-sphera">Редактировать</a>' +
                            '<a href="javascript:void(0)" class="link move text-hidden fleft js-move-sphera">Переместить</a>' +
                        '</div>' +
                        '<div class="sphera-edit-block clearer-block">' +
                            '<input class="fleft js-sphera-edit-input" value="" type="" name="">' +
                            '<a href="javascript:void(0)" class="link ok text-hidden fleft js-sphera-edit-ok">Ok</a>' +
                            '<a href="javascript:void(0)" class="link cancel text-hidden fleft js-sphera-edit-cancel">Cancel</a>' +
                        '</div>' +
                    '</div>';

            if ($('#js-sidebar-sphera-block').find('.new-item').length == 0) {
                addLink.before(newSpheraHtml);
                var spheraBlock = addLink.prev('.js-new-sphera-item');
                spheraBlock.find('.js-edit-sphera').click();
            }
        }
    });


    /* Tooltip */
    $('.js-tooltip-toggle.tooltip-standart, .js-tooltip-toggle').tooltip({
        position: {
            my: 'left-20 top+15',
            at: 'left bottom',
            using: function( position, feedback ) {
              $( this )
                .css( position )
                .addClass( feedback.vertical )
                .addClass( feedback.horizontal );
              $( "<div>" )
                .addClass( "arrow" )
                .appendTo( this );
            }
        }
    });
    $('.js-tooltip-toggle.tooltip-clock').tooltip({
        position: {
            my: 'left-32 top+15',
            at: 'left bottom',
            using: function( position, feedback ) {
              $( this )
                .css( position )
                .addClass( feedback.vertical )
                .addClass( feedback.horizontal );
              $( "<div>" )
                .addClass( "arrow" )
                .appendTo( this );
            }
        }
    });
    $('.js-tooltip-toggle.tooltip-center').tooltip({
        position: {
            my: 'left-47 top+15',
            at: 'center bottom',
            using: function( position, feedback ) {
              $( this )
                .css( position )
                .addClass( feedback.vertical )
                .addClass( feedback.horizontal );
              $( "<div>" )
                .addClass( "arrow" )
                .appendTo( this );
            }
        }
    });


    /* Sphera Actions */
    /* Small Calendar for Plan item */
    $('body').on('click', '.js-show-sphera-settings', function() {
            var link = $(this);
            link.parent().next('.sphera-main-menu').fadeIn(200);
    });
    $('body').on('mouseleave', '.sphera-main-menu', function() {
            $(this).fadeOut(200);
    });


    /* Notice Block */
    $('.notice-text-block .close').on({
        click: function(){
            $(this).parent().fadeOut(200);
        }
    });

    /* Confirm Invite Block */
    $('.js-accept').on({
        click: function(){
            $(this).parents('.plan-item').find('.js-invite-accept-block').fadeIn(200);
        }
    });
    $('.js-reject').on({
        click: function(){
            $(this).parents('.plan-item').find('.js-invite-reject-block').fadeIn(200);
        }
    });
    $('.js-invite-reject-block .yes').on({
        click: function(){
            var plan = $(this).parents('.plan-item');
            plan.find('.close').click();
            plan.find('.js-invite-ban-block').fadeIn(200);
        }
    });
    $('.confirm-block .close').on({
        click: function(){
            $(this).parents('.confirm-block').fadeOut(200);
        }
    });


    /* Custom Dropdown */
    $('.js-dropdown-toggle').on({
        click: function(){
            var toggleLink = $(this);
            toggleLink.toggleClass('active');
            toggleLink.parents('.js-dropdown').find('.js-dropdown-container').slideToggle(200);
        }
    });
    $('.js-dropdown .js-dropdown-container .item').on({
        click: function(){
            var item = $(this),
                itemHtml = item.html();
            item.parents('.js-dropdown').find('.js-dropdown-toggle').html(itemHtml).click();
        }
    });


    /* Day Plan */
    $('body').on('click', '.js-plan-toggle-edit', function() {
        $('.edit-block:visible').hide();
        $(this).parents('.plan-container').find('.edit-block').show();
    });
    $('body').on('click', '.js-make-important', function() {
        $(this).toggleClass('checked');
    });
    $('body').on('click', '.js-make-completed', function() {
        var link = $(this);
        if (!link.hasClass('checked')) {
            link.siblings('.js-welldone').fadeIn(300);
            setTimeout(function() {
                link.addClass('checked');
                link.parents('.plan-item').addClass('done');
                link.siblings('.js-welldone').fadeOut(300);
            }, 1000);
        } else {
            link.removeClass('checked');
            link.parents('.plan-item').removeClass('done');
        }
    });
    $('body').on('input', '.js-input-hour', function() {
        if (($(this).val()).length == 2) {
            $(this).siblings('.js-input-minute').focus();
        }
    });
    $('body').on('click', '.js-edit-plan-submit', function() {
        var value = $(this).prev('.js-plan-desc-input').val();
        savePlanText($(this), value);
    });
    $('#js-show-more-plan').on({
        click: function(){
            // TODO - показать еще 5 дней
            $('.day-plan-more-wrap').show();
        }
    });
    //
    $('.js-edit-fpoint-submit').on({
        click: function(){
            var value = $(this).prev('.js-fpoint-desc-input').val();
            saveFpointText($(this), value);
        }
    });

    /* Show Block in Sidebar with interval */
    setInterval(function() {
        $('.js-interval-show').each(function() {
            var items = $(this).find('.interval-item'),
                active = items.filter('.active'),
                activeIndex = items.index( active ) + 1;

            if (activeIndex == items.length) {
                items.filter(':eq(0)').fadeIn(400).addClass('active');
            } else {
                active.next('.interval-item').fadeIn(400).addClass('active');
            }
            active.fadeOut(400).removeClass('active');
        });
    }, 10000)


    /* Custom Scrollbar */
    $('.js-mCustomScrollbar').mCustomScrollbar();


    /* Show block "new plan item" */
    $('.js-add-new-plan').on({
        click: function(){
            var addLink = $(this),
                newItemHtml = '<div class="plan-item new-item clearer-block js-new-plan-item">' +
                        '<div class="number fleft js-item-number"></div>' +
                        '<div class="plan-container fleft clearer-block">' +
                            '<div class="time-block with-clock fleft js-plan-toggle-edit js-time-slider-show js-time-text-value"><i class="icon-clock grey js-tooltip-toggle tooltip-clock" title="Укажите время события"></i></div>' +
                            '<div class="desc-block fleft text-overflow-hidden js-plan-toggle-edit js-plan-desc"></div>' +
                            '<div class="manage-block fright clearer-block">' +
                                '<a href="javascript:void(0)" class="link move text-hidden fleft js-move-item">Переместить</a>' +
                                '<a href="javascript:void(0)" class="link calendar text-hidden fleft js-show-calendar-wrap">Календарь</a>' +
                                '<i class="marker welldone fleft js-welldone" title="Молодец!"></i>' +
                                '<i class="marker completed fleft js-make-completed" title="Отметить сделанным"></i>' +
                                '<i class="marker important fleft js-make-important" title="Важное"></i>' +
                            '</div>' +

                            '<!-- Edit Plan Item -->' +
                            '<div class="input-container edit-block">' +
                                '<div class="input-wrap fleft clearer-block">' +
                                    '<div class="time-block with-clock fleft js-time-slider-show js-time-text-value"><i class="icon-clock white js-tooltip-toggle tooltip-clock" title="Укажите время события"></i></div>' +
                                    '<input class="input-text fleft js-plan-desc-input" value="" name="" type="text">' +
                                    '<input class="btn-flat btn-green fright js-edit-plan-submit" value="Сохранить" name="" type="button">' +
                                '</div>' +
                                '<div class="manage-block fright clearer-block">' +
                                    '<a href="javascript:void(0)" class="link calendar text-hidden fleft js-show-calendar-wrap">Календарь</a>' +
                                '</div>' +
                            '</div>' +

                            '<div class="time-slider-wrap js-time-slider-wrap">' +
                                '<div class="js-time-slider"></div>' +
                                '<div class="time-block clearer-block">' +
                                    '<input class="input-text fleft js-time-value-hour js-input-hour" value="" name="" type="text" maxlength="2">' +
                                    '<div class="colon fleft">:</div>' +
                                    '<input class="input-text fleft js-time-value-minute js-input-minute" value="" name="" type="text" maxlength="2">' +
                                '</div>' +
                                '<a href="javascript:void(0)" class="btn-flat btn-green btn-save-time fright js-save-time"></a>' +
                            '</div>' +
                            '<!-- END Edit Plan Item -->' +
                        '</div>' +
                        '<!-- Dropdown with Calendar -->' +
                        '<div class="small-calendar js-small-calendar" data-hideOnLeave="true">' +
                            '<i class="arrow"></i>' +
                            '<div class="action-wrap clearer-block">' +
                                '<a href="javascript:void(0)" class="fleft hex medium brown-light js-edit-popup" data-popupsection="sphera"></a>' +
                                '<a href="javascript:void(0)" class="link file text-hidden fleft js-edit-popup" data-popupsection="files">Файлы</a>' +
                                '<a href="javascript:void(0)" class="link people text-hidden fleft js-edit-popup" data-popupsection="members">Люди</a>' +
                                '<a href="javascript:void(0)" class="link comment text-hidden fleft js-edit-popup" data-popupsection="comments">Комментарии</a>' +
                                '<a href="javascript:void(0)" class="link clock text-hidden fleft js-edit-popup" data-popupsection="clock">Время</a>' +
                                '<a href="javascript:void(0)" class="link repeat text-hidden fleft">Повтор</a>' +
                            '</div>' +
                            '<div class="js-datepicker"></div>' +
                        '</div>' +
                        '<!-- END Dropdown with Calendar -->' +
                    '</div>';

            if (addLink.parents('.day-plan-wrap').find('.new-item').length == 0) {
                addLink.before(newItemHtml);
                var itemBlock = addLink.prev('.js-new-plan-item');
                initTimeSlider();
                itemBlock.find('.js-item-number').text(addLink.parents('.day-plan-wrap').children('.plan-item').length);
                itemBlock.find('.js-plan-toggle-edit.js-plan-desc').click();
                itemBlock.find('.js-plan-desc-input').focus();
                initDatepicker();
            }
        }
    });


    /* Time slider */
    initTimeSlider();
    $('body').on('click', '.js-time-slider-show', function() {
        var sliderValue = parseFloat($(this).parents('.plan-container').find('.js-time-slider').slider('option', 'value')),
            sliderValueStr = sliderValueToTime(sliderValue);

        $(this).parents('.plan-container').find('.js-time-value-hour').val(sliderValueStr['hour']);
        $(this).parents('.plan-container').find('.js-time-value-minute').val(sliderValueStr['min']);
        $(this).parents('.plan-container').find('.js-time-slider-wrap').show();
    });
    $('body').on('input', '.js-time-value-hour', function() {
        var hourValue = $(this).val();

        if (hourValue.length >= 2) {
            hourValue = parseInt(hourValue);

            if (isNaN(hourValue)) {
                $(this).val('00');
                hourValue = 0;
            }

            if (hourValue > 24) {
                hourValue = 24;
            }
            if ($(this).siblings('.js-time-value-minute').val() == '30') {
                hourValue += 0.5;
            }
            if (hourValue < 1.5) {
                hourValue += 24;
            }

            $(this).parents('.plan-container').find('.js-time-slider').slider('option', 'value', hourValue);
        }
    });
    $('body').on('input', '.js-time-value-minute', function() {
            var minuteValue = $(this).val(),
                hourValue = parseInt($(this).siblings('.js-time-value-hour').val());

            if (!isNaN(minuteValue) && minuteValue.length >= 2) {
                minuteValue = parseInt(minuteValue);

                if (isNaN(hourValue)) {
                    hourValue = 0;
                }

                if (minuteValue >= 30) {
                    minuteValue = 30;
                    hourValue += 0.5;
                } else {
                    minuteValue = '00';
                }

                if (hourValue < 1.5) {
                    hourValue += 24;
                }

            $(this).val(minuteValue);
            $(this).parents('.plan-container').find('.js-time-slider').slider('option', 'value', hourValue);
        }
    });


    /* Sortable */
    $('.js-sphera-sortable').sortable({
        items: '> .sphera-item',
        handle: '.js-move-sphera'
    });
    $('.js-plan-sortable').sortable({
        items: '> .day-plan-wrap > .plan-item',
        handle: '.js-move-item',
        placeholder: 'sortable-placeholder',
        stop: function( event, ui ) {
            $(event.target).find('.day-plan-wrap').each(function() {
                $(this).find('.js-item-number').each(function(i) {
                    $(this).text(i+1);
                });
            });
        }
    });
    /* focus point page*/
    $('.js-focus-point-sortable').sortable({
        items: '> .focus-point-item',
        handle: '.js-move-item',
        placeholder: 'sortable-placeholder'
    });

    /* Click outside of some blocks */
   $('body').on({
        click: function(e){
            var editPlanContainer = $('.edit-block:visible'),
                timeSliderContainer = $('.js-time-slider-wrap'),
                editPlanToggle = $('.js-plan-toggle-edit');
            if (!editPlanToggle.is(e.target) && !editPlanContainer.is(e.target) && editPlanContainer.has(e.target).length === 0 && !timeSliderContainer.is(e.target) && timeSliderContainer.has(e.target).length === 0){
                editPlanContainer.each(function() {
                    var item = $(this),
                        itemParent = item.parents('.plan-item'),
                        value = editPlanContainer.find('.js-plan-desc-input').val();
                    if (!itemParent.hasClass('new-item')) {
                        savePlanText(editPlanContainer.find('.js-edit-plan-submit'), value);
                        item.hide();
                    }
                });
            }
            //focus point
            var editFpointContainer = $('.fpoint-edit-block:visible'),
                editFpointToggle = $('.js-fpoint-toggle-edit');
            if (!editFpointToggle.is(e.target) && !editFpointContainer.is(e.target) && editFpointContainer.has(e.target).length === 0){
                var fPoitValue = editFpointContainer.find('.js-fpoint-desc-input').val();
                //savePlanText(editFpointContainer.find('.js-edit-fpoint-submit'), fPoitValue);
            }
            //END focus point
            var editSpheraContainer = $('.sphera-edit-block'),
                editSpheraToggle = $('.js-edit-sphera');
            if (!editSpheraToggle.is(e.target) && !editSpheraContainer.is(e.target) && editSpheraContainer.has(e.target).length === 0){
                editSpheraContainer.each(function() {
                    var item = $(this),
                        itemParent = item.parents('.sphera-item');
                    if (!itemParent.hasClass('new-item')) {
                        itemParent.removeClass('edit');
                        item.hide();
                    }
                });
            }
        }
    });
    $('.js-new-plan-item').on({
        click: function(e){
            e.stopPropagation();
        }
    });


    /* Send Invite (Member) */
    $('.js-btn-send-invite').on({
        click: function(){
            $(this).parent('.js-send-invite').hide();
            $(this).parent('.js-send-invite')[0].reset();
            $(this).parent('.js-send-invite').next('.js-send-invite-result').show();
        }
    });
    $('.js-send-more-invite').on({
        click: function(){
            $(this).parent('.js-send-invite-result').hide();
            $(this).parent('.js-send-invite-result').prev('.js-send-invite').show();
        }
    });


    /*  Comments  */
    $('.js-show-comments').on({
        click: function(){
            var listBlock = $(this).prev('.js-comments-list');
            // TODO - показать еще 5 комментов
        }
    });
    $('.js-show-comment-textarea').on({
        click: function(){
            var wrap = $(this).parents('.js-comment-wrap'),
                element = $(this);
            element.hide();
            wrap.find('.js-comment-textarea').show();
        }
    });
    $('.js-hide-comment-textarea').on({
        click: function(){
            var wrap = $(this).parents('.js-comment-wrap'),
                element = $(this).parents('.js-comment-textarea');
            element.hide();
            wrap.find('.js-show-comment-textarea').show();
        }
    });


    /* Files */
    $('.js-files-selectable').on({
        click: function(){
            $(this).toggleClass('selected');
        }
    });


    /* Check All */
    $('input.js-check-all').on({
        change: function(){
            var isCheck = $(this).is(':checked'),
                form = $(this).data('form');

            if (isCheck) {
                $('#' + form).find('.jq-checkbox').addClass('checked');
            } else {
                $('#' + form).find('.jq-checkbox').removeClass('checked');
            }
            $('#' + form).find('input.js-check-item').prop('checked', isCheck);
        }
    });
    $('input.js-check-item').on({
        change: function(){
            var form = $(this).data('form'),
                checkboxCount = $('#' + form).find('input.js-check-item').length,
                checkedCount = $('#' + form).find('input.js-check-item:checked').length,
                checkAllInput = $('#' + form).find('input.js-check-all'),
                checkAllWrap = $('#' + form).find('.jq-checkbox.js-check-all');

            if (checkedCount == checkboxCount) {
                checkAllWrap.addClass('checked');
                checkAllInput.prop('checked', true);
            } else {
                checkAllWrap.removeClass('checked');
                checkAllInput.prop('checked', false);
            }
        }
    });


    /* Save */
    $('body').on('click', '.js-save-time', function() {
        var wrap = $(this).parents('.js-time-slider-wrap'),
            hour = wrap.find('.js-time-value-hour').val(),
            min = wrap.find('.js-time-value-minute').val(),
            planWrap = $(this).parents('.plan-container'),
            moveLink = planWrap.find('.js-move-item');

        if (moveLink.length > 0) {
            moveLink.remove();
        }

        planWrap.find('.js-time-text-value').text(hour + ':' + min).removeClass('with-clock');
        wrap.hide();
    });
    /* Focus point page */
    $('.js-open-edit-focus-point-dialog').on({
        click: function(){
            $('#js-edit-focus-point-dialog').dialog('open');
        }
    });
    $('.js-fpoint-toggle-edit').on({
        click: function(){
            $('.fpoint-edit-block:visible').hide();
            $(this).parents('.focus-point-container').find('.fpoint-edit-block').show();
        }
    });

    //main slider button
    var setButtons = function () {
        var slideShow = $(".slides-wrap");
        // кнопки старт и стоп
        var startSlider = $(".slider-play");
        var spButton = $('.toggleStarPause');
        startSlider.on({
            click: function(){
                slideShow.cycle('destroy');
                slideShow.cycle({
                    timeout:  15000,
                    fx:      'scrollHorz',
                    next:     '.slide-right, .slider-right-control',
                    prev:     '.slide-left, .slider-left-control'
                });
                $(this).hide().next().show();
            }
        });
        spButton.on({
            click: function(){
                slideShow.cycle('resume');
            }
        });
        var stopSlider = $(".slider-pause");
        stopSlider.on({
            click: function(){
                slideShow.cycle('pause');
                $(this).hide().prev().show();
                $(this).prev().addClass("toggleStarPause");
            }
        });
        //кнопки по порядку и вразброс
        var slideRandom = $(".slider-random");
        slideRandom.click(function(){
            startSlider.hide();
            stopSlider.show();
            slideShow.cycle('destroy');
            slideShow.cycle({
                timeout:  15000,
                delay: -15000,
                fx:      'scrollHorz',
                next:     '.slide-right, .slider-right-control',
                prev:     '.slide-left, .slider-left-control',
                random: 1
            });
            $(this).hide().next().show();
        });
        var inCourse = $(".slider-in-course");
        inCourse.click(function(){
            slideShow.cycle('destroy');
            slideShow.cycle({
                timeout:  15000,
                delay: -15000,
                fx:      'scrollHorz',
                next:     '.slide-right, .slider-right-control',
                prev:     '.slide-left, .slider-left-control',
                random: 0
            });
            $(this).hide().prev().show();
        });

    }
    //Full Screen coding
    function fullScreenOpen () {
        var contentSlider = $(".focus-point-slider-box").html();
        var controlFullScreen = "<ul class='fs-controls-list'>" +
                                    "<li class='fs-control play-fs'>" +
                                        "<a>Play</a>" +
                                    "</li>" +
                                    "<li class='fs-control pause-fs'>" +
                                        "<a>Play</a>" +
                                    "</li>" +
                                    "<li class='fs-control exit-fs'>" +
                                        "<a>Exit Full screen</a>" +
                                    "</li>" +
                                  "</ul>";
        $(".full-screen-slider").replaceWith("" +
            "<div class='overlay-full-screen'>" +
                "<div class='tip-full-screen'>"+
                    "<i class='close-tip js-tooltip-toggle tooltip-standart' title='Закрыть подсказку'>X</i>"+
                    "<div class='tip-align-center-bt'>"+
                        "<div class='tip-align-center-btc'>"+

                        "<p>Вы включили полноэкранный режим.<br/> Нажмите Esc, чтобы выйти из него.</p>"+

                        "</div>"+
                    "</div>"+
                "</div>"+
                "<i class='fs-logosite'>Aim</i>"+
            controlFullScreen +
            "<div class='focus-point-slider-box'>"+
            contentSlider +
            "</div>"+
            "</div>"+
            "</div>"+
            "</div>"+
            "</div>" +
            "");
        $(".full-screen-open").click(function(){
            $("body").css({
                overflow: 'hidden'
            });
            $(".overlay-full-screen").css({
                visibility: 'visible'
            });
            $(".slides-wrap").cycle('destroy');
            if ( $('.slider-play').is(':visible') ) {

                $(".pause-fs").css('display', 'none');
                $(".play-fs").css('display', 'inline-block');

                $(".slides-wrap").cycle({
                    fx:      'scrollHorz',
                    timeout:  0,
                    speed:    500,
                    next:     '.slide-right',
                    prev:     '.slide-left'
                });
            } else {

                $(".pause-fs").css('display', 'inline-block');
                $(".play-fs").css('display', 'none');

                $(".slides-wrap").cycle({
                    fx:      'scrollHorz',
                    timeout:  15000,
                    speed:    500,
                    next:     '.slide-right',
                    prev:     '.slide-left'
                });
            }

            $('body').keyup(function(eventObject){
                if (eventObject.which == 27) {
                    $("body").css({
                        overflow: 'auto'
                    });
                    $(".overlay-full-screen").css({
                        visibility: 'hidden'
                    });
                }
                if (eventObject.which == 39) {
                    $(".slides-wrap").cycle('next');
                }
                if (eventObject.which == 37) {
                    $(".slides-wrap").cycle('prev');
                }
            });

            var startSliderFs = $(".play-fs");
            startSliderFs.on({
                click: function(){
                    $(".slider-play").hide().next().show();
                    $(".slides-wrap").cycle('destroy');
                    $(".slides-wrap").cycle({
                        timeout:  15000,
                        fx:      'scrollHorz',
                        next:     '.slide-right, .slider-right-control',
                        prev:     '.slide-left, .slider-left-control'
                    });
                    $(this).hide().next().show();
                }
            });
            var spButtonFs = $('.toggleStarPause');
            spButtonFs.on({
                click: function(){
                    $(".slides-wrap").cycle('resume');
                }
            });
            var stopSliderFs = $(".pause-fs");
            stopSliderFs.on({
                click: function(){
                    $(".slider-pause").hide().prev().show();
                    $(".slides-wrap").cycle('pause');
                    $(this).hide().prev().show();
                    $(this).prev().addClass("toggleStarPause");
                }
            });
            $(".exit-fs").on({
                click: function(){
                    $("body").css({
                        overflow: 'auto'
                    });
                    $(".overlay-full-screen").css({
                        visibility: 'hidden'
                    });
                }
            })
        });
    }
    $(".slides-wrap").cycle({
        fx:      'scrollHorz',
        timeout:  0,
        speed:    500,
        next:     '.slide-right, .slider-right-control',
        prev:     '.slide-left, .slider-left-control'
    });
    setButtons();
    fullScreenOpen();
    /* Tip Full Screen */
    $('.close-tip').on('click', function () {
        $(this).parent().fadeOut(200);
    });

});

/* Init datepicker */
function initDatepicker() {
    $('.js-datepicker').each(function() {
        var element = $(this);
        if (!element.hasClass('initialized')) {
            element.datepicker({
                firstDay: 1,
                showOtherMonths: true,
                selectOtherMonths: true,
                nextText: "Следующий",
                prevText: "Предыдущий",
                currentText: "Сегодня",
                dayNames: [ "Понедельник", "Вторник", "Среда", "Четверг", "Пятницы", "Суббота", "Воскресенье" ],
                dayNamesMin: [ "Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс" ],
                dayNamesShort: [ "Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс" ],
                monthNames: [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ],
                monthNamesShort: [ "Янв", "Фев", "Март", "Апр", "Май", "Июнь", "Июль", "Авг", "Сент", "Окт", "Нояб", "Дек" ]
            }).addClass('initialized');
        }
    });
}

/* Init Time slider */
function initTimeSlider() {
    $('.js-time-slider').each(function() {
        var element = $(this);
        if (!element.hasClass('initialized')) {
            element.slider({
                value:6, // start - 1:30, default value - 6:00
                min:  1.5,   // start - 1:30
                max:  25,  // finish - 1:00
                step: 0.5,
                create: function( event, ui ) {
                    var sliderDiv = $(event.target),
                        hour = sliderDiv.data('time-hour'),
                        minute = sliderDiv.data('time-minute');

                    if (typeof hour != 'undefined' && typeof minute != 'undefined') {
                        var value = timeToSliderValue(parseInt(hour), parseInt(minute));

                        sliderDiv.slider('option', 'value', value);
                    }
                },
                slide: function( event, ui ) {
                    var value = ui.value,
                        sliderValueStr = sliderValueToTime(value);

                    $(ui.handle).parent().next().find('.js-time-value-hour').val(sliderValueStr['hour']);
                    $(ui.handle).parent().next().find('.js-time-value-minute').val(sliderValueStr['min']);
                }
            }).addClass('initialized');
        }
    });
}

function sliderValueToTime(value) {
    var resultArray = [];

    if (value >= 24) value -= 24;

    if (value % 1 == 0) {
        resultArray['hour'] = value;
        resultArray['min'] = '00';
    } else {
        resultArray['hour'] = value - 0.5;
        resultArray['min'] = 30;
    }

    if (value < 10) {
        resultArray['hour'] = '0' + resultArray['hour'];
    }
    return resultArray;
}

function timeToSliderValue(hour, min) {
    var hourValue = hour;

    if (min >= 30) {
        hourValue += 0.5;
    }

    if (hourValue < 1.5) {
        hourValue += 24;
    }

    return hourValue;
}

function savePlanText(btn, value) {
    var itemWrap = btn.parents('.plan-item'),
        textWrap = btn.parents('.plan-container').find('.js-plan-desc');
    if (value != '') {
        textWrap.text(value);
        itemWrap.removeClass('new-item');
        btn.parents('.edit-block').hide();
    } else {
        btn.siblings('.js-plan-desc-input').val(textWrap.text());
    }

    if (value == '' && itemWrap.hasClass('new-item')) {
        itemWrap.remove();
    }
}