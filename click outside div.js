jQuery('html').click(function (e) {
            if (e.target.id == 'wpcs_handle') {
                e.stopPropagation();
            } else {
                jQuery('.wpcs-slide-out-div .wpcs_scroll_div').slideUp(800);
            }
        });