$(document).ready(function () {

    var inputs = $('.search_input');
    var hasTemplate = false;
    $(document).on('blur', '.search_input', function (e) {
        var value = $(this).val();
        var name = $(this).attr('name');
        var this_elem = $(this);
        var path = window.location.pathname;
        var controller;
        var _controller;
        var action;
        var all_columns = [];
        var all = [];

        $(this).closest("tr").find("input").each(function (i, elem) {
            all_columns[i] = $(elem).attr("name");
        });


        $(this).closest("#listWidget").find('th').each(function (i, elem) {
            all[i] = $(elem).attr('id');
        });

        if ($(this).closest('#listWidget').find('.templates').length > 0) {
            hasTemplate = true;
        }

        // general data ..
        if (e.keyCode == 8 && $(this).val() == '') {

            var data = {
                "hasTemplate": hasTemplate,
                "column_name": '',
                "column_value": '',
                "all": all,
                "all_columns": all_columns
            }

        } else {
            var data = {
                "hasTemplate": hasTemplate,
                "column_name": name,
                "column_value": value,
                "all": all,
                "all_columns": all_columns
            }

        }

        if (path.indexOf('/') > -1) {
            controller = path.split('/')[3];
            _controller = path.split('/')[3];
        } else {
            controller = path;
            _controller = path;
        }

        $.ajax({
            url: '../' + controller + '/searchmodel',
            data: {
                data: data,
                controller: controller,
                _controller: _controller,
                action: "actionSearchModel",
            },
            method: 'POST',
            dataType: 'html',
            success: function (data) {
                $('.i').remove();
                this_elem.parents('#listWidget').find('#search').after(data);

            },
            error: function (err) {
                alert(err.responseText);
            }
        });

    });

});